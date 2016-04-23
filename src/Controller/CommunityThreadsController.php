<?php
namespace App\Controller;

use App\Controller\AppController;

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
        $thread = $this->CommunityThreads->get($id, [
            'contain' => [
                'Communities',
                'Users',
                'Users.UserProfiles'
            ]
        ]);
        $message = $this->ThreadMessages->newEntity();

        $messages = $this->ThreadMessages->messages($id);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->data;
            $ua = $this->request->env('HTTP_USER_AGENT');
            $ip = $this->request->clientIp();
            $data = array_merge($data, [
                'user_id' => $this->user['id'],
                'ip_address' => $ip,
                'user_agent' => $ua
            ]);
            $this->ThreadMessages->write($id, $data);
        }

        $this->set(compact('thread', 'message', 'messages'));
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

        $checkDefaultOptions = [
            'UserCommunities.community_id' => $communityId,
            'UserCommunities.user_id' => $this->user['id'],
            'UserCommunities.is_deleted' => false
        ];
        $belongsTo = $this->UserCommunities->exists($checkDefaultOptions);
        if (!$belongsTo) {
            $this->Flash->error(__('未参加のコミュニティにスレッドは作成できません。'));
            return false;
        }

        return true;
    }

}
