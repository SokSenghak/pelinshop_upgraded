{extends file="admin/layout.tpl"}
{block name="main"}

<ul class="breadcrumb">
	<li><a href="{$admin_file}">ទំព័រដើម (Home)</a></li>
	<li class="active">ព័ត៌មានលម្អិតអំពីប្រវត្តិផ្ទេរផលិតផល (Product Transfer History Detail)</li>
</ul>

<div class="panel panel-primary">
  <div class="panel-heading"><h3 class="panel-title">ព័ត៌មានលម្អិតអំពីប្រវត្តិផ្ទេរផលិតផល (Product Transfer History Detail)</h3></div>
  <div class="panel-body">
    <table class="table table-bordered" style="margin-bottom: 0;width: 100%">
      <tr>
        <td style="width:30%">
          <label class="nopadding" style="font-size:16px;font-weight:bold">{$product_transfer_data.branch_name}</label>
        </td>
        <td>
          <label class="nopadding" style="font-size:16px;font-weight:bold"> <i class="glyphicon glyphicon-phone"></i> {$product_transfer_data.qty} </label>
        </td>
      </tr>
    </table>
    <hr style="margin-top:5px;margin-bottom:5px;" />
    <div class="table-responsive">
    	<table class="table table-bordered table-striped table-hover">
        <thead class="table_header">
    	  	<tr>
						<th class="text-center">IMEI</th>
						<th class="text-center">ផលិតផល (Product)</th>
						<th class="text-center">តម្លៃលក់ (Price)</th>
						<th class="text-center">ក្រុមហ៊ុនផលិត (Maker)</th>
            <th class="text-center">ម៉ាកផលិតផល (Brand)</th>
    	  	</tr>
    	  </thead>
				<tbody>
          {foreach from=$product_transfer_history_detail item=data}
          <tr>
            <td class="text-center" valign="top" width="140px;">{$data.imei}</td>
            <td class="text-center">{$data.title}-{$data.color_name}-{$data.storage_name}</td>
            <td class="text-center" valign="top" width="100px;">$ {$data.price|number_format:2}</td>
            <td class="text-center">{$data.maker_name}</td>
            <td class="text-center">{$data.brand_name}</td>
          </tr>
          {/foreach}
        </tbody>
      </table>
    </div>
  </div>
</div>



{/block}
