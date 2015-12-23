<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Mailer\Email;

/**
 * Controller LandingController
 * LPページコントローラー
 */
class LandingController extends AppController
{

    /**
     * LP表示Actionです.
     */
    public function index()
    {

    }

    /**
     * 本登録メールを送信します.
     */
    public function post()
    {
        $email = new Email('default');
        $res = $email->to('kinakomochi1614@gmail.com')
            ->subject('About')
            ->send('My message');

        var_dump($res);
    }

}
