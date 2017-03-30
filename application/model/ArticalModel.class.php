<?php

/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2017/3/16
 * Time: 14:32
 */
class ArticalModel extends Model
{
    /**
     * 加红或者取消加红
     * @param $id           文章的ID
     * @param $is_red       判断是要加红还是未加红(0和1)
     */
    public function addOrCancle($id, $is_red, $arrayDataValue, $where)
    {
        //取消加红
        //return $this->update(TABLE_A, $arrayDataValue, $where, true);

    }


}