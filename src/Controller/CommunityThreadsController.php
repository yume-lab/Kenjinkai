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
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Communities', 'Users']
        ];
        $communityThreads = $this->paginate($this->CommunityThreads);

        $this->set(compact('communityThreads'));
        $this->set('_serialize', ['communityThreads']);
    }

    /**
     * View method
     *
     * @param string|null $id Community Thread id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $thread = $this->CommunityThreads->get($id, [
            'contain' => ['Communities', 'Users']
        ]);

        $this->set('thread', $thread);
        $this->set('_serialize', ['communityThread']);
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
        if ($this->request->is('post')) {
            $data = array_merge($this->request->data, [
                'community_id' => $communityId,
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
        $this->set(compact('thread', 'communityId'));
        $this->set('_serialize', ['communityThread']);
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
