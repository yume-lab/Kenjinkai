<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User Information'), ['action' => 'edit', $userInformation->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User Information'), ['action' => 'delete', $userInformation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userInformation->id)]) ?> </li>
        <li><?= $this->Html->link(__('List User Informations'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User Information'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Informations'), ['controller' => 'Informations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Information'), ['controller' => 'Informations', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="userInformations view large-9 medium-8 columns content">
    <h3><?= h($userInformation->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $userInformation->has('user') ? $this->Html->link($userInformation->user->id, ['controller' => 'Users', 'action' => 'view', $userInformation->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Information') ?></th>
            <td><?= $userInformation->has('information') ? $this->Html->link($userInformation->information->name, ['controller' => 'Informations', 'action' => 'view', $userInformation->information->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Convert Info') ?></th>
            <td><?= h($userInformation->convert_info) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($userInformation->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Read Date') ?></th>
            <td><?= h($userInformation->read_date) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($userInformation->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($userInformation->modified) ?></td>
        </tr>
        <tr>
            <th><?= __('Is Deleted') ?></th>
            <td><?= $userInformation->is_deleted ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
