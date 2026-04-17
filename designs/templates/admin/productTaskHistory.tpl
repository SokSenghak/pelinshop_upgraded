{extends file="admin/layout.tpl"}
{block name="main"}
	<ul class="breadcrumb">
		<li><a href="{$admin_file}">ទំព័រដើម (Home)</a></li>
		<li class="active">ប្រវត្តិផលិផល (Product History)</li>
	</ul>
	<div class="panel panel-primary">
		<div class="panel-heading">
		ប្រវត្តិផលិផល (Product History)
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-12">
					<form role="form" method="get" action="{$admin_file}" class="form-inline">
						<input type="hidden" name="task" value="product_history">
						<div class="form-group" style="margin-bottom: 5px;">
						<div class="input-group date">
							<input type="text" id="date_from" value ="{if $smarty.get.from|default:''}{$smarty.get.from|default:''|escape}{else}{$from_date}{/if}" class="form-control" name="from" placeholder="ពីកាលបរិច្ឆេទបញ្ជាទិញ (Order Date From)"/>
							<span class="input-group-addon">
							<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>
						</div>
						<div class="form-group" style="margin-bottom: 5px;">
						<div class="input-group date" >
							<input type="text" id="date_to" value ="{if $smarty.get.to|default:''}{$smarty.get.to|default:''|escape}{else}{$to_date}{/if}" class="form-control" name="to" placeholder="ទៅកាលបរិច្ឆេទបញ្ជាទិញ (Order Date To)" />
							<span class="input-group-addon">
							<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>
						</div>
						<div class="form-group" style="margin-bottom: 5px;">
							<button class="btn btn-success" type="submit"><li class="glyphicon glyphicon-search"></li>&nbsp;ស្វែងរក (Search)</button>
							<a href="{$admin_file}?task=product_history&amp;action=print&amp;from={$smarty.get.from|default:''|escape}&amp;to={$smarty.get.to|default:''|escape}" class="btn btn-primary" target="_blank">
								<li class="glyphicon glyphicon-search"></li> បោះពុម្ពរបាយការណ៍ (Print Report)
							</a>
						</div>
					</form>
				</div>
			</div>
      <!-- Nav tabs -->
      <ul class="nav nav-pills" role="tablist">
        <li role="presentation" class="{if !$smarty.get.tab|default:'' or $smarty.get.tab|default:'' eq 1 } active {/if} khmer-first-font"><a href="{$admin_file_name}?task=product_history&from={$smarty.get.from|default:''|escape}&to={$smarty.get.to|default:''|escape}&tab=1"><i class="fa fa-line-chart"></i> ព័ត៌មានផលិតផល កាត់ស្តុក</a></li>
        <li role="presentation" class="{if $smarty.get.tab|default:'' and $smarty.get.tab|default:'' eq 2 } active {/if} khmer-first-font"><a href="{$admin_file_name}?task=product_history&from={$smarty.get.from|default:''|escape}&to={$smarty.get.to|default:''|escape}&tab=2"><i class="fa fa-flag"></i> ព័ត៌មានផលិតផល មិនកាត់ស្តុក</a></li>
      </ul>
      <!-- Tab panes -->
      <div class="tab-content">
      <div role="tabpanel" class="tab-pane {if !$smarty.get.tab|default:'' or $smarty.get.tab|default:'' eq 1 } active {/if}" id="cutting">
          <hr style="margin-top:5px;margin-bottom:5px;" />
          <div class="table-responsive">
            <table class="table table-bordered table-striped">
              <thead class="table_header">
                <tr>
                  <th>កាលបរិច្ឆេទ (Date)</th>
                  <th>តម្លៃដើម (Cost)</th>
                  <th>ការពិពណ៌នា (Description)</th>
                  <th>សរុប (Total PSC)</th>
                  <th>លក់សរុប (Total Sale)</th>
                  <th>ចំនួននៅសល់ (Amount left)</th>
                </tr>
              </thead>
              <tbody>
              {if $list_product_history|@count gt 0}
                {foreach from=$list_product_history item=data key=k name=foo}
                <tr>
                  <td>{$data.created_at|date_format}</td>
                    <td>
              <b>&nbsp;</b>
              {foreach from=$data.products item=v}
                {if $smarty.session.is_login eq 'admin'}
                  <p> 
                    $ {$v.cost|number_format:2}
                    <button type="button" class="btn btn-xs btn-info" data-toggle="modal" data-target="#update_cost_{$v.imei}" style="padding: 0px 5px; font-size: 11px;">
                      <i class="glyphicon glyphicon-edit"></i> កែប្រែ (Edit)
                    </button>
                  </p>
                
                  <div class="modal fade" id="update_cost_{$v.imei}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"> ការបញ្ជាក់ (Confirmation Required)</h4>
                        </div>
                        <form action="{$admin_file}?task=product_history&amp;action=update_cost" method="post">
                          <div class="modal-body">
                            <p> តើអ្នកប្រាកដថាចង់ផ្លាស់ប្តូរតម្លៃផលិតផលនេះ <label class="label label-info">{$v.title} / {$v.pro_storage} / {$v.color_name} </label> ? </p>
                            <p> Are you sure want to change price this product imei <label class="label label-info">{$v.title} / {$v.pro_storage} / {$v.color_name} </label> ? </p>
                            <input type="hidden" name="storage_id" value="{$v.storage_id}">
                            <input type="hidden" name="color_id" value="{$v.color_id}">
                            <input type="hidden" name="maker_id" value="{$v.maker_id}">
                            <input type="hidden" name="product_title" value="{$v.title}">
                            <input type="hidden" name="company_title" value="{$data.company_title}">
                            <input type="hidden" name="date_from" value ="{if $smarty.get.from|default:''}{$smarty.get.from|default:''|escape}{else}{$from_date}{/if}"/>
                            <input type="hidden" name="date_to" value ="{if $smarty.get.to|default:''}{$smarty.get.to|default:''|escape}{else}{$to_date}{/if}" />
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
                  <hr style="border-top: 1px solid #959595; margin-top: 10px; margin-bottom: 10px;">
                {/if}
              {{/foreach}}
            </td>
                  <td>
                    <b><u>{$data.company_title}</u></b>
                    {foreach from=$data.products item=v}
                      <p>{$v.title} / {$v.pro_storage} / {$v.color_name}</p>
                      <hr style="border-top: 1px solid #959595; margin-top: 10px; margin-bottom: 10px;">
                    {{/foreach}}
                  </td>
                  <td>
                    <b>&nbsp;</b>
                    {foreach from=$data.products item=v}
                      <p>{$v.total_product}</p>
                      <hr style="border-top: 1px solid #959595; margin-top: 10px; margin-bottom: 10px;">
                    {{/foreach}}
                  </td>
                  <td>
                    <b>&nbsp;</b>
                    {foreach from=$data.products item=v}
                      <p>{$v.total_sale}</p>
                      <hr style="border-top: 1px solid #959595; margin-top: 10px; margin-bottom: 10px;">
                    {{/foreach}}
                  </td>
                  <td>
                    <b>&nbsp;</b>
                    {foreach from=$data.products item=v}
                      <p>{$v.total_product - $v.total_sale}</p>
                      <hr style="border-top: 1px solid #959595; margin-top: 10px; margin-bottom: 10px;">
                    {{/foreach}}
                  </td>
                </tr>
                {/foreach}
              {else}
                <tr><td colspan="13"><h4>មិនមានព័ត៌មានអំពីផលិតផលទេ។ (There is no product information.)</h4></td></tr>
              {/if}
              </tbody>
            </table>
          </div>
      </div>
    <div role="tabpanel" class="tab-pane {if $smarty.get.tab|default:'' and $smarty.get.tab|default:'' eq 2 } active {/if}" id="no-cutting">
      <hr style="margin-top:5px;margin-bottom:5px;" />
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
          <thead class="table_header">
            <tr>
              <th>កាលបរិច្ឆេទ (Date)</th>
              <th>តម្លៃដើម (Cost)</th>
              <th>ការពិពណ៌នា (Description)</th>
              <th>សរុប (Total PSC)</th>
              <th>លក់សរុប (Total Sale)</th>
              <th>ចំនួននៅសល់ (Amount left)</th>
            </tr>
          </thead>
          <tbody>
          {if $list_product_history|@count gt 0}
            {foreach from=$list_product_history item=data key=k name=foo}
            <tr>
              <td>{$data.created_at|date_format}</td>
                <td>
          <b>&nbsp;</b>
          {foreach from=$data.products item=v}
            {if $smarty.session.is_login eq 'admin'}
              <p> 
                $ {$v.cost|number_format:2}
                <button type="button" class="btn btn-xs btn-info" data-toggle="modal" data-target="#update_cost_no_cutting_{$v.imei}" style="padding: 0px 5px; font-size: 11px;">
                  <i class="glyphicon glyphicon-edit"></i> កែប្រែ (Edit)
                </button>
              </p>
            
              <div class="modal fade" id="update_cost_no_cutting_{$v.imei}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"> ការបញ្ជាក់ (Confirmation Required)</h4>
                    </div>
                    <form action="{$admin_file}?task=product_history&amp;action=update_cost" method="post">
                      <div class="modal-body">
                        <p> តើអ្នកប្រាកដថាចង់ផ្លាស់ប្តូរតម្លៃផលិតផលនេះ <label class="label label-info">{$v.title} / {$v.pro_storage} / {$v.color_name} </label> ? </p>
                        <p> Are you sure want to change price this product imei <label class="label label-info">{$v.title} / {$v.pro_storage} / {$v.color_name} </label> ? </p>
                        <input type="hidden" name="storage_id" value="{$v.storage_id}">
                        <input type="hidden" name="color_id" value="{$v.color_id}">
                        <input type="hidden" name="maker_id" value="{$v.maker_id}">
                        <input type="hidden" name="product_title" value="{$v.title}">
                        <input type="hidden" name="company_title" value="{$data.company_title}">
                        <input type="hidden" name="date_from" value ="{if $smarty.get.from|default:''}{$smarty.get.from|default:''|escape}{else}{$from_date}{/if}"/>
                        <input type="hidden" name="date_to" value ="{if $smarty.get.to|default:''}{$smarty.get.to|default:''|escape}{else}{$to_date}{/if}" />
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
              <hr style="border-top: 1px solid #959595; margin-top: 10px; margin-bottom: 10px;">
            {/if}
          {{/foreach}}
        </td>
              <td>
                <b><u>{$data.company_title}</u></b>
                {foreach from=$data.products item=v}
                  <p>{$v.title} / {$v.pro_storage} / {$v.color_name}</p>
                  <hr style="border-top: 1px solid #959595; margin-top: 10px; margin-bottom: 10px;">
                {{/foreach}}
              </td>
              <td>
                <b>&nbsp;</b>
                {foreach from=$data.products item=v}
                  <p>{$v.total_stock_increase}</p>
                  <hr style="border-top: 1px solid #959595; margin-top: 10px; margin-bottom: 10px;">
                {{/foreach}}
              </td>
              <td>
                <b>&nbsp;</b>
                {foreach from=$data.products item=v}
                  <p>{$v.total_stock_decrease}</p>
                  <hr style="border-top: 1px solid #959595; margin-top: 10px; margin-bottom: 10px;">
                {{/foreach}}
              </td>
              <td>
                <b>&nbsp;</b>
                {foreach from=$data.products item=v}
                  <p>{$v.total_stock_increase - $v.total_stock_decrease}</p>
                  <hr style="border-top: 1px solid #959595; margin-top: 10px; margin-bottom: 10px;">
                {{/foreach}}
              </td>
            </tr>
            {/foreach}
          {else}
            <tr><td colspan="13"><h4>មិនមានព័ត៌មានអំពីផលិតផលទេ។ (There is no product information.)</h4></td></tr>
          {/if}
          </tbody>
        </table>
      </div>
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
  $('#date_from').datetimepicker({
    lang: 'en',
    format: 'Y-m-d',
    timepicker: false
  });
  $('#date_to').datetimepicker({
    lang: 'en',
    format: 'Y-m-d',
    timepicker: false
  });

  $('[data-toggle="tooltip"]').tooltip({
    placement : 'top'
  });

  var sum = 0;
  $('.chk_print').each(function(i, el){
    if(el.checked == true) sum += 1;
  });

  if(sum == 30) $("#chk_print_all").prop("checked", true);

});

