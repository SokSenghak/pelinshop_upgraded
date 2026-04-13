<!-- Navbar-->
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="{$admin_file}"><span class="label label-success"> PELIN PHONE </span></a>
		</div>
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" aria-expanded="false">
			<ul class="nav navbar-nav">
				{if $staffPermission.staff || $staffPermission.customer}
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-users fa-lg"></i> Users (សមាជិក)<span class="caret"></span></a>
						<ul class="dropdown-menu">
							{if $staffPermission.staff}
							<li><a href="{$admin_file}?task=staff"><i class="glyphicon glyphicon-user"></i> បុគ្គលិក (Staff)</a></li>
							{/if}
							{if $staffPermission.customer}
								<li><a href="{$admin_file}?task=customer"><i class="glyphicon glyphicon-user"></i> អតិថិជន (Customer)</a></li>
							{/if}
						</ul>
					</li>
				{/if}
				{if $staffPermission.product || $staffPermission.product_history || $staffPermission.product_order || $staffPermission.product_transfer || $staffPermission.product_transfer_history || $staffPermission.product_note}
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-mobile fa-lg"></i> ផលិតផល (Product)<span class="caret"></span></a>
					<ul class="dropdown-menu">
						{if $staffPermission.product}
						<li><a href="{$admin_file}?task=product"><i class="glyphicon glyphicon-phone"></i> បញ្ជីផលិតផល (Product List)</a></li>
						{/if}
						{if $staffPermission.product_history}
						<li><a href="{$admin_file}?task=product_history"><i class="glyphicon glyphicon-phone"></i> ប្រវត្តិផលិផល (Product History)</a></li>
						{/if}
						{if $staffPermission.product_order}
						<li><a href="{$admin_file}?task=product_order"><i class="glyphicon glyphicon-shopping-cart"></i> ការបញ្ជាទិញផលិតផល (Product Order)</a></li>
						{/if}
						{if $staffPermission.product_transfer}
						<li><a href="{$admin_file}?task=product_transfer"><i class="fa fa-tasks" aria-hidden="true"></i> ការផ្ទេរផលិតផល (Product Transfer)</a></li>
						{/if}
						{if $staffPermission.product_transfer_history}
						<li><a href="{$admin_file}?task=product_transfer_history"><i class="fa fa-history" aria-hidden="true"></i> ប្រវត្តិផ្ទេរផលិតផល (Transfer History)</a></li>
						{/if}
						{if $staffPermission.product_note}
						<li><a href="{$admin_file}?task=product_note"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> កត់ត្រាការជួសជុល (Fixed Note)</a></li>
						{/if}
					</ul>
				</li>
				{/if}
				{if $staffPermission.internal_invoice || $staffPermission.order_list || $staffPermission.report || $staffPermission.product_stock || $staffPermission.product_stock || $staffPermission.summary_stock || $staffPermission.summary_product || $staffPermission.summary_product_return}
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-book"></i> របាយការណ៍ (Report)<span class="caret"></span></a>
					<ul class="dropdown-menu">
						{if $staffPermission.internal_invoice}
						<li><a href="{$admin_file}?task=internal_invoice"><i class="glyphicon glyphicon-usd"></i> ទឹកប្រាក់នៅជំពាក់ (Money owed)</a></li>
						{/if}
						{if $staffPermission.order_list}
						<li><a href="{$admin_file}?task=order_list"><i class="glyphicon glyphicon-shopping-cart"></i> បញ្ជីការលក់ (Sale List)</a></li>
						{/if}
						{if $staffPermission.report}
						<li><a href="{$admin_file}?task=report"><i class="glyphicon glyphicon-book"></i> របាយការណ៍លក់ផលិតផល (Product Sale Report)</a></li>
						{/if}
						{if $staffPermission.report_split_payment}
							<li><a href="{$admin_file}?task=report_split_payment"><i class="glyphicon glyphicon-book"></i> របាយការណ៍បង់បណ្ដាក់ (Split Payment Report)</a></li>
						{/if}
						{if $staffPermission.product_stock}
						<li><a href="{$admin_file}?task=product_stock"><i class="glyphicon glyphicon-book"></i> របាយការណ៍ស្តុកផលិតផល (Product Stock Report)</a></li>
						{/if}
						{if $staffPermission.summary_stock}
						<li><a href="{$admin_file}?task=summary_stock"><i class="glyphicon glyphicon-book"></i> របាយការណ៍សង្ខេប (Summary Report)</a></li>
						{/if}
						{if $staffPermission.summary_product}
						<li><a href="{$admin_file}?task=summary_product"><i class="glyphicon glyphicon-book"></i> របាយការណ៍ស្តុកសង្ខេប (Summary Stock Report)</a></li>
						{/if}
						{if $staffPermission.summary_product_return}
						<li><a href="{$admin_file}?task=summary_product_return"><i class="glyphicon glyphicon-book"></i> របាយការណ៍ផ្លាស់ប្ដូរផលិតផល (Summary Return Report)</a></li>
						{/if}
						{if $staffPermission.summary_fixed_product}
							<li><a href="{$admin_file}?task=summary_fixed_product"><i class="glyphicon glyphicon-book"></i> របាយការណ៍ការជួសជុល (Summary Fixed Report)</a></li>
						{/if}
						{if $staffPermission.order_history}
							<li><a href="{$admin_file}?task=order_history"><i class="glyphicon glyphicon-book"></i> ប្រវត្តិបញ្ជាទិញ (Order History)</a></li>
						{/if}
					</ul>
				</li>
				{/if}
			</ul>
			<ul class="nav navbar-nav navbar-right">
				{if $staffPermission.branch || $staffPermission.brand || $staffPermission.product_used || $staffPermission.maker || $staffPermission.color || $staffPermission.storage || $staffPermission.company || $staffPermission.role}
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-cog" style="font-size:17px;"></i> កំណត់ (Setting)<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							{if $staffPermission.branch}
							<li><a href="{$admin_file}?task=branch"><i class="fa fa-building"></i> សាខាផលិតផល (Product Branch)</a></li>
							{/if}
							{if $staffPermission.brand}
							<li><a href="{$admin_file}?task=brand"><i class="glyphicon glyphicon-bookmark"></i> ម៉ាកផលិតផល (Product Brand)</a></li>
							{/if}
							{if $staffPermission.product_used}
							<li><a href="{$admin_file}?task=product_used"><i class="glyphicon glyphicon-book"></i> ផលិតផលមួយតឹក (Product Used)</a></li>
							{/if}
							{if $staffPermission.maker}
							<li><a href="{$admin_file}?task=maker"><i class="glyphicon glyphicon-plane"></i> ក្រុមហ៊ុនផលិត (Product Maker)</a></li>
							{/if}
							{if $staffPermission.product_used}
								<li><a href="{$admin_file}?task=product_title"><i class="glyphicon glyphicon-duplicate"></i> ឈ្មោះផលិតផល (Product Title)</a></li>
							{/if}
							{if $staffPermission.color}
							<li><a href="{$admin_file}?task=color"><i class="glyphicon glyphicon-adjust"></i> ពណ៌ផលិតផល (Product Color)</a></li>
							{/if}
							{if $staffPermission.storage}
							<li><a href="{$admin_file}?task=storage"><i class="glyphicon glyphicon-hdd"></i> ទំហំផ្ទុក (Product Storage)</a></li>
							{/if}
							{if $staffPermission.company}
							<li><a href="{$admin_file}?task=company"><i class="fa fa-bars"></i> ក្រុមហ៊ុន (Company)</a></li>
							{/if}
							{if $staffPermission.role}
							<li><a href="{$admin_file}?task=role"><i class="fa fa-bars"></i> តួនាទី  (Role)</a></li>
							{/if}
							{* <li><a href="{$admin_file}?task=permission"><i class="fa fa-bars"></i>ការអនុញ្ញាតមុខងាប្រើប្រាស់ (Allow function Permission)</a></li> *}
						</ul>
					</li>
				{/if}
				<li><a href="" class="not-active"><span class="label label-default"><i class="glyphicon glyphicon-user"></i> {$smarty.session.is_login}</span></a></li>
				<li><a href="{$admin_file_name}?task=logout"><i class="glyphicon glyphicon-log-out"></i> ចាកចេញ (Logout)</a></li>
			</ul>
		</div>
	</div>
</nav>
