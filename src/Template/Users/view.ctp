<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List User Hometowns'), ['controller' => 'UserHometowns', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User Hometown'), ['controller' => 'UserHometowns', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List User Profiles'), ['controller' => 'UserProfiles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User Profile'), ['controller' => 'UserProfiles', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th><?= __('Password') ?></th>
            <td><?= h($user->password) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Registered') ?></th>
            <td><?= h($user->registered) ?></td>
        </tr>
        <tr>
            <th><?= __('Exited') ?></th>
            <td><?= h($user->exited) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($user->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($user->modified) ?></td>
        </tr>
        <tr>
            <th><?= __('Is Deleted') ?></th>
            <td><?= $user->is_deleted ? __('Yes') : __('No'); ?></td>
         </tr>
    </table>
    <div class="related">
        <h4><?= __('Related User Hometowns') ?></h4>
        <?php if (!empty($user->user_hometowns)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('User Id') ?></th>
                <th><?= __('Country Id') ?></th>
                <th><?= __('Prefectures Id') ?></th>
                <th><?= __('City Id') ?></th>
                <th><?= __('Memories') ?></th>
                <th><?= __('Is Deleted') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->user_hometowns as $userHometowns): ?>
            <tr>
                <td><?= h($userHometowns->id) ?></td>
                <td><?= h($userHometowns->user_id) ?></td>
                <td><?= h($userHometowns->country_id) ?></td>
                <td><?= h($userHometowns->prefectures_id) ?></td>
                <td><?= h($userHometowns->city_id) ?></td>
                <td><?= h($userHometowns->memories) ?></td>
                <td><?= h($userHometowns->is_deleted) ?></td>
                <td><?= h($userHometowns->created) ?></td>
                <td><?= h($userHometowns->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'UserHometowns', 'action' => 'view', $userHometowns->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'UserHometowns', 'action' => 'edit', $userHometowns->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'UserHometowns', 'action' => 'delete', $userHometowns->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userHometowns->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related User Profiles') ?></h4>
        <?php if (!empty($user->user_profiles)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('User Id') ?></th>
                <th><?= __('Gender') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Nickname') ?></th>
                <th><?= __('Birthday') ?></th>
                <th><?= __('Is Deleted') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->user_profiles as $userProfiles): ?>
            <tr>
                <td><?= h($userProfiles->id) ?></td>
                <td><?= h($userProfiles->user_id) ?></td>
                <td><?= h($userProfiles->gender) ?></td>
                <td><?= h($userProfiles->name) ?></td>
                <td><?= h($userProfiles->nickname) ?></td>
                <td><?= h($userProfiles->birthday) ?></td>
                <td><?= h($userProfiles->is_deleted) ?></td>
                <td><?= h($userProfiles->created) ?></td>
                <td><?= h($userProfiles->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'UserProfiles', 'action' => 'view', $userProfiles->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'UserProfiles', 'action' => 'edit', $userProfiles->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'UserProfiles', 'action' => 'delete', $userProfiles->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userProfiles->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
