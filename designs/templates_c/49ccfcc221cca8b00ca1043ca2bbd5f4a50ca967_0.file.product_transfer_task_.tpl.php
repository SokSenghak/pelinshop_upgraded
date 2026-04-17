<?php
/* Smarty version 4.1.0, created on 2026-04-17 13:50:58
  from '/home/senghak/Documents/pelinshop_php8/pelinshop_upgraded/designs/templates/admin/product_transfer_task_.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.0',
  'unifunc' => 'content_69e1d852480427_29620180',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '49ccfcc221cca8b00ca1043ca2bbd5f4a50ca967' => 
    array (
      0 => '/home/senghak/Documents/pelinshop_php8/pelinshop_upgraded/designs/templates/admin/product_transfer_task_.tpl',
      1 => 1776070560,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69e1d852480427_29620180 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_209755882069e1d852479973_98922317', "main");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "admin/layout.tpl");
}
/* {block "main"} */
class Block_209755882069e1d852479973_98922317 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'main' => 
  array (
    0 => 'Block_209755882069e1d852479973_98922317',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<ul class="breadcrumb">
		<li><a href="<?php echo $_smarty_tpl->tpl_vars['admin_file']->value;?>
">ទំព័រដើម (Home)</a></li>
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
                  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list_branch']->value, 'data');
$_smarty_tpl->tpl_vars['data']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['data']->value) {
$_smarty_tpl->tpl_vars['data']->do_else = false;
?>
                  <option value="<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['data']->value['name'];?>
</option>
                  <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
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

  
    <?php echo '<script'; ?>
 type="text/javascript">
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

    <?php echo '</script'; ?>
>
  

<?php
}
}
/* {/block "main"} */
}
