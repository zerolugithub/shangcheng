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
    <span class="action-span"><a href="<?php echo U('lst');?>">管理员列表</a></span>
    <span class="action-span1"><a href="<?php echo U('index/main');?>">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - 添加管理员 </span>
    <div style="clear:both"></div>
</h1>
<div class="main-div">
    <form action="" method="post"  id="type_frm" >
        <table width="100%" id="general-table" align="center">
            <tr>
                <td class="label" style="width: 35%">用&nbsp;户&nbsp;名：</td>
                <td>
                    <input type='text' name='admin_name' id="admin_name" /> <span style="color:red">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码：</td>
                <td>
                    <input type='password' name='password' id="password" /> <span style="color:red">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">确认密码：</td>
                <td>
                    <input type='password' name='repassword'  /> <span style="color:red">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">邮&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;箱：</td>
                <td>
                    <input type='text' name='email'  /> <span style="color:red">*</span>
                </td>
            </tr>
            <!--<tr>
                <td class="label">用户状态：</td>
                <td>
                    <input type='radio' name='status' value="1" checked />启用
                    <input type='radio' name='status' value="0" />禁用
                </td>
            </tr>-->
            <tr>
                <td class="label">所属角色：</td>
                <td>
                    <select name="role_id" id="">
                        <option value="0">请选择……</option>
                        <?php if(is_array($roleData)): foreach($roleData as $key=>$role): ?><option value="<?php echo ($role["id"]); ?>"><?php echo ($role["role_name"]); ?></option><?php endforeach; endif; ?>
                    </select>
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