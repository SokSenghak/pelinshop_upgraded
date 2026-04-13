{extends file="admin/layout.tpl"}
{block name="main"}
  <ul class="breadcrumb">
    <li><a href="{$admin_file}">ទំព័រដើម (Home)</a></li>
    <li class="active">កំណត់ (Setting)</li>
    <li class="active">ព័ត៌មានម៉ាកផលិតផល (Brand Information)</li>
  </ul>
  {if $error}
    <div class="alert alert-danger" data-dismiss="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      {if $error.brand_name eq 1}សូមបញ្ចូលម៉ាកផលិតផល។ (Please enter brand name.)<br/>{/if}
      {if $error.maker eq 1}សូមជ្រើសរើសក្រុមហ៊ុនផលិត។ (Please Choose Maker.)<br />{/if}
    </div>
  {/if}
  <div class="panel panel-primary">
    <div class="panel-heading"><h3 class="panel-title">បញ្ជីម៉ាកផលិតផល (Brand List)</h3></div>
    <div class="panel-body">
      <div class="row">
        <div class="col-md-8">
          {if $brand.id}
          <form role="form" method="post" action="{$admin_file}?task=brand&amp;action=edit&amp;id={$brand.id}" class="form-inline">
          {else}
          <form role="form" method="post" action="{$admin_file}?task=brand" class="form-inline">
          {/if}
            <div class="form-group">
              {if $brand.id}
                <select name="maker_id" class="form-control">
                  <option>ជ្រើសរើសឈ្មោះម៉ាកផលិតផល (Choose Maker Name)</option>
                  {foreach from=$list_maker_name item="maker"}
                    <option value="{$maker.id}" {if $brand.maker_id eq $maker.id}selected{/if} >{$maker.name}</option>
                  {/foreach}
                </select>
              {else}
                <select name="maker_id" class="form-control">
                  <option value="">ជ្រើសរើសឈ្មោះម៉ាកផលិតផល (Choose Maker Name)</option>
                  {foreach from=$list_maker_name item="maker"}
                    <option value="{$maker.id}">{$maker.name}</option>
                  {/foreach}
                </select>
              {/if}
            </div>
            <div class="form-group">
              <div class="input-group">
                <input type="text" name="brand_name" value="{if $brand.name}{$brand.name|escape}{/if}" class="form-control" placeholder="ម៉ាកផលិតផលថ្មី (new product brand)..." autofocus>
                {if $brand.id}
                  <input type="hidden" name="id" value="{$brand.id}" />
                  <span class="input-group-btn">
                    <button class="btn btn-success" type="submit" name="submit"><i class="glyphicon glyphicon-edit"></i>&nbsp;&nbsp;កែប្រែ (Edit)</button>
                  </span>
                {else}
                  <span class="input-group-btn">
                <button class="btn btn-success" type="submit" name="submit"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp;&nbsp;បន្ថែម (Add)</button>
              </span>
                {/if}
              </div>
              {if $brand.id}
                <a class="btn btn-info" href="{$admin_file}?task=brand"><i class="glyphicon glyphicon-remove-circle"></i>&nbsp;បោះបង់ (Cancel)</a>
              {/if}
            </div>
          </form>
        </div>
        <div class="col-md-4">
          <form role="form" method="get" action="{$admin_file}?task=brand" class="form-horizontal">
            <input type="hidden" name="task" value="brand">
            <div class="input-group">
              <input type="text" value="{$smarty.get.kwd|escape}" name="kwd" class="form-control" placeholder="ស្វែងរក (Search for)...">
                <span class="input-group-btn">
                  <button class="btn btn-success" type="submit"><li class="glyphicon glyphicon-search"></li></button>
                </span>
            </div>
          </form>
        </div>
      </div>

      <hr style="margin-top:5px;margin-bottom:5px;" />
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
          <thead class="table_header">
            <th></th>
            <th class="text-center">សកម្មភាព (Action)</th>
            <th>ឈ្មោះម៉ាកផលិតផល (Brand Name)</th>
            <th>ឈ្មោះក្រុមហ៊ុនផលិត (Maker Name)</th>
          </thead>
          <tbody>
          {if $list_brand_data|@count gt 0}
          {foreach from=$list_brand_data item="data"}
            <tr>
              <td class="text-center" valign="top" width="80px;">{if $smarty.get.next eq 1 OR $smarty.get.next eq '' }{counter}{else}{$smarty.foreach.foo.iteration+$smarty.get.next-1}{/if}</td>
              <td class="text-center" valign="top" width="100px;">
                <a data-toggle="tooltip" data-original-title="Edit Brand Name" class="btn btn-xs btn-success" href="{$admin_file}?task=brand&amp;action=edit&amp;id={$data.id}">
                  <i class="glyphicon glyphicon-pencil"></i> កែប្រែ (Edit)
                </a>
                <!-- <span title="Delete Brand" data-toggle="tooltip" data-placement="top"><button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#myModal_{$data.id}"><i class="glyphicon glyphicon-trash"></i> Delete</button></span> -->
                <!-- Modal -->
                <!-- <div class="modal fade" id="myModal_{$data.id}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Delete Brand</h4>
                      </div>
                      <div class="modal-body">Are you sure want to delete this brand named <label class="label label-danger">{$data.name}</label> ? </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-xs btn-default" data-dismiss="modal">　Cancel </button>
                        <a class="btn btn-xs btn-danger" href="{$admin_file}?task=brand&amp;action=delete&amp;id={$data.id}">　Delete</a>
                      </div>
                    </div>
                  </div>
                </div> -->
                <!--End Modal-->
              </td>
              <td valign="top" width="300px;">{$data.name}</td>
              <td>{$data.maker_name}</td>
            </tr>
          {/foreach}
          {else}
            <tr><td class="text-center" colspan="3"><h4>មិនមានទិន្នន័យម៉ាកផលិតផល។ (There is no brand information.)</h4></td></tr>
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

$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip({
    placement : 'top'
  });
});
</script>
{/block}
