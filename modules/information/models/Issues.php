<?php

namespace app\modules\information\models;

use app\models\BaseModel;
use Yii;

/**
 * This is the model class for table "issues".
 *
 * @property int $id
 * @property string $issues_name
 * @property string $issues_date
 * @property string $issues_content
 * @property string $add_info
 * @property int $status
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 */
class Issues extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'issues';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['issues_date'], 'safe'],
            [['issues_content', 'add_info'], 'string'],
            [['status', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['status', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['issues_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'issues_name' => Yii::t('app', 'Issues Name'),
            'issues_date' => Yii::t('app', 'Issues Date'),
            'issues_content' => Yii::t('app', 'Issues Content'),
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
            $this->issues_date = date('Y-m-d H:i',strtotime($this->issues_date));
        }
        return parent::beforeSave($insert);
    }
}
