<?php
namespace app\api\model;
use app\models\BaseModel;

class Menu extends \app\modules\settings\models\Menu
{
    public static function getMenuList($user = null,$parent_id = null){
        $items = Menu::find()
//            ->where(['parent_id' => $parent_id])
//            ->andWhere(['!=','status',BaseModel::STATUS_INACTIVE])
//            ->andFilterWhere(['' => $user_id])
            ->orderBy(['id' => SORT_ASC])
            ->asArray()
            ->all();

        $query = "";
        foreach ($items as $item)
            if ($item['id'] == null)
                $query = $query . "<ul><li value='{$item['id']}'  data-jstree='{ \"selected\" : true }'>{$item['menu_name']}" . self::getMenuList($item['id']) . "</li></ul>";
            else
                $query = $query . "<ul><li value='{$item['id']}'  data-jstree='{  }'>{$item['name']}" . self::getMenuList($item['id']) . "</li></ul>";

        return $query;
        return $query;
    }
}