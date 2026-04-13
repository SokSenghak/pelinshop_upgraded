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
  <style type="text/css" media="print">

  </style>
  <title>PLP_INVOICE_{$order_invoice_number}</title>
</head>
<!-- <body onload="window.print(); return false;"> -->
<body>
<div class="container" style="width: 80mm;height:auto;padding-top:0;">
  <div class="row">
    <table width="100%">
      <tbody>
        <tr>
          <!-- <td class="text-left"style="padding-left:0px;padding-right:0px;"><img src="/images/product/pelin_.png" /> </td> -->
          <td class="text-center" id="plp_headeren" style="padding-left:0px;padding-right:0px;">PELIN PHONE SHOP</td>
        </tr>
      </tbody>
    </table>
    <table width="100%">
      <tbody>
        <tr>
          <td class="text-left" style="padding-left:0px;padding-right:0px;">អាស័យដ្ឋានៈ​ ផ្ទះលេខ #118​ ផ្លូវលេខ 230</td>
        </tr>
        <tr>
          <td class="text-left" style="padding-left:0px;padding-right:0px;">សង្កាត់ផ្សារដើមគរ ខណ្ឌទួលគោក ភ្នំពេញ</td>
        </tr>
        <tr>
          <td class="text-left" style="padding-left:0px;padding-right:0px;">ទូរសព្ទ័លេខ: 097 9999 339 - 092 891 991</td>
        </tr>
        <tr>
          <td class="text-left" style="padding-left:0px;padding-right:0px;">010 891 991 - 093 77 9999 - 097 777 4449</td>
        </tr>
      </tbody>
    </table>
    <hr style="margin-bottom:5px;margin-top:0px;border: 1px solid;" />
    <div class="col-md-12 text-center"><h4>RECEIPT</h4></div>
    <table width="100%">
      <tbody>
        <tr>
          <td class="text-left" style="padding-left:0px;padding-right:0px;">Invoice No : #ios-{$order_invoice_number}</td>
          <td class="text-right" style="padding-left:0px;padding-right:0px;">{$invoice_data.ordered_at|date_format:"%Y-%m-%d %H:%M"}</td>
        </tr>
        <tr>
          <td class="text-left" style="padding-left:0px;padding-right:0px;">Buyer : {$customer.name}</td>
          <td class="text-right" style="padding-left:0px;padding-right:0px;">H/P :&nbsp; {$customer.phone}</td>
        </tr>
      </tbody>
    </table>
    <table class="table table-striped" width="100%" style="margin-bottom:0px">
      {foreach from=$products item=product}
      <tr>
        <td class="text-left" style="padding-left:0px;padding-right:0px;">
          {$product.title}-{$product.product_color_name}-{$product.product_storage_name}-imei({if $product.imei|count_characters eq 15}{$product.imei|mb_substr:9}
          {else}{$product.imei}{/if})</td>
        <td class="text-right" style="padding-left:0px;padding-right:0px;">$ {math equation="x * y" x=$product.quantity y=$product.price format="%.2f"}</td>
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
    <table>
      <tr>
        <td><strong>Note:</strong></td>
      </tr>
      {foreach from=$products item=product}
      {if $product.description}
      <tr>
        <td> *<strong>{$product.imei}</strong> : {$product.description}</td>
      </tr>
      {/if}
      {/foreach}
    </table>
    <hr style="margin-bottom:5px;margin-top:10px;border: 1px solid;" />
    <table width="100%">
      <tbody>
        <tr>
          <td class="text-left" style="padding-left:0px;padding-right:0px;font-size:12px;">
            ធានារយៈពេល <strong>{if $warrenty eq 30 OR $warrenty eq 31} 1 ខែ {elseif $warrenty eq 7} 7 ថ្ងៃ {else} {$warrenty} ថ្ងៃ{/if}</strong></td>
        </tr>
        <tr>
          <td class="text-left" style="padding-left:0px;padding-right:0px;font-size:12px;"> លក់ខាត <strong>20%</strong> គិតលើតារាងតំលៃក្នុងពេលយកមកលក់</td>
        </tr>
        <tr>
          <td class="text-left" style="padding-left:0px;padding-right:0px;font-size:12px;"> ដូរស៊េរីខាត <strong>15%</strong> គិតលើតារាងតំលៃក្នុងពេលយកមក់ដូរ</td>
        </tr>
        <tr>
          <td class="text-left" style="padding-left:0px;padding-right:0px;font-size:12px;">(សូមពិនិត្យមើលទំនិញ មុនពេលយកចេញពីហាងយើងខ្ញុំ)</td>
        </tr>
        <tr>
          <td class="text-left" style="padding-left:0px;padding-right:0px;font-size:12px;"><label>* មិនធានាលើ Touch និងអេក្រង់</label></td>
        </tr>
      </tbody>
    </table>
    <hr style="margin-bottom:5px;margin-top:10px;border: 1px solid;" />
    <table width="100%">
      <tbody>
        <tr>
          <td class="text-center" style="padding-left:0px;padding-right:0px;">សូមអរគុណ! សូមអញ្ចើញមកម្តងទៀត</td>
        </tr>
        <tr>
          <td class="text-center" style="padding-left:0px;padding-right:0px;">Thanks you! Please come here again!</td>
        </tr>
      </tbody>
    </table>
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
