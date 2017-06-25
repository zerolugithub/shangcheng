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
    <script>
        $(function () {
            //给select添加change事件
            $("select[name=type_id]").change(function () {
                //change之后提交表单searchForm
                $("form[name=searchForm]").submit();
            })
        })
    </script>
</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo U('add');?>">添加属性</a></span>
    <span class="action-span1"><a href="__GROUP__">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - 商品属性 </span>
    <div style="clear:both"></div>
</h1>
<div class="form-div">
    <form action="/index.php/Admin/Attribute/lst" name="searchForm" method="get">
        <img src="/Public/Admin/images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH"/>
        按商品类型显示：
        <select name="type_id">
            <option value="0">所有商品类型</option>
            <?php if(is_array($typeData)): foreach($typeData as $key=>$type): if($type[id] == $type_id): ?><option value='<?php echo ($type["id"]); ?>' selected><?php echo ($type["type_name"]); ?></option>
                    <?php else: ?>
                    <option value='<?php echo ($type["id"]); ?>'><?php echo ($type["type_name"]); ?></option><?php endif; endforeach; endif; ?>
            <!--<option value='3'>电影</option>
            <option value='4'>手机</option>
            <option value='5'>笔记本电脑</option>
            <option value='6'>数码相机</option>
            <option value='7'>数码摄像机</option>
            <option value='8'>化妆品</option>
            <option value='9'>精品手机</option>-->
        </select>
    </form>
</div>
<form method="post" action="" name="listForm">
    <div class="list-div" id="listDiv">
        <table width="100%" cellspacing="1" cellpadding="2" id="list-table">
            <tr>
                <th>编号</th>
                <th>属性名称</th>
                <th>商品类型</th>
                <th>属性值录入方式</th>
                <th>可选值列表</th>
                <th colspan="2">操作</th>
            </tr>
            <?php if(is_array($attrData)): foreach($attrData as $key=>$val): ?><tr align="center" class="0">
                    <td width="15%" align="center"><span><<?php echo ($val["id"]); ?>></span></td>
                    <td width="15%" align="center"><span><?php echo ($val["attr_name"]); ?></span></td>
                    <td width="15%" align="center"><span><?php echo ($val["type_name"]); ?></span></td>
                    <td width="15%" align="center"><span><?php if($val[attr_input_type] == 0): ?>手工输入<?php else: ?>从列表中选择<?php endif; ?></span>
                    </td>
                    <td width="15%" align="center"><span><?php echo ($val["attr_value"]); ?></span></td>
                    <td width="30%" align="center">
                        <a href="<?php echo U('edit','id='.$val[id]);?>">编辑</a> |
                        <a href="javascript:void(0)" title="移除" data_id="<?php echo ($val[id]); ?>" id="del" onclick="">移除</a>
                    </td>
                </tr><?php endforeach; endif; ?>
            <tr>
                <td align="right" nowrap="true" colspan="6">
                    <!-- $Id: page.htm 14216 2008-03-10 02:27:21Z testyang $ -->
                    <div id="turn-page">
                        总计 <span id="totalRecords">9</span>
                        个记录分为 <span id="totalPages">1</span>
                        页当前第 <span id="pageCurrent">1</span>
                        页，每页 <input type='text' size='3' id='pageSize' value="15"
                                    onkeypress="return listTable.changePageSize(event)"/>
                        <span id="page-link">
          <a href="javascript:listTable.gotoPageFirst()">第一页</a>
          <a href="javascript:listTable.gotoPagePrev()">上一页</a>
          <a href="javascript:listTable.gotoPageNext()">下一页</a>
          <a href="javascript:listTable.gotoPageLast()">最末页</a>
          <select id="gotoPage" onchange="listTable.gotoPage(this.value)">
            <option value='1'>1</option>          </select>
        </span>
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
    $(function () {
        $('#del').live('click', function () {
            var _this = $(this);
            var id = _this.attr('data_id');
            $.post('/index.php/Admin/Attribute/del',{'id':id},function(data){
//                console.log(data);
                if(data['status']==1){
                    _this.parents('tr').remove();
                    layer.msg(data['info']);
                }else{
                    layer.msg(data['info']);
                }
            },'json')
        })
    })
</script>
</html>