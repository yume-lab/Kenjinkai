<style>
    #message-area {
        max-height: 500px;
        overflow: scroll;
        padding: 10px;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <ol class="breadcrumb">
            	<li>
            	    <a href="/"><?= __('TOP') ?></a>
        	    </li>
            	<li>
            	    <a href="/communities/view/<?= $thread->community->id ?>"><?= $thread->community->name ?></a>
        	    </li>
            	<li class="active"><?= $thread->name ?></li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <?php $title = $thread->community->name.'  '.$thread->name; ?>
            <?= $this->Charisma->contentTitle($title, '#793862', 'icon_title_event.svg'); ?>
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

            <hr width="100%" />

            <div id="message-area" class="col-xs-12 col-md-12 jumbotron">
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

            <hr width="100%" />

            <div id="input-area" class="col-xs-12 col-md-12">
                <div class="panel panel-default">
                	<div class="panel-heading">
                	    <?= __('メッセージ投稿'); ?>
                	</div>
                	<div class="panel-body">
                        <div class="form-group">
                            <div class="inner">
                                <?= $this->Form->textarea('content', ['label' => false]); ?>
                            </div>
                        </div>
                        <div style="text-align: right;">
                            <?= $this->Form->button(__('送信する'), ['class' => 'btn btn-success']) ?>
                        </div>
                	</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function pullMessage() {
        var url = '/api/communities/message';
        var data = {thread_id: 0, sequence: 0};
        $.ajax({
            type: 'get',
            url: url,
            data: data,
            global: false
        }).done(function(row) {
            $(row).prependTo('#message-area').hide().fadeIn(1000);
        });
    }
    $(function() {
        setInterval(function() {
            pullMessage()
        }, 5000);
    });
</script>