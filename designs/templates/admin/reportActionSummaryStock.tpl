{extends file="admin/layout.tpl"}
{block name="main"}
  <ul class="breadcrumb">
    <li><a href="{$admin_file}">ទំព័រដើម (Home)</a></li>
		<li class="active">របាយការណ៍ (Report)</li>
    <li class="active">របាយការណ៍ស្តុកផលិតផល (Summary Stock Report)</li>
  </ul>
  <div class="panel panel-primary">
    <div class="panel-heading"><h3 class="panel-title">របាយការណ៍សង្ខេប (Summary Report)</h3></div>
    <div class="panel-body">
      <div class="panel panel-primary">
        <div class="panel-body">
          <form role="form" method="get" action="{$admin_file}?task=summary_stock&amp;action=summary_stock" class="form-horizontal">
            <input type="hidden" name="task" value="summary_stock">
            <div class="row">
              <div class="col-md-4">
                <div class="input-group" style="padding-bottom:10px;">
                  <span class="input-group-addon">សាខា (Branch) :</span>
                  <select name="brch" class="form-control">
                      <option value="">---ជ្រើសរើសសាខា (Select Branch)---</option>
                      {foreach from=$list_branch_name item="branch"}
                        <option value="{$branch.id}" {if $smarty.get.brch|escape eq $branch.id OR $brch_id eq 2}selected{/if}>{$branch.name}</option>
                      {/foreach}
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="input-group" style="padding-bottom:10px;">
                  <span class="input-group-addon">សាខា (Brand)</span>
                  <select name="brd" class="form-control">
                      <option value="">---ជ្រើសរើសសាខា (Select Brand)---</option>
                    {foreach from=$list_brand_name item="brand"}
                      <option value="{$brand.id}" {if $smarty.get.brd eq $brand.id}selected{/if}>{$brand.name}</option>
                    {/foreach}
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <button class="btn btn-success" type="submit"><i class="glyphicon glyphicon-search"></i>&nbsp;ស្វែងរក (Search)</button>
                <a target="_blank" class="btn btn-primary {if $summary_stock_data|@count eq 0} disabled{/if}" href="{$admin_file}?task=summary_stock&amp;action=summary_stock_show&amp;brch={if $smarty.get.brch}{$smarty.get.brch|escape}{else}{$brch_id}{/if}&amp;brd={$smarty.get.brd}">
                  <i class="glyphicon glyphicon-print"></i>&nbsp;បោះពុម្ពរបាយការណ៍ (Print Report)</a>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
              <tr class="table_header">
                <th></th>
                <!-- <th class="text-center">Branch</th> -->
                <th class="text-center">សាខា (Brand)</th>
                <th class="text-center">សមតុល្យស្តុក (Stock Balance) ({$yesterday|date_format})</th>
                <th class="text-center">ស្តុកថ្មី (New Stock) ({$smarty.now|date_format})</th>
                <th class="text-center">លក់អស់ (Sold Out) ({$smarty.now|date_format})</th>
                <th class="text-center">សមតុល្យស្តុក (Stock Balance) ({$smarty.now|date_format})</th>
              </tr>
            </thead>
            <tbody>
              {if $summary_stock_data|@count gt 0}
              {foreach from=$summary_stock_data item=data name=foo}
                <tr>
                  <td class="text-center">{if $smarty.get.next eq 1 OR $smarty.get.next eq '' }{counter}{else}{$smarty.foreach.foo.iteration+$smarty.get.next-1}{/if}</td>
                  <!-- <td class="text-center">{$data.branch_name}</td> -->
                  <td class="text-center" valign="top" width="140px;"><span class="badge_pelin">{$data.brand_name}</span></td>
                  <td class="text-center">{$data.inStockYesterday}</td>
                  <td class="text-center">{$data.newStockToday}</td>
                  <td class="text-center">{$data.outStockToday}</td>
                  <td class="text-center">{$data.inStockToday}</td>
                </tr>
              {/foreach}
              {else}
              <tr><td class="text-center" colspan="6"><h4>There is no information.</h4></td></tr>
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
