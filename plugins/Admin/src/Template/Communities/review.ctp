<div class="row">
    <div class="col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-user"></i> <?= __('審査待ちコミュニティ一覧') ?></h2>
            </div>
            <div class="box-content">
                <?= $this->Flash->render() ?>
                <table class="table table-striped table-bordered bootstrap-datatable responsive">
                    <thead>
                    <tr>
                        <th><?= __('ユーザーID') ?></th>
                        <th><?= __('ニックネーム') ?></th>
                        <th><?= __('申請日') ?></th>
                        <th><?= __('現住所') ?></th>
                        <th><?= __('故郷') ?></th>
                        <th><?= __('名称') ?></th>
                        <th><?= __('データ操作') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($reviews as $data): ?>
                        <tr>
                            <td><?= $data['user_id'] ?></td>
                            <td><?= h($data['nickname']); ?></td>
                            <td><?= date('Y/m/d', strtotime($data['created'])); ?></td>
                            <td>
                                <?= $data['ken_name'] ?>&nbsp;&nbsp;<?= $data['city_name'] ?>
                            </td>
                            <td>
                                <?= $data['hometown_ken_name'] ?>&nbsp;&nbsp;<?= $data['hometown_city_name'] ?>
                            </td>
                            <td>
                                <?= h($data['name']); ?>
                            </td>
                            <td class="actions center">
                                <a class="btn btn-primary btn-sm" href="/employees/edit/">
                                    <i class="glyphicon glyphicon-search icon-white"></i>
                                    <?= __('詳細') ?>
                                </a>
                                <a class="btn btn-success btn-sm" href="/employees/edit/">
                                    <i class="glyphicon glyphicon-edit icon-white"></i>
                                    <?= __('OK') ?>
                                </a>
                                <a class="btn btn-confirm btn-danger btn-sm" href="#"
                                   data-action="/employees/delete/">
                                    <i class="glyphicon glyphicon-trash icon-white"></i>
                                    <?= __('NG') ?>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="col-md-12">
                    <div class="dataTables_info">
                        <?= $this->Paginator->counter('{{pages}}ページ中 {{page}}ページ目 ') ?>
                    </div>
                </div>
                <div class="col-md-12 center-block">
                    <div class="dataTables_paginate paging_bootstrap pagination">
                        <ul class="pagination">
                            <?= $this->Paginator->prev('< ' . __('前')) ?>
                            <?= $this->Paginator->numbers() ?>
                            <?= $this->Paginator->next(__('次') . ' >') ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
