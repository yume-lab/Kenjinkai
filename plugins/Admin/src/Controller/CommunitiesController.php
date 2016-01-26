<?php
namespace Admin\Controller;

use Admin\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Communities Controller
 * コミュニティ関連コントローラー
 *
 * @property \Admin\Model\Table\CommunitiesTable $Communities
 * @property \Admin\Model\Table\ReviewCommunitiesTable $ReviewCommunities
 */
class CommunitiesController extends AppController
{
    /**
     * 審査待ちコミュニティ一覧のActionです.
     */
    public function review()
    {
        $this->paginate = ['limit' => 10]; // TODO: configに
        $reviews = $this->paginate($this->Communities->findInReview());

        if ($this->request->is(['post'])) {
            /** @var \Admin\Model\Table\ReviewCommunitiesTable $ReviewCommunities */
            $ReviewCommunities = TableRegistry::get('Admin.ReviewCommunities');

            $data = $this->request->data;
            $this->log($data);

            $communityId = $data['id'];
            $this->Communities->updateStatusByAlias($communityId, $data['alias']);
            $ReviewCommunities->updateComment($communityId, $data['comment']);
        }

        $this->set(compact('reviews'));
        $this->set('_serialize', ['reviews']);
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('communities', $this->paginate($this->Communities));
        $this->set('_serialize', ['communities']);
    }

    /**
     * View method
     *
     * @param string|null $id Community id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $community = $this->Communities->get($id, [
            'contain' => []
        ]);
        $this->set('community', $community);
        $this->set('_serialize', ['community']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $community = $this->Communities->newEntity();
        if ($this->request->is('post')) {
            $community = $this->Communities->patchEntity($community, $this->request->data);
            if ($this->Communities->save($community)) {
                $this->Flash->success(__('The community has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The community could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('community'));
        $this->set('_serialize', ['community']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Community id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $community = $this->Communities->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $community = $this->Communities->patchEntity($community, $this->request->data);
            if ($this->Communities->save($community)) {
                $this->Flash->success(__('The community has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The community could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('community'));
        $this->set('_serialize', ['community']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Community id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $community = $this->Communities->get($id);
        if ($this->Communities->delete($community)) {
            $this->Flash->success(__('The community has been deleted.'));
        } else {
            $this->Flash->error(__('The community could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
