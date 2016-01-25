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

}
