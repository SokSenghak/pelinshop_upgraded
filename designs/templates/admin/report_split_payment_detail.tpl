{extends file="admin/layout.tpl"}
{block name="main"}
    <ol class="breadcrumb" style="margin-bottom: 10px;">
        <li><a href="{$admin_file}?task=calendar"><i class="fa fa-home"></i> ទំព័រដើម/Home </a></li>
        <li class="active"><span><i class="fa fa-calendar"></i> បងបណ្ដាក់/Split Payment </span></li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                {* <div class="panel-heading">
                    <h3 class="panel-title font-text">ព​ត៌​មាន​ទូទាត់ទឹកប្រាក់/Payment information</h3>
                </div> *}
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3">
                                    ឈ្មោះអតិថិជន (Customer Name)&nbsp;:
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
                                    : {$customerInfo.email}
                                </div>
                            </div>
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
                <div class="row">
                    <div class="col-md-12">
                        <form role="form" method="get" action="{$admin_file}?task=order_list" class="form-inline">
                            <input type="hidden" name="task" value="report_split_payment">
                            <input type="hidden" name="action" value="detail">
                            <input type="hidden" name="cus_id" value="{$smarty.get.cus_id}">
                            <div class="form-group">
                                <div class="input-group date">
                                    <input type="text" id="order_date_from" value ="{$smarty.get.from|escape}" class="form-control" name="from" placeholder="កាលបរិច្ឆេទបញ្ជាទិញពី (Order Date From)" autocomplete="off" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group date" >
                                    <input type="text" id="order_date_to" value ="{$smarty.get.to|escape}" class="form-control" name="to" placeholder="ទៅកាលបរិច្ឆេទបញ្ជាទិញ (Order Date To)" autocomplete="off" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <select name="branch" class="form-control">
                                <option value="">ជ្រើសរើសសាខា (Select Branch)</option>
                                {foreach from=$list_branch_name item="branch"}
                                <option value="{$branch.id}" {if $smarty.get.branch|escape eq $branch.id}selected{/if}>{$branch.name}</option>
                                {/foreach}
                                </select>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success" type="submit"><li class="glyphicon glyphicon-search"></li></button>
                                {if $check_search eq 1}
                                <a href="{$admin_file}?task=report_split_payment&amp;action=print&amp;cus_id={$smarty.get.cus_id}&amp;from={$smarty.get.from}&amp;to={$smarty.get.to}&amp;branch={$smarty.get.branch}" class="btn btn-primary" target="_blank">
                                    <li class="glyphicon glyphicon-search"></li> បោះពុម្ពរបាយការណ៍ (Print Report)
                                </a>
                                {else}
                                    <span style="color:red"> សូមស្វែងរកធំបំផុតបីខែ ដើម្បីបោះពុម្ព</span>
                                {/if}
                            </div>

                        </form>
                    </div>
                </div>
                <hr style="margin-top:5px;margin-bottom:5px;" />

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table_header">
                            <th>លេខ <br>(Sale ID)</th>
                            <th>ឈ្មោះបុគ្គលិក <br>(Staff Name)</th>
                            <th>សាខា <br> (Branch)</th>
                            <th>សរុប <br> (Total)</th>
                            <th>ទឹកប្រាក់បានបង់ <br> (Total Split)</th>
                            <th>កាលបរិច្ឆេទលក់ <br> (Date Of Sale)</th>
                            <th>&nbsp;</th>
                        </thead>
                        <tbody>
                            {if $listAllInvoice|@count gt 0}
                                {foreach from=$listAllInvoice item=data}
                                <tr>
                                    <td>
                                        <a href="{$admin_file}?task=order_list&amp;action=view&amp;id={$data.id}">{$data.id}</a>
                                        {if $data.status eq 1}
                                            <br>
                                            <span class="label label-warning">មិនទាន់បញ្ចប់បង់ (Unpaid)</span>
                                        {else}
                                            <br>
                                            <span class="label label-success">វិក្កយបត្របងរួច (Paid invoice)</span>
                                        {/if}
                                    </td>
                                    <td>{$data.staff_name}</td>
                                    <td>{$data.branch_name}</td>
                                    <td>$ {$data.total|number_format:2}</td>
                                    <td>$ {$data.total_payment|number_format:2} </td>
                                    <td>{$data.ordered_at|date_format:'%Y-%m-%d'}</td>
                                    <td>
                                        <table class="table table-bordered">
                                            <thead class="table_header">
                                                <tr>
                                                    <th class="text-right">សរុបដុល្លារ <br> Total Dollar</th>
                                                    <th class="text-center">ថ្ងៃបង់ប្រាក់ <br > Pay Date</th>
                                                </tr>
                                            </thead>
                                            {if $data.invoicedata|@count gt 0}
                                            <tbody>
                                            {foreach from=$data.invoicedata item=show}
                                                <tr>
                                                    <td class="text-right">{$show.payment_invoice|@number_format:2:".":","} $</td>
                                                    <td class="text-center">
                                                        {$show.pay_date}
                                                    </td>
                                                </tr>
                                            {/foreach}
                                            </tbody>
                                            {else}
                                            <tbody>
                                                <tr>
                                                    <td class="text-center" colspan="8">&nbsp;</td>
                                                </tr>
                                            </tbody>
                                            {/if}
                                        </table>
                                    </td>
                                </tr>
                                {/foreach}
                            {else}
                                <tr><td class="text-center" colspan="8"><h4>មិនមានព័ត៌មានបញ្ជីបញ្ជាទិញទេ។ (There is no order list information.)</h4></td></tr>
                            {/if}
                        </tbody>
                    </table>
                </div>
                {include file="common/paginate.tpl"}
            </div>
        </div>
    </div>
</div>
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
</script>
{/block}