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
  @page
  {
      width: 80mm;    /* auto is the initial value */
      margin: 0mm;  /* this affects the margin in the printer settings */
  }
  </style>
  <title>PLP_INVOICE_{$order_invoice_number}</title>
</head>
<body onload="window.print(); return false;" style="width: 80mm;">
<!-- <body> -->
<div class="container">
  <div class="row">
    <div class="logo"><img src="/images/product/pelin_.png" /></div>
    <div class="col-md-9 nopadding">
      <p class="text-center" id="plp_headerkh">ប៉េលីន ហាងលក់ទូរស័ព្ទដៃ<p>
    </div>
    <div class="col-md-9 nopadding">
      <p class="text-center" id="plp_headeren">Pelin Phone Shop<p>
    </div>
    <div class="col-md-9 nopadding">
      <p id="address">#B.56 E<sub>3</sub>E<sub>0</sub> ផ្លូវលេខ 230 សង្កាត់បឹងសាឡាង ខណ្ឌទួលគោក រាជធានីភ្នំពេញ<p>
    </div>
    <div class="col-md-9 nopadding">
      <p id="phone">HP: 097 9999 339 - 097 777 4449 - 097 7777 449 - 092 891 991 - 093 77 9999</p>
    </div>
    <div class="col-md-9 nopadding">
      <hr style="margin-bottom:0px;margin-top:0px;border:1px solid;">
    </div>
    <div class="col-md-9 nopadding">
      <p class="text-center" style="font-size:24px;"> INVOICE </p>
    </div>
    <div class="col-md-9 nopadding">
      <label class="col-md-9" style="padding-left:0px;">Sold To : <b>{$customer.name}</b></label>
      <label class="col-md-3 pull-right" style="padding-right:0px;">Invoice No.&nbsp;: {$order_invoice_number}</label>
    </div>
    <div class="col-md-9 nopadding">
      <label class="col-md-9" style="padding-left:0px;">Phone&nbsp;  : <b>{$customer.phone}</b></label>
      <label class="col-md-3 pull-right" style="padding-right:0px;">Date   : <b>{$customer.created_at|date_format:"%B %e, %Y"}</b></label>
    </div>
    <div class="col-md-9 nopadding">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th class="text-center" valign="top" width="50px">ល.រ<br />No</th>
            <th class="text-center" valign="top" width="550px">រាយមុខទំនិញ <br/>Name of Goods</th>
            <th class="text-center"​​​ valign="top" width="100px">ចំនួួន <br/>Quantity</th>
            <th class="text-center" valign="top" width="160px">តំលៃរាយ <br/>Unit Price</th>
            <th class="text-center">តំលៃសរុប <br/>Amount</th>
          </tr>
        </thead>
        <tbody>
          {foreach from=$products key=k item=product}
          <tr>
            <td class="text-center">{$k+1}</td>
            <td class="text-left">{$product.title}&nbsp;(IMEI :{$product.imei})</td>
            <td class="text-center">{$product.quantity}</td>
            <td class="text-center">$ {$product.price}</td>
            <td class="text-center">$ {math equation="x * y" x=$product.quantity y=$product.price format="%.2f"}</td>
          </tr>
          {/foreach}
          {section name=foo start=$product_count+1 loop=13 step=1}
          <tr>
            <td class="text-center">{$smarty.section.foo.index}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          {if $smarty.section.foo.last}
            <tr>
              <td colspan="2" class="text-left">
                  <p>ធានារយៈពេល...............លេខម៉ាស៊ីនទូរសព្ទ័.......................</p>
                  <p>លក់ខាត....................គិតលើតារាងតំលៃក្នុងពេលយកមកលក់</p>
                  <p>ដូរស៊េរីខាត..................គិតលើតារាងតំលៃក្នុងពេលយកមក់ដូរ</p>
                  (សូមពិនិត្យមើលទំនិញ មុនពេលយកចេញពីហាងយើងខ្ញុំ)
              </td>
              <td colspan="2" class="text-center">
                  <p>សរុប Total</p>
                  <p>កក់មុន Deposit</p>
                  នៅខ្វះ Balance
              </td>
              <td class="text-center">
                  <p><b>$ {$total_price.total}</b></p>
                  <p>.....................................</p>
                  <p>.....................................</p>
              </td>
            </tr>
          {/if}
          {/section}
        </tbody>
      </table>
    </div>
    <div class="col-md-9 nopadding">
      <label class="col-md-3 nopadding text-left">
        <p></p>
        <p style="margin-bottom:0px;margin-top:0px;">_____________________</p>
        Customer Sign & Name
      </label>
      <label class="col-md-3 nopadding pull-right text-right">
        <p></p>
        <p style="margin-bottom:0px;margin-top:0px;">____________________</p>
        Authorized Signature
      </label>
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
