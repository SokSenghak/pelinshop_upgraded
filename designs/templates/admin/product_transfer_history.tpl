{extends file="admin/layout.tpl"}
{block name="main"}

<ul class="breadcrumb">
	<li><a href="{$admin_file}">ទំព័រដើម (Home)</a></li>
	<li class="active">ការផ្ទេរផលិតផលសម្រាប់ការបោះពុម្ព (Product Transfer For printing)</li>
</ul>

<div class="panel panel-primary">
  <div class="panel-heading"><h3 class="panel-title">ការផ្ទេរផលិតផល (Product Transfer)</h3></div>
  <div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<form role="form" method="get" action="{$admin_file}?task=product_transfer_history" class="form-inline">
					<input type="hidden" name="task" value="product_transfer_history">

					<div class="form-group">
						<div class="input-group">
						  <span class="input-group-addon"><label style="margin-bottom: 0;">សាខា (Branch) : </label></span>
							<select name="branch_id" class="form-control">
							<option value="">---ជ្រើសរើសឈ្មោះសាខា (Select Branch Name)---</option>
							{foreach from=$list_branch item=branch}
								<option value="{$branch.id}" {if $smarty.get.branch_id eq $branch.id}selected{/if}>{$branch.name}</option>
							{/foreach}
							</select>
							<span class="input-group-btn">
								<button class="btn btn-success" type="submit"><li class="glyphicon glyphicon-search"></li>&nbsp;ស្វែងរក (Search)</button>
							</span>
						</div>
					</div>
				</form>
			</div>
		</div>
		<hr style="margin-top:5px;margin-bottom:5px;" />
    <div class="table-responsive">
    	<table class="table table-bordered table-striped table-hover">
    	  <thead class="table_header">
    	  	<tr>
    	  		<th></th>
						<th class="text-center">សាខា (Branch)</th>
						<th class="text-center">ចំនួន (Qty)</th>
						<th class="text-center">កាលបរិច្ឆេទផ្ទេរ (Transfered Date)</th>
						<th class="text-center">សកម្មភាព (Action)</th>
    	  	</tr>
    	  </thead>
				<tbody>
					{if $product_transfer_data|@count gt 0}
					{foreach from=$product_transfer_data item=data name=foo}
					<tr {if $smarty.foreach.foo.first}class="active"{/if}>
						<td class="text-center">{if $smarty.get.next eq 1 OR $smarty.get.next eq '' }{counter}{else}{$smarty.foreach.foo.iteration+$smarty.get.next-1}{/if}</td>
						<td class="text-center">{$data.branch_name}</td>
						<td class="text-center"><i class="fa fa-mobile fa-lg"></i>&nbsp;{$data.qty}</td>
						<td class="text-center">{$data.transfered_date}</td>
						<td class="text-center" valign="top" width="150px;">
							<a class="btn btn-xs btn-primary" href="{$admin_file}?task=product_transfer_history&amp;action=detail&amp;id={$data.unique_key}" data-toggle="tooltip" title="View Report">
								<i class="fa fa-th-list"></i>&nbsp;លម្អិត (Detail)
							</a>
							<a class="btn btn-xs btn-primary" href="{$admin_file}?task=product_transfer_history&amp;action=print&amp;id={$data.unique_key}" data-toggle="tooltip" title="Print Report">
								<i class="fa fa-print"></i>&nbsp;បោះពុម្ព (Print)
							</a>
						</td>
					</tr>
					{/foreach}
					{else}
					<tr><td class="text-center" colspan="5"><h4>There is no information.</h4></td></tr>
					{/if}
				</tbody>
    	</table>
    </div>
  </div>
</div>
{include file="common/paginate.tpl"}
{/block}
