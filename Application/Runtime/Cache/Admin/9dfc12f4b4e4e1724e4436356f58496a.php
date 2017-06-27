<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>ECSHOP 管理中心 - 添加新商品 </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="/Public/Admin/Styles/general.css" rel="stylesheet" type="text/css"/>
    <link href="/Public/Admin/Styles/main.css" rel="stylesheet" type="text/css"/>
    <<script type="text/javascript" src="/Public/Admin/Js/jquery-1.8.2.min.js"></script>
    <script>
            function addImg(o){
                //获取当前行
                var current_row = $(o).parents('tr');
                if($(o).find('img').attr('src')=='/Public/Admin/Images/add_16px.ico'){
                    //克隆当前行为新行
                    var new_row = current_row.clone();
                    //将a标签中的[+]改成[-]
                    new_row.find('a').find('img').attr('src','/Public/Admin/Images/minus_16px.ico')
                    //将克隆的新行放到当前行之后
                    current_row.after(new_row);
                }else{
                    current_row.remove();
                }
            }
    </script>
</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo U('add');?>">添加新商品</a></span>
    <span class="action-span1"><a href="<?php echo U('index/mian');?>">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - 商品列表 </span>
    <div style="clear:both"></div>
</h1>
    <div class="form-div">
        <form enctype="multipart/form-data" action="" method="post" name="theForm" >
            <table width="90%" id="gallery-table"  align="center">
                <tr>
                    <td>
                        <div>

                        </div>
                    </td>
                </tr>
                <tr><td>&nbsp;</td></tr>
                <tr>
                    <td>
                        <a href="javascript:;" onclick="addImg(this)"><img src='/Public/Admin/Images/add_16px.ico' /></a>
                         <!--图片描述 <input type="hidden" name="img_desc[]" size="20" /> -->
                        上传文件 <input type="file" name="goods_images[]" />
                        <!-- <input type="text" size="40" value="或者输入外部图片链接地址" style="color:#aaa;" onfocus="if (this.value == '或者输入外部图片链接地址'){this.value='http://';this.style.color='#000';}" name="img_file[]"/> -->
                    </td>
                </tr>
                <tr align="center">
                    <td>
                        <input type="hidden" value="<?php echo ($id); ?>" name="goods_id"/>
                        <input type="submit" value=" 确定 " />
                        <input type="reset" value=" 重置 " />
                    </td>
                </tr>
            </table>
        </form>
        <div id="footer">
            共执行 9 个查询，用时 0.025161 秒，Gzip 已禁用，内存占用 3.258 MB<br/>
            版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。
        </div>
    </div>
</body>
</html>