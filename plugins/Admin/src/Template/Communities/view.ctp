<style>
    th {
        max-width: 20em;
        width: 15em;
    }
</style>

<div class="row">
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li>
                <a href="<?= $this->Url->build(['action'=>'all']) ?>">
                    <?= __('一覧　') ?>
                </a>
            </li>
            <li class="active"><?= h($community->name); ?></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-list-alt"></i> <?= __('コミュニティ詳細') ?></h2>
            </div>
            <div class="box-content">
                <?= $this->Flash->render() ?>
                <br/>
                TODO: もう少し情報を多く<br/>
                ・スレッド内容<br/>
                ・メンバー一覧<br/>
                ・メッセージ確認<br/>
                ・タブで情報を分ける<br/>
                <table class="table table-bordered bootstrap-datatable responsive">
                    <tbody>
                        <tr>
                            <th><?= __('ID'); ?></th>
                            <td><?= $community->id ?></td>
                        </tr>
                        <tr>
                            <th><?= __('名称'); ?></th>
                            <td>
                                <?= h($community->name); ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?= __('カテゴリ'); ?></th>
                            <td>
                                <?= h($community->community_category->name); ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?= __('居住地'); ?></th>
                            <td>
                                <?= h($community->city_addres->getFullName()); ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?= __('故郷'); ?></th>
                            <td>
                                <?= h($community->home_city_addres->getFullName()); ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?= __('コミュニティ画像'); ?></th>
                            <td>
                                <?php
                                    $image = $community->community_images;
                                    $hasImage = isset($image) && !empty($image->hash);
                                    $imageUrl = '/images/no_image.png';
                                    if ($hasImage) {
                                        $imageUrl = '/images/community/'.$image->hash;
                                    }
                                ?>
                                <?= $this->Html->image($imageUrl, ['style' => 'max-width: 180px; height: auto;']); ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
