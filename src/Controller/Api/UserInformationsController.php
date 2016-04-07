<?php
namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\I18n\Time;

/**
 * UserInformations Controller
 * お知らせ更新系API
 *
 * @property \App\Model\Table\UserInformationsTable $UserInformations
 */
class UserInformationsController extends AppController
{
    var $autoRender = false;

    /**
     * 既読処理を行います.
     *
     * @param string|null $id User Information id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function read()
    {
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->log(print_r($this->request->data, true));
            $id = $this->request->data['id'];
            $userInformation = $this->UserInformations->get($id, [
                'contain' => []
            ]);
            if ($userInformation->read_date) {
                echo json_encode(['success' => 'not unread']);
            } else {
                $userInformation = $this->UserInformations->patchEntity($userInformation, ['read_date' => new Time()]);
                $result = $this->UserInformations->save($userInformation);
                echo json_encode(['success' => $result]);
            }
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id User Information id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userInformation = $this->UserInformations->get($id);
        if ($this->UserInformations->delete($userInformation)) {
            $this->Flash->success(__('The user information has been deleted.'));
        } else {
            $this->Flash->error(__('The user information could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
