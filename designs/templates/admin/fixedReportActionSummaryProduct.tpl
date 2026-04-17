{extends file="admin/layout.tpl"}
{block name="main"}
    <ul class="breadcrumb">
        <li><a href="{$admin_file}">ទំព័រដើម (Home)</a></li>
        <li class="active">របាយការណ៍ (Report)</li>
        <li class="active">របាយការណ៍ការជួសជុល (Summary Fiexd Report)</li>
    </ul>
    <div class="panel panel-primary">
        <div class="panel-heading"><h3 class="panel-title">របាយការណ៍សង្ខេបការជួសជុល (Summary Fixed Product Report)</h3></div>      
        <!--Form Search-->
        <div class="panel-body">
            <form role="form" method="get" action="{$admin_file}?task=summary_fixed_product" class="form-horizontal">
                <input type="hidden" name="task" value="summary_fixed_product">
                <div class="row">
                    <div class="col-md-6">
                    <div class="input-group" style="padding-bottom:10px;">
                        <span class="input-group-addon">កាលបរិច្ជេទធ្វើ (Date Create)</span>
                        <input type="text" name="c_from_fixed" id="c_from_fixed"  value="{if $smarty.get.c_from_fixed|default:''}{$smarty.get.c_from_fixed|default:''|escape}{elseif $c_from_fixed}{$c_from_fixed}{/if}" class="form-control" placeholder="2016-08-01" />
                        <span class="input-group-addon">ទៅ (To)</span>
                        <input type="text" name="c_to_fixed" id="c_to_fixed" value="{if $smarty.get.c_to_fixed|default:''}{$smarty.get.c_to_fixed|default:''|escape}{elseif $c_to_fixed}{$c_to_fixed}{/if}" class="form-control" placeholder="2016-08-30" />
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="input-group" style="padding-bottom:10px;">
                        <span class="input-group-addon">កាលបរិច្ជេទទទួល (Date​ Receive)</span>
                        <input type="text" name="from_fixed" id="from_fixed"  value="{if $smarty.get.from_fixed|default:''}{$smarty.get.from_fixed|default:''|escape}{elseif $from_fixed}{$from_fixed}{/if}" class="form-control" placeholder="2016-08-01" />
                        <span class="input-group-addon">ទៅ (To)</span>
                        <input type="text" name="to_fixed" id="to_fixed" value="{if $smarty.get.to_fixed|default:''}{$smarty.get.to_fixed|default:''|escape}{elseif $to_fixed}{$to_fixed}{/if}" class="form-control" placeholder="2016-08-30" />
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                    <div class="input-group" style="padding-bottom:10px;">
                        <span class="input-group-addon">លេខIMEI (IMEI)</span>
                        <input type="text" name="kwd" value="{$smarty.get.kwd|default:''|escape}" id="kwd" class="form-control" placeholder="ស្វែងរកតាមរយៈលេខ IMEI (Type for search by imei)" autofocus>
                    </div>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-success" type="submit"><i class="glyphicon glyphicon-search"></i>&nbsp;ស្វែងរក (Search)</button>
                    </div>
                </div>
            </form>
            <!-- End Form Search-->
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr class="table_header">
                            <th class="text-center">លេខ IMEI (IMEI Number)</th>
                            <th class="text-center">កំណត់សម្គាល់ (Note)</th>
                            <th class="text-center">កំណត់សម្គាល់លម្អិត (Note Detail)</th>
                            <th class="text-center">កាលបរិច្ជេទធ្វើ (Date Create)</th>
                            <th class="text-center">កាលបរិច្ជេទទទួល (Date​ Receive)</th>   
                        </tr>
                    </thead>
                    <tbody>
                        {if $list_fixedlist_data|@count gt 0}
                            {foreach from=$list_fixedlist_data item=data}
                                <tr>
                                    <td class="text-center">{$data.imei}</td>
                                    <td class="text-center">{$data.note}</td>
                                    <td class="text-center">{$data.note_detail}</td>
                                    <td class="text-center">{if $data.created_at}{$data.created_at}{else} ~ {/if}</td>
                                    <td class="text-center">{if $data.date_receive}{$data.date_receive}{else} ~ {/if}</td>
                                </tr>
                            {/foreach}
                        {else}
                            <tr>
                                <td class="text-center" colspan="6">
                                    <h4>There is no information.</h4>
                                </td>
                            </tr>
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
        //datetimepicker receive
        $(function() {
            $('#from_fixed').datetimepicker({
                lang: 'en',
                format: 'Y-m-d',
                timepicker: false
            });
            $('#to_fixed').datetimepicker({
                lang: 'en',
                format: 'Y-m-d',
                timepicker: false
            });
        });
        //datetimepicker create
        $(function() {
            $('#c_from_fixed').datetimepicker({
                lang: 'en',
                format: 'Y-m-d',
                timepicker: false
            });
            $('#c_to_fixed').datetimepicker({
                lang: 'en',
                format: 'Y-m-d',
                timepicker: false
            });
        });

        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip({
                placement: 'top'
            });
        });
    </script>
{/block}
