<?php
/* Smarty version 4.1.0, created on 2026-04-17 13:16:52
  from '/home/senghak/Documents/pelinshop_php8/pelinshop_upgraded/designs/templates/admin/productTaskHistory_print.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.0',
  'unifunc' => 'content_69e1d054868865_40736304',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd5cdbab29022098bf3b524b196a09d3ee5bd4543' => 
    array (
      0 => '/home/senghak/Documents/pelinshop_php8/pelinshop_upgraded/designs/templates/admin/productTaskHistory_print.tpl',
      1 => 1776070560,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69e1d054868865_40736304 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/senghak/Documents/pelinshop_php8/pelinshop_upgraded/external_libs/smarty-4.1.0/libs/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml" moznomarginboxes mozdisallowselectionprint>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content=""/>
  <meta name="keywords" content="Pelin Phone Shop"/>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="/css/style.css" type="text/css"/>
  <link rel="stylesheet" href="/css/custom.css" type="text/css" />
  <link href='https://fonts.googleapis.com/css?family=Battambang|Bokor|Freehand|Lora' rel='stylesheet' type='text/css'>
  <link href="/fonts/LCALLIG.TTF" rel='stylesheet' type="text/css" />
  <style type="text/css" media="print"></style>
  <title> របាយការណ៍ប្រវត្តិផលិផល (Product History Report)</title>
</head>
<body onload="window.print(); return false;">
<!-- <body> -->
<div class="container">
  <div class="row">
    <div class="col-md-9 nopadding">
      <p class="text-center" id="plp_headerkh">ប៉េលីន ហាងលក់ទូរស័ព្ទដៃ<p>
    </div>
    <div class="col-md-9 nopadding">
      <p class="text-center" id="plp_headeren">Pelin Phone Shop<p>
    </div>
    <div class="col-md-9 nopadding">
      <p id="address">អាស័យដ្ឋានៈ​ ផ្ទះលេខ 118​ ផ្លូវលេខ 230 សង្កាត់ផ្សារដើមគរ ខណ្ឌទួលគោក ភ្នំពេញុ</p>
    </div>
    <div class="col-md-9 nopadding">
      <p id="phone">ទូរសព្ទ័ទំនាក់ទំនង: 097 9999 339 - 092 891 991 - 010 891 991 - 093 77 9999 - 097 777 4449</p>
    </div>
    <div class="col-md-9 nopadding">
      <hr style="margin-bottom:10px;margin-top:0px;border:1px solid;">
    </div>
    <div class="col-md-9 nopadding">
      <p class="text-center" style="font-size:20px;font-weight:bold"> របាយការណ៍ប្រវត្តិផលិផល (Product History Report)</p>
      <p></p>
    </div>

    <div class="col-md-9  nopadding">
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
              <th>កាលបរិច្ឆេទ <br> (Date)</th>
              <th>ការពិពណ៌នា <br> (Description)</th>
              <th width="92">សរុប <br> (Total PSC)</th>
              <th width="94">លក់សរុប <br> (Total Sale)</th>
              <th width="107">ចំនួននៅសល់ <br> (Amount left)</th>
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
$_prefixVariable1 = ob_get_clean();
echo $_prefixVariable1;?>

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
                    <p><?php echo $_smarty_tpl->tpl_vars['v']->value['total_sale'];?>
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
                    <p><?php echo $_smarty_tpl->tpl_vars['v']->value['total_product']-$_smarty_tpl->tpl_vars['v']->value['total_sale'];?>
</p>
                    <hr style="border-top: 1px solid #959595; margin-top: 10px; margin-bottom: 10px;">
                  <?php ob_start();
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
$_prefixVariable4 = ob_get_clean();
echo $_prefixVariable4;?>

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
<?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"><?php echo '</script'; ?>
>

  <?php echo '<script'; ?>
 type="text/javascript">
      $(document).ready(function(){
        window.print();
      });
  <?php echo '</script'; ?>
>

</body>
</html>
<?php }
}
