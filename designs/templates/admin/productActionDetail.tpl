{extends file="admin/layout.tpl"}
{block name="main"}
  <ul class="breadcrumb">
    <li><a href="{$admin_file}">ទំព័រដើម (Home)</a></li>
    <li><a href="{$admin_file}?task=product">ផលិតផល (Product)</a> </li>
    <li class="active">កែប្រែ (Edit)</li>
  </ul>

  {if $error}
    <div class="alert alert-danger" data-dismiss="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      {if $error.imei eq 1}សូមបញ្ចូលលេខ IMEI។ (Please enter imei number.)<br/>{/if}
      <!-- {if $error.imei eq 2}imei number must have 15 digit.<br/>{/if} -->
      {if $error.title eq 1}សូមបញ្ចូលឈ្មោះផលិតផល។ (Please enter product title.)<br/>{/if}
      {if $error.price eq 1}តម្លៃលក់មិនអាចទទេរ។ (Price can not empty.)<br/>{/if}
      {if $error.cost eq 1}តម្លៃដើមមិនអាចទទេរ។ (Cost can not empty.)<br/>{/if}
      {if $error.price eq 1}តម្លៃលក់មិនអាចទទេរ។ (Product price can not empty.)<br/>{/if}
      {if $error.cost eq 1}តម្លៃដើមមិនអាចទទេរ។ (Product cost can not empty.)<br/>{/if}
      {if $error.brand eq 1}សូមជ្រើសរើសម៉ាកផលិតផល។ (Please choose product brand.)<br/>{/if}
      {if $error.maker eq 1}សូមជ្រើសរើសក្រុមហ៊ុនផលិត។ Please choose product maker.<br/>{/if}
    </div>
  {/if}
  <div class="panel panel-primary">
    <div class="panel-heading"><h3 class="panel-title text-center">ព័ត៌មានផលិតផល (Product Information)</h3> </div>
    <div class="panel-body">
      <form role="form" method="post" action="{$admin_file}?task=product&amp;action=edit&amp;id={$list_product_data.id}" class="form-horizontal row-border" >
          <div class="row">
            <div class="col-md-8">
              <h4 class="text-muted">ផលិតផល (Product) </h4>
              <!-- <hr style="margin-bottom:10px;margin-top:10px;"> -->
              <table class="table">
                <tr>
                  <th width="125">លេខ IMEI (IMEI Number) </th>
                  <td width="20">:</td>
                  <td>{$list_product_data.imei}</td>
                </tr>
                <tr>
                  <th width="125">ឈ្មោះក្រុមហ៊ុន (Company Title) </th>
                  <td width="20">:</td>
                  <td>{$list_product_data.company_title}</td>
                </tr>
                <tr>
                  <th>ឈ្មោះផលិតផល (Product Title) </th>
                  <td>:</td>
                  <td>{$list_product_data.title}</td>
                </tr>
                <tr>
                  <th>ពណ៌ផលិតផល (Product Color) </th>
                  <td>:</td>
                  <td>{$list_product_data.color_name}</td>
                </tr>
                <tr>
                  <th>ទំហំផ្ទុក (Product Storage)</th>
                  <td>:</td>
                  <td>{$list_product_data.storage_name}</td>
                </tr>
                <tr>
                  <th>តម្លៃដើម (Product Cost) </th>
                  <td>:</td>
                  <td>${$list_product_data.cost|number_format:0}</td>
                </tr>
                <tr>
                  <th>តម្លៃលក់ (Product Price) </th>
                  <td>:</td>
                  <td>${$list_product_data.price|number_format:0}</td>
                </tr>
                <tr>
                  <th>ក្រុមហ៊ុនផលិត (Product Maker) </th>
                  <td>:</td>
                  <td>{$list_product_data.maker_name}</td>
                </tr>
                <tr>
                  <th>ម៉ាកផលិតផល (Product Branch) </th>
                  <td>:</td>
                  <td>{$list_product_data.brand_name}</td>
                </tr>
                <tr>
                  <th>គុណភាពផលិតផល (Product Used) </th>
                  <td>:</td>
                  <td>{$list_product_data.product_used}</td>
                </tr>
                <tr>
                  <th>ការបរិយាយ (Description)</th>
                  <td>:</td>
                  <td>{$list_product_data.brand_name}</td>
                </tr>
                <tr>
                  <th>កាត់ស្តុក (Cutting Stock)</th>
                  <td>:</td>
                  <td>
                    {if isset($list_product_data) && $list_product_data.is_cutting eq 2}
                      មិនកាត់ស្តុក
                    {else}
                      កាត់ស្តុក
                    {/if}
                  </td>
                </tr>
                <tr>
                  <th>កាលបរិច្ឆេទ (Date)</th>
                  <td>:</td>
                  <td>{$list_product_data.created_at|date_format}</td>
                </tr>
              </table>

              <div class="col-md-4">
                <a class="btn btn-info" href="{$admin_file}?task=product"><i class="fa fa-arrow-circle-left"></i> ត្រលប់ក្រោយ (Back)</a>
              </div>
            </div>
            <div class="col-md-4">
              <h4 class="text-muted">Qrcode </h4>
              <!-- <hr style="margin-bottom:10px;margin-top:10px;"> -->
              <!--QRcode -->
              <div class="panel panel-default">
                <div class="panel-body">
                <center><div id="qrcode"></div></center>
                </div>
              </div>
            </div>
          </div>

      </form>
    </div>
  </div>
{/block}
{block name="javascript"}
<script>
$(function () {
  $('input#imei').maxlength({
    alwaysShow: true,
    threshold: 10,
    warningClass: "label label-success",
    limitReachedClass: "label label-danger",
    separator: ' of ',
    preText: 'You enter ',
    postText: ' digit.',
    validate: true
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

$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip({
    placement : 'top'
  });
});

var content = '{$list_product_data.imei}';
var el = kjua({
        render: 'image',
        text: content,
        fill: '#333',
        back: '#ffffff',
        quiet: 2,
        mode:'label',
        label:"PELIN",
        mSize: 10,
        rounded:100,
        size: 200,
        fontcolor: '#333'
});
$('#qrcode').html(el);

</script>
{/block}
