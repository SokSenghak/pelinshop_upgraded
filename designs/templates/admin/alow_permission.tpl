{extends file="admin/layout.tpl"}
{block name="main"}
<ul class="breadcrumb">
  <li><a href="{$admin_file}">ទំព័រដើម (Home)</a></li>
  <li class="active">កំណត់ (Setting)</li>
  <li class="active">ព័ត៌មានការអនុញ្ញាត (Permission Information)</li>
</ul>
{if $error}
<div class="alert alert-danger" data-dismiss="alert">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  {if $error.company eq 1}សូមបញ្ចូលឈ្មោះតួនាទី។ (Please enter role name.){/if}
</div>
{/if}

<div class="panel panel-primary">
  <div class="panel-heading"><h3 class="panel-title">បញ្ជីការអនុញ្ញាត (Permission List)</h3></div>
  <div class="panel-body">
    <div class="row">
      <table class="table table-bordered table-striped table-hover">
        <thead class="table_header">
          <th>ឈ្មោះតួនាទី (Task Name)</th>
          <th>ស្ថានភាព (Status)</th>
        </thead>
        <tbody>
          	{if $list_permission_data|@count gt 0}
				{foreach $list_permission_data AS $data}
					<tr>
						<td>{$data.task_name}</td>
						<td>
							{if $data.status eq 1} 
								<button type="button" class="btn radius-50 btn-danger btn-sm" data-toggle="modal" data-target="#myModal_{$data.id}" > No  </button>
								<div class="modal fade" id="myModal_{$data.id}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
											</button>
											<h4 class="modal-title" id="myModalLabel">តម្រូវឱ្យមានការបញ្ជាក់ (Confirmation Required)</h4>
											</div>
											<div class="modal-body">តើ​អ្នក​ប្រាកដ​ជា​ចង់​ផ្អាក​តួនាទី​នេះ (Are you sure want to Suspend this role) ? </div>
											<div class="modal-footer">
											<button type="button" class="btn btn-xs btn-default" data-dismiss="modal">　បោះបង់ (Cancel) </button>
											<a class="btn btn-xs btn-success" href="{$admin_file}?task=permission&amp;action=status&amp;id={$data.id}&amp;status=2">បើកដំណើរការ (Open)</a>
											</div>
										</div>	
									</div>
								</div>
							{else} 
								<button type="button" class="btn radius-50 btn-success btn-sm" data-toggle="modal" data-target="#myModal_{$data.id}" > Yes  </button>
								<div class="modal fade" id="myModal_{$data.id}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
											</button>
											<h4 class="modal-title" id="myModalLabel">តម្រូវឱ្យមានការបញ្ជាក់ (Confirmation Required)</h4>
											</div>
											<div class="modal-body">តើ​អ្នក​ប្រាកដ​ជា​ចង់​ផ្អាក​តួនាទី​នេះ (Are you sure want to Suspend this role) ? </div>
											<div class="modal-footer">
											<button type="button" class="btn btn-xs btn-default" data-dismiss="modal">　បោះបង់ (Cancel) </button>
											<a class="btn btn-xs btn-danger" href="{$admin_file}?task=permission&amp;action=status&amp;id={$data.id}&amp;status=1">ផ្អាកដំណើរការ (Suspend)</a>
											</div>
										</div>	
									</div>
								</div>
							{/if}
						</td>
					</tr>
				{/foreach}
			{else}
				<tr><td class="text-center" colspan="3"><h4>មិនមានទិន្នន័យការអនុញ្ញាត (There is no Permission information.)</h4></td></tr>
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
