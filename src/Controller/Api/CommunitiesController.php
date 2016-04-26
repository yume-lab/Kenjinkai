<?php
namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\Network\Exception\ForbiddenException;

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
        $this->loadModel('ThreadMessages');

        $this->loadComponent('Images');
        $this->loadComponent('SecurityUtil');
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

    /**
     * メッセージエリア取得API
     */
    public function message() {
        $this->viewBuilder()->layout('');
        if ($this->request->is(['get'])) {
            $communityId = $this->SecurityUtil->decrypt($this->request->query('cid'));
            $threadId = $this->SecurityUtil->decrypt($this->request->query('tid'));

            $checkDefaultOptions = [
                'UserCommunities.community_id' => $communityId,
                'UserCommunities.user_id' => $this->user['id'],
                'UserCommunities.is_deleted' => false
            ];
            $belongsTo = $this->UserCommunities->exists($checkDefaultOptions);
            if (!$belongsTo) {
                throw new ForbiddenException();
            }

            $messages = $this->ThreadMessages->messages($threadId);

            $this->set('messages', $messages);
            $this->set('userId', $this->user['id']);
            return $this->render('message');
        }
    }

}
