<?php
/* Smarty version 4.1.0, created on 2026-04-17 11:54:04
  from '/home/senghak/Documents/pelinshop_php8/pelinshop_upgraded/designs/templates/admin/menu.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.0',
  'unifunc' => 'content_69e1bcec0be484_85144173',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1a0e349ae79c084d1f639e2b32e542f1fb799652' => 
    array (
      0 => '/home/senghak/Documents/pelinshop_php8/pelinshop_upgraded/designs/templates/admin/menu.tpl',
      1 => 1776070560,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69e1bcec0be484_85144173 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- Navbar-->
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
"><span class="label label-success"> PELIN PHONE </span></a>
		</div>
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" aria-expanded="false">
			<ul class="nav navbar-nav">
				<?php if ($_smarty_tpl->tpl_vars['staffPermission']->value['staff'] || $_smarty_tpl->tpl_vars['staffPermission']->value['customer']) {?>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-users fa-lg"></i> Users (សមាជិក)<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<?php if ($_smarty_tpl->tpl_vars['staffPermission']->value['staff']) {?>
							<li><a href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=staff"><i class="glyphicon glyphicon-user"></i> បុគ្គលិក (Staff)</a></li>
							<?php }?>
							<?php if ($_smarty_tpl->tpl_vars['staffPermission']->value['customer']) {?>
								<li><a href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=customer"><i class="glyphicon glyphicon-user"></i> អតិថិជន (Customer)</a></li>
							<?php }?>
						</ul>
					</li>
				<?php }?>
				<?php if ($_smarty_tpl->tpl_vars['staffPermission']->value['product'] || $_smarty_tpl->tpl_vars['staffPermission']->value['product_history'] || $_smarty_tpl->tpl_vars['staffPermission']->value['product_order'] || $_smarty_tpl->tpl_vars['staffPermission']->value['product_transfer'] || $_smarty_tpl->tpl_vars['staffPermission']->value['product_transfer_history'] || $_smarty_tpl->tpl_vars['staffPermission']->value['product_note']) {?>
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-mobile fa-lg"></i> ផលិតផល (Product)<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<?php if ($_smarty_tpl->tpl_vars['staffPermission']->value['product']) {?>
						<li><a href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=product"><i class="glyphicon glyphicon-phone"></i> បញ្ជីផលិតផល (Product List)</a></li>
						<?php }?>
						<?php if ($_smarty_tpl->tpl_vars['staffPermission']->value['product_history']) {?>
						<li><a href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=product_history"><i class="glyphicon glyphicon-phone"></i> ប្រវត្តិផលិផល (Product History)</a></li>
						<?php }?>
						<?php if ($_smarty_tpl->tpl_vars['staffPermission']->value['product_order']) {?>
						<li><a href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=product_order"><i class="glyphicon glyphicon-shopping-cart"></i> ការបញ្ជាទិញផលិតផល (Product Order)</a></li>
						<?php }?>
						<?php if ($_smarty_tpl->tpl_vars['staffPermission']->value['product_transfer']) {?>
						<li><a href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=product_transfer"><i class="fa fa-tasks" aria-hidden="true"></i> ការផ្ទេរផលិតផល (Product Transfer)</a></li>
						<?php }?>
						<?php if ($_smarty_tpl->tpl_vars['staffPermission']->value['product_transfer_history']) {?>
						<li><a href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=product_transfer_history"><i class="fa fa-history" aria-hidden="true"></i> ប្រវត្តិផ្ទេរផលិតផល (Transfer History)</a></li>
						<?php }?>
						<?php if ($_smarty_tpl->tpl_vars['staffPermission']->value['product_note']) {?>
						<li><a href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=product_note"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> កត់ត្រាការជួសជុល (Fixed Note)</a></li>
						<?php }?>
					</ul>
				</li>
				<?php }?>
				<?php if ($_smarty_tpl->tpl_vars['staffPermission']->value['internal_invoice'] || $_smarty_tpl->tpl_vars['staffPermission']->value['order_list'] || $_smarty_tpl->tpl_vars['staffPermission']->value['report'] || $_smarty_tpl->tpl_vars['staffPermission']->value['product_stock'] || $_smarty_tpl->tpl_vars['staffPermission']->value['product_stock'] || $_smarty_tpl->tpl_vars['staffPermission']->value['summary_stock'] || $_smarty_tpl->tpl_vars['staffPermission']->value['summary_product'] || $_smarty_tpl->tpl_vars['staffPermission']->value['summary_product_return']) {?>
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-book"></i> របាយការណ៍ (Report)<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<?php if ($_smarty_tpl->tpl_vars['staffPermission']->value['internal_invoice']) {?>
						<li><a href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=internal_invoice"><i class="glyphicon glyphicon-usd"></i> ទឹកប្រាក់នៅជំពាក់ (Money owed)</a></li>
						<?php }?>
						<?php if ($_smarty_tpl->tpl_vars['staffPermission']->value['order_list']) {?>
						<li><a href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=order_list"><i class="glyphicon glyphicon-shopping-cart"></i> បញ្ជីការលក់ (Sale List)</a></li>
						<?php }?>
						<?php if ($_smarty_tpl->tpl_vars['staffPermission']->value['report']) {?>
						<li><a href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=report"><i class="glyphicon glyphicon-book"></i> របាយការណ៍លក់ផលិតផល (Product Sale Report)</a></li>
						<?php }?>
						<?php if ($_smarty_tpl->tpl_vars['staffPermission']->value['report_split_payment']) {?>
							<li><a href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=report_split_payment"><i class="glyphicon glyphicon-book"></i> របាយការណ៍បង់បណ្ដាក់ (Split Payment Report)</a></li>
						<?php }?>
						<?php if ($_smarty_tpl->tpl_vars['staffPermission']->value['product_stock']) {?>
						<li><a href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=product_stock"><i class="glyphicon glyphicon-book"></i> របាយការណ៍ស្តុកផលិតផល (Product Stock Report)</a></li>
						<?php }?>
						<?php if ($_smarty_tpl->tpl_vars['staffPermission']->value['summary_stock']) {?>
						<li><a href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=summary_stock"><i class="glyphicon glyphicon-book"></i> របាយការណ៍សង្ខេប (Summary Report)</a></li>
						<?php }?>
						<?php if ($_smarty_tpl->tpl_vars['staffPermission']->value['summary_product']) {?>
						<li><a href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=summary_product"><i class="glyphicon glyphicon-book"></i> របាយការណ៍ស្តុកសង្ខេប (Summary Stock Report)</a></li>
						<?php }?>
						<?php if ($_smarty_tpl->tpl_vars['staffPermission']->value['summary_product_return']) {?>
						<li><a href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=summary_product_return"><i class="glyphicon glyphicon-book"></i> របាយការណ៍ផ្លាស់ប្ដូរផលិតផល (Summary Return Report)</a></li>
						<?php }?>
						<?php if ($_smarty_tpl->tpl_vars['staffPermission']->value['summary_fixed_product']) {?>
							<li><a href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=summary_fixed_product"><i class="glyphicon glyphicon-book"></i> របាយការណ៍ការជួសជុល (Summary Fixed Report)</a></li>
						<?php }?>
						<?php if ($_smarty_tpl->tpl_vars['staffPermission']->value['order_history']) {?>
							<li><a href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=order_history"><i class="glyphicon glyphicon-book"></i> ប្រវត្តិបញ្ជាទិញ (Order History)</a></li>
						<?php }?>
					</ul>
				</li>
				<?php }?>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<?php if ($_smarty_tpl->tpl_vars['staffPermission']->value['branch'] || $_smarty_tpl->tpl_vars['staffPermission']->value['brand'] || $_smarty_tpl->tpl_vars['staffPermission']->value['product_used'] || $_smarty_tpl->tpl_vars['staffPermission']->value['maker'] || $_smarty_tpl->tpl_vars['staffPermission']->value['color'] || $_smarty_tpl->tpl_vars['staffPermission']->value['storage'] || $_smarty_tpl->tpl_vars['staffPermission']->value['company'] || $_smarty_tpl->tpl_vars['staffPermission']->value['role']) {?>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-cog" style="font-size:17px;"></i> កំណត់ (Setting)<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<?php if ($_smarty_tpl->tpl_vars['staffPermission']->value['branch']) {?>
							<li><a href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=branch"><i class="fa fa-building"></i> សាខាផលិតផល (Product Branch)</a></li>
							<?php }?>
							<?php if ($_smarty_tpl->tpl_vars['staffPermission']->value['brand']) {?>
							<li><a href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=brand"><i class="glyphicon glyphicon-bookmark"></i> ម៉ាកផលិតផល (Product Brand)</a></li>
							<?php }?>
							<?php if ($_smarty_tpl->tpl_vars['staffPermission']->value['product_used']) {?>
							<li><a href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=product_used"><i class="glyphicon glyphicon-book"></i> ផលិតផលមួយតឹក (Product Used)</a></li>
							<?php }?>
							<?php if ($_smarty_tpl->tpl_vars['staffPermission']->value['maker']) {?>
							<li><a href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=maker"><i class="glyphicon glyphicon-plane"></i> ក្រុមហ៊ុនផលិត (Product Maker)</a></li>
							<?php }?>
							<?php if ($_smarty_tpl->tpl_vars['staffPermission']->value['product_used']) {?>
								<li><a href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=product_title"><i class="glyphicon glyphicon-duplicate"></i> ឈ្មោះផលិតផល (Product Title)</a></li>
							<?php }?>
							<?php if ($_smarty_tpl->tpl_vars['staffPermission']->value['color']) {?>
							<li><a href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=color"><i class="glyphicon glyphicon-adjust"></i> ពណ៌ផលិតផល (Product Color)</a></li>
							<?php }?>
							<?php if ($_smarty_tpl->tpl_vars['staffPermission']->value['storage']) {?>
							<li><a href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=storage"><i class="glyphicon glyphicon-hdd"></i> ទំហំផ្ទុក (Product Storage)</a></li>
							<?php }?>
							<?php if ($_smarty_tpl->tpl_vars['staffPermission']->value['company']) {?>
							<li><a href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=company"><i class="fa fa-bars"></i> ក្រុមហ៊ុន (Company)</a></li>
							<?php }?>
							<?php if ($_smarty_tpl->tpl_vars['staffPermission']->value['role']) {?>
							<li><a href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
?task=role"><i class="fa fa-bars"></i> តួនាទី  (Role)</a></li>
							<?php }?>
													</ul>
					</li>
				<?php }?>
				<li><a href="" class="not-active"><span class="label label-default"><i class="glyphicon glyphicon-user"></i> <?php echo $_SESSION['is_login'];?>
</span></a></li>
				<li><a href="<?php echo $_smarty_tpl->tpl_vars['admin_file_name']->value;?>
?task=logout"><i class="glyphicon glyphicon-log-out"></i> ចាកចេញ (Logout)</a></li>
			</ul>
		</div>
	</div>
</nav>
<?php }
}
