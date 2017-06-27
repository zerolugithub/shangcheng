<?php if (!defined('THINK_PATH')) exit();?>
    <?php if(is_array($attrData)): foreach($attrData as $key=>$attr): if($attr[attr_type] == 0): ?><!--//属性类型唯一-->
                <?php if($attr[attr_input_type] == 0): ?><!--//手工录入-->
                    <tr>
                        <td  class="label"><?php echo ($attr["attr_name"]); ?>：</td>
                        <td><input type="text " name="attr[]"></td>
                    </tr>
                    <?php else: ?>
                    <!--//列表选择-->
                    <tr>
            <td  class="label"><?php echo ($attr["attr_name"]); ?>：</td>
            <td>
                <select name="attr[<?php echo ($attr[id]); ?>][]" >
                    <?php if(is_array($attr[attr_value])): foreach($attr[attr_value] as $key=>$val): ?><option value="<?php echo ($val); ?>"><?php echo ($val); ?></option><?php endforeach; endif; ?>
                </select>
            </td>
        </tr><?php endif; ?>
            <?php else: ?>
            <!--//属性类型单选-->
            <?php if($attr[attr_input_type] == 0): ?><!--//手工录入-->
                <tr>
                    <td  class="label"><?php echo ($attr["attr_name"]); ?>：</td>
                    <td><input type="text " name="attr[]"></td>
                </tr>
                <?php else: ?>

                <tr>
                    <td  class="label"><a href="javascript:" onclick="copyown(this)">[+]</a><?php echo ($attr["attr_name"]); ?>：</td>
                    <td>
                        <select name="attr[<?php echo ($attr[id]); ?>][]" >
                            <?php if(is_array($attr[attr_value])): foreach($attr[attr_value] as $key=>$val): ?><option value="<?php echo ($val); ?>"><?php echo ($val); ?></option><?php endforeach; endif; ?>
                        </select>
                    </td>
                </tr><?php endif; endif; endforeach; endif; ?>

    <script>
        function copyown(o){
            //取出当前行
            var current_row=$(o).parents('tr');
            //复制当前行
            if($(o).html()=='[+]'){
                var new_row = current_row.clone();
                //把复制的新行中a标签的内容由[+]改为[-]
                new_row.find('a').html('[-]');
                //将新行放置当前行后
                current_row.after(new_row);
            }else{
                //删除a内容为[-]的行
                current_row.remove();
            }
        }
    </script>