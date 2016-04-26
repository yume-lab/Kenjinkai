<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\Exception\RecordNotFoundException;

/**
 * CommunityThreads Controller
 *
 * @property \App\Model\Table\CommunityThreadsTable $CommunityThreads
 */
class CommunityThreadsController extends AppController
{

   /**
     * Initialization method.
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadModel('Communities');
        $this->loadModel('UserCommunities');
        $this->loadModel('ThreadCategories');
        $this->loadModel('ThreadMessages');

        $this->loadComponent('SecurityUtil');
    }

    /**
     * メッセージやり取り
     *
     * @param string|null $id Community Thread id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function messages($id)
    {
        try {
            $thread = $this->CommunityThreads->get($id, [
                'contain' => [
                    'Communities',
                    'Users',
                    'Users.UserProfiles'
                ]
            ]);
        } catch (RecordNotFoundException $ex) {
            $this->Flash->error(__('スレッドが存在しません。'));
            return $this->redirect('/');
        }

        $communityId = $thread->community->id;
        if (!$this->UserCommunities->hasBelong($communityId, $this->user['id'])) {
            $this->Flash->error(__('コミュニティに入会しないとスレッドは表示できません。'));
            $this->redirect(['controller' => 'communities', 'action' => 'view', $communityId]);
        }

        $message = $this->ThreadMessages->newEntity();
        if ($this->request->is(['post'])) {
            $data = $this->request->data;
            $ua = $this->request->env('HTTP_USER_AGENT');
            $ip = $this->request->clientIp();
            $data = array_merge($data, [
                'user_id' => $this->user['id'],
                'ip_address' => $ip,
                'user_agent' => $ua
            ]);
            $this->ThreadMessages->write($id, $data);
            $this->Flash->success(__('メッセージを投稿しました！'));
        }
        // APIのセキュリティ用
        $encrypts = [
            'communityId' => $this->SecurityUtil->encrypt($communityId),
            'threadId' => $this->SecurityUtil->encrypt($thread->id),
        ];

        $this->set(compact('thread', 'message', 'encrypts'));
    }

    /**
     * スレ立てアクション.
     * @param int $communityId スレを立てるコミュニティID
     */
    public function add($communityId)
    {
        if (!$this->__validateBeforeAdd($communityId)) {
            return $this->redirect('/');
        }

        $thread = $this->CommunityThreads->newEntity();
        $categories = $this->ThreadCategories->find('list')->toArray();
        $community = $this->Communities->get($communityId);
        if ($this->request->is('post')) {
            $data = array_merge($this->request->data, [
                'community_id' => $community->id,
                'user_id' => $this->user['id'],
                'is_deleted' => false
            ]);
            $thread = $this->CommunityThreads->patchEntity($thread, $data);
            if ($this->CommunityThreads->save($thread)) {
                $this->Flash->success(__('スレッドが作成されました！'));
                return $this->redirect(['controller' => 'Communities', 'action' => 'view', $communityId]);
            } else {
                $this->Flash->error(__('スレッドの作成に失敗しました。'));
            }
        }
        $this->set(compact('thread', 'community', 'categories'));
    }

    private function __validateBeforeAdd($communityId) {
        $exists = $this->Communities->exists(['id' => $communityId]);
        if (!$exists) {
            $this->Flash->error(__('存在しないコミュニティにスレッドは作成できません。'));
            return false;
        }

        if (!$this->UserCommunities->hasBelong($communityId, $this->user['id'])) {
            $this->Flash->error(__('未参加のコミュニティにスレッドは作成できません。'));
            return false;
        }

        return true;
    }

}
