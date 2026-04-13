{extends file="admin/layout.tpl"}
{block name="main"}
  <ul class="breadcrumb">
    <li><a href="{$admin_file}">ទំព័រដើម (Home)</a></li>
		<li class="active">របាយការណ៍ (Report)</li>
    <li class="active">របាយការណ៍ស្តុកផលិតផល (Product Stock Report)</li>
  </ul>
  <div class="panel panel-primary">
    <div class="panel-heading"><h3 class="panel-title">របាយការណ៍ផលិតផល (Product Report)</h3></div>
    <div class="panel-body">
      <div class="panel panel-primary">
        <div class="panel-body">
          <form role="form" method="get" action="{$admin_file}?task=product_stock" class="form-horizontal">
            <input type="hidden" name="task" value="product_stock">
            <div class="row">
              <div class="col-md-6">
                <div class="input-group" style="padding-bottom:10px;">
                <span class="input-group-addon">កាលបរិច្ឆេទ (Date)</span>
                  <input type="text" id="order_from" value ="{if $smarty.get.order_from}{$smarty.get.order_from|escape}{elseif $order_from}{$order_from}{/if}"
                    class="form-control" name="order_from" placeholder="2016-08-01"/>
                    <span class="input-group-addon">ទៅ (To)</span>
                  <input type="text" id="order_to" value ="{$smarty.get.order_to|escape}" class="form-control"
                    name="order_to" placeholder="2016-08-30" />
                </div>
              </div>
              <div class="col-md-6">
                <div class="input-group" style="padding-bottom:10px;">
                  <span class="input-group-addon">ម៉ាកផលិតផល (Brand)</span>
                  <select name="brd" class="form-control">
                      <option value="">---ជ្រើសរើសម៉ាកផលិតផល (Select Brand)---</option>
                    {foreach from=$list_brand_name item="brand"}
                      <option value="{$brand.id}" {if $smarty.get.brd|escape eq $brand.id}selected{/if}>{$brand.name}</option>
                    {/foreach}
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="input-group" style="padding-bottom:10px;">
                  <span class="input-group-addon">សាខា (Branch) :</span>
                  <select name="branch" class="form-control">
                      <option value="">---ជ្រើសរើសសាខា (Select Branch)---</option>
                      {foreach from=$list_branch_name item="branch"}
                        <option value="{$branch.id}" {if $smarty.get.branch|escape eq $branch.id}selected{/if}>{$branch.name}</option>
                      {/foreach}
                  </select>
                </div>
              </div>
              <div class="col-md-2">
                <label class="checkbox-inline"><input type="checkbox" name="summary" value="1" {if $smarty.get.summary eq 1}checked{/if}>មើល (View)</label>&nbsp;&nbsp;
                <button class="btn btn-success" type="submit"><i class="glyphicon glyphicon-search"></i>&nbsp;ស្វែងរក (Search)</button>
              </div>
              <div class="col-md-3">
                <a target="_blank" class="btn btn-primary" href="{$admin_file}?task=product_stock&amp;action=product_stock_show&amp;order_from={$smarty.get.order_from|escape}&amp;order_to={$smarty.get.order_to|escape}&amp;brd={$smarty.get.brd|escape}&amp;branch={$smarty.get.branch|escape}&amp;summary={$smarty.get.summary|escape}">
                  <i class="glyphicon glyphicon-print"></i>&nbsp;បោះពុម្ពរបាយការណ៍ (Print Report)</a>
              </div>
            </div>
            
          </form>
        </div>
      </div>

      <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover" {if $smarty.get.summary eq 1}style="display:none;"{/if}>
            <thead>
              <tr class="table_header">
                <th></th>
                <th class="text-center">លេខ IMEI (IMEI Number)</th>
                <th class="text-center">ឈ្មោះផលិតផល (Product Title)</th>
                {if $smarty.session.is_login_role eq 2}
                <th class="text-center">តម្លៃដើម (Cost)</th>
                {/if}
                <th class="text-center">តម្លៃលក់ (Price)</th>
                <th class="text-center">ក្រុមហ៊ុនផលិត (Product Maker)</th>
                <th class="text-center">ម៉ាកផលិតផល (Product Brand)</th>
                <th class="text-center">កំណត់សម្គាល់ (Note)</th>
                <th class="text-center">កាលបរិច្ឆេទ (Date)</th>
              </tr>
            </thead>
            <tbody>
            {if $bybranch_id eq ''}
              {if $product_stock_report_data|@count gt 0}
              {foreach from=$product_stock_report_data item=data name=foo}
                <tr>
                  <td class="text-center">{if $smarty.get.next eq 1 OR $smarty.get.next eq '' }{counter}{else}{$smarty.foreach.foo.iteration+$smarty.get.next-1}{/if}</td>
                  <td class="text-center" valign="top" width="140px;"><span class="badge_pelin">{$data.imei}</span></td>
                  <td class="text-center">{$data.title}
                    {if $data.color_name}-{$data.color_name}{/if}
                    {if $data.storage_name}-{$data.storage_name}{/if}
                  </td>
                  {if $smarty.session.is_login_role eq 2}
                  <td class="text-center" valign="top" width="100px;">$ {$data.cost|number_format:2}</td>
                  {/if}
                  <td class="text-center" valign="top" width="100px;">$ {$data.price|number_format:2}</td>
                  <td class="text-center">{$data.maker_name}</td>
                  <td class="text-center">{$data.brand_name}</td>
                  <td class="text-center">{if $data.description}{$data.description|nl2br}{else} ~ {/if}</td>
                  <td class="text-center">{$data.created_at|date_format:"%Y-%m-%d"}</td>
                </tr>
              {/foreach}
              {else}
              <tr><td class="text-center" colspan="9"><h4>There is no information.</h4></td></tr>
              {/if}
            {else}
              {if $product_stock_report_data_branch|@count gt 0}
              {foreach from=$product_stock_report_data_branch item=data name=foo}
                <tr>
                  <td class="text-center">{if $smarty.get.next eq 1 OR $smarty.get.next eq '' }{counter}{else}{$smarty.foreach.foo.iteration+$smarty.get.next-1}{/if}</td>
                  <td class="text-center" valign="top" width="140px;"><span class="badge_pelin">{$data.imei}</span></td>
                  <td class="text-center">{$data.title}
                    {if $data.color_name}-{$data.color_name}{/if}
                    {if $data.storage_name}-{$data.storage_name}{/if}</td>
                  <td class="text-center" valign="top" width="100px;">$ {$data.cost|number_format:2}</td>
                  <td class="text-center" valign="top" width="100px;">$ {$data.price|number_format:2}</td>
                  <td class="text-center">{$data.maker_name}</td>
                  <td class="text-center">{$data.brand_name}</td>
                  <td class="text-center">{if $data.description}{$data.description|nl2br}{else} ~ {/if}</td>
                  <td class="text-center">{$data.created_at|date_format:"%Y-%m-%d"}</td>
                </tr>
              {/foreach}
              {else}
              <tr><td class="text-center" colspan="9"><h4>មិនមានទិន្នន័យ។ (There is no information.)</h4></td></tr>
              {/if}
            {/if}
            </tbody>
        </table>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered" style="margin-bottom: 0px;">
        {if $bybranch_id eq ''}
          {foreach from=$brand_group item=group key=k}
          <tbody>
            <tr class="active">
              <td style="width:30%">
                <label>{$group.name}</label>
              </td>
              <td>
                <label><i class="fa fa-mobile fa-lg"></i>&nbsp;{$group.brand_count}<label>
              </td>
            </tr>
          </tbody>
          {/foreach}
        {else}
          {foreach from=$branch_group item=group key=k}
          <tbody>
            <tr class="active">
              <td style="width:30%">
                <label>{$group.name}</label>
              </td>
              <td>
                <label><i class="fa fa-mobile fa-lg"></i>&nbsp;{$group.branch_count}<label>
              </td>
            </tr>
          </tbody>
          {/foreach}
        {/if}
        </table>
        {if $bybranch_id neq ''}
        <table class="table table-bordered">
          {foreach from=$brand_group_name_data item=group key=k}
          <tbody>
            <tr class="active">
              <td style="width:30%">
                <label>{$group.name}</label>
              </td>
              <td>
                <label><i class="fa fa-mobile fa-lg"></i>&nbsp;{$group.brand_count}<label>
              </td>
            </tr>
          </tbody>
          {/foreach}
        </table>
        {/if}
      </div>
    </div>
  </div>
  {include file="common/paginate.tpl"}
{/block}
{block name="javascript"}
<script>
$(function () {
  $('#order_from').datetimepicker({
    lang: 'en',
    format: 'Y-m-d',
    timepicker: false
  });
  $('#order_to').datetimepicker({
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
