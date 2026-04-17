{extends file="admin/layout.tpl"}
{block name="main"}
  <ul class="breadcrumb">
    <li><a href="{$admin_file}">ទំព័រដើម (Home)</a></li>
    <li><a href="{$admin_file}?task=customer">ព័ត៌មានអតិថិជន (Customer Information)</a></li>
    <li class="active">ប្រវត្តិ (History)</li>
  </ul>

  <div class="panel panel-primary">
    <div class="panel-heading">ប្រវត្តិការបញ្ជាទិញអតិថិជន (Customer Order History)</div>
    <div class="panel-body">
      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <th>លេខអត្តសញ្ញាណប័ណ្ណ (Personal ID)</th>
                <th>ឈ្មោះអតិថិជន (Customer Name)</th>
                <th>លេខទូរស័ព្ទ (Phone Number)</th>
                <th>អុីមែល (Email Address)</th>
                <th>អាសយដ្ឋាន (Address)</th>
              </thead>
              <tbody>
                <td><label class="label label-info">{if $list_customer_data.idnumber eq 0} ~ {else}{$list_customer_data.idnumber}{/if}</label></td>
                <td><label class="label label-info">{if $list_customer_data.name}{$list_customer_data.name}{else} ~ {/if}</label></td>
                <td><label class="label label-info">{$list_customer_data.phone}</label></td>
                <td><label class="label label-info">{if $list_customer_data.email eq ''} ~ {else}{$list_customer_data.email}{/if}</label></td>
                <td><label class="label label-info">{if $list_customer_data.address eq ''} ~ {else}{$list_customer_data.address}{/if}</label></td>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="table-responsive">
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <th></th>
              <th class="text-center" width="60px;">សកម្មភាព (Action)</th>
              <th>ឈ្មោះបុគ្គលិក (Staff Name)</th>
              <th>តម្លៃសរុប (Total)</th>
              <th>កាលបរិច្ឆេទបញ្ជាទិញ (Order Date)</th>
            </thead>
            {if $list_order_data|@count gt 0}
            {foreach from=$list_order_data item=data}
            <tbody>
              <tr>
                <td class="text-center">{if $smarty.get.next|default:'' eq 1 OR $smarty.get.next|default:'' eq '' }{counter}{else}{$smarty.foreach.foo.iteration+$smarty.get.next|default:1-1}{/if}</td>
                <td><a data-toggle="tooltip" data-original-title="View Order Information" class="btn btn-success btn-xs" href="{$index_file}?task=order_list&amp;action=view&amp;id={$data.id}">
                  <i class="glyphicon glyphicon-list"></i> លម្អិត (Detail)
                </a></td>
                <td>{$data.staff_name}</td>
                <td>$ {$data.total|number_format:2}</td>
                <td>{$data.created_at}</td>
              </tr>
            </tbody>
            {/foreach}
            {else}
            <tbody>
              <tr>
                <td class="text-center" colspan="4">
                  <h4>There is no customer history.</h4>
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
