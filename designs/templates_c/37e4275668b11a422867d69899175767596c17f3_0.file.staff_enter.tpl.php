<?php
/* Smarty version 4.1.0, created on 2026-04-17 11:36:48
  from '/home/senghak/Documents/pelinshop_php8/pelinshop_upgraded/designs/templates/order/staff_enter.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.0',
  'unifunc' => 'content_69e1b8e08d4629_05316641',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '37e4275668b11a422867d69899175767596c17f3' => 
    array (
      0 => '/home/senghak/Documents/pelinshop_php8/pelinshop_upgraded/designs/templates/order/staff_enter.tpl',
      1 => 1776070560,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common/footer.tpl' => 1,
  ),
),false)) {
function content_69e1b8e08d4629_05316641 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content=""/>
  <meta name="keywords" content="Pelin Phone Shop"/>
  <?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"><?php echo '</script'; ?>
>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <link href='https://fonts.googleapis.com/css?family=Battambang|Bokor|Freehand|Lora' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="/css/style.css" type="text/css"/>

  <title>ទំព័របញ្ជាទិញ (Order Page)</title>
</head>
<body>
<div class="container">
  <div class="row">
    <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
      <ul class="breadcrumb">
        <li><a href="#"><span class="label label-success">PELIN PHONE</span></a></li>
        <li class="active">បុគ្គលិក (Staff)</li>
      </ul>

      <?php if ($_smarty_tpl->tpl_vars['error']->value) {?>
        <div class="alert alert-danger" data-dismiss="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <?php if ($_smarty_tpl->tpl_vars['error']->value['id'] == 1) {?> សូមបញ្ចូលអត្ត ID របស់អ្នក។ (Please enter your ID.) <br/> <?php }?>
          <?php if ($_smarty_tpl->tpl_vars['error']->value['password'] == 1) {?> សូម​បញ្ចូល​ពាក្យ​សម្ងាត់​របស់​អ្នក។ (Please enter your password.) <br/> <?php }?>
          <?php if ($_smarty_tpl->tpl_vars['error']->value['stopped'] == 1) {?> បុគ្គលិកនេះមិនត្រូវបានអនុញ្ញាតឱ្យពិនិត្យចូលទេ។ (This staff was not allowed to log in.) <br /><?php }?>
          <?php if ($_smarty_tpl->tpl_vars['error']->value['login'] == 1) {?> ការពិនិត្យចូលត្រូវបានបដិសេធ។ (Login Denied.) <br /> <?php }?>
        </div>
      <?php }?>
      <div class="panel panel-success">
        <div class="panel-heading"><h4 class="panel-title text-center">ទម្រង់បុគ្គលិកពិនិត្យចូល (Staff Login Form)</h4></div>
        <div class="panel-body">
          <h4 class="text-center"> សូមបំពេញ ID និងពាក្យសម្ងាត់របស់អ្នក។ (Please fill your ID and password.)</h4>
          <form action="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=login" method="post">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" id="sizing-addon1">@</span>
                <input type="text" class="form-control" placeholder="ID" aria-describedby="sizing-addon1" name="id" autofocus>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input id="password" type="password" class="form-control" name="password" placeholder="ពាក្យសម្ងាត់ (Password)">
              </div>
            </div>
            <div class="form-group">
              <div class="btn-group" role="group">
                <button type="submit" class="btn btn-success"><i class="fa fa-sign-in"></i> ពិនិត្យចូល (Login)</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <?php $_smarty_tpl->_subTemplateRender("file:common/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    </div>
  </div>
</div>
</body>
</html>
<?php }
}
