<?php
namespace Admin\Controller;

use Admin\Controller\AppController;

/**
 * Informations Controller
 *
 * @property \Admin\Model\Table\InformationsTable $Informations
 */
class InformationsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('informations', $this->paginate($this->Informations));
        $this->set('_serialize', ['informations']);
    }

    /**
     * View method
     *
     * @param string|null $id Information id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $information = $this->Informations->get($id, [
            'contain' => []
        ]);
        $this->set('information', $information);
        $this->set('_serialize', ['information']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $information = $this->Informations->newEntity();
        if ($this->request->is('post')) {
            $information = $this->Informations->patchEntity($information, $this->request->data);
            if ($this->Informations->save($information)) {
                $this->Flash->success(__('The information has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The information could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('information'));
        $this->set('_serialize', ['information']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Information id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $information = $this->Informations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $information = $this->Informations->patchEntity($information, $this->request->data);
            if ($this->Informations->save($information)) {
                $this->Flash->success(__('The information has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The information could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('information'));
        $this->set('_serialize', ['information']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Information id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $information = $this->Informations->get($id);
        if ($this->Informations->delete($information)) {
            $this->Flash->success(__('The information has been deleted.'));
        } else {
            $this->Flash->error(__('The information could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
