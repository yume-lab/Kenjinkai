<?php foreach($messages as $message): ?>
    <?php $fromMe = $message->user->id == $userId; ?>
    <div class="panel panel-<?= $fromMe ? 'danger' : 'warning'; ?>" style="width: 75%; <?= $fromMe ? 'margin-left: auto;' : ''; ?>">
    	<div id="<?= $message['sequence'] ?>" class="panel-heading">
    	    <?php if ($fromMe): ?>
    		    <?= 'No.'.$message['sequence']; ?>
    	    <?php else: ?>
        		<a id="<?= $message['sequence']; ?>" href="#" class="reply" data-sequence="<?= $message['sequence']; ?>">
        		    <?= 'No.'.$message['sequence']; ?>
        		</a>
    	    <?php endif; ?>
    		&nbsp;
    		<?= $message->user->user_profiles[0]->nickname; ?>
    		<br/>
    		<?= date('Y/m/d H:i:s', strtotime($message['posted'])); ?>
    	</div>
    	<div class="panel-body">
    	    <?php if (!empty($message['parent_sequence'])): ?>
    	        <a href="#<?= $message['parent_sequence']; ?>">
    	            <?= '>> '.$message['parent_sequence']; ?>
    	        </a>
    	    <?php endif; ?>
    		<?= $message['content']; ?>
    	</div>
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