{extends file="admin/layout.tpl"}
{block name="main"}
  <ul class="breadcrumb">
    <li><a href="{$admin_file}">ទំព័រដើម (Home)</a></li>
		<li class="active">របាយការណ៍ (Report)</li>
    <li class="active">របាយការណ៍សង្ខេបផ្លាស់ប្ដូរផលិតផល (Summary Return Product Report)</li>
  </ul>
  <div class="panel panel-primary">
    <div class="panel-heading"><h3 class="panel-title">របាយការណ៍សង្ខេបផ្លាស់ប្ដូរផលិតផល (Summary Return Product Report) <a href="{$admin_file}?task=report&amp;action=summary_product_return_print" class="btn btn-primary btn-sm" target="_blank">បោះពុម្ព (Print)</a></h3></div>
    <div class="panel-body">
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
              <tr class="table_header">
                <th class="text-center">ឈ្មោះផលិតផល (Title)</th>
                <th class="text-center">ទំហំផ្ទុក (Storage)</th>
                <th class="text-center">ចំនួនពណ៌ (Amount Of Color)</th>
                <th class="text-center">ឈ្មោះពណ៌ (Color Name)</th>
                <th class="text-center">សរុប (Total)</th>
                <th class="text-center">ក្រុមហ៊ុនផលិត (Maker)</th>
                <th class="text-center">ម៉ាកផលិតផល (Brand)</th>
              </tr>
            </thead>
            <tbody>
              {if $summary_product_data|@count gt 0}
              {foreach from=$summary_product_data item=data name=foo}
                <tr>
                  <td class="text-center">{$data.title}</td>
                  <td class="text-center">{$data.pro_storage}</td>
                  <td class="text-center">
                    <ul class="list-group">
                      {foreach $data.product_color item=vc}
                      <li class="list-group-item" style="padding: 4px 15px;">{$vc.total_color}</li>
                      {/foreach}
                    </ul>
                  </td>
                  <td class="text-center">
                    <ul class="list-group">
                      {foreach $data.product_color item=vc}
                      <li class="list-group-item" style="padding: 4px 15px;">{$vc.product_color}</li>
                      {/foreach}
                    </ul>
                  </td>
                  <td class="text-center">{$data.total_product}</td>
                  <td class="text-center">{$data.maker_name}</td>
                  <td class="text-center">{$data.brand_name}</td>
                </tr>
              {/foreach}
              {else}
              <tr><td class="text-center" colspan="7"><h4>មិនមានទិន្នន័យ។ (There is no information.)</h4></td></tr>
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

$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip({
    placement : 'top'
  });
});
</script>
{/block}
