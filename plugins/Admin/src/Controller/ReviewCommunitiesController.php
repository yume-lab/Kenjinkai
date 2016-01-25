<?php
namespace Admin\Controller;

use Admin\Controller\AppController;

/**
 * ReviewCommunities Controller
 * コミュニティ審査コントローラー.
 *
 * @property \Admin\Model\Table\ReviewCommunitiesTable $ReviewCommunities
 */
class ReviewCommunitiesController extends AppController
{

    /**
     * 一覧表示
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = ['limit' => 10]; // TODO: configに
        $reviews = $this->paginate($this->ReviewCommunities->findInReview());
        $this->set(compact('reviews'));
        $this->set('_serialize', ['reviews']);
    }

    /**
     * View method
     *
     * @param string|null $id Review Community id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $reviewCommunity = $this->ReviewCommunities->get($id, [
            'contain' => ['Users', 'CommunityStatuses']
        ]);
        $this->set('reviewCommunity', $reviewCommunity);
        $this->set('_serialize', ['reviewCommunity']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $reviewCommunity = $this->ReviewCommunities->newEntity();
        if ($this->request->is('post')) {
            $reviewCommunity = $this->ReviewCommunities->patchEntity($reviewCommunity, $this->request->data);
            if ($this->ReviewCommunities->save($reviewCommunity)) {
                $this->Flash->success(__('The review community has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The review community could not be saved. Please, try again.'));
            }
        }
        $users = $this->ReviewCommunities->Users->find('list', ['limit' => 200]);
        $communityStatuses = $this->ReviewCommunities->CommunityStatuses->find('list', ['limit' => 200]);
        $this->set(compact('reviewCommunity', 'users', 'communityStatuses'));
        $this->set('_serialize', ['reviewCommunity']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Review Community id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $reviewCommunity = $this->ReviewCommunities->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $reviewCommunity = $this->ReviewCommunities->patchEntity($reviewCommunity, $this->request->data);
            if ($this->ReviewCommunities->save($reviewCommunity)) {
                $this->Flash->success(__('The review community has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The review community could not be saved. Please, try again.'));
            }
        }
        $users = $this->ReviewCommunities->Users->find('list', ['limit' => 200]);
        $communityStatuses = $this->ReviewCommunities->CommunityStatuses->find('list', ['limit' => 200]);
        $this->set(compact('reviewCommunity', 'users', 'communityStatuses'));
        $this->set('_serialize', ['reviewCommunity']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Review Community id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $reviewCommunity = $this->ReviewCommunities->get($id);
        if ($this->ReviewCommunities->delete($reviewCommunity)) {
            $this->Flash->success(__('The review community has been deleted.'));
        } else {
            $this->Flash->error(__('The review community could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
