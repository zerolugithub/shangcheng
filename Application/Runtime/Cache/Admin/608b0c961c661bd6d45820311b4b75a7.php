<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>ECSHOP 管理中心 - 编辑商品 </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="/Public/Admin/Styles/general.css" rel="stylesheet" type="text/css"/>
    <link href="/Public/Admin/Styles/main.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" charset="utf-8" src="/Public/Admin/Js/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/Public/Admin/Js/ueditor/ueditor.all.min.js"></script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="/Public/Admin/Js/ueditor/lang/zh-cn/zh-cn.js"></script>
    <script type="text/javascript" charset="utf-8" src="/Public/Admin/Js/jquery-1.8.2.min.js"></script>
    <script>
        $(function(){
            $('select[name=type_id]').live('change',function(){
                var _this = $(this);
                var type_id = _this.val();
                //ajax 的post发送方式可以不指定返回数据类型  此处返回的是html类型
                $.post('<?php echo U("showAttr");?>',{'id':type_id},function(data){
                    _this.parents('tr').after(data);
                });
            })
        })
    </script>
</head>
<body>
<h1>
    <span class="action-span"><a href="__GROUP__/Goods/goodsList">商品列表</a>
    </span>
    <span class="action-span1"><a href="__GROUP__">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - 编辑商品 </span>
    <div style="clear:both"></div>
</h1>

<div class="tab-div">
    <div id="tabbar-div">
        <p>
            <span class="tab-front" id="general-tab">通用信息</span>
        </p>
    </div>
    <div id="tabbody-div">
        <form enctype="multipart/form-data" action="__GROUP__/Goods/goodsEdit" method="post">
            <input type="hidden" name="goods_id" value="<?php echo ($goodsData["id"]); ?>">
            <table width="90%" id="general-table" align="center">
                <tr>
                    <td class="label">商品名称：</td>
                    <td><input type="text" name="goods_name" value="<?php echo ($goodsData["goods_name"]); ?>" size="30"/>
                        <span class="require-field">*</span></td>
                </tr>
                <tr>
                    <td class="label">商品货号：</td>
                    <td>
                        <input type="text" name="goods_sn" value="<?php echo ($goodsData["goods_sn"]); ?>" size="20"/>
                        <span id="goods_sn_notice"></span><br/>
                        <span class="notice-span" id="noticeGoodsSN">如果您不输入商品货号，系统将自动生成一个唯一的货号。</span>
                    </td>
                </tr>
                <tr>
                    <td class="label">商品分类：</td>
                    <td>
                        <select name="cate_id">
                            <!--<option value="0">请选择...</option>-->
                            <?php if(is_array($cateData)): foreach($cateData as $key=>$cate): if($cate[id] == $goodsData[cate_id]): ?><option value="<?php echo ($cate["id"]); ?>" selected><?php echo (str_repeat('&nbsp;&nbsp;',$cate["level"]*2)); echo ($cate["cate_name"]); ?></option>
                                    <?php else: ?>
                                    <option value="<?php echo ($cate["id"]); ?>"><?php echo (str_repeat('&nbsp;&nbsp;',$cate["level"]*2)); echo ($cate["cate_name"]); ?></option><?php endif; endforeach; endif; ?>
                        </select>
                        <span class="require-field">*</span>
                    </td>
                </tr>
                <tr>
                    <td class="label">商品品牌：</td>
                    <td>
                        <select name="brand_id">
                            <!--<option value="0">请选择...</option>-->
                            <?php if(is_array($brandData)): foreach($brandData as $key=>$brand): ?><option value="<?php echo ($brand["brand_id"]); ?>"
                                <?php if($goodsData[brand_id] == $brand[id]): ?>checked<?php endif; ?>
                                ><?php echo ($brand["brand_name"]); ?></option><?php endforeach; endif; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="label">商品类型：</td>
                    <td>
                        <select name="type_id">
                            <option value="0">请选择...</option>
                            <?php if(is_array($typeData)): foreach($typeData as $key=>$type): ?><option value="<?php echo ($type["id"]); ?>"><?php echo ($type["type_name"]); ?></option><?php endforeach; endif; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="label">本店售价：</td>
                    <td>
                        <input type="text" name="shop_price" value="<?php echo ($goodsData["shop_price"]); ?>" size="20"/>
                        <span class="require-field">*</span>
                    </td>
                </tr>
                <tr>
                    <td class="label">商品数量：</td>
                    <td>
                        <input type="text" name="goods_number" size="8" value="<?php echo ($goodsData["goods_number"]); ?>"/>
                    </td>
                </tr>
                <td class="label">是否上架：</td>
                <td>
                    <input type="radio" name="is_sale" value="1"
                    <?php if($goodsData["is_sale"] == 1): ?>checked<?php endif; ?>
                    /> 是
                    <input type="radio" name="is_sale" value="0"
                    <?php if($goodsData["is_sale"] == 0): ?>checked<?php endif; ?>
                    /> 否
                </td>
                </tr>
                <tr>
                    <td class="label">加入推荐：</td>
                    <td>
                        <input type="checkbox" name="is_best" value="1"
                        <?php if($goodsData["is_best"] == 1): ?>checked<?php endif; ?>
                        /> 精品
                        <input type="checkbox" name="is_new" value="1"
                        <?php if($goodsData["is_new"] == 1): ?>checked<?php endif; ?>
                        /> 新品
                        <input type="checkbox" name="is_hot" value="1"
                        <?php if($goodsData["is_hot"] == 1): ?>checked<?php endif; ?>
                        /> 热销
                    </td>
                </tr>
                <tr>
                    <td class="label">推荐排序：</td>
                    <td>
                        <input type="text" name="goods_sort" size="5" value="<?php echo ($goodsData["goods_sort"]); ?>"/>
                    </td>
                </tr>
                <tr>
                    <td class="label">市场售价：</td>
                    <td>
                        <input type="text" name="market_price" value="<?php echo ($goodsData["market_price"]); ?>" size="20"/>
                    </td>
                </tr>
                <tr>
                    <td class="label">商品关键词：</td>
                    <td>
                        <input type="text" name="keywords" value="<?php echo ($goodsData["keywords"]); ?>" size="40"/> 用空格分隔
                    </td>
                </tr>
                <tr>
                    <td class="label">商品描述：</td>
                    <td>
                        <textarea name="goods_desc" cols="40" id="goods_desc"
                                  rows="3"><?php echo ($goodsData["goods_desc"]); ?></textarea>
                    </td>
                </tr>
            </table>
            <div class="button-div">
                <input type="submit" value=" 确定 " class="button"/>
                <input type="reset" value=" 重置 " class="button"/>
            </div>
        </form>
    </div>
</div>

<div id="footer">
    共执行 9 个查询，用时 0.025161 秒，Gzip 已禁用，内存占用 3.258 MB<br/>
    版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。
</div>
</body>
</html>
<script>
    UE.getEditor('goods_desc', {
        "initialFrameWidth": 800,  //初始化编辑器宽度,默认1000
        "initialFrameHeight": 280  //初始化编辑器高度,默认320
    });
</script>