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
    <script src="/Public/Admin/Js/jquery-1.8.2.min.js" type="text/javascript"></script>
    <script src="/Public/Admin/layer/layer.js" type="text/javascript"></script>
</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo U('lst');?>">商品分类</a></span>
    <span class="action-span1"><a href="__GROUP__">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - 添加分类 </span>
    <div style="clear:both"></div>
</h1>
<div class="main-div">
    <form action="" method="post" id="frm">
        <input type="hidden" value="<?php echo ($cateData["id"]); ?>" name="id">
        <table width="100%" id="general-table">
            <tr>
                <td class="label">分类名称:</td>
                <td>
                    <input type='text' name='cate_name' maxlength="20" value="<?php echo ($cateData["cate_name"]); ?>" size='27'/> <font
                        color="red">*</font>
                </td>
            </tr>
            <tr>
                <td class="label">上级分类:</td>
                <td>
                    <select name="pid">
                        <option value="0">顶级分类</option>
                        <?php if(is_array($cateTree)): foreach($cateTree as $key=>$val): ?><option value="<?php echo ($val["id"]); ?>"
                            <?php if($val[id] == $cateData[pid]): ?>selected="selected"<?php endif; ?>
                            ><?php echo (str_repeat('&nbsp;&nbsp;',$val["level"])); echo ($val["cate_name"]); ?></option><?php endforeach; endif; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="label">排序:</td>
                <td>
                    <input type="text" name='cate_sort' value="<?php echo ($cateData[cate_sort]); ?>" size="15"/>
                </td>
            </tr>
            <tr>
                <td class="label">是否显示:</td>
                <td>
                    <input type="radio" name="is_show" value="1"
                    <?php if($cateData[is_show] == 1): ?>checked="true"<?php endif; ?>
                    /> 是
                    <input type="radio" name="is_show" value="0"
                    <?php if($cateData[is_show] == 0): ?>checked="true"<?php endif; ?>
                    /> 否
                </td>
            </tr>
            <tr>
                <td class="label">导航显示:</td>
                <td>
                    <input type="radio" name="nav_show" value="1"
                    <?php if($cateData[nav_show] == 1): ?>checked="true"<?php endif; ?>
                    /> 是
                    <input type="radio" name="nav_show" value="0"
                    <?php if($cateData[nav_show] == 0): ?>checked="true"<?php endif; ?>
                    /> 否
                </td>
            </tr>
            <tr>
                <td class="label">关键字:</td>
                <td>
                    <input type="text" name="key_word" value='<?php echo ($cateData["key_word"]); ?>' size="50">
                </td>
            </tr>
            <tr>
                <td class="label"></td>
                <td>
                    <!--<input type="button" id="sub" value=" 确定 " onclick="sub_t()"/>-->
                    <input type="button" id="sub" value=" 确定 "/>
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
<script>
    $(function () {
        $('#sub').click(function () {
            var formObj = $('#frm')[0];
            var formData = new FormData(formObj);
            var xhrobj = new XMLHttpRequest()
            xhrobj.onreadystatechange = function () {
                if (xhrobj.readyState == 4 && xhrobj.status == 200) {
                    var data = JSON.parse(xhrobj.responseText);
                    if (data['status'] == 0) {
                        layer.msg(data["info"]);
                    } else {
                        layer.msg(data["info"]);
                        $('#frm').attr('action', data['url']);
                        $('#frm').submit();
                    }
                }
            }
            xhrobj.open('post', '<?php echo U("category/edit");?>')
            xhrobj.send(formData);
        })
    })


    //        function sub_t() {
    //            var formObj = document.getElementById('frm');
    //            var formData = new FormData(formObj);
    //            xhrObj = new XMLHttpRequest();
    //            xhrObj.onreadystatechange = function () {
    //                if (xhrObj.readyState == 4 && xhrObj.status == 200) {
    //                    console.log(xhrObj.responseText);
    //                }
    //            }
    //            xhrObj.open('POST', "<?php echo U('category/edit');?>");
    //            //xhrObj.setRequestHeader('content-type', 'application/x-www-form-urlencoded');
    //            xhrObj.send(formData);
    //        }
</script>
</html>