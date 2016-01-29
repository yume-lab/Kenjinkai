<div class="row">
    <div class="col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-info-sign"></i> <?= __('お知らせ登録'); ?></h2>
            </div>
            <div class="box-content">
                <?= $this->Flash->render() ?>
                <?= $this->Form->create($information) ?>
                <fieldset>
                    <?php
                        echo $this->Form->input('information_type_id', ['value' => 1, 'label' => __('種別'), 'options' => $types]);
                        echo $this->Form->input('path', ['value' => '/admin/manual', 'label' => __('ショートカット')]);
                        echo $this->Form->input('name', ['label' => __('名称')]);
                        echo $this->Form->input('title', ['label' => __('タイトル')]);
                        echo $this->Form->textarea('content', ['id' => 'txt-content', 'label' => __('内容')]);
                        echo $this->Form->hidden('is_deleted', ['value' => 0]);
                    ?>
                </fieldset>

                <p class="center col-md-5">
                    <?= $this->Form->button(__('登録する'), ['class' => 'btn btn-info']) ?>
                </p>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>

<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script type="text/javascript">
    $(function() {
        $('#txt-content').removeAttr('required');
        tinymce.init({selector:'#txt-content'});
    })();
</script>
