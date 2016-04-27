<?php foreach($messages as $message): ?>
    <?php $fromMe = $message->user->id == $userId; ?>
    <div class="panel panel-<?= $fromMe ? 'default' : 'warning'; ?>" style="width: 75%; <?= $fromMe ? 'margin-left: auto;' : ''; ?>">
    	<div id="seq_<?= $message['sequence'] ?>" class="panel-heading">
		    <?= 'No.'.$message['sequence']; ?>
    		&nbsp;
    		<?= $message->user->user_profiles[0]->nickname; ?>
    		<br/>
    		<?= date('Y/m/d H:i:s', strtotime($message['posted'])); ?>
    	</div>
    	<div class="panel-body">
    	    <?php if (!empty($message['parent_sequence'])): ?>
    	        <a href="#seq_<?= $message['parent_sequence']; ?>">
    	            <?= '>> '.$message['parent_sequence']; ?>
    	        </a>
    	        <br/>
    	    <?php endif; ?>
    		<?= $message['content']; ?>
    	</div>
	    <?php if (!$fromMe): ?>
        	<div class="panel-footer" style="text-align: right;">
        		<a id="<?= $message['sequence']; ?>" href="#" class="reply btn btn-sm btn-success"
        		    data-sequence="<?= $message['sequence']; ?>">
        		    <?= __('返信'); ?>
        		</a>
    	    </div>
	    <?php endif; ?>
    </div>
<?php endforeach; ?>

<script type="text/javascript">
    $(function() {
        // リンク押下で呼び出し元 messages.ctpに動きをつける
        $('.reply').on('click', function() {
            var parentSequence = $(this).data('sequence');
            $('#parent-sequence').val(parentSequence);
            $('#parent-view').html(parentSequence);
            $('#reply-to').show();
            var position = $('#input-area').offset().top;
            $('body,html').animate({scrollTop:position});
            return false;
        });
    });
</script>