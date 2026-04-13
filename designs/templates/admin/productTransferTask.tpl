{extends file="admin/layout.tpl"}
{block name="main"}
  <ul class="breadcrumb">
    <li><a href="{$admin_file}">Home</a></li>
    <li class="active">Product information</li>
  </ul>
  <div class="panel panel-primary">
    <div class="panel-heading"><h3 class="panel-title">Product Information</h3></div>
    <div class="panel-body">
      {if $error}
      <div class="alert alert-danger">
        {if $error.branch_id} * Please Select Branch. <br>{/if}
        {if $error.product_id} * Please Choose Product. {/if}
      </div>
      {/if}
      <div class="row">
        <div class="col-md-8">
            <form role="form" method="get" action="{$admin_file}?task=product_transfer" class="form-inline">
              <input type="hidden" name="task" value="product_transfer">
              <div class="form-group">
                <select name="maker" class="form-control">
                  <option value="">---Choose Product Maker---</option>
                  {foreach from=$list_maker_name item=maker}
                    <option value="{$maker.id}" {if $smarty.get.maker eq $maker.id}selected{/if}>{$maker.name}</option>
                  {/foreach}
                </select>
              </div>
              <div class="form-group">
                <select name="brand" class="form-control">
                  <option value="">---Choose Brand Name---</option>
                  {foreach from=$list_brand_name item=brand}
                    <option value="{$brand.id}" {if $smarty.get.brand eq $brand.id}selected{/if}>{$brand.name}</option>
                  {/foreach}
                </select>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <input type="text" value="{$smarty.get.kwd|escape}" name="kwd" class="form-control" placeholder="Search by IMEI Number or Title" autofocus>
                    <span class="input-group-btn">
                      <button class="btn btn-success" type="submit"><li class="glyphicon glyphicon-search"></li>Search</button>
                  </span>
                </div>
              </div>
            </form>
          </div>
        <div class="col-md-4">
          <form method="post" action="{$admin_file}?task=product_transfer" class="form-inline pull-right">
              <div class="form-group">
                <select class="form-control" name="branch_id">
                  <option value="">---Select Branch To Transfer---</option>
                  {foreach from=$list_branch item=data}
                  <option value="{$data.id}" {if $smarty.session.pro_transfer.branch_id eq $data.id} selected {/if}>{$data.name}</option>
                  {/foreach}
                </select>
              </div>
              <div class="form-group">
                <button class="btn btn-success" type="submit"><i class="glyphicon glyphicon-transfer"></i>&nbsp;Transfer</button>
              </div>
        </div>
        
      </div>
        <hr style="margin-top:5px;margin-bottom:5px;" />
        <div class="table-responsive">
          <table class="table table-bordered table-striped table-hover">
              <thead bgcolor="#eeeeee">
                <tr>
                  <th class="text-center">
                    <label class="checkbox-inline">
                      <input type="checkbox" name="check_all" id="check_all">
                    </label></th>
                  <th class="text-center">IMEI Number</th>
                  <th class="text-center">Title</th>
                  <th class="text-center">Cost</th>
                  <th class="text-center">Price</th>
                  <th class="text-center">Maker</th>
                  <th class="text-center">Brand</th>
                  <th class="text-center">Note</th>
                  <th class="text-center">Image</th>
                </tr>
              </thead>

              {if $list_product_data|@count gt 0}
              {foreach from=$list_product_data item=data}
              <tbody>
                <tr>
                  <td class="text-center" valign="top">
                    <label class="checkbox-inline">
                      &nbsp;<input type="checkbox" value="{$data.id}" name="product_id[]" {foreach $smarty.session.pro_transfer.product_id as $v}{if $v eq $data.id}checked{/if}{/foreach}>&nbsp;
                    </label>
                  </td>
                  <td class="text-center" valign="top" width="140px;">{$data.imei}</td>
                  <td>{$data.title}
                    {if $data.color_name}-{$data.color_name}{/if}
                    {if $data.storage_name}-{$data.storage_name}{/if}</td>
                  <td class="text-center" valign="top" width="100px;">$ {$data.cost|number_format:2}</td>
                  <td class="text-center" valign="top" width="100px;">$ {$data.price|number_format:2}</td>
                  <td class="text-center">{$data.maker_name}</td>
                  <td class="text-center">{$data.brand_name}</td>
                  <td class="text-center">{if $data.description}{$data.description|nl2br}{else} ~ {/if}</td>
                  <td class="text-center" valign="top" width="90px;">
                    {if $data.photoone}
                      <a href="{$shop_site}images/product/{$data.photoone}" data-lightbox="{$data.photoone}">
                        <img src="{$shop_site}images/product/thumbnail__{$data.photoone}" class="img-thumbnail"  />
                      </a>
                    {/if}
                  </td>
                </tr>
              </tbody>
              {/foreach}
              {else}
              <tbody>
                <tr>
                  <td class="text-center" colspan="10">
                    <h4>There is no product information.</h4>
                  </td>
                </tr>
              </tbody>
              {/if}
          </table>
        </div>
      </form>
    </div>
  </div>
  {include file="common/paginate.tpl"}
{/block}
{block name="javascript"}
<script>

function NumAndTwoDecimals(e , field)
{
  var val = field.value;
  var reg = /^([0-9]+[\.]?[0-9]?[0-9]?|[0-9]+)/g;
  val = reg.exec(val);
  if (val) {
    field.value = val[0];
  }
  else
  {
    field.value = "";
  }
}
$('#check_all').change(function(){
    if($(this).prop('checked')){
        $('tbody tr td input[type="checkbox"]').each(function(){
            $(this).prop('checked', true);
        });
    }else{
        $('tbody tr td input[type="checkbox"]').each(function(){
            $(this).prop('checked', false);
        });
    }
});

$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip({
    placement : 'top'
  });
});
</script>
{/block}
