<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;

/**
 * Mypage Controller
 *
 * マイページ、プロフィール編集コントローラー.
 */
class MypageController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        /** @var \App\Model\Table\UsersTable $Users */
        $Users = parent::loadTable('Users');
        $user = $Users->get($this->user['id'], [
            'contain' => [
                'UserProfiles',
                'UserHometowns'
            ]
        ]);
        /** @var \App\Model\Table\AdAddressTable $AdAddress */
        $AdAddress = parent::loadTable('AdAddress');
        $prefectures = $AdAddress->getOptions();

        $genders = Configure::read('Define.genders');

        $this->set(compact('user', 'prefectures', 'genders'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Mypage id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $mypage = $this->Mypage->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $mypage = $this->Mypage->patchEntity($mypage, $this->request->data);
            if ($this->Mypage->save($mypage)) {
                $this->Flash->success(__('The mypage has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The mypage could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('mypage'));
        $this->set('_serialize', ['mypage']);
    }

}
