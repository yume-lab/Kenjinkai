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
                            <tr>
                                <th></th>
                                <td style="text-align: right;">
                                    <a class="btn btn-success review-success" href="#" data-id="<?= $data['id']; ?>">
                                        <i class="glyphicon glyphicon-edit icon-white"></i>
                                        <?= __('OK') ?>
                                    </a>
                                    <a class="btn btn-danger review-failure" href="#">
                                        <i class="glyphicon glyphicon-trash icon-white"></i>
                                        <?= __('NG') ?>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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


<?php // 審査OKダイアログ ?>
<div class="modal fade" id="dialog-success" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3><?= __('コミュニティ承認'); ?></h3>
            </div>
            <div class="modal-body">
                <?= __('コミュニティの承認を行います。'); ?>
                <br/>
                <?= __('任意で応援メッセージを入力してください。'); ?>
                <br/>
                <br/>
                <div class="form-group">
                    <?= $this->Form->label('comment', __('応援メッセージ')); ?>
                    <div class="inner">
                        <?= $this->Form->textarea('comment', ['label' => false]); ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-info send" data-dismiss="modal">
                    <?= __('送信'); ?>
                </a>
            </div>
        </div>
    </div>
</div>

<?php // 審査NGダイアログ ?>
<div class="modal fade" id="dialog-failure" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3><?= __('コミュニティNG理由'); ?></h3>
            </div>
            <div class="modal-body">
                <?= __('このコミュニティが承認できない理由を、記載してください。'); ?>
                <br/>
                <?= __('入力された理由は、申請者に通知されます。'); ?>
                <br/>
                <br/>
                <div class="form-group">
                    <?= $this->Form->label('comment', __('承認できない理由')); ?>
                    <div class="inner">
                        <?= $this->Form->textarea('comment', ['label' => false]); ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-info send" data-dismiss="modal">
                    <?= __('送信'); ?>
                </a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        $('.review-success').on('click', function(e) {
            e.preventDefault();
            $('#dialog-success').modal('show');
            console.log($(this).data('id'));
        });
        $('.review-failure').on('click', function(e) {
            e.preventDefault();
            $('#dialog-failure').modal('show');
            console.log($(this).data('id'));
        });
    });

</script>