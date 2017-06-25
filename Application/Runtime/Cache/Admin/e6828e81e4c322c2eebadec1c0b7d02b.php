<?php if (!defined('THINK_PATH')) exit();?><!-- $Id: category_info.htm 16752 2009-10-20 09:59:38Z wangleisvn $ -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>ECSHOP 管理中心 - 添加分类 </title>
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="/Public/Admin/Styles/general.css" rel="stylesheet" type="text/css"/>
    <link href="/Public/Admin/Styles/main.css" rel="stylesheet" type="text/css"/>
    <script src="/Public/Admin/Js/jquery.js"></script>
    <script src="/Public/Admin/Js/jquery.validate.js"></script>
    <script>
        $(function(){
//            $('#type_name')
            $('#type_frm').validate({
                rules:{
                    type_name:'required'
                },
                messages:{
                    type_name:'&nbsp;&nbsp;<span style="color:red">商品类型不能为空</span>'
                }
            })
        })
    </script>
</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo U('lst');?>">商品类型</a></span>
    <span class="action-span1"><a href="<?php echo U('index/main');?>">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - 修改类型 </span>
    <div style="clear:both"></div>
</h1>
<div class="main-div">
    <form action="/index.php/Admin/Type/edit" method="post"  id="type_frm" >
        <input type="hidden" name="id" value="<?php echo ($typeData["id"]); ?>">
        <table width="100%" id="general-table">
            <tr>
                <td class="label">分类名称:</td>
                <td>
                    <input type='text' name='type_name' value="<?php echo ($typeData["type_name"]); ?>" id="type_name" maxlength="20"  size='27'/> <span style="color:red">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">
                </td>
                <td>
                    <input type="submit" value=" 确定 "/>
                    <input type="reset" value=" 重置 "/>
                </td>
            </tr>
        </table>
    </form>
</div>

<div id="footer">
    共执行 3 个查询，用时 0.162348 秒，Gzip 已禁用，内存占用 2.266 MB<br/>
    版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。
</div>

</body>
</html>