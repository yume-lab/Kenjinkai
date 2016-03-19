<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * UserImages Controller
 * ユーザープロフィール画像取得コントローラー
 *
 * @property \App\Model\Table\UserImagesTable $UserImages
 */
class UserImagesController extends AppController
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
     * プロフィール画像を取得します.
     *
     * @param string $hash プロフィール画像のハッシュ
     * @return response 画像レスポンス
     */
    public function main($hash)
    {
        if (empty($hash)) {
            throw new NotFoundException();
        }

        $image = $this->UserImages->findByHash($hash);

        $dir = $this->Images->getDirectory($image['user_id'], 'profile');
        $name = $image['hash'] . '.' . $image['extension'];
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
