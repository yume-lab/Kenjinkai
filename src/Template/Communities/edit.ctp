<style>
    #review-community section {
        margin: 0 auto;
        padding: 1em;
        max-width: 500px;
    }

    #review-community .form-group .inner {
        padding-left: 1em;
    }

    #preview {
        max-width: 250px;
        width: 100%;
    }
</style>
<div id="review-community" class="container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <?= $this->Charisma->contentTitle(__('コミュニティ設定'), '#6BAD45', 'icon_title_event.svg'); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-8" style="margin: 0 auto;">
            <?= $this->Form->create($community, ['type' => 'file']) ?>
                <div class="form-group">
                    <?= $this->Form->label('community_images', __('イメージ (.jpg, .png, .gif)')); ?>
                    <div class="inner">
                        <?=
                            $this->Form->input('community_images', [
                                'id' => 'thumbnail', 'type' => 'file', 'label' => false
                            ]);
                        ?>
                    </div>
                    <?php
                        $hasImage = isset($community['community_images']) && !empty($community['community_images']);
                        $imageUrl = '/images/no_image.png';
                        if ($hasImage) {
                            $image = array_shift($community['community_images']);
                            $imageUrl = '/images/community/'.$image['hash'];
                        }
                    ?>
                    <img id="preview" src="<?= $imageUrl ?>" />
                </div>

                <div class="center col-md-10">
                    <?= $this->Form->button(__('更新する'), ['class' => 'btn btn-lg btn-warning']) ?>
                </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
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
                $(this).val('');
                $('#preview').attr('src', '/images/no_image.png');
                return $('#image-error-dialog').modal('show');
            }

            var fr = new FileReader();
            fr.onload = function() {
                $('#preview').attr('src', fr.result).css('display','inline');
            }
            fr.readAsDataURL(file);
        });
    });
</script>
