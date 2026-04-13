{extends file="order/layout.tpl"}
{block name="main"}
      <div class="table-responsive">
        {*product order item*}
        <table class="table table-bordered" id="data_append_grid"></table>

        {*product total price*}
        <table class="table table-bordered">
          <tr>
            <td class="text-right"​ width="80%"><label>សរុប (Total)</label></td>
            <td class="text-right">
              $ <label id="subtotal"></label>

            </td>
          </tr>
        </table>
      </div>
        {*Customer Information*}
      <form data-toggle="validator" onsubmit='saveOrder(); return false;' role="form" class="form-horizontal row-border">
        <input type="hidden" name="staffid" id="inputStaff" value = "{$smarty.session.staff_id}" />
        <input type="hidden" name="branchid" id="inputBranch" value = "{$smarty.session.branch_id}" />
        <input type="hidden" name="sstotal" id="order_subtotal" />

        <div class="col-md-12 nopadding">
          <div class="form-group">
            <!-- <div class="col-md-6" style="font-size:24px;">Customer Information <span style="color:red">(* Required Field)</span></div> -->
            <div class="col-md-4">
              <div class="input-group">
                <span class="input-group-addon"><label>ផ្លាស់ប្ដូរម៉ូដែល (Changed Model) :</label></span>
                <input type="text" name="model_name" id="inputModelText" placeholder="ពីម៉ូដែលទៅម៉ូដែល (From model To Model)" class="form-control"  />
              </div>
            </div>
            <div class="col-md-2">
              <div class="input-group">
                <span class="input-group-addon"><label>$</label></span>
                <input type="text" name="model_price" id="inputModelPrice" placeholder="Model Price" class="form-control" onkeyup="NumAndTwoDecimals(event , this);" />
              </div>
            </div>
            <div class="col-md-3">
              <div class="input-group">
                <span class="input-group-addon"><label>ការធានា (ថ្ងៃ) (Warrenty (days)):</label></span>
                <input type="text" name="warrenty" id="inputWarrenty" maxlength="3" class="form-control" placeholder="Discount" onkeyup="NumAndTwoDecimals(event , this);" value="30" />
              </div>
            </div>
            <div class="col-md-3">
              <div class="input-group">
                <span class="input-group-addon"><label>បញ្ចុះតម្លៃ (discount($)):</label></span>
                <input type="text" name="discount" id="inputDiscount" maxlength="7" class="form-control" placeholder="Discount" onkeyup="NumAndTwoDecimals(event , this);" value="0" />
              </div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-2"><label>លេខអត្តសញ្ញាណប័ណ្ណ (Personal ID):</label></div>
          <div class="col-md-10">
            <div class="input-group">
              <input type="text" name="idnumber" id="inputNumber" maxlength="10" class="form-control" placeholder="Personal ID" onkeyup="NumAndTwoDecimals(event , this);" data-error="Please input personal id."/>
              <span class="input-group-btn">
                <button title="Search customer information by personal ID" data-toggle="tooltip" class="btn btn-success" onClick="getCustomerInfo(); return false;"><li class="glyphicon glyphicon-search"></li>&nbsp;ស្វែងរក (Search)</button>
              </span>
              <div class="help-block with-errors"></div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-2"><label>ឈ្មោះអតិថិជន (Customer Name):</div>
          <div class="col-md-10">
            <input type="text" name="name" id="inputName" class="form-control" placeholder="Customer Name" data-error="Please input customer name." />
            <div class="help-block with-errors"></div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-2"><label>លេខទូរស័ព្ទ (Phone Number):<span style="color:red">*</span></label></div>
          <div class="col-md-10">
            <div class="input-group">
              <input type="text" name="phone" id="inputPhone" maxlength="10" class="form-control" placeholder="Customer Phone Number" onkeyup="NumAndTwoDecimals(event , this);" data-error="Please input phone number." required/>
              <span class="input-group-btn">
                <button title="Search customer information by phone number" data-toggle="tooltip" class="btn btn-success" onClick="getCustomerInfoByPhone(); return false;"><li class="glyphicon glyphicon-search"></li>&nbsp;ស្វែងរក (Search)</button>
              </span>
              <div class="help-block with-errors"></div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-2"><label>អុីមែល (Email Address):</label></div>
          <div class="col-md-10">
            <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Customer Email" data-error="Bruh, that email address is invalid"/>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-2"><label>អាសយដ្ឋាន (Address):</label></div>
          <div class="col-md-10">
            <input type="text" name="address" id="inputAddress" class="form-control" placeholder="Customer Address" />
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-2">
            <button data-toggle="tooltip" data-original-title="Save Data" class="btn btn-success btn-md" id="savedata" type="submit"><i class="glyphicon glyphicon-shopping-cart"></i> រក្សាទុកទិន្នន័យ (Save Data)</button>
          </div>
        </div>
      </form>
  {literal}
    <script type="text/javascript">
      $(function() {
        $('#data_append_grid').appendGrid({
          initRows: 0,
          columns: [
            { name: 'imei',
              display: 'លេខ IMEI (IMEI Number)', displayCss: {'text-align': 'center'},
              type: 'text',
              ctrlAttr: { maxlength: 15 , readonly:true},
              ctrlCss: { width: '180px', 'text-align': 'center'}
            },
            { name: 'title',
              display: 'ឈ្មោះផលិតផល (Product name)', displayCss: {'text-align': 'center'},
              type: 'text',
              ctrlAttr: { maxlength: 100 , readonly:true},
              ctrlCss: { width: '200px', 'text-align': 'center'}
            },
            { name: 'quantity',
              value: '1',
              display: 'ចំនួន (Quantity)', displayCss: {'text-align': 'center'},
              type: 'number',
              ctrlCss: { width: '96px', 'text-align': 'center'},
              onChange: orderCalculate
            },
            { name: 'color_name',
              display: 'ពណ៌ (Color)', displayCss: {'text-align': 'center'},
              type: 'text',
              ctrlAttr: { readonly:true},
              ctrlCss: { width: '120px', 'text-align': 'center'},
              ctrlClass: 'required',
            },
            { name: 'storage_name',
              display: 'ទំហំផ្ទុក (Storage)', displayCss: {'text-align': 'center'},
              type: 'text',
              ctrlAttr: { readonly:true},
              ctrlCss: { width: '120px', 'text-align': 'center'}
            },
           
            { name: 'price',
              display: 'តម្លៃឯកតា (Unit Price) ($)', displayCss: {'text-align': 'center'},
              type: 'number',
              ctrlAttr: { maxlength: 10, min: 0.00, 'step' : 'any' },
              ctrlCss: { width: '155px', 'text-align': 'center'},
              onChange: orderCalculate
            },
            { name: 'description',
              display: 'សម្គាល់ (Note)', displayCss: {'text-align': 'center'},
              type: 'text',
              ctrlCss: { width: '100px', 'text-align': 'center'}
            },
          ],
          i18n: {
	            rowEmpty: 'មិនមានផលិតផល (No product)'
	        },
          beforeRowRemove: function (caller, rowIndex) {
            return confirm('តើ​អ្នក​ពិតជាចង់​លុប​ផលិតផល​នេះ​ឬ? (Are you sure to remove this item?)');

          },
          afterRowRemoved: function (caller, rowIndex) {
            orderCalculate();
          },
          afterRowAppended: function (caller, rowIndex, addedRowIndex) {
            orderCalculate();
          },
          autoColumnWidth: true,
          hideButtons: {
            moveUp: true,
            insert: true,
            moveDown: true,
            removeLast: true,
            append: true
          }
        });
        // $('#data_append_grid').appendGrid('hideColumn', 'Qty');
      });

      function orderCalculate(){
    		var data = $('#data_append_grid').appendGrid('getAllValue');
    		var order_subtotal = 0;
    		for(var i = 0, t = data.length; i < t; i++){
    			order_subtotal += parseFloat(data[i].price)* parseInt(data[i].quantity);
    		}        
        $("#subtotal").text(numeral(order_subtotal).format('0,0.00'));
        $("#order_subtotal").val(order_subtotal);
    	}
      jQuery(document).on('click', '#btn_by_imei', function () {
        var search_imei = jQuery('#search_imei').val();
        if (search_imei !== "") {
          jQuery.ajax({
            url: 'new_order.php?task=order',
            data: { 'imei': search_imei },
            type: 'POST',
            dataType: 'json',
            success: function (data) {
              var existed = 0;
              var data_apendgrid = $('#data_append_grid').appendGrid('getAllValue');
              for (var i = 0, vtotal = data_apendgrid.length; i < vtotal; i++) {
                if (data.imei == data_apendgrid[i].imei) {
                  existed++;
                  // Check if quantity is greater than 1
                  if (data_apendgrid[i].quantity > 0) {
                    alert('This product IMEI has a quantity greater than 0.');
                    return;
                  }
                }
              }
              if (data.imei !== null && existed === 0) {
                // Ensure quantity is set to 1
                data.quantity = 1;
                // Insert the row with the updated quantity
                $('#data_append_grid').appendGrid('insertRow', [data]);
              } else {
                alert('this product imei has existed in list.');
              }
            },
            error: function (xhr, status, error) {
              console.error("AJAX Error:", error);
            }
          });
        }
        jQuery('#search_imei').val('');
        jQuery('#search_imei').focus();
        return false;
      });
      function getCustomerInfo()
      {
        jQuery.ajax({
          url:'order.php?task=customer&action=SearchByPersonalID',
          data:{'nationalid':jQuery("#inputNumber").val()},
          type:'POST',
          dataType:'json',
          success:function(data){
            jQuery("#inputName").val('');
            jQuery("#inputPhone").val('');
            jQuery("#inputEmail").val('');
            jQuery("#inputAddress").val('');
            if(false !== data){
              jQuery("#inputName").val(data.name);
              jQuery("#inputPhone").val(data.phone);
              jQuery("#inputEmail").val(data.email);
              jQuery("#inputAddress").val(data.address);
            }
          }
        });
      }

      function getCustomerInfoByPhone()
      {
        jQuery.ajax({
          url:'order.php?task=customer&action=SearchByPhoneNumber',
          data:{'phone':jQuery("#inputPhone").val()},
          type:'POST',
          dataType:'json',
          success:function(data){
            jQuery("#inputNumber").val('');
            jQuery("#inputName").val('');
            jQuery("#inputEmail").val('');
            jQuery("#inputAddress").val('');
            if(false !== data){
              jQuery("#inputNumber").val(data.idnumber);
              jQuery("#inputName").val(data.name);
              jQuery("#inputEmail").val(data.email);
              jQuery("#inputAddress").val(data.address);
            }
          }
        });
      }

      function saveOrder(){
      	var customer = {
                        'idnumber': jQuery("#inputNumber").val(), 'name': jQuery("#inputName").val(),
                        'phone': jQuery("#inputPhone").val(), 'email': jQuery("#inputEmail").val(),
                        'address': jQuery("#inputAddress").val()
                      };

      	var staffid = jQuery("#inputStaff").val();
      	var branchid = jQuery('#inputBranch').val();
      	var subtotal = jQuery("#order_subtotal").val();
        var discount = jQuery("#inputDiscount").val();
        var warrenty = jQuery("#inputWarrenty").val();
        var model_price = jQuery("#inputModelPrice").val();
        var model_text = jQuery("#inputModelText").val();
        var total_all = 0;
        total_all = subtotal - discount - model_price;

      	var data = $('#data_append_grid').appendGrid('getAllValue');
        if(data.length === 0){
          alert('No product.');
          return false;
        }
      	var items = [];
    		for(var i = 0, vtotal = data.length; i<vtotal; i++){
    			items.push({imei: data[i].imei, price: data[i].price, quantity: data[i].quantity,  desc: data[i].description});
    		}
  		  var paramdata = { customer: JSON.stringify(customer), staffid: staffid, branchid: branchid, subtotal: subtotal,
          discount: discount, total_all: total_all, warrenty: warrenty, model_price: model_price, model_text: model_text,
          items: JSON.stringify(items)  };
          $('.loader').show();
      	jQuery.ajax({
			      type: 'POST',
			      url:'new_order.php?task=save',
            dataType:'json',
            data: paramdata,
			      error: function (request, status, error) {
		          alert("Cannot save order. Please try again later."+JSON.stringify(request));
  		      },
  		      success: function (data, status, error) {
    		    	alert("Thank you. The product has been saved.");
                    $('.loader').hide();

              newOrder();
              if(data.result > 0){
                window.open('order.php?task=order_list&action=printInvoiceNoIme&id='+data.result, '_blank');
              }
          },
          error: function(){
            //Show error here
            alert("Cannot save data. Please try again later.");
            $('.loader').hide();
          }
  		  });
      }

      function newOrder(){
    		var data = $('#data_append_grid').appendGrid('getAllValue');
    		for(var i = 0, total = data.length; i<total; i++){
    			$('#data_append_grid').appendGrid('removeRow');
    		}
        jQuery("#inputNumber").val('');
        jQuery("#inputName").val('');
        jQuery("#inputPhone").val('');
        jQuery("#inputEmail").val('');
        jQuery("#inputAddress").val('');
      	jQuery("#total").text('');
        jQuery("#inputDiscount").val('0');
        jQuery("#inputWarrenty").val('30');
        jQuery("#inputModelPrice").val('');
        jQuery("#inputModelText").text('');
    	}

    </script>
  {/literal}

{/block}
