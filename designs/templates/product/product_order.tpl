{extends file="product/layout.tpl"}
{block name="main"}
      <div class="table-responsive">
        {*product order item*}
        <table class="table table-bordered" id="data_append_grid"></table>

        {*product total price*}
        <table class="table table-bordered">
          <tr>
            <td class="text-right"><label>Sub Total</label></td>
            <td class="text-right"> $ <label id="subOfTotal"></label> </td>
          </tr>
          <tr>
            <td class="text-right"><label>Discount</label></td>
            <td class="text-right"> 0 %</td>
          </tr>
          <tr>
            <td class="text-right"><label>Total</label></td>
            <td class="text-right"> $ 0.00 </td>
          </tr>
        </table>
      </div>
        {*Customer Information*}
      <form data-toggle="validator"  role="form" method="post" action="{$product_file}" class="form-horizontal row-border">
        <h4 class="text-muted">Please fill your information.</h4>
        <span style="color:red">* Required field</span>
        <hr style="margin-bottom:10px;margin-top:10px;">
        <div class="form-group">
          <div class="col-md-2"><label>Personal ID:<span style="color:red">*</span></label></div>
          <div class="col-md-10">
            <input type="text" name="idnumber" id="inputNumber" maxlength="10" class="form-control" placeholder="Personal ID (10 digits)" onkeyup="NumAndTwoDecimals(event , this);" data-error="Please input personal id." required>
            <div class="help-block with-errors"></div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-2"><label>Customer Name:<span style="color:red">*</span></label></div>
          <div class="col-md-10">
            <input type="text" name="name" id="inputName" class="form-control" placeholder="customer name" data-error="Please input customer name." required/>
            <div class="help-block with-errors"></div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-2"><label>Phone Number:<span style="color:red">*</span></label></div>
          <div class="col-md-10">
            <input type="text" name="phone" id="inputPhone" maxlength="10" class="form-control" placeholder="phone number" onkeyup="NumAndTwoDecimals(event , this);" data-error="Please input phone number." required/>
            <div class="help-block with-errors"></div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-2"><label>Email Address:</label></div>
          <div class="col-md-10">
            <input type="email" id="inputEmail" name="email" class="form-control" placeholder="email" data-error="Bruh, that email address is invalid"/>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-2"><label>Address:</label></div>
          <div class="col-md-10">
            <input type="text" name="address" class="form-control" placeholder="address" />
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-2">
            <button data-toggle="tooltip" data-original-title="Save Data" class="btn btn-success btn-md" type="submit"><i class="glyphicon glyphicon-shopping-cart"></i> Save</button>
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
              display: 'IMEI Number', displayCss: {'text-align': 'center'},
              type: 'text',
              ctrlAttr: { maxlength: 15 },
              ctrlCss: { width: '200px', 'text-align': 'center'}
            },
            { name: 'title',
              display: 'Product name', displayCss: {'text-align': 'center'},
              type: 'text',
              ctrlAttr: { maxlength: 100 },
              ctrlCss: { width: '300px', 'text-align': 'center'}
            },
            { name: 'Qty',
              display: 'Quantity',
              type: 'number',
              ctrlAttr: { maxlength: 10 }, displayCss: {'text-align': 'center'},
              ctrlCss: { width: '100px', 'text-align': 'center'},
              value: 1,
                onChange: function(evt, rowIndex) {
                  var row_qty = $('#data_append_grid').appendGrid('getRowValue', rowIndex);
                  var row_price = $('#data_append_grid').appendGrid('getCtrlValue', 'price', rowIndex);
                  var total = parseInt(row_qty.Qty) * parseFloat(row_price);
                  $('#data_append_grid').appendGrid('setCtrlValue', 'sub_total', rowIndex, total);
                }
            },
            { name: 'price',
              display: 'Unit Price', displayCss: {'text-align': 'center'},
              type: 'number',
              ctrlAttr: { maxlength: 10 },
              ctrlCss: { width: '100px', 'text-align': 'center'},
              value: 0,
              emptyCriteria: function (value) {
                // A value lesser than zero will consider as empty.
                return (value < 0); },
                onChange: function(evt, rowIndex) {
                  var row_price = $('#data_append_grid').appendGrid('getRowValue', rowIndex);
                  var row_qty = $('#data_append_grid').appendGrid('getCtrlValue', 'Qty', rowIndex);
                  var total = parseInt(row_qty) * parseFloat(row_price.price);
                  $('#data_append_grid').appendGrid('setCtrlValue', 'sub_total', rowIndex, total);
                }
            },
            { name: 'sub_total',
              display: 'Sub Total', displayCss: {'text-align': 'center'},
              type: 'number',
              ctrlAttr: { maxlength: 10 },
              ctrlCss: { width: '100px', 'text-align': 'center'},
              value: 0
            }
          ],

          beforeRowRemove: function (caller, rowIndex) {
            return confirm('Are you sure to remove this item?');

          },
          afterRowRemoved: function (caller, rowIndex) {

          },
          autoColumnWidth: true,
          hideButtons: {
            moveUp: true,
            insert: true,
            moveDown: true,
            removeLast: true
          }
        });
      });

      jQuery(document).on('click','#btn_by_imei',function(){
        var search_imei = jQuery('#search_imei').val();
        if("" !== search_imei){
          jQuery.ajax({
            url:'product_order.php?task=order',
            data:{'imei':search_imei},
            type:'POST',
            dataType:'json',
            success:function(data){
              if(null !== data){
                var data_new = [];
                var data_row = 0;
                var discount = 0;

                $.each(data, function(index, value){
                  data_new.push(value);
                });
                console.log(data_new);
                //load data by search imei
                $('#data_append_grid').appendGrid('load', data_new);
//                var  allData = $('#data_append_grid').appendGrid('getAllValue');
//                alert(JSON.stringify(data_new));


//                //count all row
//                var count =  $('#data_append_grid').appendGrid('getRowCount');
//
//                // sum row of sub total for total
//                for (i = 0; i < count; i++) {
//                  var row = $('#data_append_grid').appendGrid('getRowValue', i);
//                  data_row += parseFloat(row.sub_total);
//                }
//
//                alert(data_row);
//
//                //total price
//                var total = data_row - (data_row * discount);

              }
            }
          });
        }
        return false;
      });
    </script>
  {/literal}

{/block}