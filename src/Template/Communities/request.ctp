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
<div id="review-community">
    <?= $this->Charisma->contentTitle(__('コミュニティ申請'), '#6BAD45', 'icon_title_event.svg'); ?>
    <section>
        <?= $this->Form->create($community, ['type' => 'file']) ?>
            <div class="form-group">
                <?= $this->Form->label('prefecture', __('現在のお住まい')); ?>
                <div class="inner">
                    <?= $city['ken_name'] ?>&nbsp;&nbsp;<?= $city['city_name'] ?>
                </div>
            </div>

            <div class="form-group">
                <?= $this->Form->label('hometown', __('生まれ故郷')); ?>
                <div class="inner">
                    <?= $hometown['ken_name'] ?>&nbsp;&nbsp;<?= $hometown['city_name'] ?>
                </div>
            </div>

            <div class="form-group">
                <?= $this->Form->label('name', __('コミュニティ名')); ?>
                <div class="inner">
                    <?= $this->Form->input('name', ['label' => false, 'placeholder' => '◯◯飲み会！']); ?>
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

            <div class="form-group">
                <?= $this->Form->label('review_community.message', __('コミュニティ作成の想い')); ?>
                <div class="inner">
                    <?= $this->Form->textarea('review_community.message', ['label' => false]); ?>
                </div>
            </div>

            <div class="center col-md-10">
                <?= $this->Form->button(__('申請する'), ['class' => 'btn btn-lg btn-warning']) ?>
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
    })();
</script>
