<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;

/**
 * CommunityImages Controller
 * コミュニティ画像取得コントローラー
 *
 * @property \App\Model\Table\CommunityImagesTable $CommunityImages
 */
class CommunityImagesController extends AppController
{

    var $autoRender = false;

    /**
     * Initialization method.
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Images');
    }

    /**
     * コミュニティのメイン画像を取得します.
     *
     * @param string $hash コミュニティ画像のハッシュ
     * @return response 画像レスポンス
     */
    public function main($hash)
    {
        if (empty($hash)) {
            throw new NotFoundException();
        }

        $image = $this->CommunityImages->findByHash($hash);

        $dir = $this->Images->getDirectory($image['community_id'], 'community');
        $name = 'thumbnail' . '.' . $image['extension'];
        $path = $dir.$name;

        $this->response->header([
            'Content-type: '.$image['mime_type']
        ]);
        $this->response->type($image['extension']);
        $this->response->body(function () use ($path) {
            return file_get_contents($path);
        });
    }


}
