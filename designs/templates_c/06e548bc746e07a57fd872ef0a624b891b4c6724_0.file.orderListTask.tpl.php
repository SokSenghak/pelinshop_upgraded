<?php
/* Smarty version 4.1.0, created on 2026-04-17 13:02:19
  from '/home/senghak/Documents/pelinshop_php8/pelinshop_upgraded/designs/templates/admin/orderListTask.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.0',
  'unifunc' => 'content_69e1cceb8b7518_55890309',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '06e548bc746e07a57fd872ef0a624b891b4c6724' => 
    array (
      0 => '/home/senghak/Documents/pelinshop_php8/pelinshop_upgraded/designs/templates/admin/orderListTask.tpl',
      1 => 1776404474,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common/paginate.tpl' => 1,
  ),
),false)) {
function content_69e1cceb8b7518_55890309 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_129800463569e1cceb8a0a87_52972096', "main");
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_179657855169e1cceb8b6464_84701553', "javascript");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "admin/layout.tpl");
}
/* {block "main"} */
class Block_129800463569e1cceb8a0a87_52972096 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'main' => 
  array (
    0 => 'Block_129800463569e1cceb8a0a87_52972096',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/senghak/Documents/pelinshop_php8/pelinshop_upgraded/external_libs/smarty-4.1.0/libs/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>

  <ul class="breadcrumb">
    <li><a href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
">ទំព័រដើម Home</a></li>
    <li class="active">ព័ត៌មាននៃបញ្ជីលក់ (Information of Sale List)</li>
  </ul>

  <div class="panel panel-primary">
    <div class="panel-heading"><h3 class="panel-title"><i class="glyphicon glyphicon-shopping-cart"></i>&nbsp;ព័ត៌មាននៃបញ្ជីលក់ (Information of Sale List) (តម្លៃលក់ (Sale) = $ <?php echo $_smarty_tpl->tpl_vars['sale']->value['total_price'];?>
, តម្លៃដើម (Cost) = $ <?php echo $_smarty_tpl->tpl_vars['sale']->value['total_cost'];?>
, ប្រាក់ចំនេញ (Income) = $ <?php echo $_smarty_tpl->tpl_vars['sale']->value['income'];?>
)</div>
    <div class="table-responsive">
      <div class="panel-body">
        <div class="row">
          <div class="col-md-12">
            <form role="form" method="get" action="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=order_list" class="form-inline">
              <input type="hidden" name="task" value="order_list">
              <div class="form-group">
                <div class="input-group date">
                  <input type="text" id="order_date_from" value ="<?php echo htmlspecialchars((($tmp = $_GET['from'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
" class="form-control" name="from" placeholder="កាលបរិច្ឆេទបញ្ជាទិញពី (Order Date From)"/>
                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </span>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group date" >
                  <input type="text" id="order_date_to" value ="<?php echo htmlspecialchars((($tmp = $_GET['to'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
" class="form-control" name="to" placeholder="ទៅកាលបរិច្ឆេទបញ្ជាទិញ (Order Date To)" />
                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </span>
                </div>
              </div>
              <div class="form-group">
                  <select name="branch" class="form-control">
                      <option value="">ជ្រើសរើសសាខា (Select Branch)</option>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list_branch_name']->value, 'branch');
$_smarty_tpl->tpl_vars['branch']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['branch']->value) {
$_smarty_tpl->tpl_vars['branch']->do_else = false;
?>
                      <option value="<?php echo $_smarty_tpl->tpl_vars['branch']->value['id'];?>
" <?php if (htmlspecialchars((($tmp = $_GET['branch'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true) == $_smarty_tpl->tpl_vars['branch']->value['id']) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['branch']->value['name'];?>
</option>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                  </select>
              </div>
              <div class="input-group">
                <input type="text" value="<?php echo htmlspecialchars((($tmp = $_GET['kwd'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
" name="kwd" class="form-control" placeholder="ស្វែងរក (Search for...)" autofocus>
                <span class="input-group-btn">
                  <button class="btn btn-success" type="submit"><li class="glyphicon glyphicon-search"></li></button>
                </span>
              </div>
            </form>
          </div>
        </div>

        <hr style="margin-top:5px;margin-bottom:5px;" />
        <table class="table table-bordered table-striped table-hover">
          <thead class="table_header">
            <th class="text-center">សកម្មភាព (Action)</th>
            <th>ឈ្មោះអតិថិជន (Customer Name)</th>
            <th>ឈ្មោះបុគ្គលិក (Staff Name)</th>
            <th>សាខា (Branch)</th>
            <th>សរុបរង (Sub Total)</th>
            <th>បញ្ចុះតម្លៃ (Discount)</th>
            <th>ម៉ូដែលបានផ្លាស់ប្តូរ (Changed Model)</th>
            <th>តម្លៃម៉ូដែល (Model Price)</th>
            <th>សរុប (Total)</th>
            <th>កាលបរិច្ឆេទលក់ (Date Of Sale)</th>
          </thead>
          <tbody>
          <?php if (count($_smarty_tpl->tpl_vars['list_orderlist_data']->value) > 0) {?>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list_orderlist_data']->value, 'data');
$_smarty_tpl->tpl_vars['data']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['data']->value) {
$_smarty_tpl->tpl_vars['data']->do_else = false;
?>
            <tr>
              <td class="text-center" valign="top" width="100px;">
                <a data-toggle="tooltip" data-original-title="View Order Information" class="btn btn-success btn-xs" href="<?php echo $_smarty_tpl->tpl_vars['index_file']->value;?>
?task=order_list&amp;action=view&amp;id=<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
">
                  <i class="glyphicon glyphicon-list"></i>
                </a>
                <a data-toggle="tooltip" data-original-title="View Customer Information" class="btn btn-primary btn-xs" href="<?php echo $_smarty_tpl->tpl_vars['index_file']->value;?>
?task=customer&amp;action=history&amp;id=<?php echo $_smarty_tpl->tpl_vars['data']->value['customer_id'];?>
">
                  <i class="glyphicon glyphicon-user"></i>
                </a>
                <a data-toggle="tooltip" data-original-title="View Staff Information" class="btn btn-primary btn-xs" href="<?php echo $_smarty_tpl->tpl_vars['index_file']->value;?>
?task=staff&amp;action=history&amp;id=<?php echo $_smarty_tpl->tpl_vars['data']->value['staff_id'];?>
">
                  <i class="glyphicon glyphicon-user"></i>
                </a>
              </td>
              <td><?php if ($_smarty_tpl->tpl_vars['data']->value['customer_name']) {
echo $_smarty_tpl->tpl_vars['data']->value['customer_name'];
} else { ?> ~ <?php }?></td>
              <td><?php echo $_smarty_tpl->tpl_vars['data']->value['staff_name'];?>
</td>
              <td><?php echo $_smarty_tpl->tpl_vars['data']->value['branch_name'];?>
</td>
              <td>$ <?php echo number_format($_smarty_tpl->tpl_vars['data']->value['subtotal'],2);?>
</td>
              <td>$ <?php echo number_format($_smarty_tpl->tpl_vars['data']->value['discount'],2);?>
</td>
              <td><?php if ($_smarty_tpl->tpl_vars['data']->value['changed_model_from']) {
echo $_smarty_tpl->tpl_vars['data']->value['changed_model_from'];
} else { ?> ~ <?php }?></td>
              <td><?php if ($_smarty_tpl->tpl_vars['data']->value['model_price']) {?>$ <?php echo number_format($_smarty_tpl->tpl_vars['data']->value['model_price'],2);
} else { ?> ~ <?php }?></td>
              <td>$ <?php echo number_format($_smarty_tpl->tpl_vars['data']->value['total'],2);?>
</td>
              <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['data']->value['ordered_at'],'%Y-%m-%d');?>
</td>
            </tr>
          <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            <?php } else { ?>
              <tr><td class="text-center" colspan="8"><h4>មិនមានព័ត៌មានបញ្ជីបញ្ជាទិញទេ។ (There is no order list information.)</h4></td></tr>
            <?php }?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <?php $_smarty_tpl->_subTemplateRender("file:common/paginate.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
/* {/block "main"} */
/* {block "javascript"} */
class Block_179657855169e1cceb8b6464_84701553 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'javascript' => 
  array (
    0 => 'Block_179657855169e1cceb8b6464_84701553',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<?php echo '<script'; ?>
>
$(function () {
  $('#order_date_from').datetimepicker({
    lang: 'en',
    format: 'Y-m-d',
    timepicker: false
  });
  $('#order_date_to').datetimepicker({
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
