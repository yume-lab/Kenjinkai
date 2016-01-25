<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Review Communities'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Community Statuses'), ['controller' => 'CommunityStatuses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Community Status'), ['controller' => 'CommunityStatuses', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="reviewCommunities form large-9 medium-8 columns content">
    <?= $this->Form->create($reviewCommunity) ?>
    <fieldset>
        <legend><?= __('Add Review Community') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('community_status_id', ['options' => $communityStatuses]);
            echo $this->Form->input('message');
            echo $this->Form->input('comment');
            echo $this->Form->input('is_deleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
