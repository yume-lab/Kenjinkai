<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Utility\Security;

/**
 * SecurityUtil component
 * サービス内で使用する暗号化、復号化コンポーネント.
 */
class SecurityUtilComponent extends Component
{

    /** @var string hash生成時の基準となる文字列 */
    private $__modelString = 'kenjinkai0211';

    /**
     * 文字列を暗号化します.
     * @param string 平文
     * @return string 暗号化後文字列.
     */
    public function encrypt($string) {
        $encrypt = openssl_encrypt($string, 'AES-256-CBC', $this->__generateKey(), 0, $this->__generateIv());
        return base64_encode($encrypt);
    }

    /**
     * 暗号化文字列を復号化します.
     * @param string 暗号化文字列
     * @return string 平文
     */
    public function decrypt($encryptString) {
        $decrypt = base64_decode($encryptString);
        return openssl_decrypt($decrypt, 'AES-256-CBC', $this->__generateKey(), 0, $this->__generateIv());
    }

    /**
     * 暗号化時に使用するkeyを生成します.
     * @return string key
     */
    private function __generateKey() {
        return hash('sha256', $this->__modelString);
    }

    /**
     * 暗号化で使用するivとかいうのを生成します.
     * @return string iv
     */
    private function __generateIv() {
        return substr(hash('sha256', Security::salt()), 0, 16);
    }
}
