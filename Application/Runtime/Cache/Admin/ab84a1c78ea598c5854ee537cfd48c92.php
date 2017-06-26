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
    <script type="text/javascript" src="/Public/Admin/Js/jquery-1.8.2.min.js"></script>
    <style>
        .main-div2 {
            background-color: #ffffff;
        }
        #privSel {
            margin-left: 145px;
            width: 850px;
            background-color: #557766;
        }
        #privSel td{
            border: 1px solid #CCCCCC;
        }
    </style>
</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo U('lst');?>">角色列表</a></span>
    <span class="action-span1"><a href="__GROUP__">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - 添加角色 </span>
    <div style="clear:both"></div>
</h1>
<div class="main-div">
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
        <hr style="color: #ccc; margin: 0px;padding: 0px;"/>
        <div class="main-div2">
        <table width="1000" align="center" id="privSel">
            <?php if(is_array($privData)): foreach($privData as $key=>$priv): ?><tr>
                    <td class="label" align="left" width="30%">
                        <input type="checkbox" name="priv_id[]" class="partSel" data="<?php echo ($priv["id"]); ?>" value="<?php echo ($priv["id"]); ?>"><?php echo ($priv["priv_name"]); ?>
                    </td>
                    <td align="left" width="70%" id="check_<?php echo ($priv["id"]); ?>">
                        <?php if(is_array($priv[_child])): foreach($priv[_child] as $k=>$son): if($son[_child]): ?><input type="checkbox" name="priv_id[]" class="sel" value="<?php echo ($son["id"]); ?>"><?php echo ($son["priv_name"]); ?>
                                <?php if(is_array($son[_child])): foreach($son[_child] as $i=>$v): ?><input type="checkbox" name="priv_id[]" class="sel" value="<?php echo ($v["id"]); ?>"><?php echo ($v["priv_name"]); endforeach; endif; ?>
                                <?php else: ?>
                                <input type="checkbox" name="priv_id[]" class="sel" value="<?php echo ($son["id"]); ?>"><?php echo ($son["priv_name"]); endif; ?>
                            <?php if($k+$i == 4): ?><br/><?php endif; endforeach; endif; ?>
                    </td>
                </tr><?php endforeach; endif; ?>
            <hr style="color: #ccc; margin: 0px;padding: 0px;"/>

                <tr>
                    <td class="label"></td>
                    <td>
                        <input type="checkbox" value="" id="selAll"/>全选
                    </td>
                </tr>
            <table>
                <tr>
                    <td class="label"></td>
                    <td>
                        <input type="submit" value=" 确定 "/>
                        <input type="reset" value=" 重置 "/>
                    </td>
                </tr>
            </table>
        </table>
        </div>
    </form>

</div>

<div id="footer">
    共执行 3 个查询，用时 0.162348 秒，Gzip 已禁用，内存占用 2.266 MB<br/>
    版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。
</div>
</body>
<script>
    $(function () {
        $('#selAll').click(function () {
            var flag_all = true;
            $('#privSel :checkbox').each(function () {
                $(this).prop('checked', !$(this).prop('checked'))
            });
            $('.partSel').each(function () {
                var id = $(this).attr('data');
                var selector = '#check_' + id + ' :checkbox';
                var flag_part = $(selector).parents('tr').find('.partSel').prop('checked');
                $(selector).each(function () {
                    var flag = $(this).prop('checked');
                    flag_part = flag || flag_part;
                    flag_all = flag_all && flag;
                });
                $(selector).parents('tr').find('.partSel').prop('checked', flag_part);
                flag_all = flag_part && flag_all;
            });
            if (!flag_all) {
                $('#selAll').prop('checked', flag_all);
            } else {
                $('#selAll').prop('checked', flag_all);
            }
        });

        $('.partSel').click(function () {
            var flag_all = true;
            var id = $(this).attr('data');
            var selector = '#check_' + id + ' :checkbox';
            var flag_part = $(selector).parents('tr').find('.partSel').prop('checked');
            $(selector).prop('checked', flag_part);
            $('#privSel .sel').each(function () {
                var flag = $(this).prop('checked');
                flag_all = flag_all && flag;
            });
            if (!flag_all) {
                $('#selAll').prop('checked', flag_all);
            } else {
                $('#selAll').prop('checked', flag_all);
            }

        });


        $('.sel').click(function () {
            var pid = $(this).parents('tr').find('.partSel').attr('data');
            var selector = '#check_' + pid + ' :checkbox';
            var flags_part = false;
            var flags_all = true;
            $('#privSel .sel').each(function () {
                var flag = $(this).prop('checked');
                $(selector).each(function () {
                    var flags = $(this).prop('checked');
                    flags_part = flags_part || flags;
                    flags_all = flags_all && flags;
                });
                $(selector).parents('tr').find('.partSel').prop('checked', flags_part);
                flags_all = flags_all && flag;
            });
            $('#selAll').prop('checked', flags_all);
        });
    })
</script>
</html>