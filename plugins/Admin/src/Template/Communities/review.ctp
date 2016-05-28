<?php // 審査完了通知 ?>
<button id="notice" class="noty hide"
        data-noty-options="{&quot;text&quot;:&quot;<?= __('審査データを更新しました。'); ?>&quot;,&quot;layout&quot;:&quot;top&quot;,&quot;type&quot;:&quot;information&quot;}">
</button>

<style>
    th {
        max-width: 20em;
        width: 15em;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-list-alt"></i> <?= __('承認待ちコミュニティ') ?></h2>
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
                                <td><?= date('Y/m/d H:i:s', strtotime($data['created'])); ?></td>
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
                                <th><?= __('カテゴリ'); ?></th>
                                <td>
                                    <?= empty($data['community_category_id']) ? '未選択' : h($categories[$data['community_category_id']]); ?>
                                </td>
                            </tr>
                            <tr>
                                <th><?= __('コミュニティ画像'); ?></th>
                                <td>
                                    <?php
                                        $hasImage = isset($data['image_hash']) && !empty($data['image_hash']);
                                        $imageUrl = '/images/no_image.png';
                                        if ($hasImage) {
                                            $imageUrl = '/images/community/'.$data['image_hash'];
                                        }
                                    ?>
                                    <?= $this->Html->image($imageUrl, ['style' => 'max-width: 180px; height: auto;']); ?>
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
                    <div style="text-align: right;">
                        <a class="btn btn-success review-success" href="#" data-id="<?= $data['id']; ?>">
                            <i class="glyphicon glyphicon-edit icon-white"></i>
                            <?= __('OK') ?>
                        </a>
                        <a class="btn btn-danger review-failure" href="#" data-id="<?= $data['id']; ?>">
                            <i class="glyphicon glyphicon-trash icon-white"></i>
                            <?= __('NG') ?>
                        </a>
                    </div>
                    <hr/>
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
<div class="modal fade" id="dialog-review" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3><?= __('コミュニティ審査'); ?></h3>
            </div>
            <div class="modal-body">
                <div id="message-success">
                    <?= __('コミュニティの承認を行います。'); ?>
                    <br/>
                    <?= __('任意で応援メッセージを入力してください。'); ?>
                </div>
                <div id="message-failure">
                    <?= __('このコミュニティが承認できない理由を、記載してください。'); ?>
                    <br/>
                    <?= __('入力された理由は、申請者に通知されます。'); ?>
                </div>
                <br/>
                <?= $this->Form->create(null, ['id' => 'review-form', 'url' => ['controller' => 'Communities', 'action' => 'review']]);?>
                    <div class="form-group">
                        <?= $this->Form->hidden('id', ['id' => 'id']); ?>
                        <?= $this->Form->hidden('alias', ['id' => 'alias']); ?>
                        <?= $this->Form->textarea('comment', ['label' => false]); ?>
                    </div>
                <?= $this->Form->end(); ?>
            </div>
            <div class="modal-footer">
                <a id="send-comment" href="#" class="btn btn-info" data-dismiss="modal">
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
            showDialog($(this).data('id'), 'success');
        });
        $('.review-failure').on('click', function(e) {
            e.preventDefault();
            showDialog($(this).data('id'), 'failure');
        });

        $('#send-comment').on('click', function(e) {
            e.preventDefault();
            var $form = $('#review-form');
            $.post($form.attr('action'), $form.serialize(), function() {
                $('#notice').trigger('click');
                location.reload();
            });
            return false;
        });

        /**
         * 承認ダイアログを表示します.
         */
        function showDialog(id, alias) {
            $('#message-success').hide();
            $('#message-failure').hide();

            $('#alias').val(alias);
            $('#id').val(id);
            $('#message-' + alias).show();

            $('#dialog-review').modal('show');
        }
    });

</script>