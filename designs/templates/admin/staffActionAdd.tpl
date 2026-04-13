{extends file="admin/layout.tpl"}
{block name="main"}
  <ul class="breadcrumb">
    <li><a href="{$admin_file}">Home</a></li>
    <li><a href="{$admin_file}?task=staff">Staff</a> </li>
    <li class="active">New Staff</li>
  </ul>

  <div class="panel panel-primary">
    <div class="panel-heading"><h3 class="panel-title text-center">New Product Form</h3> </div>
    <div class="panel-body">
      <form role="form" method="post" action="{$admin_file}?task=staff&action=add" class="form-horizontal row-border" >
        <div class="container">
          <div class="row">
            <div class="col-md-9 col-md-offset-1"">
            <h4 class="text-muted">Please fill your staff information.</h4>
            <span style="color:red">* Required field</span>
            <hr style="margin-bottom:10px;margin-top:10px;">
            <div class="form-group">
              <div class="col-md-2"><label>Staff Name<span style="color:red">*</span></label></div>
              <div class="col-md-10">
                <input type="text" name="staff_name" class="form-control" placeholder="staff name" value="{if $smarty.session.sstaff.name}{$smarty.session.sstaff.name|escape}{else}{if $staff.name}{$staff.name|escape}{/if}{/if}"  />
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-2"><label>Work in Branch</label></div>
              <div class="col-md-10">
                <select name="brand_id" class="form-control">
                  {foreach from=$list_branch_name item=branch}
                    <option value="{$branch.id}">{$branch.name}</option>
                  {/foreach}
                </select>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-2"><label>Is Quited</span></label></div>
              <div class="col-md-10">
                <select name="brand_id" class="form-control">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-2">
                <button class="btn btn-success btn-md" type="submit" name="submit"><i class="fa fa-plus"></i>  Add New</button>
              </div>
            </div>
          </div>
        </div>
    </div>
    </form>
  </div>
  </div>


{/block}