<?php
/**
 * Created by PhpStorm.
 * User: zhf
 * Date: 2017.06.11
 * Time: 20:04
 */
namespace Admin\Model;

use Think\Model;

class AttributeModel extends Model
{
    //
    //属性验证
    protected $_validate = array(
        array('attr_name' , 'require' , '属性名称不能为空')
    );

    protected function _before_insert(&$datas , $option)
    {
        //将属性可选值中的中文逗号替换成英文逗号
        $datas['attr_value'] = str_replace('，' , ',' , $datas['attr_value']);
    }

    /**
     * 获取分类属性，并将属性字符串转换成数组
     * @param $type_id
     * @return mixed
     */
    public function attrArr($type_id)
    {
        $attrData = $this->where('type_id='.$type_id)->select();
        foreach($attrData as $key=>$val){
            if($val['attr_input_type']==1){
                $attrData[$key]['attr_value']=explode(',',$val['attr_value']);
            }
        }
        return $attrData;
    }

}