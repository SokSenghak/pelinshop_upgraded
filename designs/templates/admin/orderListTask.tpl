{extends file="admin/layout.tpl"}
{block name="main"}
  <ul class="breadcrumb">
    <li><a href="{$admin_file}">ទំព័រដើម Home</a></li>
    <li class="active">ព័ត៌មាននៃបញ្ជីលក់ (Information of Sale List)</li>
  </ul>

  <div class="panel panel-primary">
    <div class="panel-heading"><h3 class="panel-title"><i class="glyphicon glyphicon-shopping-cart"></i>&nbsp;ព័ត៌មាននៃបញ្ជីលក់ (Information of Sale List) (តម្លៃលក់ (Sale) = $ {$sale.total_price}, តម្លៃដើម (Cost) = $ {$sale.total_cost}, ប្រាក់ចំនេញ (Income) = $ {$sale.income})</div>
    <div class="table-responsive">
      <div class="panel-body">
        <div class="row">
          <div class="col-md-12">
            <form role="form" method="get" action="{$admin_file}?task=order_list" class="form-inline">
              <input type="hidden" name="task" value="order_list">
              <div class="form-group">
                <div class="input-group date">
                  <input type="text" id="order_date_from" value ="{$smarty.get.from|escape}" class="form-control" name="from" placeholder="កាលបរិច្ឆេទបញ្ជាទិញពី (Order Date From)"/>
                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </span>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group date" >
                  <input type="text" id="order_date_to" value ="{$smarty.get.to|escape}" class="form-control" name="to" placeholder="ទៅកាលបរិច្ឆេទបញ្ជាទិញ (Order Date To)" />
                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </span>
                </div>
              </div>
              <div class="form-group">
                  <select name="branch" class="form-control">
                      <option value="">ជ្រើសរើសសាខា (Select Branch)</option>
                    {foreach from=$list_branch_name item="branch"}
                      <option value="{$branch.id}" {if $smarty.get.branch|escape eq $branch.id}selected{/if}>{$branch.name}</option>
                    {/foreach}
                  </select>
              </div>
              <div class="input-group">
                <input type="text" value="{$smarty.get.kwd|escape}" name="kwd" class="form-control" placeholder="ស្វែងរក (Search for...)" autofocus>
                <span class="input-group-btn">
                  <button class="btn btn-success" type="submit"><li class="glyphicon glyphicon-search"></li></button>
                </span>
              </div>
            </form>
          </div>
        </div>

        <hr style="margin-top:5px;margin-bottom:5px;" />
        <table class="table table-bordered table-striped table-hover">
          <thead class="table_header">
            <th class="text-center">សកម្មភាព (Action)</th>
            <th>ឈ្មោះអតិថិជន (Customer Name)</th>
            <th>ឈ្មោះបុគ្គលិក (Staff Name)</th>
            <th>សាខា (Branch)</th>
            <th>សរុបរង (Sub Total)</th>
            <th>បញ្ចុះតម្លៃ (Discount)</th>
            <th>ម៉ូដែលបានផ្លាស់ប្តូរ (Changed Model)</th>
            <th>តម្លៃម៉ូដែល (Model Price)</th>
            <th>សរុប (Total)</th>
            <th>កាលបរិច្ឆេទលក់ (Date Of Sale)</th>
          </thead>
          <tbody>
          {if $list_orderlist_data|@count gt 0}
          {foreach from=$list_orderlist_data item=data}
            <tr>
              <td class="text-center" valign="top" width="100px;">
                <a data-toggle="tooltip" data-original-title="View Order Information" class="btn btn-success btn-xs" href="{$index_file}?task=order_list&amp;action=view&amp;id={$data.id}">
                  <i class="glyphicon glyphicon-list"></i>
                </a>
                <a data-toggle="tooltip" data-original-title="View Customer Information" class="btn btn-primary btn-xs" href="{$index_file}?task=customer&amp;action=history&amp;id={$data.customer_id}">
                  <i class="glyphicon glyphicon-user"></i>
                </a>
                <a data-toggle="tooltip" data-original-title="View Staff Information" class="btn btn-primary btn-xs" href="{$index_file}?task=staff&amp;action=history&amp;id={$data.staff_id}">
                  <i class="glyphicon glyphicon-user"></i>
                </a>
              </td>
              <td>{if $data.customer_name}{$data.customer_name}{else} ~ {/if}</td>
              <td>{$data.staff_name}</td>
              <td>{$data.branch_name}</td>
              <td>$ {$data.subtotal|number_format:2}</td>
              <td>$ {$data.discount|number_format:2}</td>
              <td>{if $data.changed_model_from}{$data.changed_model_from}{else} ~ {/if}</td>
              <td>{if $data.model_price}$ {$data.model_price|number_format:2}{else} ~ {/if}</td>
              <td>$ {$data.total|number_format:2}</td>
              <td>{$data.ordered_at|date_format:'%Y-%m-%d'}</td>
            </tr>
          {/foreach}
            {else}
              <tr><td class="text-center" colspan="8"><h4>មិនមានព័ត៌មានបញ្ជីបញ្ជាទិញទេ។ (There is no order list information.)</h4></td></tr>
            {/if}
          </tbody>
        </table>
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
});
</script>
{/block}
