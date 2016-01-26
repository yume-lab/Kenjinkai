<div class="row">
    <div class="col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-user"></i> <?= __('審査待ちコミュニティ一覧') ?></h2>
            </div>
            <div class="box-content">
                <?= $this->Flash->render() ?>
                <?php foreach ($reviews as $data): ?>
                    No.<?= $data['id']; ?>
                    <table class="table table-bordered bootstrap-datatable responsive">
                        <tbody>
                            <tr>
                                <th><?= __('ニックネーム'); ?></th>
                                <td><?= h($data['nickname']); ?></td>
                            </tr>
                            <tr>
                                <th><?= __('申請日'); ?></th>
                                <td><?= date('Y/m/d', strtotime($data['created'])); ?></td>
                            </tr>
                            <tr>
                                <th><?= __('現在の住まい'); ?></th>
                                <td>
                                    <?= $data['ken_name'] ?>&nbsp;&nbsp;<?= $data['city_name'] ?>
                                </td>
                            </tr>
                            <tr>
                                <th><?= __('生まれ故郷'); ?></th>
                                <td>
                                    <?= $data['hometown_ken_name'] ?>&nbsp;&nbsp;<?= $data['hometown_city_name'] ?>
                                </td>
                            </tr>
                            <tr>
                                <th><?= __('コミュニティ名'); ?></th>
                                <td>
                                    <?= h($data['name']); ?>
                                </td>
                            </tr>
                            <tr>
                                <th><?= __('コミュニティ申請の想い'); ?></th>
                                <td>
                                    <?php // エスケープして、改行コードをbrに変換 ?>
                                    <?= nl2br(h($data['message'])); ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="col-md-10" style="text-align: right;">
                        <a class="btn btn-success" href="/employees/edit/">
                            <i class="glyphicon glyphicon-edit icon-white"></i>
                            <?= __('OK') ?>
                        </a>
                        <a class="btn btn-confirm btn-danger" href="#"
                           data-action="/employees/delete/">
                            <i class="glyphicon glyphicon-trash icon-white"></i>
                            <?= __('NG') ?>
                        </a>
                    </div>
                <?php endforeach; ?>

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
