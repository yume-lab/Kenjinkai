<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Mailer\Email;
use Cake\Utility\Security;
use Cake\ORM\TableRegistry;

/**
 * Controller LandingController
 * LPページコントローラー
 */
class LandingController extends AppController
{
    /**
     * 初期処理.
     * @return void
     */
    public function initialize() {
        parent::initialize();
        $this->Auth->allow(['index', 'post']);
    }

    /**
     * LP表示Actionです.
     */
    public function index()
    {
        $this->viewBuilder()->layout('unregistered');

        // TODO: 特徴部分のサンプルデータ
        $features = [
            [
                'title' => '特徴',
                'content' => '特徴テキスト<br/>特徴テキスト<br/>特徴テキスト<br/>特徴テキスト<br/>'
            ],
            [
                'title' => '特徴',
                'content' => '特徴テキスト<br/>特徴テキスト<br/>特徴テキスト<br/>特徴テキスト<br/>'
            ],
            [
                'title' => '特徴',
                'content' => '特徴テキスト<br/>特徴テキスト<br/>特徴テキスト<br/>特徴テキスト<br/>'
            ]
        ];

        // TODO: 使い方部分のサンプルデータ
        $steps = [
            [
                'title' => '◯◯する',
                'content' => '説明文'
            ],
            [
                'title' => '◯◯する',
                'content' => '説明文'
            ],
            [
                'title' => '◯◯する',
                'content' => '説明文'
            ],
        ];

        // TODO: お客様の声部分のサンプルデータ
        $testimonials = [
            [
                'nickname' => 'A.A.',
                'text' => 'お客様の声テキスト',
                'age' => '20代',
                'hometown' => '北海道札幌市'
            ],
            [
                'nickname' => 'A.A.',
                'text' => 'お客様の声テキスト',
                'age' => '20代',
                'hometown' => '北海道札幌市'
            ],
            [
                'nickname' => 'A.A.',
                'text' => 'お客様の声テキスト',
                'age' => '20代',
                'hometown' => '北海道札幌市'
            ],
        ];
        $showMenu = true;


        $this->set(compact('showMenu', 'features', 'steps', 'testimonials'));
    }

    /**
     * 本登録メールを送信します.
     */
    public function post()
    {
        $this->viewBuilder()->layout('unregistered');
        if ($this->request->is('post')) {
            $email = $this->request->data('email');
            $hash = Security::hash(ceil(microtime(true) * 1000), 'sha1', true);
            /** @var \App\Model\Table\PreRegistrationsTable $PreRegistrations */
            $PreRegistrations = TableRegistry::get('PreRegistrations');
            $PreRegistrations->write($email, $hash);

            $urlFormat = '%s://%s/users/register/%s';
            $url = sprintf($urlFormat, $this->request->scheme(), $this->request->host(), $hash);

            // TODO: メール送信ログ
            $mailer = new Email('welcome');
            $mailer->to($email)->viewVars(['url' => $url])->send();
        }
        // TODO: スタブ
        $hometownCount = 50;
        $communityCount = 18;

        $this->set(compact('hometownCount', 'communityCount'));
    }

}
