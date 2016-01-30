<div class="row">
    <div class="col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-info-sign"></i> <?= __('お知らせ登録'); ?></h2>
            </div>
            <div class="box-content">
                <?= $this->Flash->render() ?>
                <?= $this->Form->create($information) ?>
                <fieldset>
                    <?php
                        echo $this->Form->input('name', ['label' => __('名称'), 'placeholder' => __('例:◯◯の時に送信')]);
                        echo $this->Form->input('title', ['label' => __('タイトル'), 'placeholder' => __('例:県人会◯◯キャンペーンを開始します！')]);
                        echo $this->Form->input('is_important', ['label' => __('重要なお知らせ')]);
                        echo $this->Form->hidden('information_type_id');

                        if ($isManual) {
                            echo $this->Form->hidden('path');
                        } else {
                            echo $this->Form->input('path', ['label' => __('呼び出しショートカット')]);
                        }
                        echo $this->Form->hidden('is_deleted', ['value' => 0]);
                    ?>
                    <a id="confirm-convert" href="#">
                        <?= __('利用可能の置き換え文字'); ?>
                    </a>
                    <?php
                        echo $this->Form->textarea('content', ['id' => 'txt-content', 'label' => __('内容')]);
                    ?>
                </fieldset>

                <p class="center col-md-5">
                    <?= $this->Form->button(__('登録する'), ['class' => 'btn btn-info']) ?>
                </p>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>


<?php // 利用可能タグの詳細ダイアログ ?>
<div class="modal fade" id="dialog-convert-info" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3><?= __('利用可能な置き換え文字'); ?></h3>
            </div>
            <div class="modal-body">
                <ul>
                    <?php foreach ($tags as $tag): ?>
                    <li>
                        <span><?= $tag['tag'] ?></span>
                        -
                        <span><?= $tag['value'] ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script type="text/javascript">
    $(function() {
        $('#confirm-convert').on('click', function(e) {
            e.preventDefault();
            $('#dialog-convert-info').modal('show');
        });

        $('#txt-content').removeAttr('required');
        tinymce.init({selector:'#txt-content'});
    })();
</script>
