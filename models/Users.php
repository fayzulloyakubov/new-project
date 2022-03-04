<?php

namespace app\models;

use app\modules\admin\models\AuthAssignment;
use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $username
 * @property string|null $password
 * @property string|null $auth_key
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 */
class Users extends BaseModel implements \yii\web\IdentityInterface
{

    /**
     * @var string
     */
    const SCENARIO_CREATE = "scenario-create";

    /**
     * @var
     */
    public $isUpdate = false;

    /**
     * @var string
     */
    public $password_repeat;

    /**
     * @var
     */
    public $roles;

    /**
     * @var string
     */

    /**
     * @var string
     */
    public $email;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'created_at', 'updated_at', 'created_by', 'updated_by','name'], 'default', 'value' => null],
            [['status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['username', 'password', 'auth_key'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['username'], 'required'],
            [['password', 'password_repeat'], 'required', 'on' => self::SCENARIO_CREATE],
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>"Passwords don't match" ],
            [['roles'], 'safe'],
        ];
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if ($this->isNewRecord)
            $this->status = BaseModel::STATUS_ACTIVE;

        if ($this->isNewRecord && !empty($this->password))
            $this->setPassword();
        else
            unset($this->password);
        
        return parent::beforeSave($insert);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'password_repeat' => Yii::t('app', 'Password Repeat'),
            'email' => Yii::t('app', 'Email'),
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'status' => Yii::t('app', 'Status ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    public static function findIdentity($id)
    {
        return self::findOne(['id' => $id]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($access_token, $type = null)
    {

        return self::findOne(['access_token' => $access_token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return self::findOne(['username' => $username]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($auth_key)
    {
        return $this->auth_key === $auth_key;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === md5($password);
    }

    public function setPassword()
    {
        $this->password = md5($this->password);
    }

    /**
     * @return array
     */
    public function saveUser(): array
    {
        $transaction = Yii::$app->db->beginTransaction();
        $response = [
            'status' => true,
            'message' => Yii::t('app','Success'),
        ];
        try{
            if ($this->isUpdate && $response['status'] && $this->id){
                AuthAssignment::deleteAll(['user_id' => $this->id]);
            }
                if (!$this->save()){
                    $response = [
                        'status' => false,
                        'message' => Yii::t('app', 'User not saved'),
                        'errors' => $this->getErrors()
                    ];
                }
            /**
             * Rollarni saqlaydi
             */
            if ($response['status'] && !empty($this->roles)){
                foreach ($this->roles as $key => $role) {
                    $authAssignment = new AuthAssignment([
                        'item_name' => $key,
                        'user_id' => (string)$this->id,
                        'created_at' => time(),
                    ]);
                    if (!$authAssignment->save()){
                        $response = [
                            'status' => false,
                            'message' => Yii::t('app', 'Auth assigment not saved'),
                            'errors' => $authAssignment->getErrors()
                        ];
                        break;
                    }
                }
            }
            if($response['status']){
                $transaction->commit();
            }
            else{
                $transaction->rollBack();
            }
        } catch(\Exception $e){
            $transaction->rollBack();
            $response = [
                'status' => false,
                'message' => $e->getMessage(),
            ];
        }
        return $response;
    }

}
