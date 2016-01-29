<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Informations'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="informations form large-9 medium-8 columns content">
    <?= $this->Form->create($information) ?>
    <fieldset>
        <legend><?= __('Add Information') ?></legend>
        <?php
            echo $this->Form->input('information_type_id');
            echo $this->Form->input('path');
            echo $this->Form->input('name');
            echo $this->Form->input('content');
            echo $this->Form->input('is_deleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
