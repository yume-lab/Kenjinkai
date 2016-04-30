<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12">
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-12">
            <div class="col-xs-12 col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?= __('検索条件'); ?>
                    </div>
                    <div class="panel-body">
                        <?= $this->Form->create('Conditions', ['type' => 'get']) ?>
                            <div class="form-group col-xs-6 col-md-5">
                                <?= $this->Form->label('ken_id', __('居住地から検索')); ?>
                                <?= $this->Form->select('ken_id', $prefectures, ['empty' => ['' => '']]); ?>
                            </div>
                            <div class="form-group col-xs-6 col-md-5">
                                <?= $this->Form->label('hometown_ken_id', __('故郷から検索')); ?>
                                <?= $this->Form->select('hometown_ken_id', $prefectures, ['empty' => ['' => '']]); ?>
                            </div>
                            <div class="form-group col-xs-6 col-md-5">
                                <?= $this->Form->label('community_category_id', __('カテゴリから検索')); ?>
                                <?= $this->Form->select('community_category_id', $categories, ['empty' => ['' => '']]); ?>
                            </div>
                            <div class="form-group col-xs-6 col-md-5">
                                <?= $this->Form->label('name', __('名称から検索')); ?>
                                <?= $this->Form->input('name', ['label' => false]); ?>
                            </div>
                            <div class="col-xs-12 col-md-10" style="text-align: right;">
                                <?= $this->Form->button(__('検索'), ['class' => 'btn btn-primary']) ?>
                            </div>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="clear: both;"></div>

    <hr width="100%" />

    <div class="row">
        <div class="col-xs-12">
            <?php foreach ($communities as $community): ?>
                <div class="col-xs-6 col-md-3">
                    <?php
                        $hash = $community->CommunityImages['hash'];
                        $hasImage = !empty($hash);
                        $imageUrl = '/images/no_image.png';
                        if ($hasImage) {
                            $imageUrl = '/images/community/'.$hash;
                        }
                    ?>
                    <a href="/communities/view/<?= $community->id ?>" class="thumbnail">
                        <?= $this->Html->image($imageUrl); ?>
                        <div class="caption">
                            <p><?= $community->getFullName() ; ?></p>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</div>
