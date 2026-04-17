{extends file="admin/layout.tpl"}
{block name="main"}
  <ul class="breadcrumb">
    <li><a href="{$admin_file}">Home</a></li>
    <li class="active">Product History</li>
  </ul>
<!-- <div class="panel panel-primary">
  <div class="panel-heading"><h3 class="panel-title"><i class="glyphicon glyphicon-user"></i>&nbsp;Product History</h3></div>
  <div class="panel-body">
    <div class="row">
      <div class="col-md-3">
        <form role="form" method="get" action="{$admin_file}?task=history" class="form-horizontal">
          <input type="hidden" name="task" value="history">
          <div class="input-group">
            <input type="text" name="kwd" value="{$smarty.get.kwd|default:''|escape}" class="form-control" placeholder="Search for..." autofocus>
          <span class="input-group-btn">
            <button class="btn btn-success" type="submit"><li class="glyphicon glyphicon-search"></li></button>
          </span>
          </div>
        </form>
      </div>
    </div>
    <hr style="margin-top:5px;margin-bottom:5px;" />
  <div class="table-responsive">
    <table class="table table-bordered">
      <thead>
      <th class="text-center">Action</th>
      <th class="text-center">IMEI Number</th>
      <th class="text-center">Product Name</th>
      <th class="text-center">Cost</th>
      <th class="text-center">Price</th>
      <th class="text-center">Product Maker</th>
      <th class="text-center">Product Brand</th>
      <th class="text-center">Ordered Date</th>
      </thead>
      {if $list_product_history_data|@count gt 0}
      {foreach from=$list_product_history_data item=data}
      <tbody>
        <tr>
          <td class="text-center" valign="top" width="90px;">
            <span title="Product Return" data-toggle="tooltip" data-placement="top"><button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#back_{$data.imei}"><i class="glyphicon glyphicon-user"></i>&nbsp;Return</button>

            <div class="modal fade" id="back_{$data.imei}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Confirmation Required</h4>
                  </div>
                  <div class="modal-body">Are you sure want to allow this product imei  <label class="label label-info">{$data.imei} </label> to return ? </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-xs btn-default" data-dismiss="modal">　Cancel </button>
                    <a class="btn btn-xs btn-danger" href="{$admin_file}?task=history&amp;action=back&amp;imei={$data.imei}"><i class="glyphicon glyphicon-ok"></i>&nbsp;Agree</a>
                  </div>
                </div>
              </div>
            </div>
          </td>
          <td valign="top" width="140px;">{$data.imei}</td>
          <td>{$data.title}
            {if $data.color_name}-{$data.color_name}{/if}
            {if $data.storage_name}-{$data.storage_name}{/if}</td>
          <td class="text-center" valign="top" width="90px;">$ {$data.cost|number_format:2}</td>
          <td class="text-center" valign="top" width="90px;">$ {$data.price|number_format:2}</td>
          <td class="text-center">{$data.maker_name}</td>
          <td class="text-center">{$data.brand_name}</td>
          <td class="text-center">{$data.deleted_at|date_format:"%Y-%m-%d"}</td>
        </tr>
      {/foreach}
      </tbody>
      {else}
      <tbody>
        <tr>
          <td class="text-center" colspan="9">
            <h4>There is no product history.</h4>
          </td>
        </tr>
      </tbody>
      {/if}
    </table>
    </div>
  </div>
</div> -->


  <div class="panel panel-primary">
    <div class="panel-heading"><h3 class="panel-title"><i class="glyphicon glyphicon-user"></i>&nbsp;Staff History</h3></div>
    <div class="panel-body">
      <div class="row">
        <div class="col-md-3">
          <form role="form" method="get" action="{$admin_file}?task=history" class="form-horizontal">
            <input type="hidden" name="task" value="history">
            <div class="input-group">
              <input type="text" name="kwd" value="{$smarty.get.kwd|default:''|escape}" class="form-control" placeholder="Search for..." autofocus>
            <span class="input-group-btn">
              <button class="btn btn-success" type="submit"><li class="glyphicon glyphicon-search"></li></button>
            </span>
            </div>
          </form>
        </div>
      </div>
      <hr style="margin-top:5px;margin-bottom:5px;" />
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
        <th class="text-center">Action</th>
        <th class="text-center">ID</th>
        <th class="text-center">Staff Name</th>
        <th class="text-center">Branch</th>
        <th class="text-center">Leaved Date</th>
        </thead>
        {if $list_history_data|@count gt 0}
        {foreach from=$list_history_data item=data}
        <tbody>
          <tr>
            <td class="text-center" valign="top" width="90px;">
              <span title="Staff Return" data-toggle="tooltip" data-placement="top"><button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#myModal_{$data.id}"><i class="glyphicon glyphicon-user"></i>&nbsp;Return</button>

              <div class="modal fade" id="myModal_{$data.id}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                      </button>
                      <h4 class="modal-title" id="myModalLabel">Confirmation Required</h4>
                    </div>
                    <div class="modal-body">Are you sure want to allow this staff named <label class="label label-info">{$data.name} </label> to return ? </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-xs btn-default" data-dismiss="modal">　Cancel </button>
                      <a class="btn btn-xs btn-danger" href="{$admin_file}?task=history&amp;action=return&amp;id={$data.id}"><i class="glyphicon glyphicon-ok"></i>&nbsp;Agree</a>
                    </div>
                  </div>
                </div>
              </div>
            </td>
            <td class="text-center">{$data.id}</td>
            <td class="text-center">{$data.name}</td>
            <td class="text-center">{$data.branch_name}</td>
            <td class="text-center">{$data.deleted_at|date_format:"%Y-%m-%d"}</td>
          </tr>
        {/foreach}
        </tbody>
        {else}
        <tbody>
          <tr>
            <td class="text-center" colspan="5">
              <h4>There is no staff history.</h4>
            </td>
          </tr>
        </tbody>
        {/if}
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