function viewModal(product_id) {
  $('#showModal').modal('show');
  $('#showModal').on('shown.bs.modal', function () {
    $('#phone_imei').focus()
  })
  $('#product_id').val(product_id);
  $('#showModal').on('hidden.bs.modal', function (e) {
  $(this)
    .find("input")
       .val('')
       .end()
  })
}

function cloneProduct() {
  var product_id = $("#product_id").val();
  var product_imei = $("#phone_imei").val();
  var param_data = { product_id: product_id, product_imei: product_imei };
  jQuery.ajax( {
    type: 'POST',
    url: 'admin.php?task=product&action=clone',
    dataType:'json',
    data: param_data,
    success:function(data){
      if(data.product_id !== null) {
        $("#confirmBox").modal('show');
        setTimeout(function(){  $('#confirmBox').modal('hide')  }, 2000);
        location.reload();
      } else {
        $("#ExistedImei").modal('show');
        setTimeout(function(){  $('#ExistedImei').modal('hide')  }, 2000);
      }

    },
    error: function(data) {
      alert('Your process clone has problem!.');
    }
  } );
}

function remove(array, element) {
  const index = array.indexOf(element);
  if (index !== -1) {
      array.splice(index, 1);
  }
}

$(document).on('click','.chk_print',function()
{
  $('.loader').show();
  var value = this.value;
  var status = 0;
  if(this.checked == true)
  {
    var status = 2;
  } else {
    status = 1;
  }
  var param_data = { product_id: value, status: status };

  $.ajax({
    type: 'POST',
    url: 'admin.php?task=product&action=data_print',
    dataType:'json',
    data: param_data,
    success:function(data){
      var sum = 0;
      $('.chk_print').each(function(i, el){
        if(el.checked == true) sum += 1;
      });
      if(sum == 30)
      {
        $("#chk_print_all").prop("checked", true);
      } else {
        $("#chk_print_all").prop("checked", false);
      }

      $('#total_sel').text(data);
      $('.loader').hide();
    },
    error: function(data) {
      alert('Your process check has problem!.');
    }
  } );


});

