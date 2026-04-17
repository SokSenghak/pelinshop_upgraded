{extends file="order/layout.tpl"}
{block name="main"}

	<div class="panel panel-primary">
		<div class="panel-heading">ប្រវត្តិបញ្ជាទិញរបស់អតិថិជន (Customer Order History) </div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-12">
					<form role="form" method="get" action="{$admin_file}" class="form-inline">
						<input type="hidden" name="task" value="history">
						<div class="form-group" style="margin-bottom: 5px;">
							<div class="input-group date">
								<input type="text" id="date_from" value ="{if $smarty.get.from|default:''}{$smarty.get.from|default:''|escape}{else}{$from_date}{/if}" class="form-control" name="from" placeholder="ពីកាលបរិច្ឆេទបញ្ជាទិញ (Order Date From)" autocomplete="off"/>
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
						</div>
						<div class="form-group" style="margin-bottom: 5px;">
							<div class="input-group date" >
								<input type="text" id="date_to" value ="{if $smarty.get.to|default:''}{$smarty.get.to|default:''|escape}{else}{$to_date}{/if}" class="form-control" name="to" placeholder="ទៅកាលបរិច្ឆេទបញ្ជាទិញ (Order Date To)" autocomplete="off"/>
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
						</div>
						<div class="form-group" style="margin-bottom: 5px;">
							<select name="customer_id" class="form-control select2">
								<option value="">ជ្រើសរើសអតិថិជន(Select Customer)</option>
								{foreach from=$list_customer_name item="customer"}
									<option value="{$customer.id}" {if $smarty.get.customer_id|default:''|escape eq $customer.id}selected{/if}>{$customer.name} ({$customer.phone})</option>
								{/foreach}
							</select>
						</div>
						<div class="form-group" style="margin-bottom: 5px;">
							<button class="btn btn-success" type="submit"><li class="glyphicon glyphicon-search"></li>&nbsp;ស្វែងរក (Search)</button>
						</div>
					</form>
				</div>
			</div>
			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover">
					<thead class="table_header">
						<th></th>
						<th class="text-center">សកម្មភាព (Action)</th>
						<th class="text-center">អតិថិជន (Customer)</th>
						<th class="text-center">សរុបរង (Sub Total)($)</th>
						<th class="text-center">បញ្ចុះតម្លៃ (Discount)($) </th>
						<th class="text-center">បានផ្លាស់ប្ដូរពីម៉ូដែល (Changed Model From)</th>
						<th class="text-center">តម្លៃម៉ូដែល (Model Price)</th>
						<th class="text-center">សរុប (Total)($)</th>
						<th class="text-center">កាលបរិច្ឆេទបញ្ជាទិញ (Ordered Date)</th>
					</thead>
					<tbody>
						{if $list_order_data|@count gt 0}
						{foreach from=$list_order_data item=data name=foo}
						<tr {if $smarty.foreach.foo.first}class="active"{/if}>
						<td class="text-center">{if $smarty.get.next|default:'' eq 1 OR $smarty.get.next|default:'' eq '' }{counter}{else}{$smarty.foreach.foo.iteration+$smarty.get.next|default:1-1}{/if}</td>
						<td class="text-center" valign="top" width="140px;">
							{if $data.status eq 1}
							<a data-toggle="tooltip" data-original-title="កែប្រែ(Edit)" class="btn btn-primary btn-xs" href="{if $data.totalNoCutStock gt 0}new_order.php{else}{$index_file}{/if}?task=order&amp;action=edit&amp;id={$data.order_id}">
								<i class="glyphicon glyphicon-pencil"></i> កែប្រែ (Edit)
								</a><br>
							{/if}
							<a data-toggle="tooltip" data-original-title="View Order Information" class="btn btn-success btn-xs" href="{$index_file}?task=order_list&amp;action=view&amp;id={$data.id}">
							<i class="glyphicon glyphicon-list"></i> លម្អិត (Detail)
							</a>
							<a data-toggle="tooltip" data-original-title="print Invoice" class="btn btn-success btn-xs" href="{$index_file}?task=order_list&amp;action=printInvoice&amp;id={$data.id}" target="_blank">
							<i class="glyphicon glyphicon-print"></i> បោះពុម្ភ (Print)
							</a>
							<a data-toggle="tooltip" data-original-title="print Invoice No Imei" class="btn btn-info btn-xs" href="{$index_file}?task=order_list&amp;action=printInvoiceNoIme&amp;id={$data.id}" target="_blank">
							<i class="glyphicon glyphicon-print"></i> បោះពុម្ភដោយគ្មាន imei (Print without imei)
							</a>
						</td>
						<td class="text-center">{if $data.customer_name}{$data.customer_name} ~ {/if}{$data.phone}</td>
						<td class="text-center">$ {$data.subtotal|number_format:2}</td>
						<td class="text-center">$ {$data.discount|number_format:2}</td>
						<td class="text-center">{if $data.changed_model_from}{$data.changed_model_from}{else} ~ {/if}</td>
						<td class="text-center">{if $data.model_price gt 0}$ {$data.model_price|number_format:2}{else} ~ {/if}</td>
						<td class="text-center">$ {$data.r_total|number_format:2}</td>
						<td class="text-center">{$data.ordered_at|date_format:"%Y-%m-%d %H:%M"}</td>
						</tr>
						{/foreach}
						{else}
						<tr><td class="text-center" colspan="9"><h4>There is no information.</h4></td></tr>
						{/if}
					</tbody>
				</table>
				{include file="common/paginate.tpl"}
			</div>
		</div>
	</div>
	
	<script>
		$(function () {
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
		});
		
		$(document).ready(function(){
			$('.select2').select2();
		});
	</script>

{/block}
