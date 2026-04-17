{extends file="admin/layout.tpl"}
{block name="main"}
  <ul class="breadcrumb">
    <li><a href="{$admin_file}">ទំព័រដើម (Home)</a></li>
    <li class="active">កំណត់ (Setting)</li>
    <li class="active">ព័ត៌មានទំហំផ្ទុក (Storage Information)</li>
  </ul>
  {if $error}
    <div class="alert alert-danger" data-dismiss="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      {if $error.storage_ eq 1}សូមបញ្ចូលប្រភេទទំហំផ្ទុក។ (Please enter storage name.){/if}
    </div>
  {/if}

  <div class="panel panel-primary">
    <div class="panel-heading"><h3 class="panel-title">បញ្ជីទំហំផ្ទុក (Storage List)</h3></div>
    <div class="panel-body">
      <div class="row">
        <div class="col-md-8">
          {if $storage.id}
          <form role="form" method="post" action="{$admin_file}?task=storage&amp;action=edit&amp;id={$storage.id}" class="form-inline">
          {else}
          <form role="form" method="post" action="{$admin_file}?task=storage" class="form-inline">
          {/if}
            <div class="form-group">
              <div class="input-group">
                <input type="text" name="storage_" value="{if $storage.name}{$storage.name|escape}{/if}"
                       class="form-control" placeholder="ទំហំផ្ទុក (Storage)..." autofocus>
                {if $storage.id}
                  <input type="hidden" name="id" value="{$storage.id}" />
                  <span class="input-group-btn">
                <button class="btn btn-success" type="submit" name="submit"><i class="glyphicon glyphicon-edit"></i>&nbsp;&nbsp;កែប្រែ (Edit)</button>
              </span>
                {else}
                  <span class="input-group-btn">
                <button class="btn btn-success" type="submit" name="submit"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp;&nbsp;បន្ថែម (Add)</button>
              </span>
                {/if}
              </div>
              {if $storage.id}
                <a class="btn btn-info" href="{$admin_file}?task=storage"><i class="glyphicon glyphicon-remove-circle"></i>&nbsp;បោះបង់ (Cancel)</a>
              {/if}
            </div>
          </form>
        </div>
        <div class="col-md-4">
          <form role="form" method="get" action="{$admin_file}?task=storage" class="form-horizontal">
            <input type="hidden" name="task" value="storage">
            <div class="input-group">
              <input type="text" value="{$smarty.get.kwd|default:''|escape}" name="kwd" class="form-control" placeholder="ស្វែងរក (Search for)...">
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
          <th>ប្រភេទទំហំផ្ទុក (Storage Name)</th>
        </thead>
        <tbody>
        {if $list_storage_data|@count gt 0}
        {foreach $list_storage_data AS $data}
          <tr>
            <td class="text-center" valign="top" width="80px;">{if $smarty.get.next|default:'' eq 1 OR $smarty.get.next|default:'' eq '' }{counter}{else}{$smarty.foreach.foo.iteration+$smarty.get.next|default:1-1}{/if}</td>
            <td class="text-center" valign="top" width="175px;">
              <a data-toggle="tooltip" data-original-title="Edit Storage Name" class="btn btn-xs btn-success" href="{$admin_file}?task=storage&amp;action=edit&amp;id={$data.id}">
                <i class="glyphicon glyphicon-pencil"></i> កែប្រែ (Edit)
              </a>
            </td>
            <td>{$data.name}</td>
          </tr>
        {/foreach}
        {else}
          <tr><td class="text-center" colspan="2"><h4>មិនមានទិន្នន័យទំហំផ្ទុក There is no storage information.</h4></td></tr>
          {/if}
        </tbody>
      </table>
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
