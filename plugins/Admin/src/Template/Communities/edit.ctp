<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $community->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $community->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Communities'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="communities form large-9 medium-8 columns content">
    <?= $this->Form->create($community) ?>
    <fieldset>
        <legend><?= __('Edit Community') ?></legend>
        <?php
            echo $this->Form->input('community_status_id');
            echo $this->Form->input('country_id');
            echo $this->Form->input('ken_id');
            echo $this->Form->input('city_id');
            echo $this->Form->input('hometown_country_id');
            echo $this->Form->input('hometown_ken_id');
            echo $this->Form->input('hometown_city_id');
            echo $this->Form->input('name');
            echo $this->Form->input('is_deleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
