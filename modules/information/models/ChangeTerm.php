<?php

namespace app\modules\information\models;

use app\models\BaseModel;
use Yii;

/**
 * This is the model class for table "change_term".
 *
 * @property int $id
 * @property string $old_term_date
 * @property string $new_term_date
 * @property string $change_term_reason
 * @property string $add_info
 * @property int $status
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 */
class ChangeTerm extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'change_term';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['old_term_date', 'new_term_date'], 'safe'],
            [['change_term_reason', 'add_info'], 'string'],
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
            'old_term_date' => Yii::t('app', 'Old Term Date'),
            'new_term_date' => Yii::t('app', 'New Term Time'),
            'change_term_reason' => Yii::t('app', 'Change Term Reason'),
            'add_info' => Yii::t('app', 'Add Info'),
            'status' => Yii::t('app', 'Status'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
