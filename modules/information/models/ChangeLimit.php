<?php

namespace app\modules\information\models;

use app\models\BaseModel;
use Yii;

/**
 * This is the model class for table "change_limit".
 *
 * @property int $id
 * @property string $old_limit_date
 * @property string $new_limit_date
 * @property string $change_limit_reason
 * @property string $add_info
 * @property int $status
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 */
class ChangeLimit extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'change_limit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['old_limit_date', 'new_limit_date'], 'safe'],
            [['change_limit_reason', 'add_info'], 'string'],
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
            'old_limit_date' => Yii::t('app', 'Old Limit Date'),
            'new_limit_date' => Yii::t('app', 'New Limit Date'),
            'change_limit_reason' => Yii::t('app', 'Change Limit Reason'),
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
            $this->old_limit_date = date('Y-m-d H:i',strtotime($this->old_limit_date));
            $this->new_limit_date = date('Y-m-d H:i',strtotime($this->new_limit_date));
        }
        return parent::beforeSave($insert);
    }
}
