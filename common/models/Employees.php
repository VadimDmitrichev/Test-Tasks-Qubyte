<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%employees}}".
 *
 * @property int $employee_id
 * @property int $department_id
 * @property int $post_id
 * @property string $name
 *
 * @property Department $department
 * @property Post $post
 */
class Employees extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%employees}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['department_id', 'post_id', 'name'], 'required'],
            [['department_id', 'post_id'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['name'], 'unique'],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['department_id' => 'department_id']],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['post_id' => 'post_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'employee_id' => 'ID',
            'department_id' => 'Отдел',
            'post_id' => 'Должность',
            'name' => 'Сотрудник',
        ];
    }

    /**
     * Gets query for [[Department]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\DepartmentQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['department_id' => 'department_id']);
    }

    /**
     * Gets query for [[Post]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\PostQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['post_id' => 'post_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\EmployeesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\EmployeesQuery(get_called_class());
    }
}
