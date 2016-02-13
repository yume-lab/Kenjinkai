<style>
    th.title {
        width: 50%;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-info-sign"></i> <?= __('お知らせ一覧'); ?></h2>
            </div>
            <div class="box-content">
                <?= $this->Flash->render() ?>
                <div class="box col-md-12" style="text-align: right;">
                    <a class="btn btn-info" href="<?= $this->Url->build(['controller' => $controllerName, 'action' => 'add'])?>">
                        <i class="glyphicon glyphicon-plus icon-white"></i>
                        <?= __('新規追加'); ?>
                    </a>
                </div>
                <table class="table table-striped table-bordered bootstrap-datatable responsive">
                    <thead>
                    <tr>
                        <th><?= __('名称'); ?></th>
                        <th><?= __('種別'); ?></th>
                        <th class="title"><?= __('タイトル'); ?></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($informations as $info): ?>
                        <tr>
                            <td><?= h($info->name) ?></td>
                            <td><?= h($info->title) ?></td>
                            <td><?= h($info->title) ?></td>
                            <td class="actions center">
                                <a class="btn btn-primary btn-sm"
                                   href="<?= $this->Url->build(['controller' => $controllerName, 'action'=>'edit', $info->id])?>">
                                    <i class="glyphicon glyphicon-edit icon-white"></i>
                                    <?= __('編集') ?>
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