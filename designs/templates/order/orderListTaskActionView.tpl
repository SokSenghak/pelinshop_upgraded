{extends file="order/layout.tpl"}
{block name="main"}
  <ul class="breadcrumb">
    <li><a href="{$order_file}">ទំព័រដើម (Home)</a></li>
    <li><a href="{$order_file}?task=history">ប្រវត្តិបញ្ជាទិញ (Order Histroy)</a></li>
    <li class="active">បញ្ជីបញ្ជាទិញ (Order List)</li>
  </ul>

  <div class="panel panel-primary">
    <div class="panel-heading"><h3 class="panel-title text-center">ព័ត៌មានបញ្ជាទិញផលិតផល (Order Product Information)</h3> </div>
    <div class="panel-body">
      <div class="table-responsive">
        <table class="table table-bordered">
          <tr>
            <td width="200px"><label>លេខបញ្ជាទិញ (Order ID)</label></td>
            <td>{$list_orderItem_data.id}</td>
          </tr>
          <tr>
            <td><label>ឈ្មោះសាខា (Branch Name)</label></td>
            <td>{$list_orderItem_data.branch_name}</td>
          </tr>
          <tr>
            <td><label>ឈ្មោះបុគ្គលិក (Staff Name)</label></td>
            <td><label class="label label-info">{$list_orderItem_data.staff_name}</label></td>
          </tr>
          <tr>
            <td><label>សរុបរង (Sub Total)</label></td>
            <td>$ {$list_orderItem_data.subtotal|number_format:2}</td>
          </tr>
          <tr>
            <td><label>បញ្ចុះតម្លៃ (Discount)</label></td>
            <td>$ {$list_orderItem_data.discount|number_format:2}</td>
          </tr>
          <tr>
            <td><label>សរុប (Total)</label></td>
            <td>$ {$list_orderItem_data.total|number_format:2}</td>
          </tr>
          <tr>
            <td><label>កាលបរិច្ឆេទបញ្ជាទិញ (Ordered Date)</label></td>
            <td>{$list_orderItem_data.ordered_at|date_format:"%Y-%m-%d %H:%M"}</td>
          </tr>

        </table>
      </div>
      <legend>ព័ត៌មានអតិថិជន (Customer Information)</legend>
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <th class="text-center">លេខអត្តសញ្ញាណប័ណ្ណ (ID Number)</th>
            <th>ឈ្មោះអតិថិជន (Customer Name)</th>
            <th class="text-center">លេខទូរស័ព្ទ (Phone Number)</th>
            <th>អុីមែល (Email Address)</th>
            <th>អាសយដ្ឋាន (Address)</th>
          </thead>
          <tbody>
          <tr>
            <td class="text-center" valign="top" width="120px;">{if $customer.idnumber}{$customer.idnumber}{else} ~ {/if}</td>
            <td><label class="label label-info">{$customer.name}</label></td>
            <td class="text-center" valign="top" width="130px;">{$customer.phone}</td>
            <td>{if $customer.email eq ''} ~ {else}{$customer.email}{/if}</td>
            <td>{if $customer.address eq ''} ~ {else}{$customer.address|nl2br}{/if}</td>
          </tr>
          </tbody>
        </table>
      <div>

      <legend>ព័ត៌មានផលិតផល (Product Information)</legend>
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <th class="text-center">លេខ IMEI (IMEI Number)</th>
            <th class="text-center">ឈ្មោះផលិតផល (Title)</th>
            <!-- <th class="text-center">Cost</th> -->
            <th class="text-center">តម្លៃលក់ (Price)</th>
            <th class="text-center">ក្រុមហ៊ុនផលិត (Maker)</th>
            <th class="text-center">ម៉ាកផលិតផល (Brand)</th>
            <th class="text-center">ការធានា (Warrenty)</th>
            <th class="text-center">ពិពណ៌នា (Description)</th>
          </thead>
          <tbody>
          {foreach from=$products item=data}
            <tr>
              <td valign="top" width="140px;">{$data.imei}</td>
              <td class="text-center">{$data.title}</td>
              <!-- <td class="text-center" valign="top" width="100px;">$ {$data.cost|number_format:2}</td> -->
              <td class="text-center" valign="top" width="100px;">$ {$data.price|number_format:2}</td>
              <td class="text-center">{$data.maker_name}</td>
              <td class="text-center">{$data.brand_name}</td>
              <td class="text-center">{$data.warrenty} days</td>
              <td class="text-center">{if $data.description eq ''} ~ {else}{$data.description|nl2br}{/if}</td>
            </tr>
          {/foreach}
          </tbody>
        </table>
      </div>
    </div>
  </div>

{/block}
