<?php
/* Smarty version 4.1.0, created on 2026-04-17 13:11:26
  from '/home/senghak/Documents/pelinshop_php8/pelinshop_upgraded/designs/templates/admin/productTaskHistory.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.0',
  'unifunc' => 'content_69e1cf0e45e5c6_70590707',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a96e377aee18a1daf984e0d42d7895f9bde061f6' => 
    array (
      0 => '/home/senghak/Documents/pelinshop_php8/pelinshop_upgraded/designs/templates/admin/productTaskHistory.tpl',
      1 => 1776406182,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common/paginate.tpl' => 1,
  ),
),false)) {
function content_69e1cf0e45e5c6_70590707 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_145375126369e1cf0e41e4b4_43550344', "main");
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_101076588869e1cf0e45b7b7_07130977', "javascript");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "admin/layout.tpl");
}
/* {block "main"} */
class Block_145375126369e1cf0e41e4b4_43550344 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'main' => 
  array (
    0 => 'Block_145375126369e1cf0e41e4b4_43550344',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/senghak/Documents/pelinshop_php8/pelinshop_upgraded/external_libs/smarty-4.1.0/libs/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>

	<ul class="breadcrumb">
		<li><a href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
">ទំព័រដើម (Home)</a></li>
		<li class="active">ប្រវត្តិផលិផល (Product History)</li>
	</ul>
	<div class="panel panel-primary">
		<div class="panel-heading">
		ប្រវត្តិផលិផល (Product History)
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-12">
					<form role="form" method="get" action="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
" class="form-inline">
						<input type="hidden" name="task" value="product_history">
						<div class="form-group" style="margin-bottom: 5px;">
						<div class="input-group date">
							<input type="text" id="date_from" value ="<?php if ((($tmp = $_GET['from'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp)) {
echo htmlspecialchars((($tmp = $_GET['from'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);
} else {
echo $_smarty_tpl->tpl_vars['from_date']->value;
}?>" class="form-control" name="from" placeholder="ពីកាលបរិច្ឆេទបញ្ជាទិញ (Order Date From)"/>
							<span class="input-group-addon">
							<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>
						</div>
						<div class="form-group" style="margin-bottom: 5px;">
						<div class="input-group date" >
							<input type="text" id="date_to" value ="<?php if ((($tmp = $_GET['to'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp)) {
echo htmlspecialchars((($tmp = $_GET['to'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);
} else {
echo $_smarty_tpl->tpl_vars['to_date']->value;
}?>" class="form-control" name="to" placeholder="ទៅកាលបរិច្ឆេទបញ្ជាទិញ (Order Date To)" />
							<span class="input-group-addon">
							<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>
						</div>
						<div class="form-group" style="margin-bottom: 5px;">
							<button class="btn btn-success" type="submit"><li class="glyphicon glyphicon-search"></li>&nbsp;ស្វែងរក (Search)</button>
							<a href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=product_history&amp;action=print&amp;from=<?php echo htmlspecialchars((($tmp = $_GET['from'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
&amp;to=<?php echo htmlspecialchars((($tmp = $_GET['to'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
" class="btn btn-primary" target="_blank">
								<li class="glyphicon glyphicon-search"></li> បោះពុម្ពរបាយការណ៍ (Print Report)
							</a>
						</div>
					</form>
				</div>
			</div>
      <!-- Nav tabs -->
      <ul class="nav nav-pills" role="tablist">
        <li role="presentation" class="<?php if (!(($tmp = $_GET['tab'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp) || (($tmp = $_GET['tab'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp) == 1) {?> active <?php }?> khmer-first-font"><a href="<?php echo $_smarty_tpl->tpl_vars['admin_file_name']->value;?>
?task=product_history&from=<?php echo htmlspecialchars((($tmp = $_GET['from'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
&to=<?php echo htmlspecialchars((($tmp = $_GET['to'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
&tab=1"><i class="fa fa-line-chart"></i> ព័ត៌មានផលិតផល កាត់ស្តុក</a></li>
        <li role="presentation" class="<?php if ((($tmp = $_GET['tab'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp) && (($tmp = $_GET['tab'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp) == 2) {?> active <?php }?> khmer-first-font"><a href="<?php echo $_smarty_tpl->tpl_vars['admin_file_name']->value;?>
?task=product_history&from=<?php echo htmlspecialchars((($tmp = $_GET['from'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
&to=<?php echo htmlspecialchars((($tmp = $_GET['to'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
&tab=2"><i class="fa fa-flag"></i> ព័ត៌មានផលិតផល មិនកាត់ស្តុក</a></li>
      </ul>
      <!-- Tab panes -->
      <div class="tab-content">
      <div role="tabpanel" class="tab-pane <?php if (!(($tmp = $_GET['tab'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp) || (($tmp = $_GET['tab'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp) == 1) {?> active <?php }?>" id="cutting">
          <hr style="margin-top:5px;margin-bottom:5px;" />
          <div class="table-responsive">
            <table class="table table-bordered table-striped">
              <thead class="table_header">
                <tr>
                  <th>កាលបរិច្ឆេទ (Date)</th>
                  <th>តម្លៃដើម (Cost)</th>
                  <th>ការពិពណ៌នា (Description)</th>
                  <th>សរុប (Total PSC)</th>
                  <th>លក់សរុប (Total Sale)</th>
                  <th>ចំនួននៅសល់ (Amount left)</th>
                </tr>
              </thead>
              <tbody>
              <?php if (count($_smarty_tpl->tpl_vars['list_product_history']->value) > 0) {?>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list_product_history']->value, 'data', false, 'k', 'foo', array (
));
$_smarty_tpl->tpl_vars['data']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['data']->value) {
$_smarty_tpl->tpl_vars['data']->do_else = false;
?>
                <tr>
                  <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['data']->value['created_at']);?>
</td>
                    <td>
              <b>&nbsp;</b>
              <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value['products'], 'v');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
                <?php if ($_SESSION['is_login'] == 'admin') {?>
                  <p> 
                    $ <?php echo number_format($_smarty_tpl->tpl_vars['v']->value['cost'],2);?>

                    <button type="button" class="btn btn-xs btn-info" data-toggle="modal" data-target="#update_cost_<?php echo $_smarty_tpl->tpl_vars['v']->value['imei'];?>
" style="padding: 0px 5px; font-size: 11px;">
                      <i class="glyphicon glyphicon-edit"></i> កែប្រែ (Edit)
                    </button>
                  </p>
                
                  <div class="modal fade" id="update_cost_<?php echo $_smarty_tpl->tpl_vars['v']->value['imei'];?>
" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"> ការបញ្ជាក់ (Confirmation Required)</h4>
                        </div>
                        <form action="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=product_history&amp;action=update_cost" method="post">
                          <div class="modal-body">
                            <p> តើអ្នកប្រាកដថាចង់ផ្លាស់ប្តូរតម្លៃផលិតផលនេះ <label class="label label-info"><?php echo $_smarty_tpl->tpl_vars['v']->value['title'];?>
 / <?php echo $_smarty_tpl->tpl_vars['v']->value['pro_storage'];?>
 / <?php echo $_smarty_tpl->tpl_vars['v']->value['color_name'];?>
 </label> ? </p>
                            <p> Are you sure want to change price this product imei <label class="label label-info"><?php echo $_smarty_tpl->tpl_vars['v']->value['title'];?>
 / <?php echo $_smarty_tpl->tpl_vars['v']->value['pro_storage'];?>
 / <?php echo $_smarty_tpl->tpl_vars['v']->value['color_name'];?>
 </label> ? </p>
                            <input type="hidden" name="storage_id" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['storage_id'];?>
">
                            <input type="hidden" name="color_id" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['color_id'];?>
">
                            <input type="hidden" name="maker_id" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['maker_id'];?>
">
                            <input type="hidden" name="product_title" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['title'];?>
">
                            <input type="hidden" name="company_title" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['company_title'];?>
">
                            <input type="hidden" name="date_from" value ="<?php if ((($tmp = $_GET['from'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp)) {
echo htmlspecialchars((($tmp = $_GET['from'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);
} else {
echo $_smarty_tpl->tpl_vars['from_date']->value;
}?>"/>
                            <input type="hidden" name="date_to" value ="<?php if ((($tmp = $_GET['to'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp)) {
echo htmlspecialchars((($tmp = $_GET['to'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);
} else {
echo $_smarty_tpl->tpl_vars['to_date']->value;
}?>" />
                            <br><br>
                            <div class="form-group">
                              <label for="cost" style="float: left;">តម្លៃដើម (Cost): <span style="color: red;">*</span></label>
                              <input type="text" name="cost" id="cost" class="form-control" placeholder="Ex: 120" value=""/>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-xs btn-default" data-dismiss="modal">បោះបង់ (Cancel) </button>
                            <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-ok"></i> យល់ព្រម (Agree)</a>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <hr style="border-top: 1px solid #959595; margin-top: 10px; margin-bottom: 10px;">
                <?php }?>
              <?php ob_start();
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
$_prefixVariable1 = ob_get_clean();
echo $_prefixVariable1;?>

            </td>
                  <td>
                    <b><u><?php echo $_smarty_tpl->tpl_vars['data']->value['company_title'];?>
</u></b>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value['products'], 'v');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
                      <p><?php echo $_smarty_tpl->tpl_vars['v']->value['title'];?>
 / <?php echo $_smarty_tpl->tpl_vars['v']->value['pro_storage'];?>
 / <?php echo $_smarty_tpl->tpl_vars['v']->value['color_name'];?>
</p>
                      <hr style="border-top: 1px solid #959595; margin-top: 10px; margin-bottom: 10px;">
                    <?php ob_start();
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
$_prefixVariable2 = ob_get_clean();
echo $_prefixVariable2;?>

                  </td>
                  <td>
                    <b>&nbsp;</b>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value['products'], 'v');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
                      <p><?php echo $_smarty_tpl->tpl_vars['v']->value['total_product'];?>
</p>
                      <hr style="border-top: 1px solid #959595; margin-top: 10px; margin-bottom: 10px;">
                    <?php ob_start();
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
$_prefixVariable3 = ob_get_clean();
echo $_prefixVariable3;?>

                  </td>
                  <td>
                    <b>&nbsp;</b>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value['products'], 'v');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
                      <p><?php echo $_smarty_tpl->tpl_vars['v']->value['total_sale'];?>
</p>
                      <hr style="border-top: 1px solid #959595; margin-top: 10px; margin-bottom: 10px;">
                    <?php ob_start();
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
$_prefixVariable4 = ob_get_clean();
echo $_prefixVariable4;?>

                  </td>
                  <td>
                    <b>&nbsp;</b>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value['products'], 'v');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
                      <p><?php echo $_smarty_tpl->tpl_vars['v']->value['total_product']-$_smarty_tpl->tpl_vars['v']->value['total_sale'];?>
</p>
                      <hr style="border-top: 1px solid #959595; margin-top: 10px; margin-bottom: 10px;">
                    <?php ob_start();
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
$_prefixVariable5 = ob_get_clean();
echo $_prefixVariable5;?>

                  </td>
                </tr>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
              <?php } else { ?>
                <tr><td colspan="13"><h4>មិនមានព័ត៌មានអំពីផលិតផលទេ។ (There is no product information.)</h4></td></tr>
              <?php }?>
              </tbody>
            </table>
          </div>
      </div>
    <div role="tabpanel" class="tab-pane <?php if ((($tmp = $_GET['tab'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp) && (($tmp = $_GET['tab'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp) == 2) {?> active <?php }?>" id="no-cutting">
      <hr style="margin-top:5px;margin-bottom:5px;" />
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
          <thead class="table_header">
            <tr>
              <th>កាលបរិច្ឆេទ (Date)</th>
              <th>តម្លៃដើម (Cost)</th>
              <th>ការពិពណ៌នា (Description)</th>
              <th>សរុប (Total PSC)</th>
              <th>លក់សរុប (Total Sale)</th>
              <th>ចំនួននៅសល់ (Amount left)</th>
            </tr>
          </thead>
          <tbody>
          <?php if (count($_smarty_tpl->tpl_vars['list_product_history']->value) > 0) {?>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list_product_history']->value, 'data', false, 'k', 'foo', array (
));
$_smarty_tpl->tpl_vars['data']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['data']->value) {
$_smarty_tpl->tpl_vars['data']->do_else = false;
?>
            <tr>
              <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['data']->value['created_at']);?>
</td>
                <td>
          <b>&nbsp;</b>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value['products'], 'v');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
            <?php if ($_SESSION['is_login'] == 'admin') {?>
              <p> 
                $ <?php echo number_format($_smarty_tpl->tpl_vars['v']->value['cost'],2);?>

                <button type="button" class="btn btn-xs btn-info" data-toggle="modal" data-target="#update_cost_no_cutting_<?php echo $_smarty_tpl->tpl_vars['v']->value['imei'];?>
" style="padding: 0px 5px; font-size: 11px;">
                  <i class="glyphicon glyphicon-edit"></i> កែប្រែ (Edit)
                </button>
              </p>
            
              <div class="modal fade" id="update_cost_no_cutting_<?php echo $_smarty_tpl->tpl_vars['v']->value['imei'];?>
" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"> ការបញ្ជាក់ (Confirmation Required)</h4>
                    </div>
                    <form action="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=product_history&amp;action=update_cost" method="post">
                      <div class="modal-body">
                        <p> តើអ្នកប្រាកដថាចង់ផ្លាស់ប្តូរតម្លៃផលិតផលនេះ <label class="label label-info"><?php echo $_smarty_tpl->tpl_vars['v']->value['title'];?>
 / <?php echo $_smarty_tpl->tpl_vars['v']->value['pro_storage'];?>
 / <?php echo $_smarty_tpl->tpl_vars['v']->value['color_name'];?>
 </label> ? </p>
                        <p> Are you sure want to change price this product imei <label class="label label-info"><?php echo $_smarty_tpl->tpl_vars['v']->value['title'];?>
 / <?php echo $_smarty_tpl->tpl_vars['v']->value['pro_storage'];?>
 / <?php echo $_smarty_tpl->tpl_vars['v']->value['color_name'];?>
 </label> ? </p>
                        <input type="hidden" name="storage_id" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['storage_id'];?>
">
                        <input type="hidden" name="color_id" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['color_id'];?>
">
                        <input type="hidden" name="maker_id" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['maker_id'];?>
">
                        <input type="hidden" name="product_title" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['title'];?>
">
                        <input type="hidden" name="company_title" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['company_title'];?>
">
                        <input type="hidden" name="date_from" value ="<?php if ((($tmp = $_GET['from'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp)) {
echo htmlspecialchars((($tmp = $_GET['from'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);
} else {
echo $_smarty_tpl->tpl_vars['from_date']->value;
}?>"/>
                        <input type="hidden" name="date_to" value ="<?php if ((($tmp = $_GET['to'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp)) {
echo htmlspecialchars((($tmp = $_GET['to'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);
} else {
echo $_smarty_tpl->tpl_vars['to_date']->value;
}?>" />
                        <br><br>
                        <div class="form-group">
                          <label for="cost" style="float: left;">តម្លៃដើម (Cost): <span style="color: red;">*</span></label>
                          <input type="text" name="cost" id="cost" class="form-control" placeholder="Ex: 120" value=""/>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-xs btn-default" data-dismiss="modal">បោះបង់ (Cancel) </button>
                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-ok"></i> យល់ព្រម (Agree)</a>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <hr style="border-top: 1px solid #959595; margin-top: 10px; margin-bottom: 10px;">
            <?php }?>
          <?php ob_start();
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
$_prefixVariable6 = ob_get_clean();
echo $_prefixVariable6;?>

        </td>
              <td>
                <b><u><?php echo $_smarty_tpl->tpl_vars['data']->value['company_title'];?>
</u></b>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value['products'], 'v');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
                  <p><?php echo $_smarty_tpl->tpl_vars['v']->value['title'];?>
 / <?php echo $_smarty_tpl->tpl_vars['v']->value['pro_storage'];?>
 / <?php echo $_smarty_tpl->tpl_vars['v']->value['color_name'];?>
</p>
                  <hr style="border-top: 1px solid #959595; margin-top: 10px; margin-bottom: 10px;">
                <?php ob_start();
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
$_prefixVariable7 = ob_get_clean();
echo $_prefixVariable7;?>

              </td>
              <td>
                <b>&nbsp;</b>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value['products'], 'v');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
                  <p><?php echo $_smarty_tpl->tpl_vars['v']->value['total_stock_increase'];?>
</p>
                  <hr style="border-top: 1px solid #959595; margin-top: 10px; margin-bottom: 10px;">
                <?php ob_start();
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
$_prefixVariable8 = ob_get_clean();
echo $_prefixVariable8;?>

              </td>
              <td>
                <b>&nbsp;</b>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value['products'], 'v');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
                  <p><?php echo $_smarty_tpl->tpl_vars['v']->value['total_stock_decrease'];?>
</p>
                  <hr style="border-top: 1px solid #959595; margin-top: 10px; margin-bottom: 10px;">
                <?php ob_start();
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
$_prefixVariable9 = ob_get_clean();
echo $_prefixVariable9;?>

              </td>
              <td>
                <b>&nbsp;</b>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value['products'], 'v');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
                  <p><?php echo $_smarty_tpl->tpl_vars['v']->value['total_stock_increase']-$_smarty_tpl->tpl_vars['v']->value['total_stock_decrease'];?>
</p>
                  <hr style="border-top: 1px solid #959595; margin-top: 10px; margin-bottom: 10px;">
                <?php ob_start();
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
$_prefixVariable10 = ob_get_clean();
echo $_prefixVariable10;?>

              </td>
            </tr>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
          <?php } else { ?>
            <tr><td colspan="13"><h4>មិនមានព័ត៌មានអំពីផលិតផលទេ។ (There is no product information.)</h4></td></tr>
          <?php }?>
          </tbody>
        </table>
      </div>
  </div>
		</div>
	</div>

  <?php $_smarty_tpl->_subTemplateRender("file:common/paginate.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
/* {/block "main"} */
/* {block "javascript"} */
class Block_101076588869e1cf0e45b7b7_07130977 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'javascript' => 
  array (
    0 => 'Block_101076588869e1cf0e45b7b7_07130977',
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

function viewModal(product_id) {
  $('#showModal').modal('show');
  $('#showModal').on('shown.bs.modal', function () {
    $('#phone_imei').focus()
  })
  $('#product_id').val(product_id);
  $('#showModal').on('hidden.bs.modal', function (e) {
  $(this)
    .find("input")
       .val('')
       .end()
  })
}

function cloneProduct() {
  var product_id = $("#product_id").val();
  var product_imei = $("#phone_imei").val();
  var param_data = { product_id: product_id, product_imei: product_imei };
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
    success:function(data){
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
  } );


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
  } );


});

function number_print()
{
  var num_p = $('#num_print').val();
  $('#href_print').attr('href', '<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=product&action=all_qrcode_print&num_print='+num_p);
}
<?php echo '</script'; ?>
>
<?php
}
}
/* {/block "javascript"} */
}
