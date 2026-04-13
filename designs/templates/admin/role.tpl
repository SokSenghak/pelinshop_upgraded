{extends file="admin/layout.tpl"}
{block name="main"}
<ul class="breadcrumb">
  <li><a href="{$admin_file}">ទំព័រដើម (Home)</a></li>
  <li class="active">កំណត់ (Setting)</li>
  <li class="active">ព័ត៌មានតួនាទី (Role Information)</li>
</ul>
{if $error}
<div class="alert alert-danger" data-dismiss="alert">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  {if $error.company eq 1}សូមបញ្ចូលឈ្មោះតួនាទី។ (Please enter role name.){/if}
  {if $error.existed_data eq 1}ទិន្នន័យត្រូវប្រើប្រាស់រួច (data already used".){/if}
</div>
{/if}

<div class="panel panel-primary">
  <div class="panel-heading"><h3 class="panel-title">បញ្ជីតួនាទី (Role List)</h3></div>
  <div class="panel-body">
    <div class="row">
      	<div class="col-md-8">
         	<a href="{$admin_file}?task=role&amp;action=add" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp;&nbsp;បន្ថែម (Add)</a>
        </div>
        <div class="col-md-4">
          <form role="form" method="get" action="{$admin_file}?task=role" class="form-horizontal">
            <input type="hidden" name="task" value="role">
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
      <table class="table table-bordered table-striped table-hover">
        <thead class="table_header">
          <!-- <th></th> -->
          <th class="text-center">សកម្មភាព (Action)</th>
          <th>ឈ្មោះតួនាទី (Role Name)</th>
        </thead>
        <tbody>
          {if $list_role_data|@count gt 0}
          {foreach $list_role_data AS $data}
          <tr>
            <td class="" valign="top" width="400">
              <span title="បង្ហាញមុខងាប្រើប្រាស់ (Show Permission)" data-toggle="tooltip" data-placement="top">
                <button type="button" class="btn radius-50 btn-success btn-xs" data-toggle="modal" data-target="#myModal_{$data.id}" ><i class="glyphicon glyphicon-eye-open"></i> បង្ហាញមុខងារ(Permission)</button>
              </span>
              <div class="modal fade" id="myModal_{$data.id}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                  <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                  </button>
                  <h4 class="modal-title" id="myModalLabel">បង្ហាញការអនុញ្ញាត (Show Permission)</h4>
                  </div>
                  <div class="modal-body">
                    {if $data.permissions|@count gt 0}
                      {foreach from=$data.permissions item=p}
                        <ul>
                        <li>{$p.fn_title}</li>
                        </ul>
                      {{/foreach}}
                    {else}
                      មិនមានទិន្នន័យការអនុញ្ញាត (There is no Permission information.)
                    {/if}
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-xs btn-default" data-dismiss="modal">　បោះបង់ (Cancel) </button>
                  </div>
                </div>
                </div>
              </div>
              <a data-toggle="tooltip" data-original-title="Edit role Name" class="btn btn-xs btn-success" href="{$admin_file}?task=role&amp;action=edit&amp;id={$data.id}">
                <i class="glyphicon glyphicon-pencil"></i> កែប្រែ (Edit)
              </a>
              <a data-toggle="tooltip" data-original-title="delete role Name" class="btn btn-xs btn-success" href="{$admin_file}?task=role&amp;action=delete&amp;id={$data.id}">
                <i class="fa fa-trash"></i> លុប (Delete)
              </a>
            </td>
        <td>{$data.name}</td>
      </tr>
      {/foreach}
      {else}
      <tr><td class="text-center" colspan="3"><h4>មិនមានទិន្នន័យតួនាទី។ (There is no Role information.)</h4></td></tr>
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
