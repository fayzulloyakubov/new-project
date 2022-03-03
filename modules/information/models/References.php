<?php

namespace app\modules\information\models;

use app\models\BaseModel;
use Yii;

/**
 * This is the model class for table "references".
 *
 * @property int $id
 * @property string $reference_name
 * @property string $reference_date
 * @property string $reference_content
 * @property string $add_info
 * @property int $status
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 */
class References extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'references';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['reference_date'], 'safe'],
            [['reference_content', 'add_info'], 'string'],
            [['status', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['status', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['reference_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'reference_name' => Yii::t('app', 'Reference Name'),
            'reference_date' => Yii::t('app', 'Reference Date'),
            'reference_content' => Yii::t('app', 'Reference Content'),
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
            $this->reference_date = date('Y-m-d H:i',strtotime($this->reference_date));
        }
        return parent::beforeSave($insert);
    }
}
