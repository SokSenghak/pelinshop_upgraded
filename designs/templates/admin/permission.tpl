{extends file="admin/layout.tpl"}
{block name="main"}

<ul class="breadcrumb">
  <li><a href="{$admin_file}">Home</a></li>
  <li class="active">Permission Error</li>
</ul>

<div class="panel panel-danger">
  <div class="panel-heading">
    <h3 class="panel-title"><i class="fa fa-warning"></i> Error</h3>
  </div>
  <div class="panel-body">
    You have no permission to perform this task.
  </div>
</div>
{/block}
