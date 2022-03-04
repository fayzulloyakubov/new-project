<?php


namespace app\api\modules\version\models;


use app\modules\settings\models\Menu;
use Yii;

class BaseModel extends Menu
{
    public static function getMenuList(){
        {
            $items = self::find()
                ->select([
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
            if (!empty($items)) {
                foreach ($items as $item) {
                    if (Yii::$app->user->can($item['name'])) {
                        $results[$i] = $item;
                        $results[$i]['children'] = [];
                        if (!empty($item['children'])) {
                            foreach ($item['children'] as $child) {
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
}