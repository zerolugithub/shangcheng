<?php if (!defined('THINK_PATH')) exit();?><!-- $Id: category_info.htm 16752 2009-10-20 09:59:38Z wangleisvn $ -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>ECSHOP 管理中心 - 修改属性 </title>
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
                    arrt_name:'required'
                },
                messages:{
                    attr_name:'&nbsp;&nbsp;<span style="color:red">属性名称不能为空</span>'
                }
            })
        })
    </script>
</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo U('lst',array('type_id'=>0));?>">商品属性</a></span>
    <span class="action-span1"><a href="__GROUP__">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - 修改属性 </span>
    <div style="clear:both"></div>
</h1>
<div class="main-div">
    <form action="" method="post"  id="type_frm" >
        <input type="hidden" value="<?php echo ($attrData["id"]); ?>" name="attr_id">
        <table width="100%" id="general-table">
            <tr>
                <td class="label">属性名称:</td>
                <td>
                    <input type='text' name='attr_name' id="type_name" maxlength="20" value="<?php echo ($attrData["attr_name"]); ?>"  size='27'/> <span style="color:red">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">商品类型名称:</td>
                <td>
                    <select name="type_id" id="">
                        <!--<option value="0">请选择</option>-->
                        <?php if(is_array($typeData)): foreach($typeData as $key=>$t): if($attrData[type_id] == $typeData[id]): ?><option value="<?php echo ($t[id]); ?>" selected><?php echo ($t[type_name]); ?></option>
                                <?php else: ?>
                                <option value="<?php echo ($t[id]); ?>"><?php echo ($t[type_name]); ?></option><?php endif; endforeach; endif; ?>

                    </select>
                </td>
            </tr>
            <tr>
                <td class="label">属性类型:</td>
                <td>
                   <!-- <?php if($attrData[attr_type] == 0): ?><input type="radio" name="attr_type" value="0" checked>唯一属性
                        <input type="radio" name="attr_type" value="1">单选属性
                        <?php else: ?>
                        <input type="radio" name="attr_type" value="0">唯一属性
                        <input type="radio" name="attr_type" value="1" checked>单选属性<?php endif; ?>-->
                    <input type="radio" name="attr_type" value="0" <?php if($attrData[attr_type] == 0): ?>checked<?php endif; ?>>唯一属性
                    <input type="radio" name="attr_type" value="1" <?php if($attrData[attr_type] == 1): ?>checked<?php endif; ?>>单选属性
                </td>
            </tr>
            <tr>
                <td class="label">属性值的录入方式:</td>
                <td>
                    <input type="radio" name="attr_input_type" value="0" <?php if($attrData[attr_input_type] == 0): ?>checked<?php endif; ?>>手工录入
                    <input type="radio" name="attr_input_type" value="1" <?php if($attrData[attr_input_type] == 1): ?>checked<?php endif; ?>>从列表中选择
                </td>
            </tr>
            <tr>
                <td class="label">属性值的录入方式:</td>
                <td>
                    <textarea name="attr_value" cols="30" rows="10" value="<?php echo ($attrData["attr_value"]); ?>" id="textarea"><?php echo ($attrData["attr_value"]); ?></textarea>
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