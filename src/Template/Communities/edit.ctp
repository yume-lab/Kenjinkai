<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <?= $this->Charisma->contentTitle(__('コミュニティ設定'), '#6BAD45', 'icon_title_event.svg'); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-xs-12 center align-left">
            <?= $this->Form->create($community, ['type' => 'file']) ?>
                <div class="form-group col-md-8">
                    <div class="form-group">
                        <?= $this->Form->label('community_category_id', __('カテゴリ')); ?>
                        <?=
                            $this->Form->select(
                                'community_category_id',
                                $categories,
                                ['empty' => [0 => __('未選択')]]
                            );
                        ?>
                    </div>
                </div>

                <div class="form-group col-md-8" style="height: 250px;">
                    <?= $this->Form->label('community_images', __('イメージ (.jpg, .png, .gif)')); ?>
                    <?=
                        $this->Form->input('community_images', [
                            'id' => 'thumbnail', 'type' => 'file', 'label' => false
                        ]);
                    ?>
                    <?php
                        $hasImage = isset($community['community_images']) && !empty($community['community_images']);
                        $imageUrl = '/images/no_image.png';
                        if ($hasImage) {
                            $image = array_shift($community['community_images']);
                            $imageUrl = '/images/community/'.$image['hash'];
                        }
                    ?>
                    <?= $this->Html->image($imageUrl, ['id' => 'preview', 'style' => 'width: auto; max-height: 190px;']); ?>
                </div>

                <div class="form-group col-md-8" style="text-align: center">
                    <?= $this->Form->button(__('更新する'), ['class' => 'btn btn-lg btn-primary']) ?>
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
