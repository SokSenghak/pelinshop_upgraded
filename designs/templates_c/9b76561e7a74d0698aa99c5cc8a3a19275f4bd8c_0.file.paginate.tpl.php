<?php
/* Smarty version 4.1.0, created on 2026-04-17 11:58:40
  from '/home/senghak/Documents/pelinshop_php8/pelinshop_upgraded/designs/templates/common/paginate.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.0',
  'unifunc' => 'content_69e1be001af795_26456835',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9b76561e7a74d0698aa99c5cc8a3a19275f4bd8c' => 
    array (
      0 => '/home/senghak/Documents/pelinshop_php8/pelinshop_upgraded/designs/templates/common/paginate.tpl',
      1 => 1776070560,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69e1be001af795_26456835 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/senghak/Documents/pelinshop_php8/pelinshop_upgraded/external_libs/smarty-4.1.0/libs/plugins/function.paginate_prev.php','function'=>'smarty_function_paginate_prev',),1=>array('file'=>'/home/senghak/Documents/pelinshop_php8/pelinshop_upgraded/external_libs/smarty-4.1.0/libs/plugins/function.paginate_first.php','function'=>'smarty_function_paginate_first',),2=>array('file'=>'/home/senghak/Documents/pelinshop_php8/pelinshop_upgraded/external_libs/smarty-4.1.0/libs/plugins/function.paginate_middle.php','function'=>'smarty_function_paginate_middle',),3=>array('file'=>'/home/senghak/Documents/pelinshop_php8/pelinshop_upgraded/external_libs/smarty-4.1.0/libs/plugins/function.paginate_last.php','function'=>'smarty_function_paginate_last',),4=>array('file'=>'/home/senghak/Documents/pelinshop_php8/pelinshop_upgraded/external_libs/smarty-4.1.0/libs/plugins/function.paginate_next.php','function'=>'smarty_function_paginate_next',),));
?>
<div class="col-md-12 text-center">
  <div class="pagination pagination-centered">

  <?php echo smarty_function_paginate_prev(array('text'=>"Previous"),$_smarty_tpl);?>
&nbsp;

  <?php if ($_smarty_tpl->tpl_vars['paginate']->value['total'] > $_smarty_tpl->tpl_vars['paginate']->value['limit']) {?>
    &nbsp;&nbsp;<?php echo smarty_function_paginate_first(array('text'=>"First"),$_smarty_tpl);?>
&nbsp;
  <?php }?>

  <?php if ($_smarty_tpl->tpl_vars['paginate']->value['total'] > $_smarty_tpl->tpl_vars['paginate']->value['limit']) {?>
    <?php echo smarty_function_paginate_middle(array('page_limit'=>"10",'prefix'=>"&nbsp;",'suffix'=>"&nbsp;",'format'=>"page"),$_smarty_tpl);?>

  <?php }?>

  <?php if ($_smarty_tpl->tpl_vars['paginate']->value['total'] > $_smarty_tpl->tpl_vars['paginate']->value['limit']) {?>
    &nbsp;<?php echo smarty_function_paginate_last(array('text'=>"Last"),$_smarty_tpl);?>

  <?php }?>
  &nbsp;&nbsp;<?php echo smarty_function_paginate_next(array('text'=>"Next"),$_smarty_tpl);?>
&nbsp;

  <?php if ($_smarty_tpl->tpl_vars['paginate']->value['total'] > $_smarty_tpl->tpl_vars['paginate']->value['limit']) {?>
    [<?php echo $_smarty_tpl->tpl_vars['paginate']->value['total'];?>
/<?php echo $_smarty_tpl->tpl_vars['paginate']->value['page_total'];?>
 pages]
  <?php }?>

  </div>
</div>

<?php }
}
