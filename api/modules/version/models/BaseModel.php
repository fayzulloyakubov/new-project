<?php


namespace app\api\modules\version\models;


use app\modules\settings\models\Menu;
use Yii;

class BaseModel extends Menu
{
    // Menyu listini shakllantirish uchun so'rov

    public static function getMenuList(){

            $query = self::find()->select([
                    'id',
                    'parent_id',
                    'menu_name AS name',
                    'icon_name AS icon',
                    'url'
                ])
                ->where(['parent_id' => null])
                ->with([
                    'children' => function ($e) {
                        $e->from(['m' => 'menu'])->select([
                            'm.menu_name AS name',
                            'm.parent_id',
                            'm.icon_name AS icon',
                            'm.url'
                        ]);
                    }
                ])
                ->andWhere(['status' => self::STATUS_ACTIVE])
                ->orderBy(['id' => SORT_ASC])
                ->asArray()
                ->all();
            $results = [];
            $i = 0;
            if (!empty($query)) {
                foreach ($query as $row) {
                    if (Yii::$app->user->can($row['name'])) {
                        $results[$i] = $row;
                        $results[$i]['children'] = [];
                        if (!empty($row['children'])) {
                            foreach ($row['children'] as $child) {
                                if (Yii::$app->user->can($child['name'])) {
                                    $results[$i]['children'][] = $child;
                                }
                            }
                        }
                        $i++;
                    }
                }
            }
            return $results;
    }
}