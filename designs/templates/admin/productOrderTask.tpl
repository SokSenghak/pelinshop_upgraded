{extends file="admin/layout.tpl"}
{block name="main"}
	<ul class="breadcrumb">
		<li><a href="{$admin_file}">ទំព័រដើម (Home)</a></li>
		<li class="active">ព័ត៌មានការលក់ផលិតផល (Information of Product Sold) </li>
	</ul>

	<div class="panel panel-primary">
		<div class="panel-heading"><h3 class="panel-title">ព័ត៌មានការលក់ផលិតផល (Information of Product Sold)</div>
		<div class="table-responsive">
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<form role="form" method="get" action="{$admin_file}?task=product_order" class="form-inline">
							<input type="hidden" name="task" value="product_order">
							<div class="form-group">
								<div class="input-group date">
									<input type="text" value="{$smarty.get.from|default:''|escape}" id="order_date_from" class="form-control" name="from" placeholder="ពីកាលបរិច្ឆេទលក់ (From Date of Sale)"/>
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-calendar"></span>
									</span>
								</div>
							</div>
							<div class="form-group">
								<div class="input-group date">
									<input type="text" value="{$smarty.get.to|default:''|escape}"  id="order_date_to" class="form-control" name="to" placeholder="ទៅកាលបរិច្ឆេទលក់ (To Date of Sale)" />
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-calendar"></span>
									</span>
								</div>
							</div>
							<div class="input-group">
								<input type="text" value="{$smarty.get.kwd|default:''|escape}" name="kwd" class="form-control" placeholder="ស្វែងរក (Search for)..." autofocus>
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
						<th class="text-center" width="90px;">លេខកូដលក់ <br>(Sale ID)</th>
						<th class="text-center" width="110px;">លេខ IMEI <br> (IMEI Number)</th>
						<th class="text-center" width="100px;">ឈ្មោះផលិតផល <br> (Title)</th>
						{if $smarty.session.is_login_role eq 2}
						<th class="text-center" width="100px;">តម្លៃដើម <br> (Cost)</th>
						{/if}
						<th class="text-center">តម្លៃលក់ <br> (Price)</th>
						<th class="text-center">ក្រុមហ៊ុនផលិត <br> (Product Maker)</th>
						<th class="text-center">ម៉ាកផលិតផល <br> (Product Brand)</th>
						<th class="text-center">គុណភាពផលិតផល <br> (Product Used)</th>
						<th class="text-center" width="120px;">កាលបរិច្ឆេទការលក់ <br> (Date of Sale)</th>
						<th class="text-center" width="130px">សកម្មភាព <br> (Action)</th>
					</thead>
					<tbody>
						{if $list_product_order_data|@count gte 1}
							{foreach from=$list_product_order_data item=data}
								<tr>
									<td class="text-center" valign="top">
										<a data-toggle="tooltip" data-original-title="View Order Information" class="btn btn-success btn-xs" href="{$admin_file}?task=order_list&amp;action=view&amp;id={$data.order_id}">
											{$data.order_id}
										</a>
									</td>
									<td class="text-center" valign="top">{$data.imei}</td>
									<td>{$data.title}</td>
									{if $smarty.session.is_login_role eq 2}
									<td class="text-center" valign="top">
										$ {$data.cost|number_format:2}
										{if $smarty.session.is_login eq 'admin'}
											<button type="button" class="btn btn-xs btn-info" data-toggle="modal" data-target="#update_cost_{$data.imei}">
												<i class="glyphicon glyphicon-edit"></i> កែប្រែ (Edit)
											</button>
										
											<div class="modal fade" id="update_cost_{$data.imei}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
														<h4 class="modal-title" id="myModalLabel"> ការបញ្ជាក់ (Confirmation Required)</h4>
														</div>
														<form action="{$admin_file}?task=product_order&amp;action=update_cost" method="post">
															<div class="modal-body">
																<p> តើអ្នកប្រាកដថាចង់ផ្លាស់ប្តូរតម្លៃផលិតផលនេះ <label class="label label-info">{$data.imei} ~ {$data.title} </label> ? </p>
																<p> Are you sure want to change price this product imei <label class="label label-info">{$data.imei} ~ {$data.title} </label> ? </p>
																<input type="hidden" name="id" value="{$data.order_id}">
																<input type="hidden" name="imei" value="{$data.imei}">
																<br><br>
																<div class="form-group">
																	<label for="cost" style="float: left;">តម្លៃដើម (Cost): <span style="color: red;">*</span></label>
																	<input type="text" name="cost" id="cost" class="form-control" placeholder="Ex: 120" value=""/>
																</div>
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-xs btn-default" data-dismiss="modal">បោះបង់ (Cancel) </button>
																<button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-ok"></i> យល់ព្រម (Agree)</a>
															</div>
														</form>
													</div>
												</div>
											</div>
										{/if}
									</td>
									{/if}
									<td class="text-center" valign="top">$ {$data.price|number_format:2}</td>
									<td class="text-center">{$data.maker_name}</td>
									<td class="text-center">{$data.brand_name}</td>
									<td class="text-center">{$data.pro_used_name}</td>
									<td class="text-center" valign="top">{$data.ordered_item_at|date_format:'%Y-%m-%d'}</td>
									<td class="text-center" valign="top">
										
										{if $data.returned eq 2}
											<span class="label label-warning" style="background-color: #4CAF50; /* Green */ padding: 7px 8px; text-align: center;
											display: inline-block; border-radius: 3px; margin: 4px 2px;">ផលិតផលបានបញ្ជូនត្រឡប់ចូលស្តុក</span>
										{else}
											{if $data.status eq 1}
												<span title="ផលិតផលបញ្ជូនត្រលប់ (Product Return)" data-toggle="tooltip" data-placement="top">
													<button type="button" class="btn btn-xs btn-info mg-b-5" data-toggle="modal" data-target="#return_{$data.imei}">
														<i class="glyphicon glyphicon-check"></i>&nbsp;បញ្ជូនត្រឡប់​ (Return)
													</button>
													<div class="modal fade" id="return_{$data.imei}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
														<div class="modal-dialog">
															<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span> </button>
																	<h4 class="modal-title" id="myModalLabel">តម្រូវឱ្យមានការបញ្ជាក់ (Confirmation Required)</h4>
																</div>
																<form action="{$admin_file}?task=product_order&amp;action=return" method="post">
																	<div class="modal-body">
																	តើ​អ្នក​ប្រាកដ​ជា​ចង់​អនុញ្ញាត​ចំពោះ IMEI ផលិតផល​នេះ​ (Are you sure want to allow this product imei)  <label class="label label-info">{$data.imei} </label> ដើម្បីបញ្ជូនត្រលប់ទេ (to return) ?
																		<input type="hidden" name="orid" value="{$data.order_id}">
																		<input type="hidden" name="id" value="{$data.id}">
																		<div class="form-group">
																		{* <label for="note" style="float: left;">សម្គាល់ (Note): <span style="color: red;">*</span></label>
																			<textarea class="form-control" rows="3" id="note" name="note" required></textarea>
																		</div> *}
																	</div>
																	<div class="modal-footer">
																		<button type="button" class="btn btn-xs btn-default" data-dismiss="modal">　បោះបង់ (Cancel) </button>
																		<!-- <a class="btn btn-xs btn-danger" href="{$admin_file}?task=product_order&amp;action=return&amp;id={$data.order_id}&amp;imei={$data.imei}"><i class="glyphicon glyphicon-ok"></i>&nbsp;Agree</a> -->
																		<button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-ok"></i>&nbsp;យល់ព្រម (Agree)</a>
																	</div>
																</form>
															</div>
														</div>
													</div>
												</span> 
												{else} 
													<span class="label label-warning" style="background-color: #4CAF50; /* Green */ padding: 7px 8px; text-align: center;
													display: inline-block; border-radius: 3px; margin: 4px 2px;">មិនអាចដំណើរការ! ពីព្រោះអតិថិជនបានបង់</span>
												
													<span title="ផលិតផលបញ្ជូនត្រលប់ (Product Return)" data-toggle="tooltip" data-placement="top">
													<button type="button" class="btn btn-xs btn-info mg-b-5" data-toggle="modal" data-target="#return_{$data.imei}" style="margin-bottom=10px">
														<i class="glyphicon glyphicon-check"></i>&nbsp;បញ្ជូនត្រឡប់ចូលស្តុក​ (Return)
													</button>
													<div class="modal fade" id="return_{$data.imei}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
														<div class="modal-dialog">
															<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span> </button>
																	<h4 class="modal-title" id="myModalLabel">តម្រូវឱ្យមានការបញ្ជាក់ (Confirmation Required)</h4>
																</div>
																<form action="{$admin_file}?task=product_order&amp;action=return_to_Stock" method="post">
																	<div class="modal-body">
																	តើ​អ្នក​ប្រាកដ​ជា​ចង់​អនុញ្ញាត​ចំពោះ IMEI ផលិតផល​នេះ​ចូលស្តុក (Are you sure want to allow this product imei​ return to stock)  <label class="label label-info">{$data.imei} </label> ដើម្បីបញ្ជូនត្រលប់ទេ (to return) ?
																		<input type="hidden" name="orid" value="{$data.order_id}">
																		<input type="hidden" name="id" value="{$data.id}">
																		<div class="form-group">
																	</div>
																	<div class="modal-footer">
																		<button type="button" class="btn btn-xs btn-default" data-dismiss="modal">　បោះបង់ (Cancel) </button>
																		<button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-ok"></i>&nbsp;យល់ព្រម (Agree)</a>
																	</div>
																</form>
															</div>
														</div>
													</div>
												</span> 
											{/if}
										{/if}
										{* {if $smarty.session.is_login eq 'admin'}
										<span title="លុបផលិតផលដែលបានលក់ (Delete Product Sold)" data-toggle="tooltip" data-placement="top">
											<button type="button" class="btn btn-xs btn-danger mg-b-5" data-toggle="modal" data-target="#deleted_{$data.imei}">
												<i class="glyphicon glyphicon-trash"></i> លុប (Delete)
											</button>
											<div class="modal fade" id="deleted_{$data.imei}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
															<h4 class="modal-title" id="myModalLabel">តម្រូវឱ្យមានការបញ្ជាក់ (Confirmation Required)</h4>
														</div>
														<div class="modal-body">
															តើអ្នកពិតជាចង់លុបលេខ IMEI របស់ផលិតផលនេះ (Are you sure want to delete this product imei)  <label class="label label-info">{$data.imei} </label> ?
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-xs btn-default" data-dismiss="modal">　បោះបង់ (Cancel) </button>
															<a class="btn btn-xs btn-danger" href="{$admin_file}?task=product_order&amp;action=delete&amp;orid={$data.order_id}&amp;id={$data.id}"><i class="glyphicon glyphicon-ok"></i>&nbsp;យល់ព្រម (Agree)</a>
														</div>
													</div>
												</div>
											</div>
										</span>
										{/if} *}
									</td>
								</tr>
							{/foreach}
						{else}
							<tr><td class="text-center" colspan="9"><h4>There is no information.</h4></td></tr>
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
$(function () {
  $('#order_date_from').datetimepicker({
    lang: 'en',
    format: 'Y-m-d',
    timepicker: false
  });
  $('#order_date_to').datetimepicker({
    lang: 'en',
    format: 'Y-m-d',
    timepicker: false
  });
});

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
