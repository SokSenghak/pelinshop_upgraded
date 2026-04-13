<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml" moznomarginboxes mozdisallowselectionprint>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content=""/>
  <meta name="keywords" content="Pelin Phone Shop"/>
  <link href="https://fonts.googleapis.com/css?family=Khmer" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="/css/style.css" type="text/css"/>
  <link rel="stylesheet" href="/css/custom.css" type="text/css" />
  <link href='https://fonts.googleapis.com/css?family=Battambang|Bokor|Freehand|Lora' rel='stylesheet' type='text/css'>
  <link href="/fonts/LCALLIG.TTF" rel='stylesheet' type="text/css" />
  <title>PLP_INVOICE_{$order_invoice_number}</title>
</head>
<body onload="window.print(); return false;" style="font-size: 12px;">
<!-- <body> -->
<div class="container" style="width: 140mm;height:auto;padding-top:0;">
  <div class="row">
    
    <div class="text-center" id="plp_headeren" style="font-size: 24px;" > ហាងលក់គ្រឿងអេឡិចត្រូនិច </div><br>
    {* <div class="text-center" id="plp_headeren"> PELIN PHONE SHOP </div>
    <div class="text-center">
      អាស័យដ្ឋានៈ​ ផ្ទះលេខ #118​ ផ្លូវលេខ 230 សង្កាត់ផ្សារដើមគរ ខណ្ឌទួលគោក ភ្នំពេញ
      ទូរសព្ទ័លេខ: 097 9999 339 - 092 891 991 - 010 891 991 - 093 77 9999 - 097 777 4449
    </div> *}
    <hr style="margin-bottom:5px;margin-top:0px;border: 1px solid;" />
    <div class="col-md-12 text-center"><h4>RECEIPT</h4></div>
    <table width="100%">
      <tbody>
        <tr>
          <td class="text-left" style="padding-left:0px;padding-right:0px;">Invoice No : #ios-{$order_invoice_number}</td>
          <td class="text-right" style="padding-left:0px;padding-right:0px;">{$invoice_data.ordered_at|date_format:"%Y-%m-%d %H:%M"}</td>
        </tr>
        <tr>
          <td class="text-left" style="padding-left:0px;padding-right:0px;font-size: 14px;"><strong> Buyer : {$customer.name}<strong></td>
          <td class="text-right" style="padding-left:0px;padding-right:0px;">H/P :&nbsp; {$customer.phone}</td>
        </tr>
      </tbody>
    </table>
    <table class="table table-striped" width="100%" style="margin-bottom:0px">
      <tr>
        <td>ល.រ<br>No</td>
        <td>ឈ្មោះទំនិញ<br>DESCRIBTION</td>
        <td>បរិ<br>QTY</td>
        <td>តំម្លៃ<br>PRICE</td>
        <td style="text-align: right;">តំម្លៃសរុប<br>AMOUNT</td>
      </tr>
      {foreach from=$products item=product key=k}
      <tr>
        <td>{$k + 1}</td>
        <td>{$product.title} / {$product.product_color_name} / {$product.product_storage_name} </td>
        <td>
          {if $product.quantity > 1}
            {$product.quantity}
          {else}
            {$product.tqty}
          {/if}
        </td>
        <td>$ {$product.price}</td>

        <td style="text-align: right;">
          $ 
          {if $product.quantity > 1}
            {math equation="x * y" x=$product.quantity y=$product.price format="%.2f"}
          {else}
            {math equation="x * y" x=$product.tqty y=$product.price format="%.2f"}
          {/if}
        </td>
      </tr>
      {/foreach}
    </table>
    <hr style="margin-bottom:5px;margin-top:0px;border: 1px solid;" />
    <table width="100%">
      <tbody>
        <tr>
          <td class="text-left" style="padding-left:0px;padding-right:0px;">Sub Total:</td>
          <td class="text-right" style="padding-left:0px;padding-right:0px;">$ {$invoice_data.subtotal|number_format:2}</td>
        </tr>
        <tr>
          <td class="text-left" style="padding-left:0px;padding-right:0px;">Discount:</td>
          <td class="text-right" style="padding-left:0px;padding-right:0px;">$ {$invoice_data.discount|number_format:2}</td>
        </tr>
        {if $invoice_data.model_price gt 0}
        <tr>
          <td class="text-left" style="padding-left:0px;padding-right:0px;">Changed Model From: {$invoice_data.changed_model_from}</td>
          <td class="text-right" style="padding-left:0px;padding-right:0px;">$ {$invoice_data.model_price|number_format:2}</td>
        </tr>
        {/if}
        <tr>
          <td class="text-left" style="padding-left:0px;padding-right:0px;">Total:</td>
          <td class="text-right" style="padding-left:0px;padding-right:0px;">$ {$invoice_data.total|number_format:2}</td>
        </tr>
      </tbody>
    </table>
    <hr style="margin-bottom:5px;margin-top:10px;border: 1px solid;" />
    <table width="100%">
      <tbody>
        <tr>
          <td width="25%">អ្នកចេញ</td>
          <td width="25%">អ្នកទទួល</td>
          <td width="25%">អ្នកដឹកជញ្ចូន</td>
          <td width="25%">អ្នកត្រួតពិនិត្យ</td>
        </tr>
      </tbody>
    </table>
    <br><br><br><br>
    <table width="100%">
      <tbody>
        <tr>
          <td class="text-center" style="padding-left:0px;padding-right:0px;"> សូមពិនិត្យមើលទំនិញ មុនពេលយកចេញពីហាងយើងខ្ញុំ! សូមអរគុណ!</td>
        </tr>
        <!-- <tr>
          <td class="text-center" style="padding-left:0px;padding-right:0px;">Thanks you! Please come here again!</td>
        </tr> -->
      </tbody>
    </table>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</body>
</html>
