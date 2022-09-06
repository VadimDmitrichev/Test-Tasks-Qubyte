<?php

use common\models\Department;
use common\models\Post;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Employees */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employees-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'department_id')->DropDownList(Department::find()->
    select(['department_title', 'department_id'])->indexBy('department_id')->column(), ['prompt'=>'']) ?>

    <?= $form->field($model, 'post_id')->DropDownList(Post::find()->
    select(['post_title', 'post_id'])->indexBy('post_id')->column(), ['prompt'=>'']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
