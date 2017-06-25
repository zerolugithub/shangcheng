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
</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo U('lst');?>">角色列表</a></span>
    <span class="action-span1"><a href="__GROUP__">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - 添加角色 </span>
    <div style="clear:both"></div>
</h1>
<div class="main-div">
    <form action="" method="post" name="theForm">
        <table width="100%" id="general-table" align="center">
            <tr>
                <td class="label">角色名称:</td>
                <td>
                    <input type='text' name='role_name' maxlength="20" value='' size='27'/> <font color="red">*</font>
                </td>
            </tr>
            <tr>
                <td class="label">角色描述:</td>
                <td>
                    <textarea rows="5" cols="25" name="role_desc"></textarea>
                </td>
            </tr>
        </table>
        <hr style="color: #ccc; margin: 0px;padding: 0px;" />
        <table width="1000" align="center">
            <?php if(is_array($privData)): foreach($privData as $key=>$priv): ?><tr>
                    <td class="label" align="left" width="30%">
                        <input type="checkbox" name="priv_id[]" value="<?php echo ($priv["id"]); ?>"><?php echo ($priv["priv_name"]); ?>
                    </td>
                    <td align="left" width="70%">
                        <?php if(is_array($priv[_child])): foreach($priv[_child] as $key=>$son): if($son[_child]): ?><input type="checkbox" name="priv_id[]" value="<?php echo ($son["id"]); ?>"><?php echo ($son["priv_name"]); ?>
                                <?php if(is_array($son[_child])): foreach($son[_child] as $key=>$v): ?><input type="checkbox" name="priv_id[]" value="<?php echo ($v["id"]); ?>"><?php echo ($v["priv_name"]); endforeach; endif; ?>
                                <?php else: ?>
                                <input type="checkbox" name="priv_id[]" value="<?php echo ($son["id"]); ?>"><?php echo ($son["priv_name"]); endif; endforeach; endif; ?>
                    </td>
                </tr><?php endforeach; endif; ?>
            <hr style="color: #ccc; margin: 0px;padding: 0px;" />
            <table>
            <tr>
                <td class="label"></td>
                <td>
                    <input type="checkbox" value="" />全选
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
        </table>
    </form>
</div>

<div id="footer">
    共执行 3 个查询，用时 0.162348 秒，Gzip 已禁用，内存占用 2.266 MB<br/>
    版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。
</div>
</body>
</html>