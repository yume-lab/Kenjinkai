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
     *      name: 画像のオリジナル名
     *      type: mimeタイプ
     *      size: ファイルサイズ(バイト)
     *      tmp_name: 一時保存時のディレクトリ名
     */
    public function saveCommunity($communityId, $upload)
    {
        /** @var \App\Model\Table\CommunityImagesTable $CommunityImages */
        $CommunityImages = TableRegistry::get('CommunityImages');
        $image = $CommunityImages->upload($communityId, $upload);
        if (!$image) {
            // TODO: 何かしらのエラー
            throw new Exception();
        }
        $fileName = $image['hash'] . '.' . $image['extension'];
        $dir = $this->getDirectory($image['community_id'], 'community');
        move_uploaded_file($upload['tmp_name'], $dir.$fileName);
    }

    /**
     * ユーザーのプロフィール画像を保存します.
     *
     * @param int $userId ユーザーID
     * @param array $upload アップロード画像情報
     *      name: 画像のオリジナル名
     *      type: mimeタイプ
     *      size: ファイルサイズ(バイト)
     *      tmp_name: 一時保存時のディレクトリ名
     */
    public function saveProfile($userId, $upload)
    {
        /** @var \App\Model\Table\UserImagesTable $UserImages */
        $UserImages = TableRegistry::get('UserImages');
        $image = $UserImages->upload($userId, $upload);
        if (!$image) {
            // TODO: 何かしらのエラー
            return false;
        }
        $fileName = $image['hash'] . '.' . $image['extension'];
        $dir = $this->getDirectory($image['user_id'], 'profile');
        move_uploaded_file($upload['tmp_name'], $dir.$fileName);
    }

    /**
     * 画像を保存するディレクトリを取得します.
     * 存在しなければ作成します.
     *
     * @param int $primaryId 元になるデータの主キー
     * @param string $type 画像の種別
     * @return string ディレクトリのパス
     */
    public function getDirectory($primaryId, $type)
    {
        $path = $this->__DIR_TABLE[$type];
        $path = $path . DS . $primaryId;
        $recursive = true;
        if (!file_exists($path)) {
            mkdir($path, 0777, $recursive);
        }
        chmod($path, 0777);
        return ($path . DS);
    }

}
