{extends file="admin/layout.tpl"}
{block name="main"}
	<ul class="breadcrumb">
		<li><a href="{$admin_file}">ទំព័រដើម (Home)</a></li>
		<li class="active">ដំណើរការផ្ទេរផលិតផល (Transfer Product Task)</li>
	</ul>
	<div class="panel panel-primary">
	  <div class="panel-heading"><h3 class="panel-title">បញ្ជីផលិតផល (Product List)</h3></div>
	  <div class="panel-body">
			<div class="col-md-12">
				<form class="form-horizontal" role="form">
		      <div class="form-group">
						<div class="col-md-9">
			        <div class="input-group">
								<span class="input-group-addon"><label style="margin-bottom: 0;">IMEI ផលិតផល (Product IMEI):</label></span>
			          <input maxlength="16" id="search_imei" type="text" name="imei" class="form-control" placeholder="បញ្ចូល IMEI នៅទៅនេះ (Type IMEI here)"  autofocus>
		              <span class="input-group-btn">
		                <button data-toggle="tooltip" title="Search By IMEI" id="btn_by_imei" class="btn btn-primary" ><li class="glyphicon glyphicon-search"></li>&nbsp;ស្វែងរក (Search)</button>
		              </span>
			        </div>
			      </div>
					</div>
		    </form>
			</div>
			<form data-toggle="validator" onsubmit='transferProduct(); return false;' role="form" class="form-horizontal">
				<div class="col-md-12">
					<div class="table-responsive">
				    {*product item*}
				    <table class="table table-bordered" id="data_append_grid"></table>
				  </div>
				</div>
				<div class="col-md-12">
          <div class="form-group">
            <div class="col-md-9">
              <div class="input-group">
                <span class="input-group-addon"><label style="margin-bottom: 0;">ជ្រើសរើសសាខា (Choose Branch):</label></span>
								<select class="form-control" name="branch_id" id="branch_id" required>
                  <option value="">------ឈ្មោះសាខា (Branch Name)------</option>
                  {foreach from=$list_branch item=data}
                  <option value="{$data.id}">{$data.name}</option>
                  {/foreach}
                </select>
								<span class="input-group-btn">
									<button class="btn btn-success" type="submit"><i class="glyphicon glyphicon-transfer"></i>&nbsp;ផ្ទេរផលិតផល (Transfer)</button>
								</span>
							</div>
						</div>
					</div>
        </div>
			</form>
	  </div>
	</div>

  {literal}
    <script type="text/javascript">
      $(function() {
        $('#data_append_grid').appendGrid({
          initRows: 0,
          columns: [
					{ name: 'id',
						display: 'id',
						type: 'text'
					},
            { name: 'imei',
              display: 'លេខ IMEI (IMEI Number)', displayCss: {'text-align': 'center'},
              type: 'text',
              ctrlAttr: { readonly:true},
              ctrlCss: { width: '200px', 'text-align': 'center'}
            },
            { name: 'product_name',
              display: 'ឈ្មោះផលិតផល (Phone name)', displayCss: {'text-align': 'center'},
              type: 'text',
              ctrlAttr: { readonly:true},
              ctrlCss: { width: '200px', 'text-align': 'center'}
            },
            { name: 'cost',
              display: 'តម្លៃដើម (Cost)', displayCss: {'text-align': 'center'},
              type: 'text',
              ctrlAttr: { readonly:true },
              ctrlCss: { width: '70px', 'text-align': 'center'}
            },
            { name: 'price',
              display: 'តម្លៃលក់ (Price)', displayCss: {'text-align': 'center'},
              type: 'text',
              ctrlAttr: { readonly:true },
              ctrlCss: { width: '70px', 'text-align': 'center'}
            },
						{ name: 'maker_name',
              display: 'ក្រុមហ៊ុនផលិត (Maker)', displayCss: {'text-align': 'center'},
              type: 'text',
              ctrlAttr: { readonly:true },
              ctrlCss: { width: '70px', 'text-align': 'center'}
            },
						{ name: 'brand_name',
              display: 'ម៉ាកផលិតផល (Brand)', displayCss: {'text-align': 'center'},
              type: 'text',
              ctrlAttr: { readonly:true },
              ctrlCss: { width: '70px', 'text-align': 'center'}
            },
            { name: 'description',
              display: 'បរិយាយ (Description)', displayCss: { 'text-align': 'center'},
              type: 'text',
              ctrlAttr: { readonly:true },
              ctrlCss: { width: '100px', 'text-align': 'center'}
            }
          ],
          i18n: {
	            rowEmpty: 'មិនមានផលិតផល (No product)'
	        },
          beforeRowRemove: function (caller, rowIndex) {
            return confirm('តើ​អ្នក​ប្រាកដ​ក្នុង​ការ​លុប​ផលិតផល​នេះ​ឬ? (Are you sure to remove this item?)');
          },
          afterRowRemoved: function (caller, rowIndex) {

          },
          afterRowAppended: function (caller, rowIndex, addedRowIndex) {

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
				$('#data_append_grid').appendGrid('hideColumn', 'id');
			});

      jQuery(document).on('click','#btn_by_imei',function(){
        var search_imei = jQuery('#search_imei').val();
        if("" !== search_imei){
          jQuery.ajax({
            url:'admin.php?task=getProductTransfer',
            data:{'imei':search_imei},
            type:'POST',
            dataType:'json',
            success:function(data){
							var existed = 0;
							var data_apendgrid = $('#data_append_grid').appendGrid('getAllValue');
							for(var i = 0, vtotal = data_apendgrid.length; i<vtotal; i++){
								if(data.imei == data_apendgrid[i].imei) existed++;
							}
							if(null !== data.imei && existed == 0){
                $('#data_append_grid').appendGrid('insertRow', [data]);
              } else {
                alert('this product imei has existed in list.');
              }
            }
          });
        }
        jQuery('#search_imei').val('');
        jQuery('#search_imei').focus();
        return false;
      });

      function transferProduct()
			{
      	var data = $('#data_append_grid').appendGrid('getAllValue');
				var branch_id = jQuery('#branch_id').val();

        if(data.length === 0){
          alert('No product.');
          return false;
        }
      	var items = [];
    		for(var i = 0, vtotal = data.length; i<vtotal; i++){
    			items.push({id: data[i].id, imei: data[i].imei});
    		}
  		  var paramdata = { branch_id: branch_id, items: JSON.stringify(items)  };
      	jQuery.ajax({
		      type: 'POST',
		      url:'admin.php?task=transfer',
          dataType:'json',
          data: paramdata,
		      error: function (request, status, error) {
	          alert("Something have problems. Please try again later."+JSON.stringify(request));
		      },
		      success: function (data, status, error) {
  		    	alert("The product has been transfered.");
            clearProduct();
						jQuery('#search_imei').val('');
		        jQuery('#search_imei').focus();
  		    }
  		  });
      }

      function clearProduct(){
    		var data = $('#data_append_grid').appendGrid('getAllValue');
    		for(var i = 0, total = data.length; i<total; i++){
    			$('#data_append_grid').appendGrid('removeRow');
    		}
    	}

    </script>
  {/literal}

{/block}
