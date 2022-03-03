<?php

namespace app\modules\information\models;

use app\models\BaseModel;
use Yii;

/**
 * This is the model class for table "queries".
 *
 * @property int $id
 * @property string $queries_name
 * @property string $queries_date
 * @property string $queries_content
 * @property string $add_info
 * @property int $status
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 */
class Queries extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'queries';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['queries_date'], 'safe'],
            [['queries_content', 'add_info'], 'string'],
            [['status', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['status', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['queries_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'queries_name' => Yii::t('app', 'Queries Name'),
            'queries_date' => Yii::t('app', 'Queries Date'),
            'queries_content' => Yii::t('app', 'Queries Content'),
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
            $this->queries_date = date('Y-m-d H:i',strtotime($this->queries_date));
        }
        return parent::beforeSave($insert);
    }
}
