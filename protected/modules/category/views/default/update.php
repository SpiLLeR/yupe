<?php
    $this->breadcrumbs = array(
        Yii::app()->getModule('category')->getCategory() => array(),
        Yii::t('CategoryModule.category', 'Categories') => array('/category/default/index'),
        $model->name => array('/category/default/view', 'id' => $model->id),
        Yii::t('CategoryModule.category', 'Change'),
    );

    $this->pageTitle = Yii::t('CategoryModule.category', 'Categories - edit');

    $this->menu = array(
        array('icon' => 'list-alt', 'label' => Yii::t('CategoryModule.category', 'Category manage'), 'url' => array('/category/default/index')),
        array('icon' => 'plus-sign', 'label' =>  Yii::t('CategoryModule.category', 'Create category'), 'url' => array('/category/default/create')),
        array('label' => Yii::t('CategoryModule.category', 'Category') . ' «' . mb_substr($model->name, 0, 32) . '»'),
        array('icon' => 'pencil', 'label' => Yii::t('CategoryModule.category', 'Change category'), 'url' => array(
            '/category/default/update',
            'id' => $model->id
        )),
        array('icon' => 'eye-open', 'label' => Yii::t('CategoryModule.category', 'View category'), 'url' => array(
            '/category/default/view',
            'id' => $model->id
        )),
        array('icon' => 'trash', 'label' => Yii::t('CategoryModule.category', 'Remove category'), 'url' => '#', 'linkOptions' => array(
            'submit' => array('/category/default/delete', 'id' => $model->id),
            'params' => array(Yii::app()->request->csrfTokenName => Yii::app()->request->csrfToken),
            'confirm' => Yii::t('CategoryModule.category', 'Do you really want to remove category?'),
            'csrf' => true,
        )),
    );
?>
<div class="page-header">
    <h1>
        <?php echo Yii::t('CategoryModule.category', 'Change category'); ?><br />
        <small>&laquo;<?php echo $model->name; ?>&raquo;</small>
    </h1>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model, 'languages' => $languages, 'langModels' => $langModels)); ?>
