{extends file="admin/layout.tpl"}
{block name="main"}
  <ul class="breadcrumb">
    <li><a href="{$admin_file}">ទំព័រដើម (Home)</a></li>
    <li><a href="{$admin_file}?task=product"> ផលិតផល (Product)</a></li>
    <li class="active"> ទម្រង់ (Form)</li>
  </ul>
  {if $error}
    <div class="alert alert-danger">
    	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		{if $error.imei eq 1}សូមបញ្ចូលលេខ IMEI។ (Please enter imei number.)<br/>{/if}
		<!-- {if $error.imei eq 2}IMEI number must have 15 digit.<br/>{/if} -->
		{if $error.imei eq 3}
			លេខ IMEI នេះមានរួចហើយ។ (This IMEI number existed.)<br/>
			សូមឆែកមើលនៅបញ្ជីការលក់ផលិតផល ឬចុច => <a href="{$admin_file}?task=product_order&amp;kwd={$smarty.session.sproduct.imei}" target="_blank"> {$smarty.session.sproduct.imei} </a>
		{/if}
		{* {if $error.imei eq 4}លេខ IMEI ត្រូវមានតែលេខប៉ុណ្ណោះ។ (IMEI number must only contains numbers.)<br/>{/if} *}
		{if $error.title eq 1}សូមបញ្ចូលឈ្មោះផលិតផល។ (Please enter product title.)<br/>{/if}
		{if $error.price eq 1}តម្លៃលក់មិនអាចទទេរ។ (Product price can not empty.)<br/>{/if}
		{if $error.cost eq 1}តម្លៃដើមមិនអាចទទេរ។ (Product cost can not empty.)<br/>{/if}
		{if $error.brand eq 1}សូមជ្រើសរើសម៉ាកផលិតផល។ (Please choose product brand.)<br/>{/if}
		{if $error.maker eq 1}សូមជ្រើសរើសក្រុមហ៊ុនផលិត។ (Please choose product maker.)<br/>{/if}
		{if $error.minlenght eq 1}Imei មិនគ្រប់ ១៥ ខ្ទង់ទេ។ (IMEI Number not equal 15 digits)<br/> {/if}
    </div>
  {/if}
  <div class="panel panel-primary">
    <div class="panel-heading"><h3 class="panel-title text-center">ទម្រង់បញ្ជូលផលិតផលថ្មី (New Product Form)</h3> </div>
    <div class="panel-body">
      <form role="form" method="post" action="{$admin_file}?task=product&amp;action=add" class="form-horizontal row-border">
        <div class="container">
          <div class="row">
            <div class="col-md-9 col-md-offset-1">
            <h4 class="text-muted">សូមបំពេញព័ត៌មានផលិតផលរបស់អ្នក (Please fill your product information) <span style="color:red">(* ចាំបាច់ត្រូវបំពេញ (Required field)).</span></h4>
            <hr style="margin-bottom:10px;margin-top:10px;">
            {if $smarty.session.sproduct.imei}
              <div class="form-group ck_imei hideshow" style="{if $smarty.session.sproduct.check_serial eq 1} display: none;{/if}">
                <div class="col-md-2">
                  <label>លេខ IMEI (IMEI Number): <span style="color:red">*</span></label>
                </div>
                <div class="col-md-9">
                  <input type="text" name="imei" id="input_imei" class="form-control" placeholder="លេខ IMEI (១៥ ខ្ទង់) (IMEI Number (15 digits))" minlength="15" maxlength="15" value="{if $smarty.session.sproduct.imei}{$smarty.session.sproduct.imei|escape}{else}{if $product.imei}{$product.imei|escape}{else}{/if}{/if}" onkeyup="NumAndTwoDecimals(event , this);">
                </div>
              </div>
              <div class="form-group ck_serial">
                <input type="checkbox" name="check_serial" id="check_id" value="1" {if $smarty.session.sproduct.check_serial eq 1}checked{/if}>
                <div class="col-md-2">
                  <label>លេខ Serial (Serial Number):<span style="color:red">*</span></label>
                </div>
                <div class="col-md-9">
                  <input type="text" name="imei" id="input_serial" class="form-control" placeholder="លេខ Serial (Serial Number)" value="{if $smarty.session.sproduct.check_serial eq 1} {$smarty.session.sproduct.imei|escape}{else}{if $product.imei}{$product.imei|escape}{/if}{/if}" {if $smarty.session.sproduct.check_serial ne 1} disabled {/if} required onkeyup="removeSpace(event , this);" />
                </div>
              </div>
            {else}
              <div class="form-group ck_imei">
                  <div class="col-md-2">
                      <label>លេខ IMEI (IMEI Number): <span style="color:red">*</span></label>
                  </div>
                  <div class="col-md-9">
                      <input type="text" name="imei" id="input_imei" class="form-control" placeholder="លេខ IMEI (១៥ ខ្ទង់) (IMEI Number (15 digits))" minlength="15" maxlength="15" value="{if $smarty.session.sproduct.imei}{$smarty.session.sproduct.imei|escape}{else}{if $product.imei}{$product.imei|escape}{else}{/if}{/if}" onkeyup="NumAndTwoDecimals(event , this);">
                  </div>
              </div>
              <div class="form-group ck_serial">
                <input type="checkbox" name="check_serial" id="check_id" value="1">
                  <div class="col-md-2">
                      <label>លេខ Serial (Serial Number): <span style="color:red">*</span></label>
                  </div>
                  <div class="col-md-9">
                      <input type="text" name="imei" id="input_serial" maxlength="15" class="form-control" placeholder="លេខ Serial (Serial Number)" value="{if $smarty.session.sproduct.imei}{$smarty.session.sproduct.imei|escape}{else}{if $product.imei}{$product.imei|escape}{/if}{/if}" disabled required onkeyup="removeSpace(event , this);" />
                  </div>
              </div>
            {/if}
            <div class="form-group">
              <div class="col-md-2"><label>ឈ្មោះក្រុមហ៊ុន (Company Title): <span style="color:red">*</span></label></div>
              <div class="col-md-10">
                  <select name="company_id" class="form-control" required>
                    <option value="">ជ្រើសរើសក្រុមហ៊ុន (Choose Product Company)</option>
                    <!-- <option value="1">E-KHMER</option> -->
                    {foreach from=$list_company_name item=company}
                      <option value="{$company.id}" {if $smarty.session.sproduct.company_id eq $company.id}selected{/if}>{$company.name}</option>
                    {/foreach}
                  </select>
                <!-- <input type="text" name="company_id" class="form-control" placeholder="" value="{if $smarty.session.sproduct.company_id}{$smarty.session.sproduct.company_id|escape}{else}{if $product.company_title}{$product.company_id|escape}{/if}{/if}" required/> -->
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-2"><label>ឈ្មោះផលិតផល (Product Title): <span style="color:red">*</span></label></div>
              <div class="col-md-4">
              <select name="titles" class="form-control" required>
                <option value="">ឈ្មោះផលិតផល (Product title)</option>
                {foreach from=$list_product_title item=title}
                  <option value="{$title.id}" {if $smarty.session.sproduct.titles eq $title.id}selected{/if}>{$title.name}</option>
                {/foreach}
              </select>
              </div>
              <div class="col-md-3">
                <select name="colors_" class="form-control" required>
                <option value="">ពណ៌ផលិតផល (Product Color)</option>
                {foreach from=$list_color_name item=color}
                  <option value="{$color.id}" {if $smarty.session.sproduct.colors_ eq $color.id}selected{/if}>{$color.name}</option>
                {/foreach}
                </select>
              </div>
              <div class="col-md-3">
                <select name="storages_" class="form-control" required>
                <option value="">ទំហំផ្ទុក (Product Storage)</option>
                {foreach from=$list_storage_name item=storage}
                  <option value="{$storage.id}" {if $smarty.session.sproduct.storages_ eq $storage.id}selected{/if}>{$storage.name}</option>
                {/foreach}
                </select>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-2"><label>តម្លៃដើម (Product Cost): <span style="color:red">*</span></label></div>
              <div class="col-md-4">
                <div class="input-group">
                  <span class="input-group-addon">$</span>
                  <input type="text" name="cost" class="form-control" placeholder="តម្លៃដើម (Cost)"
                        value="{if $smarty.session.sproduct.cost}{$smarty.session.sproduct.cost|escape}{else}{if $product.cost}{$product.cost|escape}{else}0{/if}{/if}"
                        onkeyup="NumAndTwoDecimals(event , this);">
                </div>
              </div>
              <div class="col-md-3">
                <div class="input-group">
                  <span class="input-group-addon">$</span>
                  <input type="text" name="price" class="form-control" placeholder="តម្លៃលក់ (Product Price)"
                        value="{if $smarty.session.sproduct.price}{$smarty.session.sproduct.price|escape}{else}{if $product.price}{$product.price|escape}{/if}{/if}"
                        onkeyup="NumAndTwoDecimals(event , this);" />
                </div>
              </div>
              <div class="col-md-3">
                <select name="branch" class="form-control" required>
                <option value="">ឈ្មោះសាខា (Branch Name)</option>
                {foreach from=$list_branch item=branch}
                  <option value="{$branch.id}" {if $smarty.session.sproduct.branch eq $branch.id}selected{/if}>{$branch.name}</option>
                {/foreach}
                </select>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-2"><label><span>ក្រុមហ៊ុនផលិត (Product Maker): <span style="color:red">*</span></label></div>
              <div class="col-md-10">
                <select name="maker_id" class="form-control" required>
                  <option value="">ជ្រើសរើសក្រុមហ៊ុនផលិត (Choose Product Maker)</option>
                  {foreach from=$list_maker_name item=maker}
                    <option value="{$maker.id}" {if $smarty.session.sproduct.maker_id eq $maker.id}selected{/if}>{$maker.name}</option>
                  {/foreach}
                </select>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-2"><label>ម៉ាកផលិតផល (Product Brand): <span style="color:red">*</span></label></div>
              <div class="col-md-10">
                <select name="brand_id" class="form-control" required>
                  <option value="">ជ្រើសរើសម៉ាកផលិតផល (Choose Product Brand)</option>
                  {foreach from=$list_brand_name item=brand}
                    <option value="{$brand.id}" {if $smarty.session.sproduct.brand_id eq $brand.id}selected{/if}>{$brand.name} ({$brand.maker_name})</option>
                  {/foreach}
                </select>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-2"><label>គុណភាពផលិតផល (Product Used): </label></div>
              <div class="col-md-10">
                <select name="pro_used_id" class="form-control">
                  <option value="">ជ្រើសរើសគុណភាពផលិតផល Choose Product Used</option>
                  {foreach from=$list_product_used item=pr_used}
                    <option value="{$pr_used.id}" {if $smarty.session.sproduct.pro_used_id eq $pr_used.id}selected{/if}>{$pr_used.name}</option>
                  {/foreach}
                </select>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-2"><label>បរិយាយ (Description): </label></div>
              <div class="col-md-10">
                <textarea class="form-control no-resize" name="desc" rows="3" placeholder="បរិយាយ (Description)">{if $smarty.session.sproduct.desc}{$smarty.session.sproduct.desc}{/if}</textarea>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-2"><label>កាត់ស្តុក (Cutting Stock): </label></div>
              <div class="col-md-10">
                <div class="checkbox">
                <label><input type="checkbox" name="is_cutting"  value="2" {if $smarty.session.sproduct.is_cutting eq 2}checked{/if}><span style="color:red">( ប្រសិនបើធីក មិនកាត់ចេញពីស្តុកនៅពេលលក់ )</span></label>
              </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-2">
                <button class="btn btn-success btn-md" type="submit" name="submit"><i class="fa fa-arrow-circle-right"></i>&nbsp;បញ្ជាក់ (Confirm)</button>
              </div>
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

function removeSpace(e , field)
{
  var val = field.value.replace(/\s/g, "");
  if(val) {
    field.value = val;
  } else {
    field.value = "";
  }
}

$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip({
    placement : 'top'
  });
});

//$(document).ready(function(){
//  $("#check_imei").click(function(){
//    $(".ck_serial").toggle();
//    var ischeck = $(this).is(':checked');
//    if (ischeck == true) {
//      $("#input_imei").prop("disabled", false);
//    }else{
//      $("#input_imei").prop("disabled", true);
//    }
//  });
//});

$(document).ready(function(){
  $("#check_id").click(function(){
    $(".ck_imei").toggle();
    var ischeck = $(this).is(':checked');
    if (ischeck == true) {
		$('.hideshow').hide();
      $("#input_serial").prop("disabled", false);
      $("#input_serial").val('');
    }else{
		$('.hideshow').show();
		$("#input_serial").prop("disabled", true);
		$("#input_imei").val('');
		$("#input_serial").val('');
    }
  });
});

</script>
{/block}
