<?php
namespace Admin\Controller;

use Admin\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Communities Controller
 * コミュニティ関連コントローラー
 *
 * @property \App\Model\Table\CommunitiesTable $Communities
 * @property \App\Model\Table\ReviewCommunitiesTable $ReviewCommunities
 */
class CommunitiesController extends AppController
{

    /**
     * 審査待ちコミュニティ一覧のActionです.
     */
    public function review()
    {
        $this->loadModel('Communities');
        $this->loadModel('ReviewCommunities');
        $this->loadModel('UserInformations');

        $this->paginate = ['limit' => 10]; // TODO: configに
        $reviews = $this->paginate($this->Communities->findInReview());
        if ($this->request->is(['post'])) {
            $data = $this->request->data;
            $this->log($data);

            $communityId = $data['id'];
            $this->Communities->updateStatusByAlias($communityId, $data['alias']);
            $this->ReviewCommunities->updateComment($communityId, $data['comment']);

            $info = $this->ReviewCommunities->findByCommunityId($communityId);
            $path = sprintf('/community/review/%s', $data['alias']);
            $this->UserInformations->send($info->user_id, $path);
        }

        $this->set(compact('reviews'));
        $this->set('_serialize', ['reviews']);
    }

}
