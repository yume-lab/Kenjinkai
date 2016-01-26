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
                        <th><?= __('想い') ?></th>
                        <th><?= __('データ操作') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($reviews as $data): ?>
                        <tr>
                            <td><?= $data['user_id'] ?></td>
                            <td><?= $data['nickname'] ?></td>
                            <td><?= date('Y/m/d', strtotime($data['created'])); ?></td>
                            <td>
                                <?php
                                    $limit = 10; // TODO: configにもつ
                                    $message = $data['message'];
                                    $length = mb_strlen($message);
                                    echo ($length >= $limit) ? mb_substr($message, 0, $limit) . '...' : $message;
                                ?>
                            </td>
                            <td class="actions center">
                                <a class="btn btn-primary btn-sm" href="/employees/edit/">
                                    <i class="glyphicon glyphicon-edit icon-white"></i>
                                    更新
                                </a>
                                <a class="btn btn-confirm btn-danger btn-sm" href="#"
                                   data-action="/employees/delete/">
                                    <i class="glyphicon glyphicon-trash icon-white"></i>
                                    削除
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
