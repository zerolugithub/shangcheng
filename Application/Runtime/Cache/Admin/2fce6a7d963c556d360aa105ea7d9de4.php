<?php if (!defined('THINK_PATH')) exit();?><!-- $Id: brand_info.htm 14216 2008-03-10 02:27:21Z testyang $ -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>ECSHOP 管理中心 - 添加品牌 </title>
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="/Public/Admin/Styles/general.css" rel="stylesheet" type="text/css"/>
    <link href="/Public/Admin/Styles/main.css" rel="stylesheet" type="text/css"/>
  <!--  <script type="text/javascript" charset="utf-8" src="/Public/Admin/Js/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/Public/Admin/Js/ueditor/ueditor.all.min.js"></script>
    &lt;!&ndash;建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败&ndash;&gt;
    &lt;!&ndash;这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文&ndash;&gt;
    <script type="text/javascript" charset="utf-8" src="/Public/Admin/Js/ueditor/lang/zh-cn/zh-cn.js"></script>-->

</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo U('lst');?>">商品品牌</a></span>
    <span class="action-span1"><a href="#">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - 添加品牌 </span>
    <div style="clear:both"></div>
</h1>
<div class="main-div">
    <form method="post" action="" enctype="multipart/form-data">
        <table cellspacing="1" cellpadding="3" width="100%">
            <tr>
                <td class="label">品牌名称</td>
                <td>
                    <input type="text" name="brand_name" maxlength="60" value=""/>
                    <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">品牌网址</td>
                <td>
                    <input type="text" name="brand_web" maxlength="60" size="40" value=""/>
                </td>
            </tr>
            <tr>
                <td class="label">品牌LOGO</td>
                <td>
                    <input type="file" name="brand_logo" id="logo" size="45"><br/>
                    <span class="notice-span" style="display:block" id="warn_brandlogo">请上传图片，做为品牌的LOGO！</span>
                </td>
            </tr>
            <tr>
                <td class="label">品牌描述</td>
                <td>
                    <textarea name="brand_desc" cols="60" id="brand_desc" rows="4"></textarea>
                </td>
            </tr>
            <tr>
                <td class="label">排序</td>
                <td>
                    <input type="text" name="sort" maxlength="40" size="15" value="50"/>
                </td>
            </tr>
            <tr>
                <td class="label">是否显示</td>
                <td>
                    <input type="radio" name="is_show" value="1" checked="checked"/> 是
                    <input type="radio" name="is_show" value="0"/> 否(当品牌下还没有商品的时候，首页及分类页的品牌区将不会显示该品牌。)
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center"><br/>
                    <input type="submit" class="button" value=" 确定 "/>
                    <input type="reset" class="button" value=" 重置 "/>
                </td>
            </tr>
        </table>
    </form>
</div>

<div id="footer">
    共执行 1 个查询，用时 0.018952 秒，Gzip 已禁用，内存占用 2.197 MB<br/>
    版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。
</div>
</body>
</html>
<!--
<script>
    UE.getEditor('brand_desc',{
        "initialFrameWidth":600,  //初始化编辑器宽度,默认1000
        "initialFrameHeight":120  //初始化编辑器高度,默认320
    });
</script>-->