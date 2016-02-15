<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\ORM\TableRegistry;

/**
 * Notification component
 * お知らせ処理コンポーネント.
 */
class NotificationComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    /**
     * お知らせ置換する際のカスタムパラメーター.
     */
    private $__parameters = [];

    /**
     * TODO: ちゃんとした実装
     * 利用可能な置き換えタグを取得します.
     * @return array 置き換えタグ
     */
    public function tags()
    {
        return [
            [
                'tag' => '[[nickname]]',
                'label' => 'ニックネーム'
            ]
        ];
    }

    /**
     * 未読のお知らせを取得します.
     *
     * @param int $userId ユーザーID
     * @return array 未読のお知らせ情報
     */
    public function getUnread($userId)
    {
        /** @var \App\Model\Table\UserInformationsTable $UserInformations */
        $UserInformations = TableRegistry::get('UserInformations');
        $unreadOnly = true;
        $informations = $UserInformations->findByUserId($userId, $unreadOnly);

        $results = [];
        // debug($informations);
        foreach ($informations as $information) {
            $info = $information->information;
            $tags = json_decode($information['convert_info']);

            $data = [];
            $data['title'] = $info->title;
            $data['content'] = $info->content;
            $data['is_important'] = $info->is_important;
            $data['created'] = $info->created;
            foreach ($tags as $tag => $value) {
                $data['title'] = str_replace($tag, $value, $data['title']);
                $data['content'] = str_replace($tag, $value, $data['content']);
            }
            $results[] = $data;
            unset($data);
        }

        return $results;
    }

    /**
     * お知らせ送信処理を行います.
     * usage:
     *      $this->Notification->addParameter('[[custom_tag]]', 'https://www.google.co.jp/');
     *      $this->Notification->send(9, '/community/review/success');
     * @param int $userId ユーザーID
     * @param string お知らせマスタのpath
     * @return 処理結果
     */
    public function send($userId, $path)
    {
        /** @var \App\Model\Table\UserInformationsTable $UserInformations */
        $UserInformations = TableRegistry::get('UserInformations');

        $tags = $this->__generateDefaultParameter($userId);
        $tags = $this->__mergeParameter($tags);

        return $UserInformations->send($userId, $path, $tags);
    }

    /**
     * お知らせ置換タグをカスタムで追加します.
     *
     * @param string $tag [[test]]形式
     * @param string $value 置き換える文字
     */
    public function addParameter($tag, $value)
    {
        $this->__parameters[$tag] = $value;
    }

    /**
     * デフォルトパラメーターを生成します.
     *
     * @param int $userId ユーザーID
     * @return array 置き換えパラメーター
     */
    private function __generateDefaultParameter($userId)
    {
        /** @var \App\Model\Table\UsersTable $Users */
        $Users = TableRegistry::get('Users');
        $user = $Users->get($userId, [
            'contain' => ['UserProfiles', 'UserHometowns']
        ])->toArray();

        $profile = array_shift($user['user_profiles']);
        $hometown = array_shift($user['user_hometowns']);
        unset($user['user_profiles']);
        unset($user['user_hometowns']);

        // TODO: 随時追加
        $tags = [
            '[[nickname]]' => $profile['nickname'],
        ];

        return $tags;
    }

    /**
     * カスタムパラメーターとデフォルトパラメーターをマージします.
     *
     * @param array $defaults デフォルトパラメーター
     * @return array パラメーター
     */
    private function __mergeParameter($defaults)
    {
        $additions = $this->__parameters;
        unset($this->__parameters);
        return array_merge($defaults, $additions);
    }

}
