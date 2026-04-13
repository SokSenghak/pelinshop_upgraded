{extends file="admin/layout.tpl"}
{block name="main"}
  <ul class="breadcrumb">
    <li><a href="{$admin_file}">ទំព័រដើម (Home)</a></li>
    <li class="active">ព័ត៌មានអតិថិជន (Customer Information)</li>
  </ul>

  <div class="panel panel-primary">
    <div class="panel-heading"><h3 class="panel-title"><i class="glyphicon glyphicon-user"></i>&nbsp;ព័ត៌មានអតិថិជន (Customer Information)</h3></div>
    <div class="table-responsive">
      <div class="panel-body">
        <div class="row">
          <div class="col-md-5">
            <form role="form" method="get" action="{$admin_file}?task=customer" class="form-horizontal">
              <input type="hidden" name="task" value="customer">
              <div class="input-group">
                <input type="text" value="{$smarty.get.kwd|escape}" name="kwd" class="form-control" placeholder="ស្វែងរកឈ្មោះអតិថិជន ឬលេខទូរស័ព្ទ ឬលេខអត្តសញ្ញាណប័ណ្ណ (Search by Customer Name or Phone Number or ID Number)" autofocus>
                <span class="input-group-btn">
                  <button class="btn btn-success" type="submit"><li class="glyphicon glyphicon-search"></li></button>
                </span>
              </div>
            </form>
          </div>
        </div>
        <hr style="margin-top:5px;margin-bottom:5px;" />
        <table class="table table-bordered table-striped table-hover">
          <thead class="table_header">
            <th></th>
            <th class="text-center">សកម្មភាព (Action)</th>
            <th class="text-center">លេខអត្តសញ្ញាណប័ណ្ណ (Personal ID)</th>
            <th class="text-center">ឈ្មោះអតិថិជន (Customer Name)</th>
            <th class="text-center">ស្ថានភាព (Status)</th>
            <th class="text-center">លេខទូរស័ព្ទ (Phone Number)</th>
            <th>អុីមែល (Email Address)</th>
            <th>អាសយដ្ឋាន (Address)</th>
          </thead>
          <tbody>
          {if $list_customer_data|@count gt 0}
          {foreach from=$list_customer_data item=data}
            <tr>
              <td class="text-center">{if $smarty.get.next eq 1 OR $smarty.get.next eq '' }{counter}{else}{$smarty.foreach.foo.iteration+$smarty.get.next-1}{/if}</td>
              <td>
                <div class="text-center" valign="top" width="105px;">
                  <a data-toggle="tooltip" data-original-title="View Customer History" class="btn btn-xs btn-success" href="{$admin_file}?task=customer&amp;action=history&amp;id={$data.id}">
                    <i class="glyphicon glyphicon-list"></i> ប្រវត្តិ (History)
                  </a>
                </div>
                <div class="text-center" valign="top" width="175px;" style='padding:5px;'>
                    <a data-toggle="tooltip" data-original-title="Edit Customer" class="btn btn-xs btn-danger" href="{$admin_file}?task=customer&amp;action=edit&amp;id={$data.id}">
                      <i class="glyphicon glyphicon-pencil"></i> កែប្រែ (Edit)
                    </a>
                  </div>
              </td>
              <td class="text-center" valign="top" width="120px;">{if $data.idnumber eq 0} ~ {else}{$data.idnumber}{/if}</td>
              <td>{if $data.name}{$data.name}{else} ~ {/if}</td>
              <td class="text-center">{if $data.status eq 1}<a class="btn btn-info" href="{$admin_file}?task=customer&amp;action=stopped&amp;id={$data.id}">កំពុងប្រើប្រាស់ (Active)</a>{else}<a class="btn btn-danger">ឈប់ប្រើប្រាស់ (Stopped)</a>{/if}</td>
              <td class="text-center" valign="top" width="130px;">{$data.phone}</td>
              <td>{if $data.email eq ''} ~ {else}{$data.email}{/if}</td>
              <td>{if $data.address}{$data.address|nl2br}{else} ~ {/if}</td>
            </tr>
          {/foreach}
          {else}
            <tr><td class="text-center" colspan="7"><h4>មិនមានព័ត៌មានអតិថិជន។ (There is no customer information.)</h4></td></tr>
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
