<?php
namespace Admin\Controller;

use Admin\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;

/**
 * Informations Controller
 * お知らせ編集コントローラー
 *
 * @property \App\Model\Table\InformationsTable $Informations
 */
class InformationsController extends AppController
{

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
        $this->loadComponent('Notification');
    }

    /**
     * リクエスト毎の処理.
     *
     * @param \Cake\Event\Event $event
     * @return void
     */
    public function beforeFilter(Event $event)
    {
        $isManual = $this->_getInformationAlias() == 'admin';
        $controllerName = $this->request->param('controller');
        $this->set(compact('controllerName', 'isManual'));
        parent::beforeFilter($event);
    }

    /**
     * 一覧処理.
     *
     * @return void
     */
    public function index()
    {
        $finder = $this->Informations->findByTypeAlias($this->_getInformationAlias());
        $informations = $this->paginate($finder);
        $this->set(compact('informations'));
        $this->set('_serialize', ['informations']);
    }

    /**
     * お知らせの新規追加Actionです.
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $information = $this->Informations->newEntity($this->_buildDefaultData());
        $types = $this->Informations->InformationTypes->find('list');
        $tags = $this->Notification->tags();
        if ($this->request->is('post')) {
            $information = $this->Informations->patchEntity($information, $this->request->data);
            if ($this->Informations->save($information)) {
                $this->Flash->success(__('お知らせ情報を登録しました。'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('お知らせの保存に失敗しました。'));
            }
        }
        $this->set(compact('information', 'types', 'tags'));
        $this->set('_serialize', ['information']);
        return $this->render('edit');
    }

    /**
     * お知らせの更新処理です.
     *
     * @param string|null $id Information id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $information = $this->Informations->get($id, [
            'contain' => []
        ]);
        $types = $this->Informations->InformationTypes->find('list');
        $tags = $this->Notification->tags();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $information = $this->Informations->patchEntity($information, $this->request->data);
            if ($this->Informations->save($information)) {
                $this->Flash->success(__('お知らせ情報を更新しました。'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('お知らせの保存に失敗しました。'));
            }
        }
        $this->set(compact('information', 'types', 'tags'));
        $this->set('_serialize', ['information']);
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
        $path = '/admin/manual/'.date('YmdHis');
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
        return 'admin';
    }
}
