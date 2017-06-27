<?php if (!defined('THINK_PATH')) exit();?><!-- $Id: category_info.htm 16752 2009-10-20 09:59:38Z wangleisvn $ -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ECSHOP 管理中心 - 修改权限 </title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Public/Admin/Styles/general.css" rel="stylesheet" type="text/css" />
<link href="/Public/Admin/Styles/main.css" rel="stylesheet" type="text/css" />
</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo U('lst');?>">权限列表</a></span>
    <span class="action-span1"><a href="__GROUP__">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - 修改权限 </span>
    <div style="clear:both"></div>
</h1>
<div class="main-div">
    <form action="" method="post" name="theForm" >
        <input type="hidden" name="priv_id" value="<?php echo ($privData["id"]); ?>">
        <table width="100%" id="general-table" align="center">
            <tr>
                <td class="label">权限名称:</td>
                <td>
                    <input type='text' name='priv_name' maxlength="20" value='<?php echo ($privData["priv_name"]); ?>' size='27' /> <font color="red">*</font>
                </td>
            </tr>
            <tr>
                <td class="label">上级权限:</td>
                <td>
                    <select name="pid">
                        <?php if(is_array($privTree)): foreach($privTree as $key=>$val): if($val[id] == $privData.pid): ?><option value="<?php echo ($val["id"]); ?>" selected ><?php echo (str_repeat('&nbsp;',$val["level"]*2)); echo ($val["priv_name"]); ?></option>
                                <?php else: ?>
                                <option value="<?php echo ($val["id"]); ?>" ><?php echo (str_repeat('&nbsp;',$val["level"]*2)); echo ($val["priv_name"]); ?></option><?php endif; endforeach; endif; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="label">权限模型名称:</td>
                <td>
                    <input type="text" name='module_name'  size="15" value="<?php echo ($privData["module_name"]); ?>" />
                </td>
            </tr>
            <tr>
                <td class="label">权限控制器名称:</td>
                <td>
                    <input type="text" name='controller_name'  size="15" value="<?php echo ($privData["controller_name"]); ?>" />
                </td>
            </tr>
            <tr>
                <td class="label">权限方法名称:</td>
                <td>
                    <input type="text" name='action_name'  size="15" value="<?php echo ($privData["action_name"]); ?>" />
                </td>
            </tr>
            <tr>
                <td class="label">是否显示:</td>
                <td>
                    <input type="radio" name="is_show" value="1" <?php if($privData[is_show] == 1): ?>checked<?php endif; ?> /> 是
                    <input type="radio" name="is_show" value="0" <?php if($privData[is_show] == 0): ?>checked<?php endif; ?> /> 否
                </td>
            </tr>
            <tr>
                <td class="label"></td>
                <td>
                    <input type="submit" value=" 确定 " />
                    <input type="reset" value=" 重置 " />
                </td>
            </tr>
        </table>
    </form>
</div>

<div id="footer">
共执行 3 个查询，用时 0.162348 秒，Gzip 已禁用，内存占用 2.266 MB<br />
版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>
</body>
</html>