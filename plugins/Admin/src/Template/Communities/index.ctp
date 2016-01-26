<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Community'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="communities index large-9 medium-8 columns content">
    <h3><?= __('Communities') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('community_status_id') ?></th>
                <th><?= $this->Paginator->sort('country_id') ?></th>
                <th><?= $this->Paginator->sort('ken_id') ?></th>
                <th><?= $this->Paginator->sort('city_id') ?></th>
                <th><?= $this->Paginator->sort('hometown_country_id') ?></th>
                <th><?= $this->Paginator->sort('hometown_ken_id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($communities as $community): ?>
            <tr>
                <td><?= $this->Number->format($community->id) ?></td>
                <td><?= $this->Number->format($community->community_status_id) ?></td>
                <td><?= $this->Number->format($community->country_id) ?></td>
                <td><?= $this->Number->format($community->ken_id) ?></td>
                <td><?= $this->Number->format($community->city_id) ?></td>
                <td><?= $this->Number->format($community->hometown_country_id) ?></td>
                <td><?= $this->Number->format($community->hometown_ken_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $community->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $community->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $community->id], ['confirm' => __('Are you sure you want to delete # {0}?', $community->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
