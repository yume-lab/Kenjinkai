<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Review Community'), ['action' => 'edit', $reviewCommunity->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Review Community'), ['action' => 'delete', $reviewCommunity->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reviewCommunity->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Review Communities'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Review Community'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Community Statuses'), ['controller' => 'CommunityStatuses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Community Status'), ['controller' => 'CommunityStatuses', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="reviewCommunities view large-9 medium-8 columns content">
    <h3><?= h($reviewCommunity->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $reviewCommunity->has('user') ? $this->Html->link($reviewCommunity->user->id, ['controller' => 'Users', 'action' => 'view', $reviewCommunity->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Community Status') ?></th>
            <td><?= $reviewCommunity->has('community_status') ? $this->Html->link($reviewCommunity->community_status->name, ['controller' => 'CommunityStatuses', 'action' => 'view', $reviewCommunity->community_status->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($reviewCommunity->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($reviewCommunity->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($reviewCommunity->modified) ?></td>
        </tr>
        <tr>
            <th><?= __('Is Deleted') ?></th>
            <td><?= $reviewCommunity->is_deleted ? __('Yes') : __('No'); ?></td>
         </tr>
    </table>
    <div class="row">
        <h4><?= __('Message') ?></h4>
        <?= $this->Text->autoParagraph(h($reviewCommunity->message)); ?>
    </div>
    <div class="row">
        <h4><?= __('Comment') ?></h4>
        <?= $this->Text->autoParagraph(h($reviewCommunity->comment)); ?>
    </div>
</div>
