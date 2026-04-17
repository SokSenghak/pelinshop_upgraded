<?php
/* Smarty version 4.1.0, created on 2026-04-17 14:45:18
  from '/home/senghak/Documents/pelinshop_php8/pelinshop_upgraded/designs/templates/admin/branchTask.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.0',
  'unifunc' => 'content_69e1e50eeedb01_13775930',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd7cd2be406233132a52a6d3ca7d3dd1931c924ed' => 
    array (
      0 => '/home/senghak/Documents/pelinshop_php8/pelinshop_upgraded/designs/templates/admin/branchTask.tpl',
      1 => 1776406042,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common/paginate.tpl' => 1,
  ),
),false)) {
function content_69e1e50eeedb01_13775930 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_210219417269e1e50eeaa120_31378573', "main");
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_196953011269e1e50eee7ac8_74381895', "javascript");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "admin/layout.tpl");
}
/* {block "main"} */
class Block_210219417269e1e50eeaa120_31378573 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'main' => 
  array (
    0 => 'Block_210219417269e1e50eeaa120_31378573',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

  <ul class="breadcrumb">
    <li><a href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
">ទំព័រដើម (Home)</a></li>
    <li class="active">កំណត់ (Setting)</li>
    <li class="active">ព័ត៌មានសាខា (Branch Information)</li>
  </ul>
  <?php if ($_smarty_tpl->tpl_vars['error']->value) {?>
    <div class="alert alert-danger" data-dismiss="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <?php if ($_smarty_tpl->tpl_vars['error']->value['branch_name'] == 1) {?>សូមបញ្ចូលឈ្មោះសាខា។ (Please enter branch name.)<?php }?>
    </div>
  <?php }?>

  <div class="panel panel-primary">
    <div class="panel-heading"><h3 class="panel-title">បញ្ជីសាខា (Branch List)</h3></div>
    <div class="panel-body">
      <div class="row">
        <div class="col-md-8">
          <?php if ($_smarty_tpl->tpl_vars['branch']->value['id']) {?>
          <form role="form" method="post" action="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=branch&amp;action=edit&amp;id=<?php echo $_smarty_tpl->tpl_vars['branch']->value['id'];?>
" class="form-inline">
          <?php } else { ?>
          <form role="form" method="post" action="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=branch" class="form-inline">
          <?php }?>
            <div class="form-group">
              <div class="input-group">
                <input type="text" name="branch_name" value="<?php if ($_smarty_tpl->tpl_vars['branch']->value['name']) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['branch']->value['name'], ENT_QUOTES, 'UTF-8', true);
}?>"
                       class="form-control" placeholder="សាខាថ្មី (new branch)..." autofocus>
                <?php if ($_smarty_tpl->tpl_vars['branch']->value['id']) {?>
                  <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['branch']->value['id'];?>
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
              <?php if ($_smarty_tpl->tpl_vars['branch']->value['id']) {?>
                <a class="btn btn-info" href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=branch"><i class="glyphicon glyphicon-remove-circle"></i>&nbsp;បោះបង់ (Cancel)</a>
              <?php }?>
            </div>
          </form>
        </div>
        <div class="col-md-4">
          <form role="form" method="get" action="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=branch" class="form-horizontal">
            <input type="hidden" name="task" value="branch">
            <div class="input-group">
              <input type="text" value="<?php echo htmlspecialchars((($tmp = $_GET['kwd'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
" name="kwd" class="form-control" placeholder="ស្វែងរក (Search for)...">
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
          <th>ឈ្មោះសាខា (Branch Name)</th>
        </thead>
        <tbody>
          <?php if (count($_smarty_tpl->tpl_vars['list_branch_data']->value) > 0) {?>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list_branch_data']->value, 'data');
$_smarty_tpl->tpl_vars['data']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['data']->value) {
$_smarty_tpl->tpl_vars['data']->do_else = false;
?>
          <tr>
            <td class="text-center" valign="top" width="175px;">
              <a data-toggle="tooltip" data-original-title="Edit Branch Name" class="btn btn-xs btn-success" href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=branch&amp;action=edit&amp;id=<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
">
                <i class="glyphicon glyphicon-pencil"></i> កែប្រែ (Edit)
              </a>
            </td>
            <td><?php echo $_smarty_tpl->tpl_vars['data']->value['name'];?>
</td>
          </tr>
          <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
          <?php } else { ?>
            <tr>
              <td class="text-center" colspan="2">
                <h4>មិនមានព័ត៌មានសាខា។ (There is no branch information.)</h4>
              </td>
            </tr>
          <?php }?>
        </tbody>
      </table>
    </div>
  </div>
<?php $_smarty_tpl->_subTemplateRender("file:common/paginate.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
/* {/block "main"} */
/* {block "javascript"} */
class Block_196953011269e1e50eee7ac8_74381895 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'javascript' => 
  array (
    0 => 'Block_196953011269e1e50eee7ac8_74381895',
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
