<?php
/* Smarty version 4.1.0, created on 2026-04-17 12:43:25
  from '/home/senghak/Documents/pelinshop_php8/pelinshop_upgraded/designs/templates/admin/reportTask_.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.0',
  'unifunc' => 'content_69e1c87dd0dea7_27342156',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6d4e774536cbda6f3a7937e83a1e185b266d3040' => 
    array (
      0 => '/home/senghak/Documents/pelinshop_php8/pelinshop_upgraded/designs/templates/admin/reportTask_.tpl',
      1 => 1776070560,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common/paginate.tpl' => 1,
  ),
),false)) {
function content_69e1c87dd0dea7_27342156 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_46251538469e1c87dce5121_17237198', "main");
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_178645848169e1c87dd0cc24_83345447', "javascript");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "admin/layout.tpl");
}
/* {block "main"} */
class Block_46251538469e1c87dce5121_17237198 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'main' => 
  array (
    0 => 'Block_46251538469e1c87dce5121_17237198',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

  <ul class="breadcrumb">
    <li><a href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
">Home</a></li>
    <li class="active">របាយការណ៍ (Report)</li>
    <li class="active">របាយការណ៍លក់ (Sale Report)</li>
  </ul>
  <div class="panel panel-primary">
    <div class="panel-heading"><h3 class="panel-title">របាយការណ៍ (Report)</h3></div>
    <div class="panel-body">
      <div class="panel panel-primary">
        <div class="panel-body">
          <form role="form" method="get" action="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=report" class="form-horizontal">
            <input type="hidden" name="task" value="report">
            <div class="row">
              <div class="col-md-5">
                <div class="input-group" style="padding-bottom:10px;">
                <span class="input-group-addon">កាលបរិច្ឆេទ (Date)</span>
                  <input type="text" id="order_from" value ="<?php if ($_GET['order_from']) {
echo htmlspecialchars($_GET['order_from'], ENT_QUOTES, 'UTF-8', true);
} elseif ($_smarty_tpl->tpl_vars['order_from']->value) {
echo $_smarty_tpl->tpl_vars['order_from']->value;
}?>"
                    class="form-control" name="order_from" placeholder="Example: 2016-08-01"/>
                    <span class="input-group-addon">ទៅ (To)</span>
                  <input type="text" id="order_to" value ="<?php echo htmlspecialchars($_GET['order_to'], ENT_QUOTES, 'UTF-8', true);?>
" class="form-control"
                    name="order_to" placeholder="Example: 2016-08-30" />
                </div>
              </div>
              <div class="col-md-4">
                <div class="input-group" style="padding-bottom:10px;">
                  <span class="input-group-addon">ម៉ាកផលិតផល (Product Brand) :</span>
                  <select name="brd" class="form-control">
                      <option value="">-----ជ្រើសរើសសាខា (Select Brand)-----</option>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list_brand_name']->value, 'brand');
