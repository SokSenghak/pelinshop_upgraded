{extends file="admin/layout.tpl"}
{block name="main"}
{if $smarty.session.is_login eq 'admin'}
  <div class="panel panel-primary">
    <div class="panel-heading"><h3 class="panel-title"><i class="glyphicon glyphicon-user"></i>&nbsp;ព័ត៌មានបុគ្គលិក (Staff Information)</h3> </div>
    <div class="table-responsive">
      <table class="table table-bordered table-striped table-hover">
        <thead class="table_header">
          <tr>
            <!-- <th class="text-center">Action</th> -->
            <th>ឈ្មោះបុគ្គលិក (Staff Name)</th>
            <th class="text-center">ស្ថានភាព (Status)</th>
            <th>សាខា (Branch)</th>
          </tr>
        </thead>
        <tbody>
        {if $list_staff_data|@count gt 0}
        {foreach from=$list_staff_data item=data}
          <tr>
            <!-- <td class="text-center" valign="top" width="105px;">
              <a data-toggle="tooltip" data-original-title="View Staff History" class="btn btn-xs btn-success" href="{$admin_file}?task=staff&amp;action=history&amp;id={$data.id}">
                <i class="glyphicon glyphicon-list"></i> History
              </a>
            </td> -->
            <td>{$data.name}</td>
            <td class="text-center">{if $data.is_quited eq 0}<label class="label label-info">ធ្វើការ (Working)</label>{else}<label class="label label-danger">ឈប់ធ្វើការ (Stopped)</label>{/if}</td>
            <td>{$data.branch_name} </td>
          </tr>
        {/foreach}
        {else}
          <tr><td class="text-center" colspan="3"><h4>មិនមានទិន្នន័យបុគ្គលិក។ (There is no staff information.)</h4></td></tr>
        {/if}
        </tbody>
      </table>
    </div>
  </div>
{/if}
  {*Product information*}
  <div class="panel panel-primary">
    <div class="panel-heading"><h3 class="panel-title">&nbsp;ផលិតផលថ្មីៗ (Latest Product)</h3></div>
    <div class="table-responsive">
      <table class="table table-bordered table-striped table-hover">
        <thead class="table_header">
          <tr>
            <th>លេខ IMEI (IMEI Number)</th>
            <th>ឈ្មោះផលិតផល (Product Title)</th>
            <th>ក្រុមហ៊ុនផលិត (Product Maker)</th>
            <th>ម៉ាកផលិតផល (Product Brand)</th>
          </tr>
        </thead>
        <tbody>
        {if $list_product_data|@count gt 0}
        {foreach from=$list_product_data item=data}
          <tr>
            <td>{$data.imei}</td>
            <td>{$data.title}
              {if $data.color_name}-{$data.color_name}{/if}
              {if $data.storage_name}-{$data.storage_name}{/if}</td>
            <td>{$data.maker_name}</td>
            <td>{$data.brand_name}</td>
          </tr>
        {/foreach}
        {else}
          <tr><td class="text-center" colspan="4"><h4>មិនមានទិន្នន័យផលិតផល។ (There is no product information.)</h4></td></tr>
        {/if}
        </tbody>
      </table>
    </div>
  </div>

{if $smarty.session.is_login eq 'admin'}
  <div class="panel panel-primary">
    <div class="panel-heading"><h3 class="panel-title"><i class="glyphicon glyphicon-user"></i>&nbsp;អតិថិជនថ្មីៗ (Latest Customer)</h3></div>
    <div class="table-responsive">
      <table class="table table-bordered table-striped table-hover">
        <thead class="table_header">
          <tr>
            <th class="text-center">សកម្មភាព (Action)</th>
            <th class="text-center">លេខអត្តសញ្ញាណប័ណ្ណ (Personal ID)</th>
            <th class="text-center">ឈ្មោះអតិថិជន (Customer Name)</th>
            <th class="text-center">លេខទូរស័ព្ទ (Phone Number)</th>
            <th class="text-center">អុីមែល (Email Address)</th>
            <th class="text-center">អាសយដ្ឋាន (Address)</th>
          </tr>
        </thead>
        <tbody>
        {if $list_customer_data|@count gt 0}
        {foreach from=$list_customer_data item=data}
          <tr>
            <td class="text-center" valign="top" width="105px;">
              <a data-toggle="tooltip" data-original-title="View Customer History" class="btn btn-xs btn-success" href="{$admin_file}?task=customer&amp;action=history&amp;id={$data.id}">
                <i class="glyphicon glyphicon-list"></i> ប្រវត្តិ (History)
              </a>
            </td>
            <td class="text-center">{if $data.idnumber}{$data.idnumber}{else} ~ {/if}</td>
            <td class="text-center">{if $data.name}{$data.name}{else} ~ {/if}</td>
            <td class="text-center" valign="top" width="130px;">{$data.phone}</td>
            <td class="text-center">{if $data.email}{$data.email}{else} ~ {/if}</td>
            <td class="text-center">{if $data.address}{$data.address|nl2br}{else} ~ {/if}</td>
          </tr>
        {/foreach}
        {else}
          <tr><td class="text-center" colspan="6"><h4>មិនមានទិន្នន័យអតិថិជន។ (There is no customer information.)</h4></td></tr>
        {/if}
        </tbody>
      </table>
    </div>
  </div>
{/if}
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
