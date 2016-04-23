<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <ol class="breadcrumb">
            	<li>
            	    <a href="/"><?= __('TOP') ?></a>
        	    </li>
            	<li>
            	    <a href="/communities/view/24"><?= $thread->community->name ?></a>
        	    </li>
            	<li class="active"><?= $thread->name ?></li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <?php $title = $thread->community->name.'  '.$thread->name; ?>
            <?= $this->Charisma->contentTitle($title, '#5bc0de', 'icon_title_event.svg'); ?>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-xs-12 col-md-12">
            <div class="col-xs-12 col-md-12">
                <div class="panel panel-info">
                	<div class="panel-heading">
                		<?= date('Y/m/d H:i:s', strtotime($thread['created'])); ?>
                		&nbsp;&nbsp;&nbsp;
                		<?= __('作成者: ').$thread->user->user_profiles[0]->nickname; ?>
                	</div>
                	<div class="panel-body">
                		<?= $thread->description; ?>
                	</div>
                </div>
            </div>

            <div class="col-xs-12 col-md-12">
                <div class="panel panel-warning">
                	<div class="panel-heading">
                		<?= date('Y/m/d H:i:s', strtotime($thread['created'])); ?>
                		&nbsp;&nbsp;&nbsp;
                		<?= __('作成者: ').$thread->user->user_profiles[0]->nickname; ?>
                	</div>
                	<div class="panel-body">
                		メッセージ
                	</div>
                </div>
                <div class="panel panel-warning">
                	<div class="panel-heading">
                		<?= date('Y/m/d H:i:s', strtotime($thread['created'])); ?>
                		&nbsp;&nbsp;&nbsp;
                		<?= __('作成者: ').$thread->user->user_profiles[0]->nickname; ?>
                	</div>
                	<div class="panel-body">
                		メッセージ
                	</div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= debug($thread); ?>