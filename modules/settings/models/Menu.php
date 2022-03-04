<?php

namespace app\modules\settings\models;

use app\models\BaseModel;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "menu".
 *
 * @property int $id
 * @property string $menu_name
 * @property string $table_name
 * @property string $role_name
 * @property string $icon_name
 * @property string $url
 * @property int $status
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 * @property int $parent_id
 *
 * @property Menu[] $menus
 */
class Menu extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'created_by', 'updated_by', 'created_at', 'updated_at', 'parent_id','icon_name','url'], 'default', 'value' => null],
            [['status', 'created_by', 'updated_by', 'created_at', 'updated_at', 'parent_id'], 'integer'],
            [['menu_name', 'table_name', 'role_name'], 'string', 'max' => 255],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Menu::className(), 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'menu_name' => Yii::t('app', 'Menu Name'),
            'table_name' => Yii::t('app', 'Table Name'),
            'role_name' => Yii::t('app', 'Role Name'),
            'status' => Yii::t('app', 'Status'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'icon_name' => Yii::t('app', 'Icon Name'),
            'url' => Yii::t('app', 'Url'),
        ];
    }

    public function beforeSave($insert)
    {
        if ($this->isNewRecord){
            $this->status = BaseModel::STATUS_ACTIVE;
        }
        return parent::beforeSave($insert);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Menu::className(), ['id' => 'parent_id']);
    }

    /**
     * Gets query for [[Menus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChildren()
    {
        return $this->hasMany(Menu::className(), ['parent_id' => 'id']);
    }
    public static function getList($key = null){
        $query = self::find()
            ->select(['id','menu_name AS name'])
            ->where(['status' => BaseModel::STATUS_ACTIVE])
            ->asArray()
            ->all();
        if(!empty($query)){
            return ArrayHelper::map($query,'id','name');
        }
        return [];
    }

}
