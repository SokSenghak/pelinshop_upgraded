<?php
/* Smarty version 4.1.0, created on 2026-04-17 11:58:40
  from '/home/senghak/Documents/pelinshop_php8/pelinshop_upgraded/designs/templates/admin/staffTask.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.0',
  'unifunc' => 'content_69e1be001989e6_04397001',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4c19808b083bcc8d41c0b590028c1d4a261a7554' => 
    array (
      0 => '/home/senghak/Documents/pelinshop_php8/pelinshop_upgraded/designs/templates/admin/staffTask.tpl',
      1 => 1776070560,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common/paginate.tpl' => 1,
  ),
),false)) {
function content_69e1be001989e6_04397001 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_8957561269e1be00181483_31420440', "main");
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_148153500069e1be00198138_22865504', "javascript");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "admin/layout.tpl");
}
/* {block "main"} */
class Block_8957561269e1be00181483_31420440 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'main' => 
  array (
    0 => 'Block_8957561269e1be00181483_31420440',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/senghak/Documents/pelinshop_php8/pelinshop_upgraded/external_libs/smarty-4.1.0/libs/plugins/function.counter.php','function'=>'smarty_function_counter',),));
?>

  <ul class="breadcrumb">
    <li><a href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
">ទំព័រដើម (Home)</a></li>
    <li class="active">ព័ត៌មានបុគ្គលិក (Staff Information)</li>
  </ul>
  <?php if ($_smarty_tpl->tpl_vars['error']->value) {?>
    <div class="alert alert-danger" data-dismiss="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <?php if ($_smarty_tpl->tpl_vars['error']->value['role'] == 1) {?>សូមជ្រើសរើសតួនាទីការសម្រាប់បុគ្គលិក។ (Please choose role for staff work.)<br/><?php }?>
      <?php if ($_smarty_tpl->tpl_vars['error']->value['brand'] == 1) {?>សូមជ្រើសរើសសាខាធ្វើការសម្រាប់បុគ្គលិក។ (Please choose branch for staff work.)<br/><?php }?>
      <?php if ($_smarty_tpl->tpl_vars['error']->value['staff_name'] == 1) {?>សូមបញ្ចូលឈ្មោះបុគ្គលិក។ (Please enter staff name.)<br/><?php }?>
      <?php if ($_smarty_tpl->tpl_vars['error']->value['staff_password'] == 1) {?>សូមបញ្ចូលពាក្យសម្ងាត់បុគ្គលិក។ (Please enter password for staff.)<br/><?php }?>
    </div>
  <?php }?>
  <div class="panel panel-primary">
    <div class="panel-heading"><h3 class="panel-title"><i class="glyphicon glyphicon-user"></i>&nbsp;ព័ត៌មានបុគ្គលិក (Staff Information)</h3></div>
    <div class="panel-body">
      <div class="row">
        <div class="col-md-9">
          <?php if ($_smarty_tpl->tpl_vars['staff']->value['id']) {?>
          <form role="form" method="post" class="form-inline" action="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=staff&amp;action=edit&amp;id=<?php echo $_smarty_tpl->tpl_vars['staff']->value['id'];?>
">
          <?php } else { ?>
          <form role="form" method="post" class="form-inline" action="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=staff">
          <?php }?>
            <div class="form-group">
              <?php if ($_smarty_tpl->tpl_vars['staff']->value['id']) {?>
                <select name="branch_id" class="form-control">
                  <option value="">ជ្រើសរើសសាខា (Choose branch name)</option>
                  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list_branch_name']->value, 'branch');
$_smarty_tpl->tpl_vars['branch']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['branch']->value) {
$_smarty_tpl->tpl_vars['branch']->do_else = false;
?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['branch']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['staff']->value['branch_id'] == $_smarty_tpl->tpl_vars['branch']->value['id']) {?>selected<?php }?> ><?php echo $_smarty_tpl->tpl_vars['branch']->value['name'];?>
</option>
                  <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </select>
              <?php } else { ?>
                <select name="branch_id" class="form-control">
                  <option value="">សូមជ្រើសរើសសាខា (Choose branch name)</option>
                  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list_branch_name']->value, 'branch');
$_smarty_tpl->tpl_vars['branch']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['branch']->value) {
$_smarty_tpl->tpl_vars['branch']->do_else = false;
?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['branch']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['branch']->value['name'];?>
</option>
                  <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </select>
              <?php }?>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input type="text" name="staff_password" value="<?php if ($_smarty_tpl->tpl_vars['staff']->value['password']) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['staff']->value['password'], ENT_QUOTES, 'UTF-8', true);
}?>" class="form-control" placeholder="ពាក្យសម្ងាត់ (Password)">
              </div>
            </div>
            <div class="form-group">
              <?php if ($_smarty_tpl->tpl_vars['staff']->value['id']) {?>
                <select name="role" class="form-control">
                  <option value="">ជ្រើសរើសតួនាទី (Choose role name)</option>
                  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list_role_name']->value, 'role');
$_smarty_tpl->tpl_vars['role']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['role']->value) {
$_smarty_tpl->tpl_vars['role']->do_else = false;
?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['role']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['staff']->value['role'] == $_smarty_tpl->tpl_vars['role']->value['id']) {?>selected<?php }?> ><?php echo $_smarty_tpl->tpl_vars['role']->value['name'];?>
</option>
                  <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </select>
              <?php } else { ?>
                <select name="role" class="form-control">
                  <option value="">សូមជ្រើសរើសតួនាទី (Choose role name)</option>
                  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list_role_name']->value, 'role');
$_smarty_tpl->tpl_vars['role']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['role']->value) {
$_smarty_tpl->tpl_vars['role']->do_else = false;
?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['role']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['role']->value['name'];?>
</option>
                  <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </select>
              <?php }?>
            </div>
            <div class="form-group">
              <div class="input-group">
                <input type="text" name="staff_name" value="<?php if ($_smarty_tpl->tpl_vars['staff']->value['name']) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['staff']->value['name'], ENT_QUOTES, 'UTF-8', true);
}?>" class="form-control" placeholder="ឈ្មោះបុគ្គលិក (Staff Name)">
                <?php if ($_smarty_tpl->tpl_vars['staff']->value['id']) {?>
                  <input type="hidden" name="staff_id" value="<?php echo $_smarty_tpl->tpl_vars['staff']->value['id'];?>
" />
                  <span class="input-group-btn">
                      <button class="btn btn-success" type="submit" name="submit"><i class="glyphicon glyphicon-edit"></i>&nbsp;&nbsp;កែប្រែ (Edit)</button>
                    </span>
                <?php } else { ?>
                  <span class="input-group-btn">
                      <button class="btn btn-success" type="submit" name="submit"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp;&nbsp;បន្ថែម (Add)</button>
                    </span>
                <?php }?>
              </div>
            </div>
          </form>
        </div>
        <div class="col-md-3">
          <form role="form" method="get" action="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=staff" class="form-horizontal">
            <input type="hidden" name="task" value="staff">
            <div class="input-group">
              <input type="text" name="kwd" value="<?php echo $_GET['kwd'];?>
