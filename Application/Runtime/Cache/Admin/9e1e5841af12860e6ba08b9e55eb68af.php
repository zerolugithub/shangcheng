<?php if (!defined('THINK_PATH')) exit();?><!-- $Id: category_list.htm 17019 2010-01-29 10:10:34Z liuhui $ -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>ECSHOP 管理中心 - 商品类型 </title>
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="/Public/Admin/Styles/general.css" rel="stylesheet" type="text/css"/>
    <link href="/Public/Admin/Styles/main.css" rel="stylesheet" type="text/css"/>
    <script src="/Public/Admin/Js/jquery-1.8.2.min.js" type="text/javascript"></script>
    <script src="/Public/Admin/layer/layer.js" type="text/javascript"></script>
</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo U('add');?>">添加类型</a></span>
    <span class="action-span1"><a href="__GROUP__">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - 商品类型 </span>
    <div style="clear:both"></div>
</h1>


<form method="post" action="" name="listForm">
    <div class="list-div" id="listDiv">
        <table width="100%" cellspacing="1" cellpadding="2" id="list-table">
            <tr>
                <th>序号</th>
                <th>类型名称</th>
                <th>属性数</th>
                <th>操作</th>
            </tr>
            <?php if(is_array($typeData)): foreach($typeData as $k=>$val): ?><tr align="center" class="0">
                    <td width="15%" align="center"><span><<?php echo ($k); ?>></span></td>
                    <td width="15%" align="center"><span><?php echo ($val["type_name"]); ?></span></td>
                    <td width="15%" align="center"><span>0</span></td>
                    <td width="30%" align="center">
                        <a href="<?php echo U('Attribute/lst','type_id='.$val[id]);?>">属性列表</a> |
                        <a href="<?php echo U('edit',array('id'=>$val[id]));?>">编辑</a> |
                        <a href="javascript:void(0)" data_id="<?php echo ($val["id"]); ?>" title="移除" id="del">移除</a>
                    </td>
                </tr><?php endforeach; endif; ?>
            <tr>
                <td align="right" nowrap="true" colspan="6">
                    <!-- $Id: page.htm 14216 2008-03-10 02:27:21Z testyang $ -->
                    <div id="turn-page">
                        <?php echo ($show); ?>
                        <!--总计  <span id="totalRecords">9</span>
                        个记录分为 <span id="totalPages">1</span>
                        页当前第 <span id="pageCurrent">1</span>
                        页，每页 <input type='text' size='3' id='pageSize' value="15" onkeypress="return listTable.changePageSize(event)" />
                        <span id="page-link">
          <a href="javascript:listTable.gotoPageFirst()">第一页</a>
          <a href="javascript:listTable.gotoPagePrev()">上一页</a>
          <a href="javascript:listTable.gotoPageNext()">下一页</a>
          <a href="javascript:listTable.gotoPageLast()">最末页</a>
          <select id="gotoPage" onchange="listTable.gotoPage(this.value)">
            <option value='1'>1</option>          </select>
        </span>-->
                    </div>
                </td>
            </tr>
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
        $('#del').live('click',function(){
            _this = $(this);
            var id = _this.attr('data_id');
            if(confirm('删除商品类型将会清空该商品类型下的所有属性\n您确定要删除吗？')){
                $.post('<?php echo U("del");?>',{'id':id},function(data){
                    if(data['status']){
                        _this.parents('tr').remove();
                        layer.msg(data['info']);
                    }else{
                        layer.msg(data['info']);
                    }
                },'json');
            }
        });
    });
</script>
</html>