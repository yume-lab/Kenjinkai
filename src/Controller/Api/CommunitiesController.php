<?php
namespace App\Controller\Api;

use App\Controller\AppController;

/**
 * Communities Controller
 *
 * @property \App\Model\Table\CommunitiesTable $Communities
 */
class CommunitiesController extends AppController
{
    /**
     * Initialization method.
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('UserCommunities');

        $this->loadComponent('Images');
    }

    /**
     * TODO: 使ってないかも
     * コミュニティ情報操作API
     */
    public function index()
    {
        $this->viewBuilder()->layout('');
        if ($this->request->is(['get'])) {
            $id = $this->request->query('id');

            $data = $this->Communities->findDetails($id);
            $this->set(compact('data'));
            return $this->render('index');
        }
    }

    public function message() {
        $this->viewBuilder()->layout('');
        if ($this->request->is(['get'])) {
            $id = $this->request->query('thread_id');
            $sequence = $this->request->query('sequence'); // これよりも後の物をとりにいく

            // TODO: 取得処理
            $messages = [
                [
                    'thread_id' => '3',
                    'user_id' => '9',
                    'nickname' => 'てすとてすと',
                    'sequence' => '1',
                    'content' => 'ああああああ<br/>',
                    'parent_id' => '0',
                    'posted' => '2016-04-13 05:00:00'
                ],
            ];

            $this->set('messages', $messages);
            return $this->render('message');
        }
    }

}
