<?php
/* Smarty version 4.1.0, created on 2026-04-17 11:54:04
  from '/home/senghak/Documents/pelinshop_php8/pelinshop_upgraded/designs/templates/admin/layout.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.0',
  'unifunc' => 'content_69e1bcec0aa1a9_29857783',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '07959460581fda5ee892a2fa6501079a75f56fce' => 
    array (
      0 => '/home/senghak/Documents/pelinshop_php8/pelinshop_upgraded/designs/templates/admin/layout.tpl',
      1 => 1776070560,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:admin/menu.tpl' => 1,
    'file:common/footer.tpl' => 1,
  ),
),false)) {
function content_69e1bcec0aa1a9_29857783 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
<!DOCTYPE html>
<html xmlns="https://www.w3.org/1999/xhtml" xml:lang="en" lang="en" xmlns:og="https://ogp.me/ns#" xmlns:fb="https://www.facebook.com/2008/fbml">
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
    <?php echo '<script'; ?>
 type="text/javascript" src="/js/jquery-ui.min.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="/js/jquery.appendGrid-1.6.0.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="/js/bootstrap-maxlength.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="/js/jquery.datetimepicker.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="/js/lightbox.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="js/kjua-0.1.1.min.js"><?php echo '</script'; ?>
>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/ui-lightness/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="/css/jquery-ui.theme.min.css" />
  <link rel="stylesheet" href="https://code.jquery.com/qunit/qunit-1.18.0.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css">
  <link rel="stylesheet" href="/css/style.css" type="text/css"/>
  <link rel="stylesheet" type="text/css" href="/css/jquery.datetimepicker.css">
  <link rel="stylesheet" type="text/css" href="/css/lightbox.css" >
  <link rel="stylesheet" type="text/css" href="/css/jquery.appendGrid-1.6.0.css" >
  <link rel="stylesheet" type="text/css" href="/css/switch.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Battambang&family=Hanuman&family=Siemreap&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <!-- <title>PELIN PHONE-ADMIN<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_159319405769e1bcec0a8355_33771658', "title");
?>
</title> -->
  <title>ADMIN<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_43585862269e1bcec0a89d8_36350024', "title");
?>
</title>
</head>
<?php echo '<script'; ?>
>
    $(document).ready(function(){
        $(window).load(function() { $(".loader").fadeOut("slow"); });
    });

<?php echo '</script'; ?>
>
<body>
<?php $_smarty_tpl->_subTemplateRender("file:admin/menu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_84746261969e1bcec0a9489_91718487', "main");
?>

    </div>
  </div>
  <hr />
  <div class="loader"></div>
  <?php $_smarty_tpl->_subTemplateRender("file:common/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
</div>
<!-- <?php echo '<script'; ?>
 src="/js/switch.js"><?php echo '</script'; ?>
> -->
<?php echo '<script'; ?>
 src="/js/moment.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"><?php echo '</script'; ?>
>
<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_8258436869e1bcec0a9ca4_07307830', "javascript");
?>

</body>
</html>
<?php }
/* {block "title"} */
class Block_159319405769e1bcec0a8355_33771658 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'title' => 
  array (
    0 => 'Block_159319405769e1bcec0a8355_33771658',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block "title"} */
/* {block "title"} */
class Block_43585862269e1bcec0a89d8_36350024 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'title' => 
  array (
    0 => 'Block_43585862269e1bcec0a89d8_36350024',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block "title"} */
/* {block "main"} */
class Block_84746261969e1bcec0a9489_91718487 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'main' => 
  array (
    0 => 'Block_84746261969e1bcec0a9489_91718487',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <?php
}
}
/* {/block "main"} */
/* {block "javascript"} */
class Block_8258436869e1bcec0a9ca4_07307830 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'javascript' => 
  array (
    0 => 'Block_8258436869e1bcec0a9ca4_07307830',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


<?php
}
}
/* {/block "javascript"} */
}
