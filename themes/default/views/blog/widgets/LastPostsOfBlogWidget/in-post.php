<h3><small>Последние записи блога</small></h3>

<?php foreach($posts as $data):?>
    <div class="row">
        <div class="span6">
            <h4><small><?php echo CHtml::link(CHtml::encode($data->title), array('/blog/post/show/', 'slug' => $data->slug)); ?></small></h4>
        </div>
    </div>
<?php endforeach?>