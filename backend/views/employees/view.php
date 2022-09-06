<?php

use common\models\Department;
use common\models\Employees;
use common\models\Post;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Employees */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="employees-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
		<?= Html::a('Update', ['update', 'employee_id' => $model->employee_id], ['class' => 'btn btn-primary']) ?>
		<?= Html::a('Delete', ['delete', 'employee_id' => $model->employee_id], [
			'class' => 'btn btn-danger',
			'data' => [
				'confirm' => 'Are you sure you want to delete this item?',
				'method' => 'post',
			],
		]) ?>
    </p>

	<?= DetailView::widget([
		'model' => $model,
		'attributes' => [
			'employee_id',

			[
				'attribute' => 'department_id',
				'filter' => Department::find()->select(['department_title', 'department_id'])->
				indexBy('department_id')->column(),
				'value' => function (Employees $employees) {
					return \yii\helpers\ArrayHelper::getValue($employees, 'department.department_title');
				}
			],
			[
				'attribute' => 'post_id',
				'filter' => Post::find()->select(['post_title', 'post_id'])->
				indexBy('post_id')->column(),
				'value' => function (Employees $employees) {
					return \yii\helpers\ArrayHelper::getValue($employees, 'post.post_title');
				}
			],
			'name',
		],
	]) ?>

</div>
