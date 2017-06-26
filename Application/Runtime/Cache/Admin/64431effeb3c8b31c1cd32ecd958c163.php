<?php if (!defined('THINK_PATH')) exit();?><!-- $Id: category_list.htm 17019 2010-01-29 10:10:34Z liuhui $ -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>ECSHOP 管理中心 - 权限管理 </title>
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="/Public/Admin/Styles/general.css" rel="stylesheet" type="text/css"/>
    <link href="/Public/Admin/Styles/main.css" rel="stylesheet" type="text/css"/>
    <script src="/Public/Admin/Js/jquery-1.8.2.min.js" type="text/javascript"></script>
    <script src="/Public/Admin/layer/layer.js" type="text/javascript"></script>
</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo U('add');?>">添加角色</a></span>
    <span class="action-span1"><a href="<?php echo U('index/main');?>">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - 权限管理 </span>
    <div style="clear:both"></div>
</h1>
<form method="post" action="" name="listForm">
    <div class="list-div" id="listDiv">
        <table width="100%" cellspacing="1" cellpadding="2" id="list-table">
            <tr>
                <th>编号</th>
                <th>角色名称</th>
                <th>角色描述</th>
                <th>角色权限</th>
                <th>操作</th>
            </tr>
            <?php if(is_array($roleLst)): foreach($roleLst as $k=>$val): ?><tr align="center" class="0">
                    <td align="center"><?php echo ($k+1); ?></td>
                    <td align="right" class="first-cell"><?php echo ($val["role_name"]); ?></td>
                    <td align="left" class="first-cell"><?php echo ($val["role_desc"]); ?></td>
                    <td align="left" class="first-cell"><?php echo ($val["priv_name"]); ?></td>
                    <td align="center">
                        <a href="<?php echo U('edit','id='.$cate[id]);?>">编辑</a> |
                        <a href="javascript:void(0)" title="移除" data_id="<?php echo ($cate[id]); ?>" id="del">移除</a>
                    </td>
                </tr><?php endforeach; endif; ?>
        </table>
    </div>
</form>
<div id="footer">
    共执行 1 个查询，用时 0.055904 秒，Gzip 已禁用，内存占用 2.202 MB<br/>
    版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。
</div>
</body>
<script>
    $(function(){
        $('#list-table #del').live('click',function(){
            if(confirm('您确定要删除此分类')){
                var _this=$(this);
                var id=_this.attr('data_id');
                console.log(id);
                $.post('<?php echo U("category/del");?>',{'id':id},function(data){
                    if(data['status']==1){
                        layer.msg(data['info']);
                        _this.parents('tr').remove();
                    }else{
                        layer.msg(data['info']);
                    }
                },'json');
            }
        });
    });
</script>
</html>