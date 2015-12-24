<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List User Hometowns'), ['controller' => 'UserHometowns', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User Hometown'), ['controller' => 'UserHometowns', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List User Profiles'), ['controller' => 'UserProfiles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User Profile'), ['controller' => 'UserProfiles', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
        <?php
            echo $this->Form->input('email');
            echo $this->Form->input('password');
            echo $this->Form->input('registered');
            echo $this->Form->input('exited');
            echo $this->Form->input('is_deleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
