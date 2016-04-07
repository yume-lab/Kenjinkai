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
     * 最新のお知らせを取得します.
     *
     * @param int $userId ユーザーID
     * @return array 最新のお知らせ情報
     */
    public function getLatest($userId)
    {
        /** @var \App\Model\Table\UserInformationsTable $UserInformations */
        $UserInformations = TableRegistry::get('UserInformations');
        $unreadOnly = true;
        $informations = $UserInformations->findLatest($userId);
        return $this->__replaceInformations($informations);
    }

    /**
     * ユーザーのお知らせを取得します.
     *
     * @param int $userId ユーザーID
     * @return array ユーザーへのお知らせ情報
     */
    public function getList($userId)
    {
        /** @var \App\Model\Table\UserInformationsTable $UserInformations */
        $UserInformations = TableRegistry::get('UserInformations');
        $informations = $UserInformations->findByUserId($userId);
        return $this->__replaceInformations($informations);
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

    /**
     * お知らせ情報のタグ変換を一括で行います.
     *
     * @param array $list お知らせ情報
     * @return array 置き換え後のお知らせ情報リスト
     */
    private function __replaceInformations($list) {
        $results = [];
        foreach ($list as $data) {
            $results[] = $this->__replaceInformation($data);
        }
        return $results;
    }

    /**
     * 1つのお知らせのタグ変換を行います.
     *
     * @param object $data お知らせModelのデータ
     * @see \App\Model\Table\UserInformationsTable
     * @return array 置換したお知らせ情報
     */
    private function __replaceInformation($data) {
        // お知らせマスタ情報
        $info = $data->information;
        $tags = json_decode($data['convert_info'], true);

        $title = $info->title;
        $content = $info->content;

        foreach ($tags as $tag => $value) {
            if(strpos($tag, 'url') !== false) {
                $value = $this->__toLink($value);
            }
            $title = str_replace($tag, $value, $title);
            $content = str_replace($tag, $value, $content);
        }

        $data = [
            'id' => $data->id,
            // 'title' => str_replace(array_keys($tags), array_values($tags), $info->title),
            // 'content' => str_replace(array_keys($tags), array_values($tags), $info->content),
            'title' => $title,
            'content' => $content,
            'is_important' => $info->is_important,
            'created' => $data['created'],
        ];
        return $data;
    }

    /**
     * リンクのaタグを生成します.
     * @param string 設定されている値
     * @return string <a href="%s">%s</a>タグ. %sには設定されたURLが入ります.
     */
    private function __toLink($value)
    {
        $urlFormat = '%s://%s%s';
        $url = sprintf($urlFormat, $this->request->scheme(), $this->request->host(), $value);
        return sprintf('<a href="%s">%s</a>', $url, $url);
    }
}
