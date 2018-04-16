<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
// +----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | 模型字段管理  Version 2016/12/3
// +----------------------------------------------------------------------
namespace app\admin\controller;

use app\admin\model\Dbmodel;
use app\admin\service\Attribute as Attributeapi;
use app\admin\model\Attribute as AttributeModel;
use think\Request;
use app\admin\service\Dbmodel as DbmodelApi;
use think\Db;

class Attribute extends Admin
{
    /**
     * @Mark:初始化
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/12/8
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->jumpUrl  =  'index';
        //获取字段类型列表
        $datatype = include APP_PATH.'/common/datatypes.php';
        $datatype_arr = [];
        foreach ($datatype as $k=>$v){
            $datatype_arr[$k]['title']=$v['langstr'];
            $datatype_arr[$k]['type']=getDataType($k);
        }
        $this->assign('datatype_arr',$datatype_arr);
    }
    
    /**
     * @Mark:属性列表
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/12/8
     */
    public function index(){
        $param      = $this->request->param();
        /* 查询条件初始化 */
        $map = [];
        if (isset($param['ids'])) $map['model_id'] = $param['ids'] ;
        $list = Attributeapi::getlist('Attribute', $map, 'sort desc,id asc');
        $this->assign('list', $list['list']);
        $this->assign('_total',$list['total']);
        $this->assign('page',$list['list']->render());
        $this->assign('model_id', isset($param['ids']) ? $param['ids'] : null);
        $this->assign('meta_title', lang('Field_list'));
        $this->assign('model_name', input('model'));
        return $this->fetch();
    }
    
    /**
     * @Mark:新增页面初始化
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/12/8
     */
    public function add(){
        $model_id  =  $this->request->param('model_id');
        $Dbmodel   = new Dbmodel();
        $model     = $Dbmodel::where('id', $model_id)->field('langstr,name')->find();
        $this->assign('model', $model);
        $this->assign("meta_title", lang('Field_add'));
        $this->assign("data", null);
        $this->assign("model_id", $model_id);
        return $this->fetch('edit');
    }
    
    
    /**
     * @Mark:保存数据
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/12/8
     */
    public function savedata()
    {
        $param = $this->request->param();
        if (!isset($param['status'])) $this->request->post(['status'=>0]);
        if (!isset($param['status'])) $this->request->post(['is_must'=>0]);
        //如果是枚举字段，将参数绑定进去
        if ($param['type'] == 'select'){
            $extra_str = implode("','",explode(",",trim($param['extra'])));
            $type_value = explode(' ',trim($param['type_value']));
            $param['type_value'] = $type_value[0].'(\''.$extra_str.'\') NOT NULL';
        }
        //检测表是否存在
        $re_table = DbmodelApi::checkTableExist($param['model_id']);
        //获取默认值
        $default = $param['value']!='' ? ' DEFAULT \''.$param['value'] .'\' ': '';
        $comment = $param['remark']!='' ? ' COMMENT \''.$param['remark'] .'\' ': '';
        if (isset($param['id'])) {
            if ($re_table['code'] == 0) $this->error(lang('Table_Not_Exist'));
            //获取原字段信息
            $field_info = AttributeModel::get($param['id']);
            //获取原字段名
            $last_field = $field_info['name'];
            
            $sql = <<<sql
ALTER TABLE `{$re_table['data']['name']}` CHANGE  COLUMN `{$last_field}` `{$param['name']}`  {$param['type_value']} {$default} {$comment};
sql;
        } else {
            if ($re_table['code'] == 0){
                //判断是否需有主键
                if ($re_table['data']['need_pk']) {
                    $sql = <<<sql
CREATE TABLE IF NOT EXISTS `{$re_table['data']['name']}` (\n
`id`  int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键' ,\n
`{$param['name']}`  {$param['type_value']} {$default}  {$comment}  ,\n
PRIMARY KEY (`id`)
)
ENGINE={$re_table['data']['engine_type']}
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
CHECKSUM=0
ROW_FORMAT=DYNAMIC
DELAY_KEY_WRITE=0
;
sql;
                } else {
                    //创建表
                    $sql = <<<sql
DROP TABLE IF EXISTS {$re_table['data']['name']};
CREATE TABLE `{$re_table['data']['name']}` (
  `{$param['name']}` {$param['type_value']} {$default} {$comment} \n
) ENGINE={$re_table['data']['engine_type']}
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
CHECKSUM=0
ROW_FORMAT=DYNAMIC
DELAY_KEY_WRITE=0
COMMENT='{$re_table['data']['remark']}';
sql;
                }
            } else {
                $sql = <<<sql
ALTER TABLE `{$re_table['data']['name']}`
ADD COLUMN `{$param['name']}`  {$param['type_value']} {$default} {$comment};
sql;
            }
        }
        try {
            Db::execute($sql);
            //更新schame文件
            create_schame_file($param['model_id']);
        } catch (\Exception $e){
            $this->error($e->getMessage());
        }
        $this->jumpUrl ="index";
        parent::savedata();
    }
    
    /**
     * @Mark:删除一条数据
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/12/8
     */
    public function delete(){
        $param = $this->request->param();
        $id = isset($param['ids'])?$param['ids']:'';
        empty($id) && $this->error(lang('Error_id'));
        
        $Attribute   =  new AttributeModel();
        $info = AttributeModel::all(['id'=>['in',$id]])->toArray();
        empty($info) && $this->error(lang('Field_not_find'));
        Db::startTrans();
        try{
            //删除属性数据
            $Attribute->where(['id'=>['in',$id]])->delete();
            //删除表字段
            AttributeApi::deleteField($info);
            Db::commit();
        } catch (\Exception $exception) {
            Db::rollback();
            $this->error($exception->getMessage());
        }
        //记录行为
        action_log('update_attribute', 'attribute', $id, UID);
        $this->success(lang('Deleteok'), url('index',['ids'=>$param['model_id']]));
    }
    
    
}