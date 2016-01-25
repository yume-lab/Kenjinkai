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
        if ($this->request->is(['get'])) {
            $id = $this->request->query('id');

            /** @var \App\Model\Table\ReviewCommunitiesTable $ReviewCommunities */
            $ReviewCommunities = parent::loadTable('ReviewCommunities');
            $data = $ReviewCommunities->get($id);

            /** @var \App\Model\Table\UsersTable $Users */
            $Users = parent::loadTable('Users');
            $user = $Users->get($data->user_id, ['contain' => 'UserProfiles'])->toArray();
            $sender = array_merge($user, array_shift($user['user_profiles']));
            unset($user['user_profiles']);

            $this->set(compact('data', 'sender'));
            return $this->render('index');
        }
    }

}
