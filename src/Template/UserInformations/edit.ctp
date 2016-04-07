<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $userInformation->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $userInformation->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List User Informations'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Informations'), ['controller' => 'Informations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Information'), ['controller' => 'Informations', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="userInformations form large-9 medium-8 columns content">
    <?= $this->Form->create($userInformation) ?>
    <fieldset>
        <legend><?= __('Edit User Information') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('information_id', ['options' => $informations]);
            echo $this->Form->input('convert_info');
            echo $this->Form->input('read_date', ['empty' => true]);
            echo $this->Form->input('is_deleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
