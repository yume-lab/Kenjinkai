<?php
namespace Admin\Controller;

use Admin\Controller\AppController;
use Admin\Controller\InformationsController;
use Cake\Network\Request;
use Cake\Network\Response;
use Cake\ORM\TableRegistry;

/**
 * SystemInformations Controller
 * システムで自動で送るお知らせの登録一覧処理.
 *
 * @property \App\Model\Table\InformationsTable $Informations
 */
class SystemInformationsController extends InformationsController
{

    /**
     * コンストラクタ.
     * 使用するテーブル名を変えます.
     */
    public function __construct(Request $request = null, Response $response = null, $name = null, $eventManager = null, $components = null)
    {
        parent::__construct($request, $response, 'Informations', $eventManager, $components);
    }

    /**
     * Initialization method.
     * コンポーネントのロードなど.
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Informations');
    }

    /**
     * お知らせの初期データを作成します.
     *
     * @return array Informationsの初期値
     */
    protected function _buildDefaultData()
    {
        /** @var \App\Model\Table\InformationTypesTable $InformationTypes */
        $InformationTypes = TableRegistry::get('InformationTypes');
        $path = '';
        $typeId = $InformationTypes->findIdByAlias($this->_getInformationAlias());

        return [
            'information_type_id' => $typeId,
            'path' => $path
        ];
    }

    /**
     * お知らせタイプのエイリアスを取得します.
     *
     * @return string お知らせタイプのエイリアス
     */
    protected function _getInformationAlias() {
        return 'notice';
    }
}
