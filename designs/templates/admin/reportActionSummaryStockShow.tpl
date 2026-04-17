<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml" moznomarginboxes mozdisallowselectionprint>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content=""/>
  <meta name="keywords" content="Pelin Phone Shop"/>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="/css/style.css" type="text/css"/>
  <link rel="stylesheet" href="/css/custom.css" type="text/css" />
  <link href='https://fonts.googleapis.com/css?family=Battambang|Bokor|Freehand|Lora' rel='stylesheet' type='text/css'>
  <link href="/fonts/LCALLIG.TTF" rel='stylesheet' type="text/css" />
  <style type="text/css" media="print"></style>
  <title> Stock Summary Report</title>
</head>
<body onload="window.print(); return false;">
<!-- <body> -->
<div class="container">
  <div class="row">
    <div class="col-md-9 nopadding">
      <p class="text-center" id="plp_headerkh">ប៉េលីន ហាងលក់ទូរស័ព្ទដៃ<p>
    </div>
    <div class="col-md-9 nopadding">
      <p class="text-center" id="plp_headeren">Pelin Phone Shop<p>
    </div>
    <div class="col-md-9 nopadding">
      <p id="address">អាស័យដ្ឋានៈ​ ផ្ទះលេខ 118​ ផ្លូវលេខ 230 សង្កាត់ផ្សារដើមគរ ខណ្ឌទួលគោក ភ្នំពេញុ</p>
    </div>
    <div class="col-md-9 nopadding">
      <p id="phone">ទូរសព្ទ័ទំនាក់ទំនង: 097 9999 339 - 092 891 991 - 010 891 991 - 093 77 9999 - 097 777 4449</p>
    </div>
    <div class="col-md-9 nopadding">
      <hr style="margin-bottom:10px;margin-top:0px;border:1px solid;">
    </div>
    <div class="col-md-9 nopadding">
      <p class="text-center" style="font-size:20px;font-weight:bold"> Stock Summary Report ({$smarty.now|date_format:"%d-%m-%Y"}) For {$branch_name} </p>
      <p></p>
    </div>

    <div class="col-md-9  nopadding">
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
              <tr class="table_header">
                <th></th>
                <!-- <th class="text-center">Branch</th> -->
                <th class="text-center">Brand</th>
                <th class="text-center">Stock Balance ({$yesterday|date_format})</th>
                <th class="text-center">New Stock ({$smarty.now|date_format})</th>
                <th class="text-center">Sold Out ({$smarty.now|date_format})</th>
                <th class="text-center">Stock Balance ({$smarty.now|date_format})</th>
              </tr>
            </thead>
            <tbody>
              {if $summary_stock_data|@count gt 0}
              {foreach from=$summary_stock_data item=data name=foo}
                <tr>
                  <td class="text-center">{if $smarty.get.next|default:'' eq 1 OR $smarty.get.next|default:'' eq '' }{counter}{else}{$smarty.foreach.foo.iteration+$smarty.get.next|default:1-1}{/if}</td>
                  <!-- <td class="text-center">{$data.branch_name}</td> -->
                  <td class="text-center">{$data.brand_name}</td>
                  <td class="text-center">{$data.inStockYesterday}</td>
                  <td class="text-center">{$data.newStockToday}</td>
                  <td class="text-center">{$data.outStockToday}</td>
                  <td class="text-center">{$data.inStockToday}</td>
                </tr>
              {/foreach}
              {else}
              <tr><td class="text-center" colspan="6"><h4>There is no information.</h4></td></tr>
              {/if}
            </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
{literal}
  <script type="text/javascript">
      $(document).ready(function(){
        window.print();
      });
  </script>
{/literal}
</body>
</html>
