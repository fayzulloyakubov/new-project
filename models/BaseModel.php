<?php

namespace app\models;

use app\components\OurCustomBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * Class BaseModel
 */
class BaseModel extends ActiveRecord
{
    const STATUS_ACTIVE             = 1;
    const STATUS_INACTIVE           = 2;
    const STATUS_SAVED              = 3;
    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            [
                'class' => OurCustomBehavior::className(),
            ],
            [
                'class' => TimestampBehavior::className(),
            ]
        ];
    }

    /**
     * @param string $need
     * @return float|int
     **/

    public static function getStatusList($key = null){
        $result = [
            self::STATUS_ACTIVE   => Yii::t('app','Active'),
            self::STATUS_INACTIVE => Yii::t('app','Deleted'),
            self::STATUS_SAVED => Yii::t('app','Saved'),
        ];
        if(!empty($key)){
            return $result[$key] ?? '';
        }
        return $result;
    }
}

