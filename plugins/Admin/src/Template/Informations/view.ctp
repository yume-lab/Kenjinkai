<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Information'), ['action' => 'edit', $information->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Information'), ['action' => 'delete', $information->id], ['confirm' => __('Are you sure you want to delete # {0}?', $information->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Informations'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Information'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="informations view large-9 medium-8 columns content">
    <h3><?= h($information->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Path') ?></th>
            <td><?= h($information->path) ?></td>
        </tr>
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($information->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($information->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Information Type Id') ?></th>
            <td><?= $this->Number->format($information->information_type_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($information->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($information->modified) ?></td>
        </tr>
        <tr>
            <th><?= __('Is Deleted') ?></th>
            <td><?= $information->is_deleted ? __('Yes') : __('No'); ?></td>
         </tr>
    </table>
    <div class="row">
        <h4><?= __('Content') ?></h4>
        <?= $this->Text->autoParagraph(h($information->content)); ?>
    </div>
</div>
