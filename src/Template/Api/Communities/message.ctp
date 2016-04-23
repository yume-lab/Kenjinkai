<?php foreach($messages as $message): ?>
    <div class="panel panel-warning">
    	<div id="<?= $message['sequence'] ?>" class="panel-heading">
    		<?= date('Y/m/d H:i:s', strtotime($message['posted'])); ?>
    		&nbsp;&nbsp;&nbsp;
    		<?= $message['nickname']; ?>
    	</div>
    	<div class="panel-body">
    	    <?php if (!empty($message['parent_id'])): ?>
    	        <a href="#<?= $message['parent_id']; ?>">
    	            <?= '>> '.$message['parent_id']; ?>
    	        </a>
    	    <?php endif; ?>
    		<?= $message['content']; ?>
    	</div>
    </div>
<?php endforeach; ?>
