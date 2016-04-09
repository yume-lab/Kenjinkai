<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <?= $this->Charisma->contentTitle(__('コミュニティ情報'), '#5bc0de', 'icon_title_event.svg'); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="col-xs-12">
                <div class="col-xs-5 col-md-4">
                    <?php
                        $hasImage = isset($community['community_images']) && !empty($community['community_images']);
                        $imageUrl = '/images/no_image.png';
                        if ($hasImage) {
                            $image = array_shift($community['community_images']);
                            $imageUrl = '/images/community/'.$image['hash'];
                        }
                    ?>
                    <?= $this->Html->image($imageUrl, ['style' => 'max-width: 180px; height: auto;']); ?>
                </div>
                <div class="col-md-8 col-md-offset-0 col-xs-6 col-xs-offset-1">
                    <h3>
                        <?= $community->getFullName(); ?>
                    </h3>
                    <p>
                        <?= sprintf(__('参加メンバー: %d'), count($users)); ?>
                    </p>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-8 center">
                        <?php if ($belongsTo): ?>
                            <?= $this->Form->button(__('コミュニティを退会する'), ['class' => 'btn btn-lg btn-warning']) ?>
                        <?php else: ?>
                            <?= $this->Form->button(__('コミュニティに参加する'), ['class' => 'btn btn-lg btn-success']) ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
