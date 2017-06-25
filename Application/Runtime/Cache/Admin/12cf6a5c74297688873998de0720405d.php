<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>ECSHOP 管理中心 - 商品列表 </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="/Public/Admin/Styles/general.css" rel="stylesheet" type="text/css"/>
    <link href="/Public/Admin/Styles/main.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="/Public/Admin/Js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="/Public/Admin/layer/layer.js"></script>

</head>
<script>
    //    window.onload=function(){
    function searchForm(){
        alert(1);
    }
    //    }

</script>

<body>
<h1>
    <span class="action-span"><a href="<?php echo U('add');?>">添加新商品</a></span>
    <span class="action-span1"><a href="<?php echo U('index/mian');?>">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - 商品列表 </span>
    <div style="clear:both"></div>
</h1>
<div class="form-div">
    <form action="" name="searchForm" id="searchFrm">
        <img src="/Public/Admin/Images/icon_search.gif" width="26" height="22" border="0" alt="search"/>
        <!-- 分类 -->
        <select name="cate_id">
            <option value="0">所有分类</option>
            <?php if(is_array($cateData)): foreach($cateData as $key=>$cate): ?><option value="<?php echo ($cate["id"]); ?>"><?php echo (str_repeat('&nbsp;',$cate["level"]*3)); echo ($cate["cate_name"]); ?></option><?php endforeach; endif; ?>
        </select>
        <!-- 品牌 -->
        <select name="brand_id">
            <option value="0">所有品牌</option>
        </select>
        <!-- 推荐 -->
        <select name="intro_type">
            <option value="0">全部</option>
            <option value="is_best">精品</option>
            <option value="is_new">新品</option>
            <option value="is_hot">热销</option>
        </select>
        <!-- 上架 -->
        <select name="is_sale">
            <option value=''>全部</option>
            <option value="1">上架</option>
            <option value="0">下架</option>
        </select>
        <!-- 关键字 -->
        关键字 <input type="text" name="keyword" size="15"/>
        <input type="button" value=" 搜索 " id="btn"  class="button"/>
    </form>
</div>
<script type="text/javascript">
    $(function(){
        $('#btn').click(function(){
            var searchObj=$('#searchFrm')[0];
            var searchData = new FormData(searchObj);
            var xhrObj = new XMLHttpRequest();
            xhrObj.onreadystatechange=function(){

            }
            xhrObj.open('post','<?php echo U("lst");?>');
            xhrObj.send(searchData);
        })
    })
</script>
<!-- 商品列表 -->
<form method="post" action="" name="listForm" onsubmit="">
    <div class="list-div" id="listDiv">
        <table cellpadding="3" cellspacing="1">
            <tr>
                <th>编号</th>
                <th>商品名称</th>
                <th>货号</th>
                <th>价格</th>
                <th>上架</th>
                <th>精品</th>
                <th>新品</th>
                <th>热销</th>
                <th>排序</th>
                <th>库存</th>
                <th>操作</th>
            </tr>
            <?php if(is_array($goodsData)): foreach($goodsData as $key=>$goods): ?><tr>
                    <td align="center"><?php echo ($goods["id"]); ?></td>
                    <td align="center" class="first-cell"><span><?php echo ($goods["goods_name"]); ?></span></td>
                    <td align="center"><span onclick=""><?php echo ($goods["goods_sn"]); ?></span></td>
                    <!--<td align="center"><span onclick=""><?php echo ($goods["goods_sn"]); ?></span></td> 商品分类和商品品牌
                    <td align="center"><span onclick=""><?php echo ($goods["goods_sn"]); ?></span></td>-->
                    <td align="center"><span><?php echo ($goods["shop_price"]); ?></span></td>
                    <td align="center"><img
                            src="<?php if(($goods["is_sale"] == 1)): ?>/Public/Admin/Images/yes.gif <?php else: ?> /Public/Admin/Images/no.gif<?php endif; ?>"/>
                    </td>
                    <td align="center"><img
                            src="<?php if(($goods["is_best"] == 1)): ?>/Public/Admin/Images/yes.gif <?php else: ?> /Public/Admin/Images/no.gif<?php endif; ?>"/>
                    </td>
                    <td align="center"><img
                            src="<?php if(($goods["is_new"] == 1)): ?>/Public/Admin/Images/yes.gif <?php else: ?> /Public/Admin/Images/no.gif<?php endif; ?>"/>
                    </td>
                    <td align="center"><img
                            src="<?php if(($goods["is_hot"] == 1)): ?>/Public/Admin/Images/yes.gif <?php else: ?> /Public/Admin/Images/no.gif<?php endif; ?>"/>
                    </td>
                    <td align="center"><span>100</span></td>
                    <td align="center"><span><?php echo ($goods["goods_number"]); ?></span></td>
                    <td align="center">
                        <a href="<?php echo U('photosAdd',array('id'=>$goods[id]));?>" title="相册"><img src="/Public/Admin/Images/img.png" width="16" height="16"
                                                                 border="0"/></a>
                        <!--<a href="/index.php/Goods/?goods_id=<<?php echo ($val["goods_id"]); ?>>" target="_blank" title="查看"><img src="/Public/Admin/Images/icon_view.gif" width="16" height="16" border="0" /></a>-->
                        <a href="<?php echo U('edit',array('id'=>$goods[id]));?>" title="编辑"><img
                                src="/Public/Admin/Images/icon_edit.gif" width="16" height="16" border="0"/></a>
                        <a href="javascript:void(0)" id="trash" data_id="<?php echo ($goods[id]); ?>" title="回收站"><img
                                src="/Public/Admin/Images/icon_trash.gif" width="16" height="16" border="0"/></a>
                    </td>
                </tr><?php endforeach; endif; ?>
        </table>

        <!-- 分页开始 -->
        <table id="page-table" cellspacing="0">
            <tr>
                <td width="80%">&nbsp;</td>
                <td align="center" nowrap="true">
                    <?php echo ($showPage); ?>
                </td>
            </tr>
        </table>
        <!-- 分页结束 -->
    </div>
</form>

<div id="footer">
    共执行 7 个查询，用时 0.028849 秒，Gzip 已禁用，内存占用 3.219 MB<br/>
    版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。
</div>
</body>
<script>
    $(function () {
        $('#trash').live('click',function () {
            if (confirm('确定要将该商品放入回收站？')) {
                var _this = $(this);
                var goods_id = _this.attr('data_id');
                $.post('<?php echo U("trash");?>', {'goods_id': goods_id}, function (data) {
                    if(data['status']==1){
                        _this.parents('tr').remove();
                    }else{
                        layer.msg(data['info']);
                    }
                }, 'json')
            }
        })
    })
</script>
</html>