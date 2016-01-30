<?php
namespace Admin\Controller;

use Admin\Controller\AppController;
use Admin\Controller\Component\NotificationComponent;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;

/**
 * Informations Controller
 * お知らせ編集コントローラー
 *
 * @property \Admin\Model\Table\InformationsTable $Informations
 * @property \Admin\Controller\Component\NotificationComponent $Notification
 */
class InformationsController extends AppController
{

    /**
     * 使用コンポーネント
     * @var array
     */
    public $components = ['Admin.Notification'];

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
     * Index method
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
        $tags = $this->Notification->usableConvert();
        if ($this->request->is('post')) {
            $information = $this->Informations->patchEntity($information, $this->request->data);
            if ($this->Informations->save($information)) {
                $this->Flash->success(__('The information has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The information could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('information', 'types', 'tags'));
        $this->set('_serialize', ['information']);
        return $this->render('edit');
    }

    /**
     * Edit method
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
        $tags = $this->Notification->usableConvert();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $information = $this->Informations->patchEntity($information, $this->request->data);
            if ($this->Informations->save($information)) {
                $this->Flash->success(__('The information has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The information could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('information', 'types', 'tags'));
        $this->set('_serialize', ['information']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Information id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $information = $this->Informations->get($id);
        if ($this->Informations->delete($information)) {
            $this->Flash->success(__('The information has been deleted.'));
        } else {
            $this->Flash->error(__('The information could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    /**
     * お知らせの初期データを作成します.
     *
     * @return array Informationsの初期値
     */
    protected function _buildDefaultData()
    {
        /** @var \Admin\Model\Table\InformationTypesTable $InformationTypes */
        $InformationTypes = TableRegistry::get('Admin.InformationTypes');
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
