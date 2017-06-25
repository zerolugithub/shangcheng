<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>ECSHOP 管理中心 - 商品品牌 </title>
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="/Public/Admin/Styles/general.css" rel="stylesheet" type="text/css"/>
    <link href="/Public/Admin/Styles/main.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="/Public/Admin/Js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="/Public/Admin/layer/layer.js"></script>
</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo U('add');?>">添加品牌</a></span>
    <span class="action-span1"><a href="#">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - 商品品牌 </span>
    <div style="clear:both"></div>
</h1>
<div class="form-div">
    <form action="" name="searchForm">
        <img src="/Public/Admin/Images/icon_search.gif" width="26" height="22" border="0" alt="search"/>
        <input type="text" name="brand_name" size="15"/>
        <input type="submit" value=" 搜索 " class="button"/>
    </form>
</div>
<form method="post" action="" name="listForm" enctype="multipart/form-data">
    <div class="list-div" id="listDiv">
        <table cellpadding="3" cellspacing="1">
            <tr>
                <th>品牌名称</th>
                <th>品牌网址</th>
                <th>品牌描述</th>
                <th>排序</th>
                <th>是否显示</th>
                <th>操作</th>
            </tr>
            <?php if(is_array($brandData)): foreach($brandData as $key=>$val): ?><tr>
                    <td class="first-cell">
                        <span style="float:right"><a href="" target="_brank"><img src="/Public/<?php echo ($val["brand_logo"]); ?>" width="16" height="16"
                                                                                  border="0" alt="品牌LOGO"/></a></span>
                        <span><?php echo ($val["brand_name"]); ?></span>
                    </td>
                    <td align="center">
                        <span>公司网站：</span> <a href="<?php echo ($val["brand_web"]); ?>" target="_brank"><?php echo ($val["brand_web"]); ?></a>
                    </td>
                    <td align="center"><?php echo ($val["brand_desc"]); ?></td>
                    <td align="center"><span><?php echo ($val["sort"]); ?></span></td>
                    <td align="center">
                        <?php if($val[is_show] == 1): ?><img src="/Public/Admin/Images/yes.gif"/>
                            <?php else: ?>
                            <img src="/Public/Admin/Images/no.gif"/><?php endif; ?>

                    </td>
                    <td align="center">
                        <a href="<?php echo U('edit',array('id'=>$val[id]));?>" title="编辑">编辑</a> |
                        <a href="javascript:" id="del" brand_id="<?php echo ($val["id"]); ?>" title="编辑">移除</a>
                    </td>
                </tr><?php endforeach; endif; ?>

            <tr>
                <td align="right" nowrap="true" colspan="6">
                    <div id="turn-page">
                        总计 <span id="totalRecords">11</span>
                        个记录分为 <span id="totalPages">1</span>
                        页当前第 <span id="pageCurrent">1</span>
                        页，每页 <input type='text' size='3' id='pageSize' value="15"/>
                        <span id="page-link">
                            <a href="#">第一页</a>
                            <a href="#">上一页</a>
                            <a href="#">下一页</a>
                            <a href="#">最末页</a>
                            <select id="gotoPage">
                                <option value='1'>1</option>
                            </select>
                        </span>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</form>

<div id="footer">
    共执行 3 个查询，用时 0.021251 秒，Gzip 已禁用，内存占用 2.194 MB<br/>
    版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。
</div>
</body>
<script>
    $(function(){
        $('#del').live('click',function(){
            if(confirm('您确定要移除该品牌吗？')){
                var _this= $(this);
                var brand_id = _this.attr('brand_id');
                $.post('/index.php/Admin/Brand/del',{'brand_id':brand_id},function(data){
                    if(data['status']==1){
                        _this.parents('tr').remove();
                    }else{
                        layer.msg(data['info']);
                    }
                },'json')
            }
        })
    })
</script>
</html>