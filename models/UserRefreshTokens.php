<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_refresh_tokens".
 *
 * @property int $id
 * @property int $user_id
 * @property string $refresh_token
 * @property int $expire_to
 * @property int $expire_refresh_token
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Users $users
 */
class UserRefreshTokens extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_refresh_tokens';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'expire_to', 'expire_refresh_token', 'status', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['user_id', 'expire_to', 'expire_refresh_token', 'status', 'created_at', 'updated_at'], 'integer'],
            [['refresh_token'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'refresh_token' => Yii::t('app', 'Refresh Token'),
            'expire_to' => Yii::t('app', 'Expire To'),
            'expire_refresh_token' => Yii::t('app', 'Expire Refresh Token'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }
    public static function generateRefreshToken($user_id, $solt = null){
        $param = $user_id . "." . Yii::$app->params['SECRET_KEY'] . "." . $solt;
        return str_replace('a','-', hash("whirlpool", $param . time()));
    }
}
