<?php
    $this->breadcrumbs = array(
        Yii::app()->getModule('contentblock')->getCategory() => array(),
        Yii::t('ContentBlockModule.contentblock', 'Content blocks') => array('/contentblock/default/index'),
        $model->name => array('/contentblock/default/view', 'id' => $model->id),
        Yii::t('ContentBlockModule.contentblock', 'Edit content block'),
    );

    $this->pageTitle = Yii::t('ContentBlockModule.contentblock', 'Content blocks - edit');

    $this->menu = array(
        array('icon' => 'list-alt','label' => Yii::t('ContentBlockModule.contentblock', 'Content blocks administration'), 'url' => array('/contentblock/default/index')),
        array('icon' => 'plus-sign','label' => Yii::t('ContentBlockModule.contentblock', 'Add content block'), 'url' => array('/contentblock/default/create')),
        array('label' => Yii::t('ContentBlockModule.contentblock', 'Content block') . ' «' . mb_substr($model->name, 0, 32) . '»'),
        array('icon' => 'pencil', 'label' => Yii::t('ContentBlockModule.contentblock', 'Edit content block'), 'url' => array(
            '/contentblock/default/update',
            'id' => $model->id
        )),
        array('icon' => 'eye-open', 'label' => Yii::t('ContentBlockModule.contentblock', 'View Content block'), 'url' => array(
            '/contentblock/default/view',
            'id' => $model->id
        )),
        array('icon' => 'trash', 'label' => Yii::t('ContentBlockModule.contentblock', 'Remove Content block'), 'url' => '#', 'linkOptions' => array(
            'submit' => array('/contentblock/default/delete', 'id' => $model->id),
            'params' => array(Yii::app()->request->csrfTokenName => Yii::app()->request->csrfToken),
            'confirm' => Yii::t('ContentBlockModule.contentblock', 'Do you really want to remove content block?'),
        )),
    );
?>
<div class="page-header">
    <h1>
        <?php echo Yii::t('ContentBlockModule.contentblock', 'Edit content block'); ?><br />
        <small>&laquo;<?php echo $model->name; ?>&raquo;</small>
    </h1>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>
