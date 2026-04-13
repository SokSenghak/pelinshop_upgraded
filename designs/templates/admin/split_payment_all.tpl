{extends file="admin/layout.tpl"}
{block name="main"}
    <ol class="breadcrumb" style="margin-bottom: 10px;">
        <li><a href="staff.php?task=calendar"><i class="fa fa-home"></i> ទំព័រដើម/Home </a></li>
        <li class="active"><span><i class="fa fa-calendar"></i> បងបណ្ដាក់/Split Payment </span></li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title font-text">ព​ត៌​មាន​ទូទាត់ទឹកប្រាក់/Payment information</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-3">
                                    សាខា (Branch)&nbsp;
                                </div>
                                <div class="col-md-9">
                                    : {$branch.name}<br>
                                </div>
                            </div>
				            <br/>
                            <div class="row">
                                <div class="col-md-3">
                                    ឈ្មោះ (​Name)&nbsp;:
                                </div>
                                <div class="col-md-9">
                                    : {$customerInfo.name} 
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-md-3">
                                ទូរស័ព្ទ (Phone)&nbsp;
                                </div>
                                <div class="col-md-9">
                                    : {$customerInfo.phone}
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-md-3">
                                    អុីម៉ែល (Email)&nbsp;
                                </div>
                                <div class="col-md-9">
                                    :{$customerInfo.email}
                                </div>
                            </div>
                            <br/>
                             <hr>
                        </div>
                        <div class="col-md-5">
                            {$sub_total_dollar = 0}
                            {$sub_total_dollar = $total_val_invoice.totaldollar - $total_split_invoice.split_total}
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th style="width:320px;">Total (ទឹកប្រាក់សរុបទាំងអស់) </th>
                                        <td><span>{$total_val_invoice.totaldollar|@number_format:2:".":","}</span> $</td>
                                    </tr>
                                    <tr>
                                        <th style="width:320px;">Total Split payment (ចំនួនទឹកប្រាក់បានបង់)</th>
                                        <td>{if $sub_total_dollar eq 0}0.00 $ / 0.00 ៛{else}{$total_split_invoice.split_total|@number_format:2:".":","} ${/if}</td>
                                    </tr>
                                    <tr>
                                        <th style="width:320px;">Payment Lest (ទឹកប្រាក់នៅជំពាក់)</th>
                                        <td>{if $sub_total_dollar eq 0}0.00 $ / 0.00 ៛{else}{$sub_total_dollar|@number_format:2:".":","} ${/if}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
            <h3 class="panel-title font-text">បង់បណ្ដាក់ (Split Payment)</h3>
            </div>
            <div class="panel-body">
                {if $error.is_error}
                    <div class="alert alert-danger">
                        <strong>Warning!</strong> {if $error.is_error eq 1}ដំណើរបង់មួយនេះត្រូវបានបញ្ចាប់រួចរាល់!<br/>{/if}
                    </div>
                {/if}
				 <div class="row">
          			<div class="col-md-12">
                        {if $edit_data.id}
                            <form action="{$admin_file}?task=internal_invoice&amp;action=split_payment&invoice_id={$edit_data.id}&cus_id={$smarty.get.cus_id}&amp;int_in_id={$smarty.get.int_in_id}" method="post">
                        {else}
                            <form action="{$admin_file}?task=internal_invoice&amp;action=split_payment&cus_id={$smarty.get.cus_id}&amp;int_in_id={$smarty.get.int_in_id}" method="post">
                        {/if}
					  		<div class="row">
          						<div class="col-md-5">
									<div class="form-group">
										<label for="pwd">កាលបរិច្ឆេទ (Date)</label>
										<div class="input-group date" >
											<input type="text" id="date_pay" name="date_pay" class="form-control" name="to" placeholder="កាលបរិច្ឆេទបញ្ជាបង់(Pay Date)" value="{if $edit_data.pay_date}{$edit_data.pay_date}{/if}" />
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-calendar"></span>
											</span>
										</div>
										<span style="color:red">{if $error.date_pay eq 1}សូមបញ្ចូលថ្ងៃបង់។ (Please select date.)<br/>{/if}</span>
									</div>
								</div>
								<div class="col-md-5">
                                    <div class="form-group">
                                        <label for="pwd">សរុប (Total)</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">$</span>
                                            <input type="text" name="total" class="form-control" placeholder="ចំនួនទឹកប្រាក់បង់ (Pay Amount)" value="{if $edit_data.total}{$edit_data.total}{/if}" onkeyup="NumAndTwoDecimals(event , this);">
                                            <span style="color:red">{if $error.dollar eq 1}សូមបញ្ចូលចំនួនត្រូវបង់។ (Please enter total.)<br/>{/if}</span>
                                        </div>
                                    </div>
								</div>
							</div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="note">ចំណាំ (Note)</label>
                                       <textarea class="form-control" name="note" rows="3" id="note" value="{if $edit_data.note}{$edit_data.note}{/if}"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
									<div class="form-group">
										<label for="sumit"></label>
                                        <input type="hidden" name="payment_lest" class="form-control" value="{$sub_total_dollar|@number_format:0}" onkeyup="NumAndTwoDecimals(event , this);">
                                        {if $edit_data.id}
										    <button type="submit" name='submit' class="btn btn-danger btn-block text-center" style="margin-top:5px,text-align:center">គេប្រែ (Update)</button>
                                        {else}
                                            <button type="submit" name='submit' class="btn btn-info btn-block text-center" style="margin-top:5px, text-align:center">បង់ប្រាក់ (Pay Now)</button>
                                        {/if}
									</div>
								</div>
                            </div>
						</form>
					</div>
				</div>
				<br/>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>អតិថិជន <br> Customers</th>
                                <th class="text-right">ទូរស័ព្ទ <br> Phone</th>
                                <th class="text-right">សរុបដុល្លារ <br> Total Dollar</th>
                                <th class="text-center">ថ្ងៃបង់ប្រាក់ <br > Pay Date</th>
                                <th class=" text-center"> សកម្មភាព <br> Action</th>
                            </tr>
                        </thead>
                        {if $listAllInvoice|@count gt 0}
                        {foreach from=$listAllInvoice item=show}
                            <tbody>
                                <tr>
                                    <td>{$show.cus_name}</td>
                                    <td class="text-right">
                                        {if $show.phone}
                                            {$show.phone}
                                        {else}
                                            ~
                                        {/if}
                                       
                                    </td>
                                    <td class="text-right">{$show.total|@number_format:2:".":","} $</td>
                                    <td class="text-center">
                                         {$show.pay_date}
                                    </td>
                                    <td class="text-center">
                                        <!-- edit branch -->
                                        <a href="{$admin_file}?task=internal_invoice&amp;action=split_payment&amp;invoice_id={$show.id}&amp;&cus_id={$smarty.get.cus_id}&amp;int_in_id={$smarty.get.int_in_id}" class="btn radius-50 btn-info btn-sm" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a>
                                         <span title="លុបទិន្នន័យ (Delete Invoice)" data-toggle="tooltip" data-placement="top">
                                            <button type="button" class="btn radius-50 btn-danger btn-sm" data-toggle="modal" data-target="#myModal_{$show.id}" ><i class="glyphicon glyphicon-trash"></i></button>
                                            <!-- Modal -->
                                        </span>
                                        <div class="modal fade" id="myModal_{$show.id}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                                                </button>
                                                <h4 class="modal-title" id="myModalLabel">តម្រូវឱ្យមានការបញ្ជាក់ (Confirmation Required)</h4>
                                                </div>
                                                <div class="modal-body">តើអ្នកពិតជាចង់លុបទិន្នន័យនេះមែនទេ (Are you sure want to delete) ? </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-xs btn-default" data-dismiss="modal">　បោះបង់ (Cancel) </button>
                                                <a class="btn btn-xs btn-danger" href="{$admin_file}?task=internal_invoice&amp;action=delete&amp;id={$show.id}&cus_id={$show.customer_id}&amp;int_in_id={$smarty.get.int_in_id}">　លុប (Delete)</a>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        {/foreach}
                        {else}
                        <tbody>
                            <tr>
                                <td class="text-center" colspan="8">
                                    <h4 class="font-text" style="color:red">មិនមានទិន្នន័យទេ។ / There is no record.</h4>
                                </td>
                            </tr>
                        </tbody>
                        {/if}
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
{/block}

{block name="javascript"}
<script>
	$(function () {
		$('#date_pay').datetimepicker({
			lang: 'en',
			format: 'Y-m-d H:i',
			timepicker: true
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
</script>
{/block}