<?php
/* Smarty version 4.1.0, created on 2026-04-17 11:54:04
  from '/home/senghak/Documents/pelinshop_php8/pelinshop_upgraded/designs/templates/admin/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.0',
  'unifunc' => 'content_69e1bcec0a39e0_41058683',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4a8797afaf4bde384c688ef8206d1dadf083a67f' => 
    array (
      0 => '/home/senghak/Documents/pelinshop_php8/pelinshop_upgraded/designs/templates/admin/index.tpl',
      1 => 1776070560,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69e1bcec0a39e0_41058683 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_104858547469e1bcec088da1_21150356', "main");
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_163605822169e1bcec0a2f17_13785494', "javascript");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "admin/layout.tpl");
}
/* {block "main"} */
class Block_104858547469e1bcec088da1_21150356 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'main' => 
  array (
    0 => 'Block_104858547469e1bcec088da1_21150356',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<?php if ($_SESSION['is_login'] == 'admin') {?>
  <div class="panel panel-primary">
    <div class="panel-heading"><h3 class="panel-title"><i class="glyphicon glyphicon-user"></i>&nbsp;ព័ត៌មានបុគ្គលិក (Staff Information)</h3> </div>
    <div class="table-responsive">
      <table class="table table-bordered table-striped table-hover">
        <thead class="table_header">
          <tr>
            <!-- <th class="text-center">Action</th> -->
            <th>ឈ្មោះបុគ្គលិក (Staff Name)</th>
            <th class="text-center">ស្ថានភាព (Status)</th>
            <th>សាខា (Branch)</th>
          </tr>
        </thead>
        <tbody>
        <?php if (count($_smarty_tpl->tpl_vars['list_staff_data']->value) > 0) {?>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list_staff_data']->value, 'data');
$_smarty_tpl->tpl_vars['data']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['data']->value) {
$_smarty_tpl->tpl_vars['data']->do_else = false;
?>
          <tr>
            <!-- <td class="text-center" valign="top" width="105px;">
              <a data-toggle="tooltip" data-original-title="View Staff History" class="btn btn-xs btn-success" href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=staff&amp;action=history&amp;id=<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
">
                <i class="glyphicon glyphicon-list"></i> History
              </a>
            </td> -->
            <td><?php echo $_smarty_tpl->tpl_vars['data']->value['name'];?>
</td>
            <td class="text-center"><?php if ($_smarty_tpl->tpl_vars['data']->value['is_quited'] == 0) {?><label class="label label-info">ធ្វើការ (Working)</label><?php } else { ?><label class="label label-danger">ឈប់ធ្វើការ (Stopped)</label><?php }?></td>
            <td><?php echo $_smarty_tpl->tpl_vars['data']->value['branch_name'];?>
 </td>
          </tr>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        <?php } else { ?>
          <tr><td class="text-center" colspan="3"><h4>មិនមានទិន្នន័យបុគ្គលិក។ (There is no staff information.)</h4></td></tr>
        <?php }?>
        </tbody>
      </table>
    </div>
  </div>
<?php }?>
    <div class="panel panel-primary">
    <div class="panel-heading"><h3 class="panel-title">&nbsp;ផលិតផលថ្មីៗ (Latest Product)</h3></div>
    <div class="table-responsive">
      <table class="table table-bordered table-striped table-hover">
        <thead class="table_header">
          <tr>
            <th>លេខ IMEI (IMEI Number)</th>
            <th>ឈ្មោះផលិតផល (Product Title)</th>
            <th>ក្រុមហ៊ុនផលិត (Product Maker)</th>
            <th>ម៉ាកផលិតផល (Product Brand)</th>
          </tr>
        </thead>
        <tbody>
        <?php if (count($_smarty_tpl->tpl_vars['list_product_data']->value) > 0) {?>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list_product_data']->value, 'data');
$_smarty_tpl->tpl_vars['data']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['data']->value) {
$_smarty_tpl->tpl_vars['data']->do_else = false;
?>
          <tr>
            <td><?php echo $_smarty_tpl->tpl_vars['data']->value['imei'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['data']->value['title'];?>

              <?php if ($_smarty_tpl->tpl_vars['data']->value['color_name']) {?>-<?php echo $_smarty_tpl->tpl_vars['data']->value['color_name'];
}?>
              <?php if ($_smarty_tpl->tpl_vars['data']->value['storage_name']) {?>-<?php echo $_smarty_tpl->tpl_vars['data']->value['storage_name'];
}?></td>
            <td><?php echo $_smarty_tpl->tpl_vars['data']->value['maker_name'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['data']->value['brand_name'];?>
</td>
          </tr>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        <?php } else { ?>
          <tr><td class="text-center" colspan="4"><h4>មិនមានទិន្នន័យផលិតផល។ (There is no product information.)</h4></td></tr>
        <?php }?>
        </tbody>
      </table>
    </div>
  </div>

<?php if ($_SESSION['is_login'] == 'admin') {?>
  <div class="panel panel-primary">
    <div class="panel-heading"><h3 class="panel-title"><i class="glyphicon glyphicon-user"></i>&nbsp;អតិថិជនថ្មីៗ (Latest Customer)</h3></div>
    <div class="table-responsive">
      <table class="table table-bordered table-striped table-hover">
        <thead class="table_header">
          <tr>
            <th class="text-center">សកម្មភាព (Action)</th>
            <th class="text-center">លេខអត្តសញ្ញាណប័ណ្ណ (Personal ID)</th>
            <th class="text-center">ឈ្មោះអតិថិជន (Customer Name)</th>
            <th class="text-center">លេខទូរស័ព្ទ (Phone Number)</th>
            <th class="text-center">អុីមែល (Email Address)</th>
            <th class="text-center">អាសយដ្ឋាន (Address)</th>
          </tr>
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
            <td class="text-center" valign="top" width="105px;">
              <a data-toggle="tooltip" data-original-title="View Customer History" class="btn btn-xs btn-success" href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=customer&amp;action=history&amp;id=<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
">
                <i class="glyphicon glyphicon-list"></i> ប្រវត្តិ (History)
              </a>
            </td>
            <td class="text-center"><?php if ($_smarty_tpl->tpl_vars['data']->value['idnumber']) {
echo $_smarty_tpl->tpl_vars['data']->value['idnumber'];
} else { ?> ~ <?php }?></td>
            <td class="text-center"><?php if ($_smarty_tpl->tpl_vars['data']->value['name']) {
echo $_smarty_tpl->tpl_vars['data']->value['name'];
} else { ?> ~ <?php }?></td>
            <td class="text-center" valign="top" width="130px;"><?php echo $_smarty_tpl->tpl_vars['data']->value['phone'];?>
</td>
            <td class="text-center"><?php if ($_smarty_tpl->tpl_vars['data']->value['email']) {
echo $_smarty_tpl->tpl_vars['data']->value['email'];
} else { ?> ~ <?php }?></td>
            <td class="text-center"><?php if ($_smarty_tpl->tpl_vars['data']->value['address']) {
echo nl2br($_smarty_tpl->tpl_vars['data']->value['address']);
} else { ?> ~ <?php }?></td>
          </tr>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        <?php } else { ?>
          <tr><td class="text-center" colspan="6"><h4>មិនមានទិន្នន័យអតិថិជន។ (There is no customer information.)</h4></td></tr>
        <?php }?>
        </tbody>
      </table>
    </div>
  </div>
<?php }
}
}
/* {/block "main"} */
/* {block "javascript"} */
class Block_163605822169e1bcec0a2f17_13785494 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'javascript' => 
  array (
    0 => 'Block_163605822169e1bcec0a2f17_13785494',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<?php echo '<script'; ?>
>
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
