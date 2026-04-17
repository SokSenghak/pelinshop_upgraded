<?php
/* Smarty version 4.1.0, created on 2026-04-17 12:13:55
  from '/home/senghak/Documents/pelinshop_php8/pelinshop_upgraded/designs/templates/admin/customerTask.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.0',
  'unifunc' => 'content_69e1c193a7aa06_43690562',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e1100e53d4466a93af7e909bf9f8c50664e0b51a' => 
    array (
      0 => '/home/senghak/Documents/pelinshop_php8/pelinshop_upgraded/designs/templates/admin/customerTask.tpl',
      1 => 1776070560,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common/paginate.tpl' => 1,
  ),
),false)) {
function content_69e1c193a7aa06_43690562 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_172794624969e1c193a4cec3_61242472', "main");
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_174764816669e1c193a7a165_43287107', "javascript");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "admin/layout.tpl");
}
/* {block "main"} */
class Block_172794624969e1c193a4cec3_61242472 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'main' => 
  array (
    0 => 'Block_172794624969e1c193a4cec3_61242472',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/senghak/Documents/pelinshop_php8/pelinshop_upgraded/external_libs/smarty-4.1.0/libs/plugins/function.counter.php','function'=>'smarty_function_counter',),));
?>

  <ul class="breadcrumb">
    <li><a href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
">ទំព័រដើម (Home)</a></li>
    <li class="active">ព័ត៌មានអតិថិជន (Customer Information)</li>
  </ul>

  <div class="panel panel-primary">
    <div class="panel-heading"><h3 class="panel-title"><i class="glyphicon glyphicon-user"></i>&nbsp;ព័ត៌មានអតិថិជន (Customer Information)</h3></div>
    <div class="table-responsive">
      <div class="panel-body">
        <div class="row">
          <div class="col-md-5">
            <form role="form" method="get" action="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=customer" class="form-horizontal">
              <input type="hidden" name="task" value="customer">
              <div class="input-group">
                <input type="text" value="<?php echo htmlspecialchars($_GET['kwd'], ENT_QUOTES, 'UTF-8', true);?>
" name="kwd" class="form-control" placeholder="ស្វែងរកឈ្មោះអតិថិជន ឬលេខទូរស័ព្ទ ឬលេខអត្តសញ្ញាណប័ណ្ណ (Search by Customer Name or Phone Number or ID Number)" autofocus>
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
            <th></th>
            <th class="text-center">សកម្មភាព (Action)</th>
            <th class="text-center">លេខអត្តសញ្ញាណប័ណ្ណ (Personal ID)</th>
            <th class="text-center">ឈ្មោះអតិថិជន (Customer Name)</th>
            <th class="text-center">ស្ថានភាព (Status)</th>
            <th class="text-center">លេខទូរស័ព្ទ (Phone Number)</th>
            <th>អុីមែល (Email Address)</th>
            <th>អាសយដ្ឋាន (Address)</th>
          </thead>
          <tbody>
          <?php if (count($_smarty_tpl->tpl_vars['list_customer_data']->value) > 0) {?>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list_customer_data']->value, 'data');
$_smarty_tpl->tpl_vars['data']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['data']->value) {
$_smarty_tpl->tpl_vars['data']->do_else = false;
?>
            <tr>
              <td class="text-center"><?php if ($_GET['next'] == 1 || $_GET['next'] == '') {
echo smarty_function_counter(array(),$_smarty_tpl);
} else {
echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['iteration'] : null)+$_GET['next']-1;
}?></td>
              <td>
                <div class="text-center" valign="top" width="105px;">
                  <a data-toggle="tooltip" data-original-title="View Customer History" class="btn btn-xs btn-success" href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=customer&amp;action=history&amp;id=<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
">
                    <i class="glyphicon glyphicon-list"></i> ប្រវត្តិ (History)
                  </a>
                </div>
                <div class="text-center" valign="top" width="175px;" style='padding:5px;'>
                    <a data-toggle="tooltip" data-original-title="Edit Customer" class="btn btn-xs btn-danger" href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=customer&amp;action=edit&amp;id=<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
">
                      <i class="glyphicon glyphicon-pencil"></i> កែប្រែ (Edit)
                    </a>
                  </div>
              </td>
              <td class="text-center" valign="top" width="120px;"><?php if ($_smarty_tpl->tpl_vars['data']->value['idnumber'] == 0) {?> ~ <?php } else {
echo $_smarty_tpl->tpl_vars['data']->value['idnumber'];
}?></td>
              <td><?php if ($_smarty_tpl->tpl_vars['data']->value['name']) {
echo $_smarty_tpl->tpl_vars['data']->value['name'];
} else { ?> ~ <?php }?></td>
              <td class="text-center"><?php if ($_smarty_tpl->tpl_vars['data']->value['status'] == 1) {?><a class="btn btn-info" href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=customer&amp;action=stopped&amp;id=<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
">កំពុងប្រើប្រាស់ (Active)</a><?php } else { ?><a class="btn btn-danger">ឈប់ប្រើប្រាស់ (Stopped)</a><?php }?></td>
              <td class="text-center" valign="top" width="130px;"><?php echo $_smarty_tpl->tpl_vars['data']->value['phone'];?>
</td>
              <td><?php if ($_smarty_tpl->tpl_vars['data']->value['email'] == '') {?> ~ <?php } else {
echo $_smarty_tpl->tpl_vars['data']->value['email'];
}?></td>
              <td><?php if ($_smarty_tpl->tpl_vars['data']->value['address']) {
echo nl2br($_smarty_tpl->tpl_vars['data']->value['address']);
} else { ?> ~ <?php }?></td>
            </tr>
          <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
          <?php } else { ?>
            <tr><td class="text-center" colspan="7"><h4>មិនមានព័ត៌មានអតិថិជន។ (There is no customer information.)</h4></td></tr>
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
class Block_174764816669e1c193a7a165_43287107 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'javascript' => 
  array (
    0 => 'Block_174764816669e1c193a7a165_43287107',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<?php echo '<script'; ?>
>

function NumAndTwoDecimals(e , field)
{
  var val = field.value;
  var reg = /^([0-9]+[\.]?[0-9]?[0-9]?|[0-9]+)/g;
  val = reg.exec(val);
  if (val) {
    field.value = val[0];
  }
  else
  {
    field.value = "";
  }
}

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