" class="form-control" placeholder="ស្វែងរក (Search for...)" autofocus>
            <span class="input-group-btn">
              <button class="btn btn-success" type="submit"><li class="glyphicon glyphicon-search"></li></button>
            </span>
            </div>
          </form>
        </div>
      </div>
      <hr style="margin-top:5px;margin-bottom:5px;" />
    <div class="table-responsive">
      <table class="table table-bordered table-striped table-hover">
        <thead class="table_header">
          <th></th>
          <th class="text-center">សកម្មភាព (Action)</th>
          <th class="text-center">ID</th>
          <th class="text-center">ពាក្យសម្ងាត់ (Password)</th>
          <th class="text-center">ឈ្មោះបុគ្គលិក (Staff Name)</th>
          <th class="text-center">ស្ថានភាព (Status)</th>
          <th class="text-center">សាខា (Branch)</th>
          <th class="text-center">តួនាទី (Role)</th>
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
            <td class="text-center"><?php if ($_GET['next'] == 1 || $_GET['next'] == '') {
echo smarty_function_counter(array(),$_smarty_tpl);
} else {
echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['iteration'] : null)+$_GET['next']-1;
}?></td>
            <td class="text-center" valign="top" width="100px;">
              <!-- <a data-toggle="tooltip" data-original-title="View Staff History" class="btn btn-xs btn-success" href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=staff&amp;action=history&amp;id=<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
">
                <i class="glyphicon glyphicon-list"></i> History
              </a> -->
              <a data-toggle="tooltip" data-original-title="Edit Staff Information"  class="btn btn-xs btn-success" href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=staff&amp;action=edit&amp;id=<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
">
                <i class="glyphicon glyphicon-edit"></i> កែប្រែ (Edit)
              </a>
            </td>
            <td class="text-center"><?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
</td>
            <td class="text-center"><?php echo $_smarty_tpl->tpl_vars['data']->value['password'];?>
</td>
            <td class="text-center"><?php echo $_smarty_tpl->tpl_vars['data']->value['name'];?>
</td>
            <td class="text-center"><?php if ($_smarty_tpl->tpl_vars['data']->value['is_quited'] == 0) {?><label class="label label-info">ធ្វើការ (Working)</label><?php } else { ?><label class="label label-danger">ឈប់ធ្វើការ (Stopped)</label><?php }?></td>
            <td class="text-center"><?php echo $_smarty_tpl->tpl_vars['data']->value['branch_name'];?>
</td>
             <td class="text-center"><?php echo $_smarty_tpl->tpl_vars['data']->value['role_name'];?>
</td>
          </tr>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        <?php } else { ?>
          <tr><td class="text-center" colspan="6"><h4>មិនមានព័ត៌មានបុគ្គលិក។ (There is no staff information.)</h4></td></tr>
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
class Block_148153500069e1be00198138_22865504 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'javascript' => 
  array (
    0 => 'Block_148153500069e1be00198138_22865504',
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
