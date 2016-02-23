<style>
    #init-community section {
        margin: 0 auto;
        padding: 1em;
        max-width: 500px;
    }

    #init-community .form-group .inner {
        padding-left: 1em;
    }

    #preview {
        max-width: 250px;
        width: 100%;
    }
</style>

<div id="init-community">
    <?= $this->Charisma->contentTitle(__('コミュニティ初期設定'), '#6BAD45', 'icon_title_event.svg'); ?>

    <section>
        <?= $this->Flash->render(); ?>
        <?= $this->Form->create($community, ['type' => 'file']) ?>
            <div class="form-group">
                <?= $this->Form->label('full_name', __('正式名称')); ?>
                <div class="inner">
                    <?= $community->getFullName(); ?>
                </div>
            </div>

            <div class="form-group">
                <?= $this->Form->label('community_images', __('イメージ (.jpg, .png, .gif)')); ?>
                <div class="inner">
                    <?=
                        $this->Form->input('community_images', [
                            'id' => 'thumbnail', 'type' => 'file', 'label' => false
                        ]);
                    ?>
                </div>
                <img id="preview" src="/images/no_image.png" />
            </div>

            <div class="form-group">
                <?= $this->Form->label('community_settings[0].gender', __('性別制限')); ?>
                <div class="inner">
                    <?=
                        $this->Form->select(
                            'community_settings[0].gender',
                            $genders,
                            ['empty' => true, 'style' => 'width: 5em; display: inline;']
                        ).__(' 限定');
                    ?>
                </div>
            </div>

            <div class="form-group">
                <?= $this->Form->label('community_settings[0].generation', __('年齢制限')); ?>
                <div class="inner">
                    <?=
                        $this->Form->select(
                            'community_settings[0].generation',
                            $generations,
                            ['empty' => true, 'style' => 'width: 5em; display: inline;']
                        ).__(' 代限定');
                    ?>
                </div>
            </div>

            <?= $this->Form->hidden('id'); ?>
            <?= $this->Form->hidden('community_status_id', ['value' => $publishStatusId]); ?>
            <?= $this->Form->hidden('community_settings[0].is_deleted', ['value' => 0]); ?>

            <div class="center col-md-10">
                <?= $this->Form->button(__('公開する'), ['class' => 'btn btn-lg btn-warning']) ?>
            </div>
        <?= $this->Form->end() ?>
    </section>
</div>


<?php // ファイル形式エラーダイアログ ?>
<div class="modal fade" id="image-error-dialog" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3><?= __('ファイル不正'); ?></h3>
            </div>
            <div class="modal-body">
                <?= __('ファイル形式が正しくありません。'); ?>
                <br/>
                <?= __('画像ファイルのみ有効です。（.jpg, .png, .gif）'); ?>
                <br/>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal">
                    <?= __('閉じる'); ?>
                </button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        $('#thumbnail').on('change', function() {
            var file = $(this).prop('files')[0];
            var type = file.type;
            if (type.indexOf('image/') < 0) {
                // 画像ではないためエラー
                return $('#image-error-dialog').modal('show');
            }

            var fr = new FileReader();
            fr.onload = function() {
                $('#preview').attr('src', fr.result ).css('display','inline');
            }
            fr.readAsDataURL(file);
        });
    })();
</script>