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
  <title>Sale Report</title>
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
      <p class="text-center" style="font-size:20px;font-weight:bold"> Sale Report (
        {if $smarty.get.order_from|default:''}{$smarty.get.order_from|default:''|date_format:"%d-%m-%Y"}{/if}
        {if $smarty.get.order_to|default:''} - {$smarty.get.order_to|default:''|date_format:"%d-%m-%Y"}{/if}
        {if $smarty.get.order_from|default:'' eq '' AND $smarty.get.order_to|default:'' eq ''}{$smarty.now|date_format:"%d-%m-%Y"}{/if}
        ) </p>
      <p></p>
    </div>


    <div class="col-md-9  nopadding">
      {foreach from=$brand_group item=group key=k}
      <table class="table table-bordered" style="margin-bottom: 0;width: 100%">
        <tbody>
          <tr>
            <td style="width:30%">
              <label class="nopadding" style="font-size:16px;font-weight:bold">{$group.name}</label>
            </td>
            <td>
              <label class="nopadding" style="font-size:16px;font-weight:bold"> <i class="glyphicon glyphicon-phone"></i> {$group.brand_count} </label>
            </td>
          </tr>
        </tbody>
      </table>

      {if $smarty.get.summary|default:'' eq ''}
        <table class="table table-bordered">
          {foreach from=$brand_data{$group.brand_id} item=data key=k}
          <tbody>
            <tr>
              <td class="text-center" valign="top" width="50px;">{$k+1}</td>
              <td class="text-center" valign="top" width="140px;">{$data.imei}</td>
              <td class="text-center">{$data.title}
                {if $data.color_name}-{$data.color_name}{/if}
                {if $data.storage_name}-{$data.storage_name}{/if}</td>
              <td class="text-center" valign="top" width="100px;">$ {$data.cost|number_format:2}</td>
              <td class="text-center" valign="top" width="100px;">$ {$data.price|number_format:2}</td>
              <td class="text-center">{$data.maker_name}</td>
              <td class="text-center">{if $data.deleted_at eq null} In Stock{else}Sold Out{/if}</td>
            </tr>
          </tbody>
          {/foreach}
        </table>
        {/if}
      {/foreach}
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
