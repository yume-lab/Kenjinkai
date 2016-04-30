<style>
    #init-community section {
        margin: 0 auto;
        padding: 1em;
        max-width: 500px;
    }

    #init-community .form-group .inner {
        padding-left: 1em;
    }

    #init-community img {
        max-width: 250px;
        width: 100%;
    }
</style>

<div id="init-community" class="container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <ol class="breadcrumb">
                <li>
                    <a href="/"><?= __('TOP') ?></a>
                </li>
                <li>
                    <a href="/communities/view/<?= $community->id ?>"><?= $community->name ?></a>
                </li>
                <li class="active"><?= __('スレッド作成') ?></li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <?= $this->Charisma->contentTitle(__('スレッド作成'), '#6BAD45', 'icon_title_event.svg'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-md-8 ">
            <?= $this->Form->create($thread) ?>
                <div class="form-group">
                    <?= $this->Form->label('name', __('タイトル')); ?>
                    <div class="inner">
                        <?= $this->Form->input('name', ['label' => false, 'placeholder' => '次回の飲み会計画']); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?= $this->Form->label('thread_category_id', __('カテゴリ')); ?>
                    <div class="inner">
                        <?= $this->Form->select('thread_category_id', $categories); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?= $this->Form->label('description', __('説明')); ?>
                    <div class="inner">
                        <?= $this->Form->input('description', ['label' => false, 'placeholder' => '説明です']); ?>
                    </div>
                </div>

                <div class="center col-md-10">
                    <?= $this->Form->button(__('スレッドを作成する'), ['class' => 'btn btn-lg btn-primary']) ?>
                </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
