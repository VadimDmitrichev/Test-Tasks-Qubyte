<?php

use common\models\Department;
use common\models\Employees;
use common\models\Post;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\EmployeesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Сотрудники';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employees-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
		<?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [

			[
				'attribute' => 'employee_id',
				'contentOptions' => [
					'style' => 'width: 50px'
				]],
			'name',
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
			[
				'class' => ActionColumn::className(),
				'urlCreator' => function ($action, Employees $model, $key, $index, $column) {
					return Url::toRoute([$action, 'employee_id' => $model->employee_id]);
				}
			],
		],
	]); ?>


</div>
