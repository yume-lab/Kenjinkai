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
     * Initialization method.
     * コンポーネントのロードなど.
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Notification');
    }

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

            $communityId = $data['id'];
            $comment = empty($data['comment']) ? '' : str_replace("\r\n", '<br/>', $data['comment']);
            $this->Communities->updateStatusByAlias($communityId, $data['alias']);
            $this->ReviewCommunities->updateComment($communityId, $comment);

            $info = $this->ReviewCommunities->findByCommunityId($communityId);
            $path = sprintf('/community/review/%s', $data['alias']);

            $url = sprintf('/communities/init/%d', $communityId);

            $this->Notification->addParameter('[[community.init.id]]', $communityId);
            $this->Notification->addParameter('[[community.review.comment]]', $comment);
            $this->Notification->send($info->user_id, $path);
        }

        $this->set(compact('reviews'));
        $this->set('_serialize', ['reviews']);
    }

}
