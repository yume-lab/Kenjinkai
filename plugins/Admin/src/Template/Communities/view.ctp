<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Community'), ['action' => 'edit', $community->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Community'), ['action' => 'delete', $community->id], ['confirm' => __('Are you sure you want to delete # {0}?', $community->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Communities'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Community'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="communities view large-9 medium-8 columns content">
    <h3><?= h($community->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($community->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($community->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Community Status Id') ?></th>
            <td><?= $this->Number->format($community->community_status_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Country Id') ?></th>
            <td><?= $this->Number->format($community->country_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Ken Id') ?></th>
            <td><?= $this->Number->format($community->ken_id) ?></td>
        </tr>
        <tr>
            <th><?= __('City Id') ?></th>
            <td><?= $this->Number->format($community->city_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Hometown Country Id') ?></th>
            <td><?= $this->Number->format($community->hometown_country_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Hometown Ken Id') ?></th>
            <td><?= $this->Number->format($community->hometown_ken_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Hometown City Id') ?></th>
            <td><?= $this->Number->format($community->hometown_city_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($community->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($community->modified) ?></td>
        </tr>
        <tr>
            <th><?= __('Is Deleted') ?></th>
            <td><?= $community->is_deleted ? __('Yes') : __('No'); ?></td>
         </tr>
    </table>
</div>
