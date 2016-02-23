<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\ORM\TableRegistry;

/**
 * Images component
 * 画像処理のコンポーネント
 */
class ImagesComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    /**
     * 画像保存先パス
     */
    private $__DIR_TABLE = [
        'community' => COMMUNITY_IMAGE_PATH,
        'profile' => PROFILE_IMAGE_PATH,
    ];


    /**
     * コミュニティのサムネイル画像を保存します.
     *
     * @param int $communityId コミュニティID
     * @param array $upload アップロード画像情報
     */
    public function saveCommunity($communityId, $upload)
    {

        /** @var \App\Model\Table\CommunityImagesTable $CommunityImages */
        $CommunityImages = TableRegistry::get('CommunityImages');
        $CommunityImages->upload($communityId, $upload);
    }

    /**
     * アップロードされた画像を保存します.
     *
     * @param string $type 保存する画像の種別
     * @param array $upload アップロード画像情報
     *      name: 画像のオリジナル名
     *      type: mimeタイプの
     *      size: ファイルサイズ(バイト)
     *      tmp_name: 一時保存時のディレクトリ名
     */
    private function __saveImage($type, $hash, $primaryId, $upload)
    {
        $dir = $this->__getDirectory($primaryId, $type);
        move_uploaded_file($upload['tmp_name'], $path . DS . $image['name']);
    }

    private function __getDirectory($primaryId, $type)
    {
        $path = $this->__DIR_TABLE[$type];
        $path = $path . DS . $primaryId;
        if (!file_exists($path)) {
            mkdir($path, 0777);
        }
        chmod($path, 0777);
        return $path;
    }

}
