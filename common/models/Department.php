<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%department}}".
 *
 * @property int $department_id
 * @property string $department_title
 *
 * @property Employees[] $employees
 */
class Department extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%department}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['department_title'], 'required'],
            [['department_title'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'department_id' => 'Department ID',
            'department_title' => 'Department Title',
        ];
    }

    /**
     * Gets query for [[Employees]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\EmployeeQuery
     */
    public function getEmployees()
    {
        return $this->hasMany(Employees::className(), ['department_id' => 'department_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\DepartmentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\DepartmentQuery(get_called_class());
    }
}
