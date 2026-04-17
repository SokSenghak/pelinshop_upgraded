<?php
/* Smarty version 4.1.0, created on 2026-04-17 13:50:13
  from '/home/senghak/Documents/pelinshop_php8/pelinshop_upgraded/designs/templates/admin/productTask.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.0',
  'unifunc' => 'content_69e1d825727f86_56738950',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6eecf1d571dbcc9748c9280439cd98771db488fb' => 
    array (
      0 => '/home/senghak/Documents/pelinshop_php8/pelinshop_upgraded/designs/templates/admin/productTask.tpl',
      1 => 1776408232,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common/paginate.tpl' => 1,
  ),
),false)) {
function content_69e1d825727f86_56738950 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_200048078269e1d82564cb91_85342931', "main");
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_190052063769e1d82571eef8_24892518', "javascript");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "admin/layout.tpl");
}
/* {block "main"} */
class Block_200048078269e1d82564cb91_85342931 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'main' => 
  array (
    0 => 'Block_200048078269e1d82564cb91_85342931',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/senghak/Documents/pelinshop_php8/pelinshop_upgraded/external_libs/smarty-4.1.0/libs/plugins/function.counter.php','function'=>'smarty_function_counter',),1=>array('file'=>'/home/senghak/Documents/pelinshop_php8/pelinshop_upgraded/external_libs/smarty-4.1.0/libs/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>

  <ul class="breadcrumb">
    <li><a href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
">ទំព័រដើម (Home)</a></li>
    <li class="active">ព័ត៌មានផលិតផល (Product information)</li>
  </ul>
  <div class="panel panel-primary">
    <div class="panel-heading">
      <form method="get" class="form-inline" action="#">
        <a class="btn btn-md btn-success " href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=product&amp;action=add"><i class="glyphicon glyphicon-plus"></i>&nbsp;ផលិតផលថ្មី (New Product)</a>
        <div class="form-group">
          <input type="number" id="num_print" maxlength="2" class="form-control" style="width: 65px;" onchange="number_print()">
        </div>
        <div class="btn-group">
          <a class="btn btn-md btn-danger" id="href_print" href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=product&amp;action=all_qrcode_print&amp;num_print=0" target="_blank"><i class="fa fa fa-print"></i>
            បោះពុម្ព Qrcode ដោយការជ្រើសរើស (Print Qrcode By Select) <span class="badge" id="total_sel"><?php if ((($tmp = $_SESSION['pro_id'] ?? null)===null||$tmp==='' ? array() ?? null : $tmp)) {
echo COUNT((($tmp = $_SESSION['pro_id'] ?? null)===null||$tmp==='' ? array() ?? null : $tmp));
} else { ?>0<?php }?></span>
          </a>
          <button type="button" class="btn btn-primary" id="remove_pro">X</button>
        </div>

      </form>

    </div>
    <div class="panel-body">
      <div class="row">
        <div class="col-md-12">
          <form role="form" method="get" action="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=product" class="form-inline">
            <input type="hidden" name="task" value="product">
            <div class="form-group" style="margin-bottom: 5px;">
              <select name="maker" class="form-control" style="padding:0px">
                <option value="">---ជ្រើសរើសក្រុមហ៊ុនផលិត (Choose Product Maker)---</option>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list_maker_name']->value, 'maker');
$_smarty_tpl->tpl_vars['maker']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['maker']->value) {
$_smarty_tpl->tpl_vars['maker']->do_else = false;
?>
                  <option value="<?php echo $_smarty_tpl->tpl_vars['maker']->value['id'];?>
" <?php if ((($tmp = $_GET['maker'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp) == $_smarty_tpl->tpl_vars['maker']->value['id']) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['maker']->value['name'];?>
</option>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
              </select>
            </div>
            <div class="form-group" style="margin-bottom: 5px;">
              <select name="brand" class="form-control" style="padding:0px">
                <option value="">---ជ្រើសរើសម៉ាកផលិតផល (Choose Brand Name)---</option>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list_brand_name']->value, 'brand');
$_smarty_tpl->tpl_vars['brand']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['brand']->value) {
$_smarty_tpl->tpl_vars['brand']->do_else = false;
?>
                  <option value="<?php echo $_smarty_tpl->tpl_vars['brand']->value['id'];?>
" <?php if ((($tmp = $_GET['brand'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp) == $_smarty_tpl->tpl_vars['brand']->value['id']) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['brand']->value['name'];?>
</option>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
              </select>
            </div>
            <div class="form-group" style="margin-bottom: 5px;">
              <select name="branch_id" class="form-control" style="padding:0px">
              <option value="">---ជ្រើសរើសសាខា (Select Branch Name)---</option>
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
            </div>
            <div class="form-group" style="margin-bottom: 5px;">
              <select name="pr_st_id" class="form-control" style="padding:0px">
              <option value="">---ជ្រើសរើសទំហំផ្ទុក (Select Product Storage)---</option>
              <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product_storage']->value, 'data');
$_smarty_tpl->tpl_vars['data']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['data']->value) {
$_smarty_tpl->tpl_vars['data']->do_else = false;
?>
                <option value="<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
" <?php if ((($tmp = $_GET['pr_st_id'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp) == $_smarty_tpl->tpl_vars['data']->value['id']) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['data']->value['name'];?>
</option>
              <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
              </select>
            </div>
            <div class="form-group" style="margin-bottom: 5px;">
              <div class="input-group date">
                <input type="text" id="date_from" value ="<?php echo htmlspecialchars((($tmp = $_GET['from'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
" class="form-control" name="from" placeholder="ពីកាលបរិច្ឆេទបញ្ជាទិញ (Order Date From)"/>
                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
                </span>
              </div>
            </div>
            <div class="form-group" style="margin-bottom: 5px;">
              <div class="input-group date" >
                <input type="text" id="date_to" value ="<?php echo htmlspecialchars((($tmp = $_GET['to'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
" class="form-control" name="to" placeholder="ទៅកាលបរិច្ឆេទបញ្ជាទិញ (Order Date To)" />
                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
                </span>
              </div>
            </div>
            <div class="form-group" style="margin-bottom: 5px;">
              <div class="input-group">
                <input type="text" value="<?php echo htmlspecialchars((($tmp = $_GET['kwd'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
" name="kwd" class="form-control" style="padding:0px" placeholder=" ស្វែងរកតាមលេខ IMEI ឬឈ្មោះផលិតផល (Search by IMEI Number or Title)" autofocus>
                  <span class="input-group-btn">
                    <button class="btn btn-success" type="submit"><li class="glyphicon glyphicon-search"></li>&nbsp;ស្វែងរក (Search)</button>
                </span>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <!-- Nav tabs -->
          <ul class="nav nav-pills" role="tablist">
              <li role="presentation" class="<?php if (!(($tmp = $_GET['tab'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp) || (($tmp = $_GET['tab'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp) == 1) {?> active <?php }?> khmer-first-font"><a href="<?php echo $_smarty_tpl->tpl_vars['admin_file_name']->value;?>
?task=product&maker=<?php echo htmlspecialchars((($tmp = $_GET['maker'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
&brand=<?php echo htmlspecialchars((($tmp = $_GET['brand'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
&branch_id=<?php echo htmlspecialchars((($tmp = $_GET['branch_id'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
&pr_st_id=<?php echo htmlspecialchars((($tmp = $_GET['pr_st_id'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
&from=<?php echo htmlspecialchars((($tmp = $_GET['from'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
&to=<?php echo htmlspecialchars((($tmp = $_GET['to'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
&kwd=<?php echo htmlspecialchars((($tmp = $_GET['kwd'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
&tab=1"><i class="fa fa-line-chart"></i> ព័ត៌មានផលិតផល កាត់ស្តុក</a></li>
              <li role="presentation" class="<?php if ((($tmp = $_GET['tab'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp) && (($tmp = $_GET['tab'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp) == 2) {?> active <?php }?> khmer-first-font"><a href="<?php echo $_smarty_tpl->tpl_vars['admin_file_name']->value;?>
?task=product&maker=<?php echo htmlspecialchars((($tmp = $_GET['maker'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
&brand=<?php echo htmlspecialchars((($tmp = $_GET['brand'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
&branch_id=<?php echo htmlspecialchars((($tmp = $_GET['branch_id'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
&pr_st_id=<?php echo htmlspecialchars((($tmp = $_GET['pr_st_id'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
&from=<?php echo htmlspecialchars((($tmp = $_GET['from'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
&to=<?php echo htmlspecialchars((($tmp = $_GET['to'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
&kwd=<?php echo htmlspecialchars((($tmp = $_GET['kwd'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
&tab=2"><i class="fa fa-flag"></i> ព័ត៌មានផលិតផល មិនកាត់ស្តុក</a></li>
          </ul>
          <!-- Tab panes -->
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane <?php if (!(($tmp = $_GET['tab'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp) || (($tmp = $_GET['tab'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp) == 1) {?> active <?php }?>" id="cutting">
              <hr style="margin-top:5px;margin-bottom:5px;" />
              <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table_header">
                      <tr>
                        <th></th>
                        <th>
                          <div class="checkbox">
                            <label><input type="checkbox" id="chk_print_all"></label>
                          </div>
                        </th>
                        <th class="text-center" width="185">សកម្មភាព (Action)</th>
                        <th class="text-center">សាខា (Branch)</th>
                        <th class="text-center">លេខ IMEI (IMEI Number)</th>
                        <th class="text-center">ឈ្មោះផលិតផល (Title)</th>
                        <th class="text-center">ឈ្មោះក្រុមហ៊ុន (Company Name)</th>
                        <?php if ($_SESSION['is_login_role'] == 2) {?>
                        <th class="text-center">តម្លៃដើម (Cost)</th>
                        <?php }?>
                        <th class="text-center">តម្លៃលក់ (Price)</th>
                        <th class="text-center">ក្រុមហ៊ុនផលិត (Maker)</th>
                        <th class="text-center">ម៉ាកផលិតផល (Brand)</th>
                        <th class="text-center">គុណភាព (Pro-Used)</th>
                        <th class="text-center">រូបភាព (Image)</th>
                        <th class="text-center" width="100">កាលបរិច្ឆេទចូល (Date In)</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (count($_smarty_tpl->tpl_vars['list_product_data']->value) > 0) {?>
                      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list_product_data']->value, 'data', false, 'k', 'foo', array (
  'first' => true,
  'iteration' => true,
  'index' => true,
));
$_smarty_tpl->tpl_vars['data']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['data']->value) {
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
                        <td valign="top">
                          <div class="checkbox">
                            <label><input type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
" class="chk_print" <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, (($tmp = $_SESSION['pro_id'] ?? null)===null||$tmp==='' ? array() ?? null : $tmp), 'vp');
$_smarty_tpl->tpl_vars['vp']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['vp']->value) {
$_smarty_tpl->tpl_vars['vp']->do_else = false;
if ($_smarty_tpl->tpl_vars['vp']->value == $_smarty_tpl->tpl_vars['data']->value['id']) {?>checked<?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>></label>
                          </div>
                        </td>
                        <td class="text-center" valign="top" width="155px;">
        
                          <span title="បញ្ជូនត្រឡប់​ទៅ​ក្រុមហ៊ុន (Return Back To Company)" data-toggle="tooltip" data-placement="top">
                            <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#myReturn_<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
" ><i class="fa fa-reply"></i></button>
                          <!-- Modal -->
                          </span>
                          <div class="modal fade" id="myReturn_<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                                  </button>
                                  <h4 class="modal-title" id="myModalLabel">ការបញ្ជាក់ (Confirmation)</h4>
                                </div>
                                <div class="modal-body">តើ​អ្នក​ពិតជា​ចង់​បញ្ជូនត្រឡប់​ទៅ​ក្រុមហ៊ុន​វិញ​នូវ​ផលិតផលដែលមានលេខលេខ IMEI ​នេះ (Are you sure want to return back to company this product IMEI number) <label class="label label-danger"><?php echo $_smarty_tpl->tpl_vars['data']->value['imei'];?>
</label> ? </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-xs btn-default" data-dismiss="modal">　បោះបង់ (Cancel) </button>
                                  <a class="btn btn-xs btn-danger" href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=product&amp;action=return_back&amp;id=<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
"> បាទ/ចាស (Yes)</a>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!--End Modal-->
        
                          <a class="btn btn-xs btn-primary" href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=product&amp;action=detail&amp;id=<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
" data-toggle="tooltip" data-placement="top" title="ផលិតផលលម្អិត & Qrcode (Detail Product & Qrcode)">
                            <i class="glyphicon glyphicon-eye-open"></i>
                          </a>
                          <?php if ($_SESSION['is_login'] == 'admin') {?>
                          <a class="btn btn-xs btn-primary" href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=product&amp;action=edit&amp;id=<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
" data-toggle="tooltip" data-original-title="កែប្រែផលិតផល (Edit Product)">
                            <i class="glyphicon glyphicon-edit"></i>
                          </a>
                          <?php }?>
                          <a class="btn btn-xs btn-primary" href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=product&amp;action=upload&amp;id=<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
" data-toggle="tooltip" data-original-title="ដាក់រូបភាពផលិតផល (Upload Product Image)">
                            <i class="glyphicon glyphicon-picture"></i>
                          </a>
                          <a class="btn btn-xs btn-primary" onclick="viewModal('<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
', '<?php echo $_smarty_tpl->tpl_vars['data']->value['imei'];?>
'); return false;" href="#" title="ចុចដើម្បីក្លូនផលិតផល (Click to clone product)" data-toggle="tooltip" data-placement="top">
                            <i class="glyphicon glyphicon-copy"></i></a>
                          <?php if ($_SESSION['is_login'] == 'admin' || $_SESSION['is_login'] == 'sub_admin') {?>
                          <span title="លុបផលិតផល (Delete Product)" data-toggle="tooltip" data-placement="top">
                            <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#myModal_<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
" ><i class="glyphicon glyphicon-trash"></i></button>
                          <!-- Modal -->
                          </span>
                          <div class="modal fade" id="myModal_<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                                  </button>
                                  <h4 class="modal-title" id="myModalLabel">តម្រូវឱ្យមានការបញ្ជាក់ (Confirmation Required)</h4>
                                </div>
                                <div class="modal-body">តើអ្នកពិតជាចង់លុបលេខ IMEI របស់ផលិតផលនេះ (Are you sure want to delete this product IMEI number) <label class="label label-danger"><?php echo $_smarty_tpl->tpl_vars['data']->value['imei'];?>
</label> ? </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-xs btn-default" data-dismiss="modal">　បោះបង់ (Cancel) </button>
                                  <a class="btn btn-xs btn-danger" href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=product&amp;action=delete&amp;id=<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
">　លុប (Delete)</a>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!--End Modal-->
                          <?php }?>
                        </td>
                        <td class="text-center" valign="top"><?php echo $_smarty_tpl->tpl_vars['data']->value['branch_name'];?>
</td>
                        <td class="text-center" valign="top" width="140px;"><?php echo $_smarty_tpl->tpl_vars['data']->value['imei'];?>
 
                        <?php if ((isset($_smarty_tpl->tpl_vars['data']->value)) && $_smarty_tpl->tpl_vars['data']->value['is_cutting'] == 2) {?>
                          <br><span style="color: red;">(មិនកាត់ស្តុក)</span> 
                        <?php }?>
                        </td>
                        <td><?php echo $_smarty_tpl->tpl_vars['data']->value['title'];?>

                          <?php if ($_smarty_tpl->tpl_vars['data']->value['color_name']) {?>-<?php echo $_smarty_tpl->tpl_vars['data']->value['color_name'];
}?>
                          <?php if ($_smarty_tpl->tpl_vars['data']->value['storage_name']) {?>-<?php echo $_smarty_tpl->tpl_vars['data']->value['storage_name'];
}?>
                        </td>
                        <td class="text-center"><?php echo $_smarty_tpl->tpl_vars['data']->value['company_title'];?>
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
                        <td class="text-center"><?php echo $_smarty_tpl->tpl_vars['data']->value['pro_used_name'];?>
</td>
                        <td class="text-center" valign="top" width="90px;">
                          <?php if ($_smarty_tpl->tpl_vars['data']->value['photoone']) {?>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['shop_site']->value;?>
images/product/<?php echo $_smarty_tpl->tpl_vars['data']->value['photoone'];?>
" data-lightbox="<?php echo $_smarty_tpl->tpl_vars['data']->value['photoone'];?>
">
                              <img src="<?php echo $_smarty_tpl->tpl_vars['shop_site']->value;?>
images/product/thumbnail__<?php echo $_smarty_tpl->tpl_vars['data']->value['photoone'];?>
" class="img-thumbnail"  />
                            </a>
                          <?php }?>
                        </td>
                        <td class="text-center"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['data']->value['created_at']);?>
</td>
                      </tr>
                      <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                      <?php } else { ?>
                      <tr><td class="text-center" colspan="13"><h4>មិនមានព័ត៌មានអំពីផលិតផលទេ។ (There is no product information.)</h4></td></tr>
                      <?php }?>
                    </tbody>
                </table>
              </div>
            </div>
            <div role="tabpanel" class="tab-pane <?php if ((($tmp = $_GET['tab'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp) && (($tmp = $_GET['tab'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp) == 2) {?> active <?php }?>" id="no-cutting">
              <hr style="margin-top:5px;margin-bottom:5px;" />
              <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table_header">
                      <tr>
                        <th></th>
                        <th>
                          <div class="checkbox">
                            <label><input type="checkbox" id="chk_print_all"></label>
                          </div>
                        </th>
                        <th class="text-center" width="185">សកម្មភាព (Action)</th>
                        <th class="text-center">សាខា (Branch)</th>
                        <th class="text-center">លេខ IMEI (IMEI Number)</th>
                        <th class="text-center">ឈ្មោះផលិតផល (Title)</th>
                        <th class="text-center">ឈ្មោះក្រុមហ៊ុន (Company Name)</th>
                        <?php if ($_SESSION['is_login_role'] == 2) {?>
                        <th class="text-center">តម្លៃដើម (Cost)</th>
                        <?php }?>
                        <th class="text-center">តម្លៃលក់ (Price)</th>
                        <th class="text-center">ក្រុមហ៊ុនផលិត (Maker)</th>
                        <th class="text-center">ម៉ាកផលិតផល (Brand)</th>
                        <th class="text-center">គុណភាព (Pro-Used)</th>
                        <th class="text-center">រូបភាព (Image)</th>
                        <th class="text-center" width="100">កាលបរិច្ឆេទចូល (Date In)</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (count($_smarty_tpl->tpl_vars['list_product_data']->value) > 0) {?>
                      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list_product_data']->value, 'data', false, 'k', 'foo', array (
  'first' => true,
  'iteration' => true,
  'index' => true,
));
$_smarty_tpl->tpl_vars['data']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['data']->value) {
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
                        <td valign="top">
                          <div class="checkbox">
                            <label><input type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
" class="chk_print" <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, (($tmp = $_SESSION['pro_id'] ?? null)===null||$tmp==='' ? array() ?? null : $tmp), 'vp');
$_smarty_tpl->tpl_vars['vp']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['vp']->value) {
$_smarty_tpl->tpl_vars['vp']->do_else = false;
if ($_smarty_tpl->tpl_vars['vp']->value == $_smarty_tpl->tpl_vars['data']->value['id']) {?>checked<?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>></label>
                          </div>
                        </td>
                        <td class="text-center" valign="top" width="155px;">
        
                          <span title="បញ្ជូនត្រឡប់​ទៅ​ក្រុមហ៊ុន (Return Back To Company)" data-toggle="tooltip" data-placement="top">
                            <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#myReturn_<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
" ><i class="fa fa-reply"></i></button>
                          <!-- Modal -->
                          </span>
                          <div class="modal fade" id="myReturn_<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                                  </button>
                                  <h4 class="modal-title" id="myModalLabel">ការបញ្ជាក់ (Confirmation)</h4>
                                </div>
                                <div class="modal-body">តើ​អ្នក​ពិតជា​ចង់​បញ្ជូនត្រឡប់​ទៅ​ក្រុមហ៊ុន​វិញ​នូវ​ផលិតផលដែលមានលេខលេខ IMEI ​នេះ (Are you sure want to return back to company this product IMEI number) <label class="label label-danger"><?php echo $_smarty_tpl->tpl_vars['data']->value['imei'];?>
</label> ? </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-xs btn-default" data-dismiss="modal">　បោះបង់ (Cancel) </button>
                                  <a class="btn btn-xs btn-danger" href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=product&amp;action=return_back&amp;id=<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
"> បាទ/ចាស (Yes)</a>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!--End Modal-->
        
                          <a class="btn btn-xs btn-primary" href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=product&amp;action=detail&amp;id=<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
" data-toggle="tooltip" data-placement="top" title="ផលិតផលលម្អិត & Qrcode (Detail Product & Qrcode)">
                            <i class="glyphicon glyphicon-eye-open"></i>
                          </a>
                          <?php if ($_SESSION['is_login'] == 'admin') {?>
                          <a class="btn btn-xs btn-primary" href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=product&amp;action=edit&amp;id=<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
" data-toggle="tooltip" data-original-title="កែប្រែផលិតផល (Edit Product)">
                            <i class="glyphicon glyphicon-edit"></i>
                          </a>
                          <?php }?>
                          <a class="btn btn-xs btn-primary" href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=product&amp;action=upload&amp;id=<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
" data-toggle="tooltip" data-original-title="ដាក់រូបភាពផលិតផល (Upload Product Image)">
                            <i class="glyphicon glyphicon-picture"></i>
                          </a>
                          <a class="btn btn-xs btn-primary" onclick="viewModal('<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
', '<?php echo $_smarty_tpl->tpl_vars['data']->value['imei'];?>
'); return false;" href="#" title="ចុចដើម្បីក្លូនផលិតផល (Click to clone product)" data-toggle="tooltip" data-placement="top">
                            <i class="glyphicon glyphicon-copy"></i></a>
                          <?php if ($_SESSION['is_login'] == 'admin' || $_SESSION['is_login'] == 'sub_admin') {?>
                          <span title="លុបផលិតផល (Delete Product)" data-toggle="tooltip" data-placement="top">
                            <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#myModal_<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
" ><i class="glyphicon glyphicon-trash"></i></button>
                          <!-- Modal -->
                          </span>
                          <div class="modal fade" id="myModal_<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                                  </button>
                                  <h4 class="modal-title" id="myModalLabel">តម្រូវឱ្យមានការបញ្ជាក់ (Confirmation Required)</h4>
                                </div>
                                <div class="modal-body">តើអ្នកពិតជាចង់លុបលេខ IMEI របស់ផលិតផលនេះ (Are you sure want to delete this product IMEI number) <label class="label label-danger"><?php echo $_smarty_tpl->tpl_vars['data']->value['imei'];?>
</label> ? </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-xs btn-default" data-dismiss="modal">　បោះបង់ (Cancel) </button>
                                  <a class="btn btn-xs btn-danger" href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=product&amp;action=delete&amp;id=<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
">　លុប (Delete)</a>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!--End Modal-->
                          <?php }?>
                        </td>
                        <td class="text-center" valign="top"><?php echo $_smarty_tpl->tpl_vars['data']->value['branch_name'];?>
</td>
                        <td class="text-center" valign="top" width="140px;"><?php echo $_smarty_tpl->tpl_vars['data']->value['imei'];?>

                          <?php if ((isset($_smarty_tpl->tpl_vars['data']->value)) && $_smarty_tpl->tpl_vars['data']->value['is_cutting'] == 2) {?>
                            <br> 
                            <a class="btn btn-md btn-success text-center" href="#" onclick="addStockModal('<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
' , '<?php echo $_smarty_tpl->tpl_vars['data']->value['stock'];?>
'); return false;" data-toggle="tooltip" data-placement="top">
                              <i class="glyphicon glyphicon-plus"></i> បន្ថែមស្តុក <span class="badge"><?php echo $_smarty_tpl->tpl_vars['data']->value['stock'];?>
</span>
                              </a>
                          <?php }?>
                        </td>
                        <td><?php echo $_smarty_tpl->tpl_vars['data']->value['title'];?>

                          <?php if ($_smarty_tpl->tpl_vars['data']->value['color_name']) {?>-<?php echo $_smarty_tpl->tpl_vars['data']->value['color_name'];
}?>
                          <?php if ($_smarty_tpl->tpl_vars['data']->value['storage_name']) {?>-<?php echo $_smarty_tpl->tpl_vars['data']->value['storage_name'];
}?>
                        </td>
                        <td class="text-center"><?php echo $_smarty_tpl->tpl_vars['data']->value['company_title'];?>
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
                        <td class="text-center"><?php echo $_smarty_tpl->tpl_vars['data']->value['pro_used_name'];?>
</td>
                        <td class="text-center" valign="top" width="90px;">
                          <?php if ($_smarty_tpl->tpl_vars['data']->value['photoone']) {?>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['shop_site']->value;?>
images/product/<?php echo $_smarty_tpl->tpl_vars['data']->value['photoone'];?>
" data-lightbox="<?php echo $_smarty_tpl->tpl_vars['data']->value['photoone'];?>
">
                              <img src="<?php echo $_smarty_tpl->tpl_vars['shop_site']->value;?>
images/product/thumbnail__<?php echo $_smarty_tpl->tpl_vars['data']->value['photoone'];?>
" class="img-thumbnail"  />
                            </a>
                          <?php }?>
                        </td>
                        <td class="text-center"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['data']->value['created_at']);?>
</td>
                      </tr>
                      <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                      <?php } else { ?>
                      <tr><td class="text-center" colspan="13"><h4>មិនមានព័ត៌មានអំពីផលិតផលទេ។ (There is no product information.)</h4></td></tr>
                      <?php }?>
                    </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--Add Stock Modal -->
  <div class="modal fade" id="showAddModal" tabindex="-1" role="dialog" aria-labelledby="Add Stock" aria-hidden="true">
  <div class="modal-dialog">
      <div class="panel panel-primary modal-content">
          <div class="panel-heading modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="panel-title modal-title"> ស្តុកផលិតផល (Add Quantity of Product Stock)</h3>
          </div>
          <div class="modal-body">
              <!-- The form is placed inside the body of modal -->
            <form class="form" data-toggle="validator" onsubmit='addQuantityProduct(); return false;' id="clone_form" method="post">
              <div class="row">
                <div class="col-md-12" style="margin-bottom:15px">
                  <div class="input-group">
                    <span class="input-group-addon">ចំនួនផលិតផលក្នុងស្តុក (Quantity of Product Stock)</span>
                    <input type="hidden" name="product_id" id="product_id">
                    <input type="text" id="quantity" name="quantity" maxlength="5" class="form-control" placeholder="សូមបញ្ចូលចំនួនផលិតផល" onkeyup="NumAndTwoDecimals(event , this);">
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary">រក្សាទុក (Save)</button>
            </form>
          </div>
      </div>
  </div>
</div>

  <!--Check Stock Modal -->
    <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="Check Stock" aria-hidden="true">
      <div class="modal-dialog">
          <div class="panel panel-primary modal-content">
              <div class="panel-heading modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="panel-title modal-title"> ក្លូនផលិតផល (Clone Product)</h3>
              </div>
              <div class="modal-body">
                  <!-- The form is placed inside the body of modal -->
                <form class="form" data-toggle="validator" onsubmit='cloneProduct(); return false;' id="clone_form" method="post">
                  <div class="row ck_imei">
                    <div class="col-md-12" style="margin-bottom:15px">
                      <div class="input-group">
                        <span class="input-group-addon">លេខ IMEI ផលិតផល (Product IMEI)</span>
                        <input type="hidden" name="product_id" id="product_id">
                        <input type="text" id="phone_imei" name="imei" maxlength="15" class="form-control" placeholder="លេខ IMEI (១៥ ខ្ទង់) (IMEI Number (15 digits))" required onkeyup="NumAndTwoDecimals(event , this);">
                      </div>
                    </div>
                  </div>
                  <div class="row ck_serial">
                    <input type="checkbox" name="check_serial" id="check_id" >
                    <div class="col-md-12" style="margin-bottom:15px">
                      <div class="input-group">
                        <span class="input-group-addon">លេខ Serial ផលិតផល (Product Serial)</span>
                        <input type="text" id="phone_serial" name="imei" maxlength="15" class="form-control" placeholder="លេខ Serial (១៥ ខ្ទង់) (Serial Number (15 digits))" required onkeyup="removeSpace(event , this);">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12" style="margin-bottom:15px">
                      <div class="form-group">
                        <div class="col-md-5" style="margin-top: 10px;"><label>កាត់ស្តុក (Cutting Stock): </label></div>
                          <div class="col-md-7">
                            <div class="checkbox">
                            <label><input type="checkbox" id="is_cutting" name="is_cutting" value="2" <?php if ((($tmp = $_GET['tab'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp) == 2) {?>checked<?php }?>><span style="color:red">( ប្រសិនបើធីក មិនកាត់ចេញពីស្តុកនៅពេលលក់ )</span></label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary">ក្លូន (Clone)</button>
                </form>
              </div>
          </div>
      </div>
    </div>
    <!-- confirmAddStockBox -->
    <div class="modal fade bs-example-modal-sm" id="confirmAddBox" role="dialog">
      <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-center"> ព័ត៌មាន (Information)</h4></div>
          <div class="modal-body text-center">
            <p><strong>ផលិតផលត្រូវបានបន្ថែមចំនួនក្នុងស្តុក ដោយជោគជ័យ! (Product has been update stock successfully!)</strong></p>
          </div>
        </div>
      </div>
    </div>
<!-- confirmAddStockBox -->
	<!-- confirmBox -->
    <div class="modal fade bs-example-modal-sm" id="confirmBox" role="dialog">
      <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-center"> ព័ត៌មាន (Information)</h4></div>
          <div class="modal-body text-center">
            <p><strong>ផលិតផលថ្មីត្រូវបានក្លូនដោយជោគជ័យ! (New product was cloned successfully!)</strong></p>
          </div>
        </div>
      </div>
    </div>
<!-- confirmBox -->
    <div class="modal fade bs-example-modal-sm" id="ExistedImei" role="dialog">
      <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-center"> ព័ត៌មាន (Information)</h4></div>
          <div class="modal-body text-center">
            <p><strong>IMEI ផលិតផលមានរួចហើយ ឬមានបញ្ហា។ (Product imei have existed or have sth problems.)</strong></p>
          </div>
        </div>
      </div>
    </div>
  <?php $_smarty_tpl->_subTemplateRender("file:common/paginate.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
/* {/block "main"} */
/* {block "javascript"} */
class Block_190052063769e1d82571eef8_24892518 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'javascript' => 
  array (
    0 => 'Block_190052063769e1d82571eef8_24892518',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php echo '<script'; ?>
>
		function isNumeric(val) {
			return /^-?\d+$/.test(val);
		}
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

		$(document).ready(function()
		{
			$('#date_from').datetimepicker({
				lang: 'en',
				format: 'Y-m-d',
				timepicker: false
			});
			$('#date_to').datetimepicker({
				lang: 'en',
				format: 'Y-m-d',
				timepicker: false
			});

			$('[data-toggle="tooltip"]').tooltip({
				placement : 'top'
			});

			var sum = 0;
			$('.chk_print').each(function(i, el){
				if(el.checked == true) sum += 1;
			});

			if(sum == 30) $("#chk_print_all").prop("checked", true);

		});

    function addStockModal(product_id, stock) 
		{
			$('#showAddModal').modal('show');
			$('#showAddModal').on('shown.bs.modal', function () {
				$('#quantity').focus();
			})
			$('#product_id').val(product_id);
			$('#showAddModal').on('hidden.bs.modal', function (e) {
			$(this)
				.find("input")
				.val('')
				.end()
			})
		}

    function addQuantityProduct() 
		{
			var product_id = $("#product_id").val();
      var quantity = $("#quantity").val();
      
			if(quantity == '')
			{
				alert("សូមបញ្ចូលចំនួនផលិតផល។ (Please enter quantity of product.)");
				return;
			}

			var param_data = { product_id: product_id, stock: quantity };
			
			jQuery.ajax( {
				type: 'POST',
				url: 'admin.php?task=product&action=increase_stock',
				dataType:'json',
				data: param_data,
				success:function(data){
          if(data.product_id !== null) {
            $("#confirmAddBox").modal('show');
            setTimeout(function(){  $('#confirmAddBox').modal('hide')  }, 2000);
            location.reload();
          }
				},
				error: function(data) {
				  alert('Your process has problem!.');
				}
			} );
		}
		function viewModal(product_id, imei) 
		{
			$("#phone_imei").val('');
			$("#phone_serial").val('');

			if (isNumeric(imei) == true) 
			{
				$("#phone_imei").prop("disabled", false);
				$("#phone_serial").prop("disabled", true);
				
				$('.ck_imei').show();
				$('.ck_serial').hide();
			}else{

				$("#phone_imei").prop("disabled", true);
				$("#phone_serial").prop("disabled", false);

				$('.ck_imei').hide();
				$('.ck_serial').show();
			}

			$('#showModal').modal('show');
			$('#showModal').on('shown.bs.modal', function () {
				$('#phone_imei').focus();
        $('#phone_serial').focus();
			})
			$('#product_id').val(product_id);
			$('#showModal').on('hidden.bs.modal', function (e) {
			$(this)
				.find("input")
				.val('')
				.end()
			})
		}

		function cloneProduct() 
		{
      var is_checked = '';
			var product_id = $("#product_id").val();
      var ischeck = $("#is_cutting").is(':checked');
      if(ischeck){
        var is_checked = 2;
      }
			      
			if($("#phone_serial").val()) {
				var product_imei = $("#phone_serial").val();
			}

			if($("#phone_imei").val()) {
				var product_imei = $("#phone_imei").val();
			}

			if(product_imei == '')
			{
				alert("សូមបញ្ចូល imei។ (Please enter Imei.)");
				return;
			}

			if (isNumeric(product_imei) == true) 
			{
				if(product_imei.length < 15) {
					alert("Imei មិនគ្រប់ ១៥ ខ្ទង់ទេ។ (IMEI Number not equal 15 digits)");
					return;
				}
			}

			var param_data = { product_id: product_id, product_imei: product_imei, is_cutting: is_checked };
			
			jQuery.ajax( {
				type: 'POST',
				url: 'admin.php?task=product&action=clone',
				dataType:'json',
				data: param_data,
				success:function(data){
				if(data.product_id !== null) {
					$("#confirmBox").modal('show');
					setTimeout(function(){  $('#confirmBox').modal('hide')  }, 2000);
					location.reload();
				} else {
					$("#ExistedImei").modal('show');
					setTimeout(function(){  $('#ExistedImei').modal('hide')  }, 2000);
				}

				},
				error: function(data) {
				alert('Your process clone has problem!.');
				}
			} );
		}

		function remove(array, element) {
			const index = array.indexOf(element);
			if (index !== -1) {
				array.splice(index, 1);
			}
		}

		function removeSpace(e , field)
		{
			var val = field.value.replace(/\s/g, "");
			if(val) {
				field.value = val;
			} else {
				field.value = "";
			}
		}

		$(document).on('click','.chk_print',function()
		{
			$('.loader').show();
			var value = this.value;
			var status = 0;
			if(this.checked == true)
			{
				var status = 2;
			} else {
				status = 1;
			}
			var param_data = { product_id: value, status: status };

			$.ajax({
				type: 'POST',
				url: 'admin.php?task=product&action=data_print',
				dataType:'json',
				data: param_data,
				success:function(data)
				{
					var sum = 0;
					$('.chk_print').each(function(i, el){
						if(el.checked == true) sum += 1;
					});
					if(sum == 30)
					{
						$("#chk_print_all").prop("checked", true);
					} else {
						$("#chk_print_all").prop("checked", false);
					}

					$('#total_sel').text(data);
					$('.loader').hide();
				},
					error: function(data) {
					alert('Your process check has problem!.');
				}
			});
		});

		$(document).on('click','#remove_pro',function()
		{
			$('.loader').show();

			var param_data = { status: 3 };

			$.ajax({
				type: 'POST',
				url: 'admin.php?task=product&action=data_print',
				dataType:'json',
				data: param_data,
				success:function(data){
					if(data == 0)
					{
						$(".chk_print").prop("checked", false);
					}
					var sum = 0;
					$('.chk_print').each(function(i, el){
						if(el.checked == true) sum += 1;
					});
					if(sum == 30)
					{
						$("#chk_print_all").prop("checked", true);
					} else {
						$("#chk_print_all").prop("checked", false);
					}

					$('#total_sel').text(data);
					$('.loader').hide();
				},
					error: function(data) {
					alert('Your process remove has problem!.');
				}
			} );
		});

		$(document).on('click','#chk_print_all',function()
		{
			$('.loader').show();
			var product = [];
			var value = this.value;

			$('.chk_print').each(function(i, el){
				var val = $(el).val();
				product.push(val);
			});

			if(this.checked == true)
			{
				var status = 2;
			} else {
				var status = 1;
			}

			var param_data = { status: status,  product_id: JSON.stringify(product) };

			$.ajax({
				type: 'POST',
				url: 'admin.php?task=product&action=data_print_all',
				dataType:'json',
				data: param_data,
				success:function(data){
					if(status == 1)
					{
						$(".chk_print").prop("checked", false);
					} else {
						$(".chk_print").prop("checked", true);
					}
					$('#total_sel').text(data);
					$('.loader').hide();
				},
					error: function(data) {
					alert('Your process select all has problem!.');
				}
			});


		});

		function number_print()
		{
			var num_p = $('#num_print').val();
			$('#href_print').attr('href', '<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=product&action=all_qrcode_print&num_print='+num_p);
		}

		$(document).ready(function(){
					});
	<?php echo '</script'; ?>
>
<?php
}
}
/* {/block "javascript"} */
}
