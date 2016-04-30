<style>
    #message-area {
        max-height: 500px;
        min-height: 200px;
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
            <?=
                $this->Charisma->contentTitle(
                    $title,
                    '#793862',
                    'icon_title_event.svg',
                    ['glyphs' => [
                        'icon' => 'glyphicon-send',
                        'href' => '#input-area'
                    ]]
                );
            ?>
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

            <div class="col-xs-12 col-md-12" style="text-align: right; padding: 5px 0;">
                <a id="refresh" href="" class="btn btn-sm btn-default">
                    <span class="glyphicon glyphicon-refresh"></span>
                </a>
            </div>

            <?php // AjaxでここにDOMが登録される ?>
            <div id="message-area" class="col-xs-12 col-md-12 jumbotron"></div>

            <hr width="100%" />

            <div id="input-area" class="col-xs-12 col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?= __('メッセージ投稿'); ?>
                    </div>
                    <div class="panel-body">
                        <p id="reply-to" style="display: none;">
                            <?= __('返信: >> '); ?><span id="parent-view"></span>
                        </p>
                        <?= $this->Form->create($message) ?>
                            <div class="form-group">
                                <div class="inner">
                                    <?= $this->Form->textarea('content', ['id' => 'input-message', 'label' => false, 'value' => '']); ?>
                                </div>
                            </div>
                            <div style="text-align: right;">
                                <?= $this->Form->button(__('送信する'), ['class' => 'btn btn-success']) ?>
                            </div>
                            <?= $this->Form->hidden('parent_sequence', ['id' => 'parent-sequence', 'value' => 0]); ?>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->Form->hidden('', ['id' => 'cid', 'value' => $encrypts['communityId']]); ?>
<?= $this->Form->hidden('', ['id' => 'tid', 'value' => $encrypts['threadId']]); ?>

<script type="text/javascript">
    function pullMessage() {
        var url = '/api/communities/message';
        var data = {
            cid: $('#cid').val(),
            tid: $('#tid').val()
        };
        $.ajax({
            type: 'get',
            url: url,
            data: data,
        }).done(function(rows) {
            $('#message-area').html(rows).hide().fadeIn(1000);
        });
    }
    $(function() {
        pullMessage();
        $('#refresh').on('click', function() {
            pullMessage();
            return false;
        });
    });
</script>