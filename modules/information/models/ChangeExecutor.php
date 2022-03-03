<?php

namespace app\modules\information\models;

use app\models\BaseModel;
use Yii;

/**
 * This is the model class for table "change_executor".
 *
 * @property int $id
 * @property string $old_executor_date
 * @property string $new_executor_date
 * @property string $change_executor_reason
 * @property string $add_info
 * @property int $status
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 */
class ChangeExecutor extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'change_executor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['old_executor_date', 'new_executor_date'], 'safe'],
            [['change_executor_reason', 'add_info'], 'string'],
            [['status', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['status', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'old_executor_date' => Yii::t('app', 'Old Executor Date'),
            'new_executor_date' => Yii::t('app', 'New Executor Date'),
            'change_executor_reason' => Yii::t('app', 'Change Executor Reason'),
            'add_info' => Yii::t('app', 'Add Info'),
            'status' => Yii::t('app', 'Status'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
    public function beforeSave($insert)
    {
        if ($this->isNewRecord){
            $this->status = BaseModel::STATUS_ACTIVE;
            $this->old_executor_date = date('Y-m-d H:i',strtotime($this->old_executor_date));
            $this->new_executor_date = date('Y-m-d H:i',strtotime($this->new_executor_date));
        }
        return parent::beforeSave($insert);
    }
}
