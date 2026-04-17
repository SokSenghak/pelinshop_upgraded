<?php
/* Smarty version 4.1.0, created on 2026-04-17 14:45:34
  from '/home/senghak/Documents/pelinshop_php8/pelinshop_upgraded/designs/templates/admin/brandTask.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.0',
  'unifunc' => 'content_69e1e51e803073_77222534',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f3b4a446432e770570ce2a8a3b14a97a87306ce8' => 
    array (
      0 => '/home/senghak/Documents/pelinshop_php8/pelinshop_upgraded/designs/templates/admin/brandTask.tpl',
      1 => 1776406222,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common/paginate.tpl' => 1,
  ),
),false)) {
function content_69e1e51e803073_77222534 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_45409581269e1e51e7c6825_65314131', "main");
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_185999540969e1e51e8015c2_69784465', "javascript");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "admin/layout.tpl");
}
/* {block "main"} */
class Block_45409581269e1e51e7c6825_65314131 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'main' => 
  array (
    0 => 'Block_45409581269e1e51e7c6825_65314131',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/senghak/Documents/pelinshop_php8/pelinshop_upgraded/external_libs/smarty-4.1.0/libs/plugins/function.counter.php','function'=>'smarty_function_counter',),));
?>

  <ul class="breadcrumb">
    <li><a href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
">ទំព័រដើម (Home)</a></li>
    <li class="active">កំណត់ (Setting)</li>
    <li class="active">ព័ត៌មានម៉ាកផលិតផល (Brand Information)</li>
  </ul>
  <?php if ($_smarty_tpl->tpl_vars['error']->value) {?>
    <div class="alert alert-danger" data-dismiss="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <?php if ($_smarty_tpl->tpl_vars['error']->value['brand_name'] == 1) {?>សូមបញ្ចូលម៉ាកផលិតផល។ (Please enter brand name.)<br/><?php }?>
      <?php if ($_smarty_tpl->tpl_vars['error']->value['maker'] == 1) {?>សូមជ្រើសរើសក្រុមហ៊ុនផលិត។ (Please Choose Maker.)<br /><?php }?>
    </div>
  <?php }?>
  <div class="panel panel-primary">
    <div class="panel-heading"><h3 class="panel-title">បញ្ជីម៉ាកផលិតផល (Brand List)</h3></div>
    <div class="panel-body">
      <div class="row">
        <div class="col-md-8">
          <?php if ($_smarty_tpl->tpl_vars['brand']->value['id']) {?>
          <form role="form" method="post" action="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=brand&amp;action=edit&amp;id=<?php echo $_smarty_tpl->tpl_vars['brand']->value['id'];?>
" class="form-inline">
          <?php } else { ?>
          <form role="form" method="post" action="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=brand" class="form-inline">
          <?php }?>
            <div class="form-group">
              <?php if ($_smarty_tpl->tpl_vars['brand']->value['id']) {?>
                <select name="maker_id" class="form-control">
                  <option>ជ្រើសរើសឈ្មោះម៉ាកផលិតផល (Choose Maker Name)</option>
                  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list_maker_name']->value, 'maker');
$_smarty_tpl->tpl_vars['maker']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['maker']->value) {
$_smarty_tpl->tpl_vars['maker']->do_else = false;
?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['maker']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['brand']->value['maker_id'] == $_smarty_tpl->tpl_vars['maker']->value['id']) {?>selected<?php }?> ><?php echo $_smarty_tpl->tpl_vars['maker']->value['name'];?>
</option>
                  <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </select>
              <?php } else { ?>
                <select name="maker_id" class="form-control">
                  <option value="">ជ្រើសរើសឈ្មោះម៉ាកផលិតផល (Choose Maker Name)</option>
                  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list_maker_name']->value, 'maker');
$_smarty_tpl->tpl_vars['maker']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['maker']->value) {
$_smarty_tpl->tpl_vars['maker']->do_else = false;
?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['maker']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['maker']->value['name'];?>
</option>
                  <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </select>
              <?php }?>
            </div>
            <div class="form-group">
              <div class="input-group">
                <input type="text" name="brand_name" value="<?php if ($_smarty_tpl->tpl_vars['brand']->value['name']) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['brand']->value['name'], ENT_QUOTES, 'UTF-8', true);
}?>" class="form-control" placeholder="ម៉ាកផលិតផលថ្មី (new product brand)..." autofocus>
                <?php if ($_smarty_tpl->tpl_vars['brand']->value['id']) {?>
                  <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['brand']->value['id'];?>
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
              <?php if ($_smarty_tpl->tpl_vars['brand']->value['id']) {?>
                <a class="btn btn-info" href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=brand"><i class="glyphicon glyphicon-remove-circle"></i>&nbsp;បោះបង់ (Cancel)</a>
              <?php }?>
            </div>
          </form>
        </div>
        <div class="col-md-4">
          <form role="form" method="get" action="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=brand" class="form-horizontal">
            <input type="hidden" name="task" value="brand">
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
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
          <thead class="table_header">
            <th></th>
            <th class="text-center">សកម្មភាព (Action)</th>
            <th>ឈ្មោះម៉ាកផលិតផល (Brand Name)</th>
            <th>ឈ្មោះក្រុមហ៊ុនផលិត (Maker Name)</th>
          </thead>
          <tbody>
          <?php if (count($_smarty_tpl->tpl_vars['list_brand_data']->value) > 0) {?>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list_brand_data']->value, 'data');
$_smarty_tpl->tpl_vars['data']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['data']->value) {
$_smarty_tpl->tpl_vars['data']->do_else = false;
?>
            <tr>
              <td class="text-center" valign="top" width="80px;"><?php if ((($tmp = $_GET['next'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp) == 1 || (($tmp = $_GET['next'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp) == '') {
echo smarty_function_counter(array(),$_smarty_tpl);
} else {
echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['iteration'] : null)+(($tmp = $_GET['next'] ?? null)===null||$tmp==='' ? 1 ?? null : $tmp)-1;
}?></td>
              <td class="text-center" valign="top" width="100px;">
                <a data-toggle="tooltip" data-original-title="Edit Brand Name" class="btn btn-xs btn-success" href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=brand&amp;action=edit&amp;id=<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
">
                  <i class="glyphicon glyphicon-pencil"></i> កែប្រែ (Edit)
                </a>
                <!-- <span title="Delete Brand" data-toggle="tooltip" data-placement="top"><button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#myModal_<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
"><i class="glyphicon glyphicon-trash"></i> Delete</button></span> -->
                <!-- Modal -->
                <!-- <div class="modal fade" id="myModal_<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Delete Brand</h4>
                      </div>
                      <div class="modal-body">Are you sure want to delete this brand named <label class="label label-danger"><?php echo $_smarty_tpl->tpl_vars['data']->value['name'];?>
</label> ? </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-xs btn-default" data-dismiss="modal">　Cancel </button>
                        <a class="btn btn-xs btn-danger" href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=brand&amp;action=delete&amp;id=<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
">　Delete</a>
                      </div>
                    </div>
                  </div>
                </div> -->
                <!--End Modal-->
              </td>
              <td valign="top" width="300px;"><?php echo $_smarty_tpl->tpl_vars['data']->value['name'];?>
</td>
              <td><?php echo $_smarty_tpl->tpl_vars['data']->value['maker_name'];?>
</td>
            </tr>
          <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
          <?php } else { ?>
            <tr><td class="text-center" colspan="3"><h4>មិនមានទិន្នន័យម៉ាកផលិតផល។ (There is no brand information.)</h4></td></tr>
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
class Block_185999540969e1e51e8015c2_69784465 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'javascript' => 
  array (
    0 => 'Block_185999540969e1e51e8015c2_69784465',
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
