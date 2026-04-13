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
  <title>Product Stock Report</title>
</head>
<body onload="window.print(); return false;">
<!-- <body> -->
<div style="width: 900px; margin: 0 auto; padding: 20px; height:1255px;">
  <div>
    <p class="text-center" id="plp_headerkh">ប៉េលីន ហាងលក់ទូរស័ព្ទដៃ<p>
    <p class="text-center" id="plp_headeren">Summary Return Product Report<p>
    <p id="address">អាស័យដ្ឋានៈ​ ផ្ទះលេខ 118​ ផ្លូវលេខ 230 សង្កាត់ផ្សារដើមគរ ខណ្ឌទួលគោក ភ្នំពេញុ</p>
    <p id="phone">ទូរសព្ទ័ទំនាក់ទំនង: 097 9999 339 - 092 891 991 - 010 891 991 - 093 77 9999 - 097 777 4449</p>

  </div>
  <br>
  <table class="table table-bordered table-striped table-hover">
      <thead>
        <tr class="table_header">
          <th class="text-center">Title</th>
          <th class="text-center">Storage</th>
          <th class="text-center">Amount Of Color</th>
          <th class="text-center">Color Nme</th>
          <th class="text-center">Total</th>
          <th class="text-center">Maker</th>
          <th class="text-center">Brand</th>
        </tr>
      </thead>
      <tbody>
        {if $summary_product_data|@count gt 0}
        {foreach from=$summary_product_data item=data name=foo}
          <tr>
            <td class="text-center">{$data.title}</td>
            <td class="text-center">{$data.pro_storage}</td>
            <td class="text-center">
              <ul class="list-group">
                {foreach $data.product_color item=vc}
                <li class="list-group-item" style="padding: 4px 15px;">{$vc.total_color}</li>
                {/foreach}
              </ul>
            </td>
            <td class="text-center">
              <ul class="list-group">
                {foreach $data.product_color item=vc}
                <li class="list-group-item" style="padding: 4px 15px;">{$vc.product_color}</li>
                {/foreach}
              </ul>
            </td>
            <td class="text-center">{$data.total_product}</td>
            <td class="text-center">{$data.maker_name}</td>
            <td class="text-center">{$data.brand_name}</td>
          </tr>
        {/foreach}
        {else}
        <tr><td class="text-center" colspan="7"><h4>There is no information.</h4></td></tr>
        {/if}
      </tbody>
  </table>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</body>
</html>
