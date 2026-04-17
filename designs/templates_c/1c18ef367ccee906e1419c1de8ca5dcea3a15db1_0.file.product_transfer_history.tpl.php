<?php
/* Smarty version 4.1.0, created on 2026-04-17 13:51:11
  from '/home/senghak/Documents/pelinshop_php8/pelinshop_upgraded/designs/templates/admin/product_transfer_history.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.0',
  'unifunc' => 'content_69e1d85fb696e1_50264965',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1c18ef367ccee906e1419c1de8ca5dcea3a15db1' => 
    array (
      0 => '/home/senghak/Documents/pelinshop_php8/pelinshop_upgraded/designs/templates/admin/product_transfer_history.tpl',
      1 => 1776406182,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common/paginate.tpl' => 1,
  ),
),false)) {
function content_69e1d85fb696e1_50264965 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_101925083869e1d85fb53883_34058774', "main");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "admin/layout.tpl");
}
/* {block "main"} */
class Block_101925083869e1d85fb53883_34058774 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'main' => 
  array (
    0 => 'Block_101925083869e1d85fb53883_34058774',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/senghak/Documents/pelinshop_php8/pelinshop_upgraded/external_libs/smarty-4.1.0/libs/plugins/function.counter.php','function'=>'smarty_function_counter',),));
?>


<ul class="breadcrumb">
	<li><a href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
">ទំព័រដើម (Home)</a></li>
	<li class="active">ការផ្ទេរផលិតផលសម្រាប់ការបោះពុម្ព (Product Transfer For printing)</li>
</ul>

<div class="panel panel-primary">
  <div class="panel-heading"><h3 class="panel-title">ការផ្ទេរផលិតផល (Product Transfer)</h3></div>
  <div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<form role="form" method="get" action="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=product_transfer_history" class="form-inline">
					<input type="hidden" name="task" value="product_transfer_history">

					<div class="form-group">
						<div class="input-group">
						  <span class="input-group-addon"><label style="margin-bottom: 0;">សាខា (Branch) : </label></span>
							<select name="branch_id" class="form-control">
							<option value="">---ជ្រើសរើសឈ្មោះសាខា (Select Branch Name)---</option>
							<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list_branch']->value, 'branch');
$_smarty_tpl->tpl_vars['branch']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['branch']->value) {
$_smarty_tpl->tpl_vars['branch']->do_else = false;
?>
								<option value="<?php echo $_smarty_tpl->tpl_vars['branch']->value['id'];?>
" <?php if ((($tmp = $_GET['branch_id'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp) == $_smarty_tpl->tpl_vars['branch']->value['id']) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['branch']->value['name'];?>
</option>
							<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
							</select>
							<span class="input-group-btn">
								<button class="btn btn-success" type="submit"><li class="glyphicon glyphicon-search"></li>&nbsp;ស្វែងរក (Search)</button>
							</span>
						</div>
					</div>
				</form>
			</div>
		</div>
		<hr style="margin-top:5px;margin-bottom:5px;" />
    <div class="table-responsive">
    	<table class="table table-bordered table-striped table-hover">
    	  <thead class="table_header">
    	  	<tr>
    	  		<th></th>
						<th class="text-center">សាខា (Branch)</th>
						<th class="text-center">ចំនួន (Qty)</th>
						<th class="text-center">កាលបរិច្ឆេទផ្ទេរ (Transfered Date)</th>
						<th class="text-center">សកម្មភាព (Action)</th>
    	  	</tr>
    	  </thead>
				<tbody>
					<?php if (count($_smarty_tpl->tpl_vars['product_transfer_data']->value) > 0) {?>
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product_transfer_data']->value, 'data', false, NULL, 'foo', array (
  'first' => true,
  'iteration' => true,
  'index' => true,
));
$_smarty_tpl->tpl_vars['data']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['data']->value) {
$_smarty_tpl->tpl_vars['data']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['iteration']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['index']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['first'] = !$_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['index'];
?>
					<tr <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['first']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['first'] : null)) {?>class="active"<?php }?>>
						<td class="text-center"><?php if ((($tmp = $_GET['next'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp) == 1 || (($tmp = $_GET['next'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp) == '') {
echo smarty_function_counter(array(),$_smarty_tpl);
} else {
echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['iteration'] : null)+(($tmp = $_GET['next'] ?? null)===null||$tmp==='' ? 1 ?? null : $tmp)-1;
}?></td>
						<td class="text-center"><?php echo $_smarty_tpl->tpl_vars['data']->value['branch_name'];?>
</td>
						<td class="text-center"><i class="fa fa-mobile fa-lg"></i>&nbsp;<?php echo $_smarty_tpl->tpl_vars['data']->value['qty'];?>
</td>
						<td class="text-center"><?php echo $_smarty_tpl->tpl_vars['data']->value['transfered_date'];?>
</td>
						<td class="text-center" valign="top" width="150px;">
							<a class="btn btn-xs btn-primary" href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=product_transfer_history&amp;action=detail&amp;id=<?php echo $_smarty_tpl->tpl_vars['data']->value['unique_key'];?>
" data-toggle="tooltip" title="View Report">
								<i class="fa fa-th-list"></i>&nbsp;លម្អិត (Detail)
							</a>
							<a class="btn btn-xs btn-primary" href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=product_transfer_history&amp;action=print&amp;id=<?php echo $_smarty_tpl->tpl_vars['data']->value['unique_key'];?>
" data-toggle="tooltip" title="Print Report">
								<i class="fa fa-print"></i>&nbsp;បោះពុម្ព (Print)
							</a>
						</td>
					</tr>
					<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
					<?php } else { ?>
					<tr><td class="text-center" colspan="5"><h4>There is no information.</h4></td></tr>
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
}