$(document).on('click','#remove_pro',function()
{
  $('.loader').show();

  var param_data = { status: 3 };

  $.ajax({
    type: 'POST',
    url: 'admin.php?task=product&action=data_print',
    dataType:'json',
    data: param_data,
    success:function(data){
      if(data == 0)
      {
        $(".chk_print").prop("checked", false);
      }
      var sum = 0;
      $('.chk_print').each(function(i, el){
        if(el.checked == true) sum += 1;
      });
      if(sum == 30)
      {
        $("#chk_print_all").prop("checked", true);
      } else {
        $("#chk_print_all").prop("checked", false);
      }

      $('#total_sel').text(data);
      $('.loader').hide();
    },
    error: function(data) {
      alert('Your process remove has problem!.');
    }
  } );


});

$(document).on('click','#chk_print_all',function()
{
  $('.loader').show();
  var product = [];
  var value = this.value;

  $('.chk_print').each(function(i, el){
    var val = $(el).val();
    product.push(val);
  });

  if(this.checked == true)
  {
    var status = 2;
  } else {
    var status = 1;
  }

  var param_data = { status: status,  product_id: JSON.stringify(product) };

  $.ajax({
    type: 'POST',
    url: 'admin.php?task=product&action=data_print_all',
    dataType:'json',
    data: param_data,
    success:function(data){
      if(status == 1)
      {
        $(".chk_print").prop("checked", false);
      } else {
        $(".chk_print").prop("checked", true);
      }
      $('#total_sel').text(data);
      $('.loader').hide();
    },
    error: function(data) {
      alert('Your process select all has problem!.');
    }
  } );


});

function number_print()
{
  var num_p = $('#num_print').val();
  $('#href_print').attr('href', '{$admin_file}?task=product&action=all_qrcode_print&num_print='+num_p);
}
</script>
{/block}