$_smarty_tpl->tpl_vars['brand']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['brand']->value) {
$_smarty_tpl->tpl_vars['brand']->do_else = false;
?>
                      <option value="<?php echo $_smarty_tpl->tpl_vars['brand']->value['id'];?>
" <?php if (htmlspecialchars($_GET['brd'], ENT_QUOTES, 'UTF-8', true) == $_smarty_tpl->tpl_vars['brand']->value['id']) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['brand']->value['name'];?>
</option>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <label class="checkbox-inline"><input type="checkbox" name="summary" value="1" <?php if ($_GET['summary'] == 1) {?>checked<?php }?>>មើលសង្ខេប (View Summary)</label>
              &nbsp;&nbsp;
                <button class="btn btn-success" type="submit"><i class="glyphicon glyphicon-search"></i>&nbsp;ស្វែងរក (Search)</button>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <a target="_blank" class="btn btn-primary <?php if (count($_smarty_tpl->tpl_vars['brand_group']->value) == 0) {?>disabled<?php }?>"
                href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=report&amp;action=show&amp;order_from=<?php echo $_GET['order_from'];?>
&amp;order_to=<?php echo $_GET['order_to'];?>
&amp;brd=<?php echo $_GET['brd'];?>
&amp;sts=<?php echo $_GET['sts'];?>
&amp;summary=<?php echo htmlspecialchars($_GET['summary'], ENT_QUOTES, 'UTF-8', true);?>
">
                  <i class="glyphicon glyphicon-print"></i>&nbsp;បោះពុម្ពរបាយការណ៍ (Print Report)</a>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover" <?php if ($_GET['summary'] == 1) {?>style="display:none;"<?php }?>>
            <thead>
              <tr class="table_header">
                <th class="text-center">លេខ IMEI (IMEI Number)</th>
                <th class="text-center">ឈ្មោះផលិតផល Product Title</th>
                <?php if ($_SESSION['is_login_role'] == 2) {?>
                <th class="text-center">តម្លៃដើម (Cost)</th>
                <?php }?>
                <th class="text-center">តម្លៃលក់ (Price)</th>
                <th class="text-center">ក្រមហ៊ុនផលិត (Product Maker)</th>
                <th class="text-center">ម៉ាកផលិតផល (Product Brand)</th>
                <th class="text-center">ស្ថានភាព (Status)</th>
                <th class="text-center">កំណត់សម្គាល់ (Note)</th>
              </tr>
            </thead>
            <tbody>
            <?php if (count($_smarty_tpl->tpl_vars['report_data']->value) > 0) {?>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['report_data']->value, 'data');
$_smarty_tpl->tpl_vars['data']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['data']->value) {
$_smarty_tpl->tpl_vars['data']->do_else = false;
?>
              <tr>
                <td class="text-center" valign="top" width="140px;"><span class="badge_pelin"><?php echo $_smarty_tpl->tpl_vars['data']->value['imei'];?>
</span></td>
                <td class="text-center"><?php echo $_smarty_tpl->tpl_vars['data']->value['title'];?>

                  <?php if ($_smarty_tpl->tpl_vars['data']->value['color_name']) {?>-<?php echo $_smarty_tpl->tpl_vars['data']->value['color_name'];
}?>
                  <?php if ($_smarty_tpl->tpl_vars['data']->value['storage_name']) {?>-<?php echo $_smarty_tpl->tpl_vars['data']->value['storage_name'];
}?>
                </td>
                <?php if ($_SESSION['is_login_role'] == 2) {?>
                <td class="text-center" valign="top" width="100px;">$ <?php echo number_format($_smarty_tpl->tpl_vars['data']->value['cost'],2);?>
</td>
                <?php }?>
                <td class="text-center" valign="top" width="100px;">$ <?php echo number_format($_smarty_tpl->tpl_vars['data']->value['price'],2);?>
</td>
                <td class="text-center"><?php echo $_smarty_tpl->tpl_vars['data']->value['maker_name'];?>
</td>
                <td class="text-center"><?php echo $_smarty_tpl->tpl_vars['data']->value['brand_name'];?>
</td>
                <td class="text-center"><?php if ($_smarty_tpl->tpl_vars['data']->value['deleted_at'] == null) {?> In Stock<?php } else { ?>Sold<?php }?></td>
                <td class="text-center"><?php if ($_smarty_tpl->tpl_vars['data']->value['description']) {
echo nl2br($_smarty_tpl->tpl_vars['data']->value['description']);
} else { ?> ~ <?php }?></td>
              </tr>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            <?php } else { ?>
              <tr><td class="text-center" colspan="8"><h4>There is no information.</h4></td></tr>
            <?php }?>
            </tbody>
        </table>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['brand_group']->value, 'group', false, 'k');
$_smarty_tpl->tpl_vars['group']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['group']->value) {
$_smarty_tpl->tpl_vars['group']->do_else = false;
?>
          <tbody>
            <tr>
              <td style="width:30%">
                <label><?php echo $_smarty_tpl->tpl_vars['group']->value['name'];?>
</label>
              </td>
              <td>
                <span class="badge_pelin"><label><?php echo $_smarty_tpl->tpl_vars['group']->value['brand_count'];?>
<label>
              </td>
            </tr>
          </tbody>
          <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </table>
      </div>
    </div>
  </div>
  <?php $_smarty_tpl->_subTemplateRender("file:common/paginate.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
/* {/block "main"} */
/* {block "javascript"} */
class Block_178645848169e1c87dd0cc24_83345447 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'javascript' => 
  array (
    0 => 'Block_178645848169e1c87dd0cc24_83345447',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<?php echo '<script'; ?>
>
$(function () {
  $('#order_from').datetimepicker({
    lang: 'en',
    format: 'Y-m-d',
    timepicker: false
  });
  $('#order_to').datetimepicker({
    lang: 'en',
    format: 'Y-m-d',
    timepicker: false
  });
});

$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip({
    placement : 'top'
  });
});
<?php echo '</script'; ?>
>
<?php
}
}
/* {/block "javascript"} */
}
