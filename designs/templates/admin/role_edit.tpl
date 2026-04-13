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
  {if $error.role_name eq 1}សូមបញ្ចូលឈ្មោះតួនាទី។ (Please enter role name.){/if} <br>
  {if $error.task eq 1}សូមពិនិត្យមើលមុខងារអនុញ្ញាត (Please check allow function.){/if} <br>
  {if $error.existed_data eq 1}ទិន្នន័យត្រូវប្រើប្រាស់រួច (data already used".){/if}
</div>
{/if}

<div class="panel panel-primary">
  	<div class="panel-heading"><h3 class="panel-title">តួនាទី (Role)</h3></div>
  	<div class="panel-body">
		<form role="form" method="post" action="{$admin_file}?task=role&amp;action=edit&amp;id={$role.id}">
			<div class="row">
				<div class="col-md-10">
					<div class="form-group">
						<div class="input-group">
							<input type="text" name="role" value="{if $role.name}{$role.name|escape}{/if}" class="form-control" placeholder="តួនាទី (Role)..." autofocus>
							<span class="input-group-btn">
								<button class="btn btn-success" type="submit" name="submit"><i class="glyphicon glyphicon-pencil"></i> កែប្រែ (Edit)</button>
							</span>
						</div>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<a class="btn btn-info" href="{$admin_file}?task=role"><i class="glyphicon glyphicon-remove-circle"></i>&nbsp;បោះបង់ (Cancel)</a>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<div class="input-group">
						{foreach $list_function AS $data}
							{$check = FuncPermission($data.id, $role.id)}
							<div class="checkbox">
								<label><input class="func_Check" data-id='{$data.id}' type="checkbox" name="task[]"  value="{$data.id}" {if $check eq 1}checked{/if}>{$data.title}</label>
							</div>
						 {/foreach}
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
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
