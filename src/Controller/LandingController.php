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
        $email = 'kinakomochi1614@gmail.com';
        $hash = '1234567890';
        // TODO: DB登録

        $urlFormat = '%s/users/register/%s';
        $url = sprintf($urlFormat, $this->request->host(), $hash);

        $mailer = new Email('welcome');
        $mailer->to($email)->viewVars(['url' => $url])->send();

        var_dump($res);
    }

}
