{extends file="admin/layout.tpl"}
{block name="main"}
  <ul class="breadcrumb">
    <li><a href="{$admin_file}">ទំព័រដើម (Home)</a></li>
    <li class="active">ព័ត៌មានបុគ្គលិក (Staff Information)</li>
  </ul>
  {if $error}
    <div class="alert alert-danger" data-dismiss="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      {if $error.role eq 1}សូមជ្រើសរើសតួនាទីការសម្រាប់បុគ្គលិក។ (Please choose role for staff work.)<br/>{/if}
      {if $error.brand eq 1}សូមជ្រើសរើសសាខាធ្វើការសម្រាប់បុគ្គលិក។ (Please choose branch for staff work.)<br/>{/if}
      {if $error.staff_name eq 1}សូមបញ្ចូលឈ្មោះបុគ្គលិក។ (Please enter staff name.)<br/>{/if}
      {if $error.staff_password eq 1}សូមបញ្ចូលពាក្យសម្ងាត់បុគ្គលិក។ (Please enter password for staff.)<br/>{/if}
    </div>
  {/if}
  <div class="panel panel-primary">
    <div class="panel-heading"><h3 class="panel-title"><i class="glyphicon glyphicon-user"></i>&nbsp;ព័ត៌មានបុគ្គលិក (Staff Information)</h3></div>
    <div class="panel-body">
      <div class="row">
        <div class="col-md-9">
          {if $staff.id}
          <form role="form" method="post" class="form-inline" action="{$admin_file}?task=staff&amp;action=edit&amp;id={$staff.id}">
          {else}
          <form role="form" method="post" class="form-inline" action="{$admin_file}?task=staff">
          {/if}
            <div class="form-group">
              {if $staff.id}
                <select name="branch_id" class="form-control">
                  <option value="">ជ្រើសរើសសាខា (Choose branch name)</option>
                  {foreach from=$list_branch_name item=branch}
                    <option value="{$branch.id}" {if $staff.branch_id eq $branch.id}selected{/if} >{$branch.name}</option>
                  {/foreach}
                </select>
              {else}
                <select name="branch_id" class="form-control">
                  <option value="">សូមជ្រើសរើសសាខា (Choose branch name)</option>
                  {foreach from=$list_branch_name item=branch}
                    <option value="{$branch.id}">{$branch.name}</option>
                  {/foreach}
                </select>
              {/if}
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input type="text" name="staff_password" value="{if $staff.password}{$staff.password|escape}{/if}" class="form-control" placeholder="ពាក្យសម្ងាត់ (Password)">
              </div>
            </div>
            <div class="form-group">
              {if $staff.id}
                <select name="role" class="form-control">
                  <option value="">ជ្រើសរើសតួនាទី (Choose role name)</option>
                  {foreach from=$list_role_name item=role}
                    <option value="{$role.id}" {if $staff.role eq $role.id}selected{/if} >{$role.name}</option>
                  {/foreach}
                </select>
              {else}
                <select name="role" class="form-control">
                  <option value="">សូមជ្រើសរើសតួនាទី (Choose role name)</option>
                  {foreach from=$list_role_name item=role}
                    <option value="{$role.id}">{$role.name}</option>
                  {/foreach}
                </select>
              {/if}
            </div>
            <div class="form-group">
              <div class="input-group">
                <input type="text" name="staff_name" value="{if $staff.name}{$staff.name|escape}{/if}" class="form-control" placeholder="ឈ្មោះបុគ្គលិក (Staff Name)">
                {if $staff.id}
                  <input type="hidden" name="staff_id" value="{$staff.id}" />
                  <span class="input-group-btn">
                      <button class="btn btn-success" type="submit" name="submit"><i class="glyphicon glyphicon-edit"></i>&nbsp;&nbsp;កែប្រែ (Edit)</button>
                    </span>
                {else}
                  <span class="input-group-btn">
                      <button class="btn btn-success" type="submit" name="submit"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp;&nbsp;បន្ថែម (Add)</button>
                    </span>
                {/if}
              </div>
            </div>
          </form>
        </div>
        <div class="col-md-3">
          <form role="form" method="get" action="{$admin_file}?task=staff" class="form-horizontal">
            <input type="hidden" name="task" value="staff">
            <div class="input-group">
              <input type="text" name="kwd" value="{$smarty.get.kwd}" class="form-control" placeholder="ស្វែងរក (Search for...)" autofocus>
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
          <th class="text-center">ID</th>
          <th class="text-center">ពាក្យសម្ងាត់ (Password)</th>
          <th class="text-center">ឈ្មោះបុគ្គលិក (Staff Name)</th>
          <th class="text-center">ស្ថានភាព (Status)</th>
          <th class="text-center">សាខា (Branch)</th>
          <th class="text-center">តួនាទី (Role)</th>
        </thead>
        <tbody>
        {if $list_staff_data|@count gt 0}
        {foreach from=$list_staff_data item=data}
          <tr>
            <td class="text-center">{if $smarty.get.next eq 1 OR $smarty.get.next eq '' }{counter}{else}{$smarty.foreach.foo.iteration+$smarty.get.next-1}{/if}</td>
            <td class="text-center" valign="top" width="100px;">
              <!-- <a data-toggle="tooltip" data-original-title="View Staff History" class="btn btn-xs btn-success" href="{$admin_file}?task=staff&amp;action=history&amp;id={$data.id}">
                <i class="glyphicon glyphicon-list"></i> History
              </a> -->
              <a data-toggle="tooltip" data-original-title="Edit Staff Information"  class="btn btn-xs btn-success" href="{$admin_file}?task=staff&amp;action=edit&amp;id={$data.id}">
                <i class="glyphicon glyphicon-edit"></i> កែប្រែ (Edit)
              </a>
            </td>
            <td class="text-center">{$data.id}</td>
            <td class="text-center">{$data.password}</td>
            <td class="text-center">{$data.name}</td>
            <td class="text-center">{if $data.is_quited eq 0}<label class="label label-info">ធ្វើការ (Working)</label>{else}<label class="label label-danger">ឈប់ធ្វើការ (Stopped)</label>{/if}</td>
            <td class="text-center">{$data.branch_name}</td>
             <td class="text-center">{$data.role_name}</td>
          </tr>
        {/foreach}
        {else}
          <tr><td class="text-center" colspan="6"><h4>មិនមានព័ត៌មានបុគ្គលិក។ (There is no staff information.)</h4></td></tr>
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
