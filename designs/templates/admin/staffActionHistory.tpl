{extends file="admin/layout.tpl"}
{block name="main"}
  <ul class="breadcrumb">
    <li><a href="{$admin_file}">ទំព័រដើម (Home)</a></li>
    <li><a href="{$admin_file}?task=staff">ព័ត៌មានបុគ្គលិក (Staff Information)</a></li>
    <li class="active">ប្រវត្តិ (History)</li>
  </ul>

  <div class="panel panel-primary">
    <div class="panel-heading">ប្រវត្តិនៃការបញ្ជាទិញដែលបានទទួល (Accepted Order History)</div>
    <div class="panel-body">
      <div class="form-group">
        <p style="font-size:15px;">ឈ្មោះបុគ្គលិក (Staff Name): <label class="label label-success">{$staff.name}</label>
        <p style="font-size:15px;">សាខា (Branch): <label class="label label-success">{$staff.branch_name}</label>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <th class="text-center" valign="top" width="60px;">សកម្មភាព (Action)</th>
            <th>ឈ្មោះបុគ្គលិក (Customer Name)</th>
            <th>សរុបរង (Sub Total)</th>
            <th>បញ្ចុះតម្លៃ (Discount)</th>
            <th>សរុប (Total)</th>
            <th>កាលបរិច្ឆេទបានបញ្ជាទិញ Ordered Date</th>
          </thead>
          {if $list_order_data|@count}
          {foreach from=$list_order_data item=data}
          <tbody>
            <tr>
              <td>
                <a data-toggle="tooltip" data-original-title="View Order Information" class="btn btn-success btn-xs" href="{$index_file}?task=order_list&amp;action=view&amp;id={$data.id}"><i class="glyphicon glyphicon-list"></i> Detail</a>
              </td>
              <td>{$data.customer_name} - {$data.phone}</td>
              <td>$ {$data.subtotal|number_format:2}</td>
              <td>$ {$data.discount|number_format:2}</td>
              <td>$ {$data.total|number_format:2}</td>
              <td>{$data.ordered_at|date_format:"%Y-%m-%d %H:%M"}</td>
            </tr>
          </tbody>
          {/foreach}
          {else}
          <tbody>
            <tr>
              <td class="text-center" colspan="6">
                <h4>មិនមានប្រវត្តិបុគ្គលិកទេ។ (There is no staff history.)</h4>
              </td>
            </tr>
          </tbody>
          {/if}
        </table>
        {include file="common/paginate.tpl"}
      </div>
    </div>
  </div>

{/block}
{block name="javascript"}
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip({
    placement : 'top'
  });
});
</script>
{/block}
