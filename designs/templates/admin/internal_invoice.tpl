{extends file="admin/layout.tpl"}
{block name="main"}
  <ul class="breadcrumb">
    <li><a href="{$admin_file}">ទំព័រដើម Home</a></li>
    <li class="active"> ទឹកប្រាក់នៅជំពាក់ (Money owed)</li>
  </ul>

  <div class="panel panel-primary">
    <div class="panel-heading"><h3 class="panel-title"><i class="glyphicon glyphicon-shopping-cart"></i>&nbsp;ព័ត៌មាននៃបញ្ជី ទឹកប្រាក់នៅជំពាក់ (Money owed list)</div>
    <div class="table-responsive">
      <div class="panel-body">
        <div class="row">
          <div class="col-md-12">
            <form role="form" method="get" action="{$admin_file}" class="form-inline">
              <input type="hidden" name="task" value="internal_invoice">
              <div class="form-group">
                  <select name="customer_id" class="form-control select2">
                      <option value="">ជ្រើសរើសអតិថិជន(Select Customer)</option>
                      {foreach from=$list_customer_name item="customer"}
                        <option value="{$customer.id}" {if $smarty.get.customer_id|default:''|escape eq $customer.id}selected{/if}>{$customer.name} ({$customer.phone})</option>
                      {/foreach}
                  </select>
              </div>
              <div class="form-group">
                <input type="text" value="{$smarty.get.kwd|default:''|escape}" name="kwd" class="form-control" placeholder="ស្វែងរក (Search for...)" autofocus>
                  <button class="btn btn-success" type="submit"><li class="glyphicon glyphicon-search"></li></button>
									<a href="{$admin_file}?task=internal_invoice&amp;action=print" class="btn btn-primary" target="_blank">
											<li class="glyphicon glyphicon-print"></li> បោះពុម្ពរបាយការណ៍ (Print Report)
									</a>
              </div>
            </form>
          </div>
        </div>

        <hr style="margin-top:5px;margin-bottom:5px;" />
        <div class="table-responsive">
			<table class="table table-bordered table-striped table-hover">
				<thead class="table_header">
					<th class="text-center">សកម្មភាព (Action)</th>
					<th>ឈ្មោះអតិថិជន (Customer Name)</th>
					<th>ឈ្មោះបុគ្គលិក (Staff Name)</th>
					<th>ទឹកប្រាក់នៅជំពាក់ (Total)</th>
					{* <th>ចំនួនទឹកប្រាក់បានបង់/Total Split</th>
					<th>ទឹកប្រាក់នៅជំពាក់/Payment Lest</th>
					<th>ដំណើរការបង់ (Progress)</th> *}
				</thead>
				<tbody>
				{if $list_orderlist_data|@count gt 0}
					{foreach from=$list_orderlist_data item=data}
					<tr>
						<td class="text-center" valign="top" width="170px;">
						<span data-toggle="tooltip" title="Split Payment">
							<a href="{$index_file}?task=internal_invoice&amp;action=split_payment&amp;cus_id={$data.customer_id}&amp;int_in_id={$data.id}" class="btn radius-50 btn-primary btn-sm" name="view" value=""><i class="fa fa-plus-circle"></i></a>
						</span>
						</td>
						<td>{if $data.customer_name}{$data.customer_name} ({$data.customer_phone}){else} ~ {/if}</td>
						<td>{$data.staff_name}</td>
						<td>{$data.total_amount|number_format:2}</td>
						{* <td>$ {$data.total_split_invoice|number_format:2}</td>
						<td>$ {$data.total_payment_lest|number_format:2}</td> *}
						{* <td>
							<div class="progress">
								{$percentage = $data.total_split_invoice/$data.sub_total * 100}
								{$progress = $percentage|number_format:2}
								{if $progress lte 50}
									<div class="progress-bar progress-bar-danger split_progress" role="progressbar" data-value="{$progress}" aria-valuemin="0" aria-valuemax="100" style="width: {$progress}%">
									<span style="color: #321321;"> {$progress}%</span>
									</div>
								{else if $progress gte 50 && $progress lte 75 }
									<div class="progress-bar progress-bar-warning split_progress" role="progressbar" data-value="{$progress}" aria-valuemin="0" aria-valuemax="100" style="width: {$progress}%">
									{$progress} %
									</div>
								{else}
									<div class="progress-bar progress-bar-success split_progress" role="progressbar" data-value="{$progress}" aria-valuemin="0" aria-valuemax="100" style="width: {$progress}%">
									{$progress}%
									</div>
								{/if}
							</div>
						</td> *}
					</tr>
					{/foreach}
				{else}
					<tr><td class="text-center" colspan="8"><h4>មិនមានព័ត៌មានបញ្ជីបញ្ជាទិញទេ។ (There is no order list information.)</h4></td></tr>
				{/if}
				</tbody>
			</table>
        </div>
		<div class="pull-right" name="amount" id="amount">
			ទឹកប្រាក់សរុប​ (Amount Total) = {$list_total|number_format:2}
		</div>
      </div>
    </div>
  </div>
  {include file="common/paginate.tpl"}
{/block}
{block name="javascript"}
<script>
$(function () {
  $('#order_date_from').datetimepicker({
    lang: 'en',
    format: 'Y-m-d',
    timepicker: false
  });
  $('#order_date_to').datetimepicker({
    lang: 'en',
    format: 'Y-m-d',
    timepicker: false
  });
});

$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip({
    placement : 'top'
  });

	$('.select2').select2();
});
</script>
{/block}
