<style>
    th.title {
        width: 50%;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-info-sign"></i> <?= __('コミュニティ一覧'); ?></h2>
            </div>
            <div class="box-content">
                <?= $this->Flash->render() ?>
                <table class="table table-striped table-bordered bootstrap-datatable responsive">
                    <thead>
                    <tr>
                        <th><?= __('ID'); ?></th>
                        <th><?= __('コミュニティ名'); ?></th>
                        <th><?= __('カテゴリ'); ?></th>
                        <th><?= __('居住地'); ?></th>
                        <th><?= __('故郷'); ?></th>
                        <th><?= __('ユーザー数'); ?></th>
                        <th><?= __('スレ数'); ?></th>
                        <th><?= __('ステータス'); ?></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($communities as $community): ?>
                        <tr>
                            <td><?= $community->id; ?></td>
                            <td><?= h($community->name) ?></td>
                            <td><?= h($community->community_category->name); ?></td>
                            <td><?= h($community->city_addres->ken_name); ?></td>
                            <td><?= h($community->home_city_addres->ken_name); ?></td>
                            <td><?= count($community->user_communities); ?></td>
                            <td><?= count($community->community_threads); ?></td>
                            <td><?= h($community->community_status->name); ?></td>
                            <td class="actions center">
                                <a class="btn btn-primary btn-sm" href="<?= $this->Url->build(['action'=>'view', $community->id])?>">
                                    <?= __('詳細') ?>
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