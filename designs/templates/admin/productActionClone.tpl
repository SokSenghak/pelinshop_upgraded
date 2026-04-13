{extends file="admin/layout.tpl"}
{block name="main"}
  <ul class="breadcrumb">
    <li><a href="{$admin_file}">Home</a></li>
    <li><a href="{$admin_file}?task=product"> Product</a></li>
    <li class="active"> Clone</li>
  </ul>
  {if $error}
    <div class="alert alert-danger" data-dismiss="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      {if $error.imei eq 1}Please enter imei number.<br/>{/if}
      <!-- {if $error.imei eq 2}IMEI number must have 15 digit.<br/>{/if} -->
      {if $error.imei eq 3}This IMEI existed already.<br/>{/if}
      {if $error.price eq 1}Product price can not empty.<br/>{/if}
      {if $error.cost eq 1}Product cost can not empty.<br/>{/if}
    </div>
  {/if}
  <div class="panel panel-primary">
    <div class="panel-heading"><h3 class="panel-title text-center">Clone Product Form</h3> </div>
    <div class="panel-body">
      <form role="form" method="post" action="{$admin_file}?task=product&amp;action=clone&amp;id={$id}" class="form-horizontal row-border">
        <div class="container">
          <div class="row">
            <div class="col-md-9 col-md-offset-1">
            <h4 class="text-muted">Please fill your product information <span style="color:red">(* Required field).</span></h4>
            <hr style="margin-bottom:10px;margin-top:10px;">
            <div class="form-group">
              <div class="col-md-2"><label>IMEI Number: <span style="color:red">*</span></label></div>
              <div class="col-md-10">
                <input type="text" name="imei" id="imei" maxlength="16" class="form-control" placeholder="IMEI Number (15 digits or up to 16)" value="{if $smarty.session.clone_pro.imei}{$smarty.session.clone_pro.imei|escape}{else}{if $product.imei}{$product.imei|escape}{/if}{/if}"  autofocus />
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-2"><label>Product Cost: <span style="color:red">*</span></label></div>
              <div class="col-md-10">
                <div class="input-group">
                  <span class="input-group-addon">$</span>
                  <input type="text" name="cost" class="form-control" placeholder="Cost" value="{if $smarty.session.clone_pro.cost}{$smarty.session.clone_pro.cost|escape}{else}{if $product.cost}{$product.cost|escape}{/if}{/if}" onkeyup="NumAndTwoDecimals(event , this);">
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-2"><label>Product Price: <span style="color:red">*</span></label></div>
              <div class="col-md-10">
                <div class="input-group">
                  <span class="input-group-addon">$</span>
                  <input type="text" name="price" class="form-control" placeholder="Price" value="{if $smarty.session.clone_pro.price}{$smarty.session.clone_pro.price|escape}{else}{if $product.price}{$product.price|escape}{/if}{/if}" onkeyup="NumAndTwoDecimals(event , this);" />
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-2">
                <button class="btn btn-success btn-md" type="submit" name="submit"><i class="fa fa-arrow-circle-right"></i>&nbsp;Confirm</button>
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

$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip({
    placement : 'top'
  });
});
</script>
{/block}
