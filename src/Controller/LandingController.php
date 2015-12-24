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
        if ($this->request->is('post')) {
            $email = $this->request->data('email');
            $hash = Security::hash(ceil(microtime(true) * 1000), 'sha1', true);
        }
        /** @var \App\Model\Table\PreRegistrationsTable $PreRegistrations */
        $PreRegistrations = TableRegistry::get('PreRegistrations');
        $PreRegistrations->write($email, $hash);

        $urlFormat = '%s://%s/users/register/%s';
        $url = sprintf($urlFormat, $this->request->scheme(), $this->request->host(), $hash);
        
        // TODO: メール送信ログ
        $mailer = new Email('welcome');
        $mailer->to($email)->viewVars(['url' => $url])->send();
    }

}
