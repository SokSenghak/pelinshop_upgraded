{extends file="admin/layout.tpl"}
{block name="main"}
  <ul class="breadcrumb">
    <li><a href="{$admin_file}">ទំព័រដើម (Home)</a></li>
		<li class="active">របាយការណ៍ (Report)</li>
    <li class="active">របាយការណ៍ផលិតផលសង្ខេប (Summary Product Report)</li>
  </ul>
  <div class="panel panel-primary">
    <div class="panel-heading"><h3 class="panel-title">របាយការណ៍ផលិតផលសង្ខេប (Summary Product Report) <a href="{$admin_file}?task=summary_product&amp;action=summary_product_print&amp;branch_id={$smarty.get.branch_id|default:''|escape}&amp;pr_st_id={$smarty.get.pr_st_id|default:''|escape}&amp;kwd={$smarty.get.kwd|default:''|escape}" class="btn btn-primary btn-sm" target="_blank">បោះពុម្ព (Print)</a></h3> </div>
    <div class="panel-body">
        <div class="row">
          <div class="col-md-12">
            <form role="form" method="get" action="{$admin_file}?task=summary_product" class="form-inline">
              <input type="hidden" name="task" value="summary_product">
              <div class="form-group" style="margin-bottom: 5px;">
                <select name="branch_id" class="form-control" style="padding:0px">
                <option value="">---ជ្រើសរើសឈ្មោះសាខា (Select Branch Name)---</option>
                {foreach from=$list_branch item=branch}
                  <option value="{$branch.id}" {if $smarty.get.branch_id|default:'' eq $branch.id}selected{/if}>{$branch.name}</option>
                {/foreach}
                </select>
              </div>
              <div class="form-group" style="margin-bottom: 5px;">
                <select name="pr_st_id" class="form-control" style="padding:0px">
                <option value="">---ជ្រើសរើសទំហំផ្ទុកផលិតផល (Select Product Storage)---</option>
                {foreach from=$product_storage item=data}
                  <option value="{$data.id}" {if $smarty.get.pr_st_id|default:'' eq $data.id}selected{/if}>{$data.name}</option>
                {/foreach}
                </select>
              </div>
              <div class="form-group" style="margin-bottom: 5px;">
                <div class="input-group">
                  <input type="text" value="{$smarty.get.kwd|default:''|escape}" name="kwd" class="form-control" style="padding:0px" placeholder="Search by IMEI Number or Title" autofocus>
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
