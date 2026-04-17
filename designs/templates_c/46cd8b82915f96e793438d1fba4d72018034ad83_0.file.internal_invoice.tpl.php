<?php
/* Smarty version 4.1.0, created on 2026-04-17 13:14:09
  from '/home/senghak/Documents/pelinshop_php8/pelinshop_upgraded/designs/templates/admin/internal_invoice.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.0',
  'unifunc' => 'content_69e1cfb1b35e09_61692572',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '46cd8b82915f96e793438d1fba4d72018034ad83' => 
    array (
      0 => '/home/senghak/Documents/pelinshop_php8/pelinshop_upgraded/designs/templates/admin/internal_invoice.tpl',
      1 => 1776406042,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common/paginate.tpl' => 1,
  ),
),false)) {
function content_69e1cfb1b35e09_61692572 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_37075408269e1cfb1b2b0b7_88816066', "main");
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_118192234369e1cfb1b35596_94004022', "javascript");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "admin/layout.tpl");
}
/* {block "main"} */
class Block_37075408269e1cfb1b2b0b7_88816066 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'main' => 
  array (
    0 => 'Block_37075408269e1cfb1b2b0b7_88816066',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

  <ul class="breadcrumb">
    <li><a href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
">ទំព័រដើម Home</a></li>
    <li class="active"> ទឹកប្រាក់នៅជំពាក់ (Money owed)</li>
  </ul>

  <div class="panel panel-primary">
    <div class="panel-heading"><h3 class="panel-title"><i class="glyphicon glyphicon-shopping-cart"></i>&nbsp;ព័ត៌មាននៃបញ្ជី ទឹកប្រាក់នៅជំពាក់ (Money owed list)</div>
    <div class="table-responsive">
      <div class="panel-body">
        <div class="row">
          <div class="col-md-12">
            <form role="form" method="get" action="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
" class="form-inline">
              <input type="hidden" name="task" value="internal_invoice">
              <div class="form-group">
                  <select name="customer_id" class="form-control select2">
                      <option value="">ជ្រើសរើសអតិថិជន(Select Customer)</option>
                      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list_customer_name']->value, 'customer');
$_smarty_tpl->tpl_vars['customer']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['customer']->value) {
$_smarty_tpl->tpl_vars['customer']->do_else = false;
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['customer']->value['id'];?>
" <?php if (htmlspecialchars((($tmp = $_GET['customer_id'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true) == $_smarty_tpl->tpl_vars['customer']->value['id']) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['customer']->value['name'];?>
 (<?php echo $_smarty_tpl->tpl_vars['customer']->value['phone'];?>
)</option>
                      <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                  </select>
              </div>
              <div class="form-group">
                <input type="text" value="<?php echo htmlspecialchars((($tmp = $_GET['kwd'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
" name="kwd" class="form-control" placeholder="ស្វែងរក (Search for...)" autofocus>
                  <button class="btn btn-success" type="submit"><li class="glyphicon glyphicon-search"></li></button>
									<a href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=internal_invoice&amp;action=print" class="btn btn-primary" target="_blank">
											<li class="glyphicon glyphicon-print"></li> បោះពុម្ពរបាយការណ៍ (Print Report)
									</a>
              </div>
            </form>
          </div>
        </div>

        <hr style="margin-top:5px;margin-bottom:5px;" />
        <div class="table-responsive">
			<table class="table table-bordered table-striped table-hover">
				<thead class="table_header">
					<th class="text-center">សកម្មភាព (Action)</th>
					<th>ឈ្មោះអតិថិជន (Customer Name)</th>
					<th>ឈ្មោះបុគ្គលិក (Staff Name)</th>
					<th>ទឹកប្រាក់នៅជំពាក់ (Total)</th>
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
						<td class="text-center" valign="top" width="170px;">
						<span data-toggle="tooltip" title="Split Payment">
							<a href="<?php echo $_smarty_tpl->tpl_vars['index_file']->value;?>
?task=internal_invoice&amp;action=split_payment&amp;cus_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['customer_id'];?>
&amp;int_in_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
" class="btn radius-50 btn-primary btn-sm" name="view" value=""><i class="fa fa-plus-circle"></i></a>
						</span>
						</td>
						<td><?php if ($_smarty_tpl->tpl_vars['data']->value['customer_name']) {
echo $_smarty_tpl->tpl_vars['data']->value['customer_name'];?>
 (<?php echo $_smarty_tpl->tpl_vars['data']->value['customer_phone'];?>
)<?php } else { ?> ~ <?php }?></td>
						<td><?php echo $_smarty_tpl->tpl_vars['data']->value['staff_name'];?>
</td>
						<td><?php echo number_format($_smarty_tpl->tpl_vars['data']->value['total_amount'],2);?>
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
		<div class="pull-right" name="amount" id="amount">
			ទឹកប្រាក់សរុប​ (Amount Total) = <?php echo number_format($_smarty_tpl->tpl_vars['list_total']->value,2);?>

		</div>
      </div>
    </div>
  </div>
  <?php $_smarty_tpl->_subTemplateRender("file:common/paginate.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
/* {/block "main"} */
/* {block "javascript"} */
class Block_118192234369e1cfb1b35596_94004022 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'javascript' => 
  array (
    0 => 'Block_118192234369e1cfb1b35596_94004022',
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

	$('.select2').select2();
});
<?php echo '</script'; ?>
>
<?php
}
}
/* {/block "javascript"} */
}
