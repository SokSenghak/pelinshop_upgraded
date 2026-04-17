{extends file="admin/layout.tpl"}
{block name="main"}
    <ul class="breadcrumb">
        <li><a href="{$admin_file}">ទំព័រដើម (Home)</a></li>
        <li class="active">ព័ត៌មាន​នៃ​កំណត់​សម្គាល់​ផលិតផល (Information of Product Note) </li>
    </ul>
     {if $error}
    <div class="alert alert-danger">
    	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		{if $error.note eq 1}សូមបញ្ចូលចំណុចបញ្ហា។ (Please enter Note.)<br/>{/if}
		{if $error.note_detail eq 1}សូមបញ្ចូលចំណាំ។ (Please enter Note Details.)<br/>{/if}
    </div>
  {/if}
    <div class="panel panel-primary">
        <div class="panel-heading">
            <form class="form-horizontal" role="form" method="get" action="admin.php">
                <input type="hidden" name="task" value="product_note">
                <div class="input-group">
                    <input type="text" name="imei" value="{if $smarty.get.imei|default:''}{$smarty.get.imei|default:''|escape}{/if}" id="search_imei"
                        class="form-control" placeholder="ស្វែងរកតាមរយៈលេខ IMEI (Type for search by imei)" autofocus>
                    <span class="input-group-btn">
                        <button class="btn btn-success" type="submit" id="btn_by_imei">
                            <li class="glyphicon glyphicon-search"></li>
                        </button>
                    </span>
                </div>
            </form>
        </div>
        <div class="panel-body">
            <div class="row box-custom">
                <div class="col-md-12">
                    <h4>ផលិតផលដែលបានលក់ (Product Sold)</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>សាខា (Branch)</th>
                                    <th>បុគ្គលិក (Staff)</th>
                                    <th>អតិថិជន & លេខទូរស័ព្ទ (Cus & Phone)</th>
                                    {* <th>សរុប (Total)</th> *}
                                    <th>កាលបរិច្ឆេទការលក់ (Date Of Sale)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="background-color: rgb(218, 165, 32);">
                                    <td>{$list_orderItem_data.branch_name}</td>
                                    <td>{$list_orderItem_data.staff_name}</td>
                                    <td>{$list_orderItem_data.cus_name} {$list_orderItem_data.cus_phone}</td>
                                    {* <td>{$list_orderItem_data.total|number_format:2}</td> *}
                                    <td>{$list_orderItem_data.ordered_at}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row box-custom">
                <div class="col-md-12">
                    <h4>ព័ត៌មានផលិតផល (Product Information)</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <th class="text-center">លេ​ខ IMEI (IMEI Number)</th>
                                <th class="text-center">ឈ្មោះផលិតផល (Title)</th>
                                <th class="text-center">ក្រុមហ៊ុន (Company)</th>
                                <th class="text-center">ក្រុមហ៊ុនផលិត (Maker)</th>
                                <th class="text-center">ម៉ាកផលិតផល (Brand)</th>
                                <th class="text-center">តម្លៃលក់ (Price)</th>
                                <th class="text-center">ទំហំផ្ទុក (Product Storage)</th>
                                <th class="text-center">បរិយាយ (Description)</th>
                                <th class="text-center">កាលបរិច្ឆេទចូល (Date In)</th>
                            </thead>
                            <tbody>
                                <tr id="product_list" style="background-color: rgb(218, 165, 32);">
                                    <td>{$list_imei_data.imei|default:''}</td>
                                    <td>{$list_imei_data.title|default:''}</td>
                                    <td>{$list_imei_data.company_title|default:''}</td>
                                    <td>{$list_imei_data.maker_name|default:''} </td>
                                    <td>{$list_imei_data.brand_name|default:''}</td>
                                    <td>{$list_imei_data.price|default:''}</td>
                                    <td>{$list_imei_data.storage_name|default:''}</td>
                                    <td>{$list_imei_data.description|default:''}</td>
                                    <td>{$list_imei_data.pro_date_in|default:''}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {if $list_imei_data.imei|default:null ne null}
            <div class="row box-custom">
                <div class="col-md-12">
                     <form class="form-horizontal" role="form" method="post" action="{$admin_file}?task=product_note&amp;imei={$smarty.get.imei|default:''|escape}&amp;action=add_pro_note">
                        <input type="hidden" name="note_id" value="{$edit_note.id|default:''}">
                        <div class="row">
                            <div class="col-md-12" style='padding:15px'>
                                <label for="problam">ចំនុចបញ្ហា (Note):<span style="color:red">*</span></label>
                                <input type="hidden" name="order_id" id="order_id" value="{if $list_orderItem_data.id|default:''}{$list_orderItem_data.id|default:''}{/if}">
                                <input type="hidden" name="imei" id="imei" value="{if $list_imei_data.imei|default:''}{$list_imei_data.imei|default:''}{/if}">
                                <div class="input-group" style="width: 100%">
                                    <select id="searchnote" class="form-control font_siemreap" name="note">
                                        <option>{if $edit_note.note|default:''}{$edit_note.note|default:''}{/if}</option>
                                    </select>
                                    {* <input type="text" name="note" class="form-control" placeholder="បញ្ចូលបញ្ហាទូរស័ព្ទ (Enter error phone)"> *}
                                </div>
                            </div>
                        </div>
                        <div class="row" style='padding:15px'>
                            <div class="form-group">
                                <label for="comment">ចំណាំ (Note):<span style="color:red">*</span></label>
                                <textarea name="note_detail" class="form-control" rows="4" id="note_detail"> {if $edit_note.note_detail|default:''}{$edit_note.note_detail|default:''}{/if}</textarea>
                            </div>
                        </div>
                        <div class="row" style='padding:15px'>
                            <input type='hidden' value='' id="_id">
                            <button class="btn btn-success" type="submit" name="submit" style="text-align: center">
                                <i class="fa fa-floppy-o" aria-hidden="true"></i> រក្សាទុក (Save)
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <br>
            {if $smarty.get.error|default:'' eq 1}
                <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>IMEI!</strong> ផលិតផលមានរួចហើយ ឬមានបញ្ហា។ (Product imei have existed or have sth problems.)
                </div>
            {/if}
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table_header">
                        <tr>
                            <th class="text-center">លេ​ខ IMEI (IMEI Number)</th>
                            <th class="text-center">ចំនុចបញ្ហា (Note)</th>
                            <th class="text-center" width="50" >ស្ថានភាព (Status)</th>
                            <th class="text-center">ថ្ងៃយក (Return day)</th>
                            <th class="text-center">ថ្ងៃទទួល (received day)</th>
                            <th class="text-center">ផ្លាស់ប្ដូរផលិតផល (Product Change)</th>
                            <th class="text-center" width="200">សកម្មភាព (Action)</th>
                        </tr>
                    </thead>
                    <tbody id="note_list">
                        {foreach from=$list_pronote_data item=pronote}
                            <tr>
                                <td>{$list_imei_data.imei|default:''}</td>
                                {* <td colspan="3" class="text-center">There are no record.</td> *}
                                <td>{$pronote.note}</td>
                                <td class='text-center'>
                                    {if $pronote.status eq 1}
                                        <span class='label label-info'>Fixing</span>
                                    {else}
                                        <span class='label label-success'>return</span>
                                    {/if}
                                </td>
                                <td>{$pronote.date_receive}</td>
                                <td>{$pronote.created_at}</td>
                                <td>{$pronote.imei_old}~{$pronote.imei_change}</td>
                                <td>
                                    {if $pronote.status eq 1}
                                        <a href="{$admin_file}?task=product_note&amp;imei={$smarty.get.imei|default:''|escape}&amp;edit_note_id={$pronote.id}"
                                        class="btn btn-info btn-sm"><span class='fa fa-pencil'></span></a>
                                    {else}
                                        <button type='button' class='btn radius-50 btn-info btn-sm' disabled><i
                                                class='fa fa-pencil'></i></button>
                                    {/if}
                                    <button type='button' class='btn radius-50 btn-primary btn-sm'  data-toggle="modal" data-target="#RepairDetail_{$pronote.id}"><i class='fa fa-eye'></i></button>
                                    {if $pronote.status eq 1}
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#return" style="text-align: center" title="បញ្ជូនត្រឡប់​ (Return)"><i class="fa fa-reply" aria-hidden="true"></i></button>
                                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#change" style="text-align: center" title="ផ្លាស់ប្ដូរផលិតផល (Change product)"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                                        <span title="លុបផលិតផល (Delete Product)" data-toggle="tooltip" data-placement="top">
                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#myModal_{$pronote.id}" ><i class="glyphicon glyphicon-trash"></i></button>
                                        </span>
                                        <!-- Modal -->
                                        <div class="modal fade" id="myModal_{$pronote.id}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                                                </button>
                                                <h4 class="modal-title" id="myModalLabel">តម្រូវឱ្យមានការបញ្ជាក់ (Confirmation Required)</h4>
                                                </div>
                                                <div class="modal-body">តើអ្នកពិតជាចង់លុបលេខ IMEI របស់ផលិតផលនេះ (Are you sure want to delete this product IMEI number) <label class="label label-danger">{$data.imei}</label> ? </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-xs btn-default" data-dismiss="modal">　បោះបង់ (Cancel) </button>
                                                <a href="admin.php?task=product_note&amp;action=delete_pro_note&amp;imei={$smarty.get.imei|default:''|escape}&amp;note_id={$pronote.id}" class="btn btn-xs btn-danger">&nbsp;លុប (Delete)</a>
                                                {* <a class="btn btn-xs btn-danger" href="{$admin_file}?task=product_note&amp;imei={$smarty.get.imei}&amp;action=delete&amp;id={$pronote.id}">　លុប (Delete)</a> *}
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        <!--End Modal-->
                                    {/if}
                                    <div class="modal fade" id="change" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_{$pronote.id}">
                                        <div class="modal-dialog">
                                            <div class="panel panel-primary modal-content">
                                                <div class="panel-heading modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h3 class="panel-title modal-title">ផ្លាស់ប្ដូរផលិតផល (Change Product)</h3>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form" data-toggle="validator" id="changeProduct" action="admin.php?task=product_note&action=change&amp;imei={$smarty.get.imei|default:''|escape}&amp;note_id={$pronote.id}" method="post">
                                                        <div class="row">
                                                            <div class="col-md-12" style="margin-bottom:5px">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">លេខ IMEI ផលិតផល (Product IMEI)</span>
                                                                    <input type="hidden" name="note_id" id="note_id" value="{$pronote.id}">
                                                                    <input type="hidden" name="imei_old" id="imei_old" value="{$pronote.imei}">
                                                                    <input type="text" id="imei_change" name="imei_change" maxlength="15" class="form-control" placeholder="លេខ IMEI (១៥ ខ្ទង់) (IMEI Number (15 digits))" required>
                                                                </div>
                                                                <div class="col-md-12" style="margin-bottom:5px; margin-top:10px;">
                                                                    <span class="input-group-btn">
                                                                        <button class="btn btn-primary" id="btn_change"
                                                                            type="submit" style="margin-bottom:5px; border-radius:5px;">ផ្លាស់ប្ដូរផលិតផល (Change Product)</button>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- confirmBox -->
                                    <div class="modal fade bs-example-modal-sm" id="confirmBox" role="alert">
                                        <div class="alert alert-primary">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                                            aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title text-center"> ព័ត៌មាន (Information)</h4>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <p><strong>ផលិតផលថ្មីត្រូវបានផ្លាស់ប្ដូរ ដោយជោគជ័យ! (New product was change
                                                            successfully!)</strong></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- confirmBox -->
                                    <div class="modal fade bs-example-modal-sm" id="ExistedImei" role="alert">
                                        <div class="alert alert-warning">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                                            aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title text-center"> ព័ត៌មាន (Information)</h4>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <p><strong>IMEI ផលិតផលមានរួចហើយ ឬមានបញ្ហា។ (Product imei have existed or have sth
                                                            problems.)</strong>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Product Change Modal -->
                                    
                                    <div class="modal fade" id="return" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_{$pronote.id}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <h4 class="modal-title">ការបញ្ជាក់ (Confirmation)</h4>
                                                </div>
                                                <div class="modal-body">តើ​អ្នក​ពិត​ជា​ចង់​បញ្ជូន​ផលិតផល​នេះ​ត្រលប់ទៅ​វិញមែនទេ? (Are
                                                    you
                                                    sure want to return this product?) </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-xs btn-default"
                                                        data-dismiss="modal">　បោះបង់
                                                        (Cancel) </button>
                                                    <a href="admin.php?task=product_note&action=return&amp;imei={$smarty.get.imei|default:''|escape}&amp;note_id={$pronote.id}" class="btn btn-xs btn-danger" id="btn_agree"><i
                                                            class="glyphicon glyphicon-ok"></i>&nbsp;យល់ព្រម (Agree)</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="modal fade" id="RepairDetail_{$pronote.id}" role="dialog">
                                    <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">ពត៏មានលំអិត (Infomation Detail)</h4>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td width="150">ចំណាំ (Note)</td>
                                                        <td width="10">:</td>
                                                        <td class="note">{$pronote.note}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>ស្ថានភាព (Status)</td>
                                                        <td>:</td>
                                                        <td class="status">
                                                        {if $pronote.status eq 1}
                                                            <span class='label label-info'>Fixing</span>
                                                        {else}
                                                            <span class='label label-success'>return</span>
                                                        {/if}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>ពត៏មាន (Details)</td>
                                                        <td>:</td>
                                                        <td class="detail">{$pronote.note_detail}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>ថ្ងៃជុសជុល (Date Fix)</td>
                                                        <td>:</td>
                                                        <td class="date_fix">{$pronote.created_at}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>ថ្ងៃទទួល (Receive Fix)</td>
                                                        <td>:</td>
                                                        <td class="return_fix">{$pronote.date_receive}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>ប្ដូរផលិតផល (Change Product)</td>
                                                        <td>:</td>
                                                        <td class="product_change"> ពី {$pronote.imei_old} ទៅ {$pronote.imei_change}​</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </td>
                            </tr>
                        {/foreach}
                    </tbody>
                </table>
            </div>
            {/if}
            {include file = "common/paginate.tpl"}
        </div>
    </div>
{/block}
{block name=javascript}
    <script>
        $(document).ready(function() {

            $.fn.select2.amd.define('select2/data/extended-ajax', ['./ajax', '../utils', 'jquery'], function(
                AjaxAdapter, Utils, $) {

                function ExtendedAjaxAdapter($element, options) {
                    //we need explicitly process minimumInputLength value
                    //to decide should we use AjaxAdapter or return defaultResults,
                    //so it is impossible to use MinimumLength decorator here
                    this.minimumInputLength = options.get('minimumInputLength');
                    this.defaultResults = options.get('defaultResults');
                    ExtendedAjaxAdapter.__super__.constructor.call(this, $element, options);
                }
                Utils.Extend(ExtendedAjaxAdapter, AjaxAdapter);

                //override original query function to support default results
                var originQuery = AjaxAdapter.prototype.query;

                ExtendedAjaxAdapter.prototype.query = function(params, callback) {
                    var defaultResults = (typeof this.defaultResults == 'function') ? this.defaultResults.call(this) : this.defaultResults;
                    if (defaultResults && defaultResults.length && (!params.term || params.term.length <this.minimumInputLength))
                    {
                        var processedResults = this.processResults(defaultResults, params.term);
                        callback(processedResults);
                    } else {
                        originQuery.call(this, params, callback);
                    }
                };

                return ExtendedAjaxAdapter;
            });

            $("#searchnote").select2({
                ajax: {
                    url: "{$index_file}",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            task: 'product_note',
                            action: 'searchnote',
                            q: params.term, // search term
                            page: params.page,
                        };
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;
                        if (data.items.length > 0) {
                            return {
                                results: data.items,
                                pagination: {
                                    more: (params.page * 20) < data.total_count
                                }
                            };
                        } else {
                            // Add new text
                            return {
                                results: [{ id: params.term, text: params.term }]
                            }
                        }
                    },
                    cache: true,
                },

                escapeMarkup: function(markup) { return markup; }, // let our custom formatter work
                minimumInputLength: 1,
                placeholder: "បញ្ចូលបញ្ហាទូរស័ព្ទ (Enter error phone)",
                dataAdapter: $.fn.select2.amd.require('select2/data/extended-ajax')
            });
            $("#searchnote_1").select2({
                tags: true,
                createTag: function(params) {
                    return {
                        id: params.term,
                        text: params.term,
                        newOption: true
                    }
                },
                templateResult: function(data) {

                    var $result = $("<span></span>");
                    $result.text(data.text);
                    console.log(data.text);

                    if (data.newOption) {
                        $result.append(" <em>(new)</em>");
                    }

                    return $result;
                }
            });

        });
    </script>
{/block}
