{extends file="admin/layout.tpl"}
{block name="main"}
  <ul class="breadcrumb">
    <li><a href="{$admin_file}">ទំព័រដើម (Home)</a></li>
    <li><a href="{$admin_file}?task=order_list">ព័ត៌មានការបញ្ជាទិញ (Order Information)</a></li>
    <li class="active">ព័ត៌មានអំពីបញ្ជីលក់ផលិតផល (Information of Product Sold List)</li>
  </ul>

  <div class="panel panel-primary">
    <div class="panel-heading"><h3 class="panel-title">ព័ត៌មានការលក់ផលិតផល (Information of Product Sold)</h3> </div>
    <div class="panel-body">
      <div class="table-responsive">
        <table class="table table-bordered">
          <tr>
            <td width="200px"><label>លេខសម្គាល់ការលក់ (Sale ID)</label></td>
            <td>{$list_orderItem_data.id}</td>
          </tr>
          <tr>
            <td><label>ឈ្មោះសាខា (Branch Name)</label></td>
            <td>{$list_orderItem_data.branch_name}</td>
          </tr>
          <tr>
            <td><label>ឈ្មោះបុគ្គលិក (Staff Name)</label></td>
            <td><label class="label label-info"><a href="{$index_file}?task=staff&amp;action=history&amp;id={$list_orderItem_data.staff_id}">{$list_orderItem_data.staff_name}</a></label></td>
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
            <td><label>តម្លៃសរុប (Total)</label></td>
            <td>$ {$list_orderItem_data.total|number_format:2}</td>
          </tr>
          <tr>
            <td><label>កាលបរិច្ឆេទការលក់ (Date Of Sale)</label></td>
            <td>{$list_orderItem_data.created_at}</td>
          </tr>

        </table>
      </div>
      <legend>ព័ត៌មានអតិថិជន (Customer Information)</legend>
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <th class="text-center">លេខអត្តសញ្ញាណប័ណ្ណ </br>(Personal ID)</th>
            <th>ឈ្មោះអតិថិជន (Customer Name)</th>
            <th class="text-center">លេខទូរស័ព្ទ </br>(Phone Number)</th>
            <th>អុីមែល </br>(Email Address)</th>
            <th>អាសយដ្ឋាន (Address)</th>
          </thead>
          <tbody>
          <tr>
            <td class="text-center" valign="top" width="120px;">{if $customer.idnumber}{$customer.idnumber}{else} ~ {/if}</td>
            <td><label class="label label-info"><a href="{$index_file}?task=customer&amp;action=history&amp;id={$customer.id}">{if $customer.name}{$customer.name}{else} ~ {/if}</a></label></td>
            <td class="text-center" valign="top" width="130px;">{$customer.phone}</td>
            <td>{if $customer.email eq ''} ~ {else}{$customer.email}{/if}</td>
            <td>{if $customer.address eq ''} ~ {else}{$customer.address|mb_substr:0:50|nl2br}{if $customer.address|count_characters >= 50} ... {/if}{/if}</td>
          </tr>
          </tbody>
        </table>
      <div>
      <legend>ព័ត៌មានផលិតផល (Product Information)</legend>
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <th class="text-center">លេខ IMEI (IMEI Number)</th>
            <th class="text-center">ផលិតផល (Title)</th>
            <th class="text-center">តម្លៃដើម (Cost)</th>
            <th class="text-center">តម្លៃលក់ (Price)</th>
            <th class="text-center">ក្រុមហ៊ុនផលិត (Maker)</th>
            <th class="text-center">ម៉ាកផលិតផល (Brand)</th>
            <th class="text-center">បរិយាយ (Description)</th>
          </thead>
          <tbody>
          {foreach from=$products item=data}
            <tr>
              <td valign="top" width="140px;">{$data.imei}</td>
              <td class="text-center">{$data.title}</td>
              <td class="text-center" valign="top" width="73px;">$ {$data.cost|number_format:2}</td>
              <td class="text-center" valign="top" width="73px;">$ {$data.price|number_format:2}</td>
              <td class="text-center">{$data.maker_name}</td>
              <td class="text-center">{$data.brand_name}</td>
              <td class="text-center">{if $data.description eq ''} ~ {else}{$data.description|mb_substr:0:50|nl2br}{if $data.description|count_characters >= 50} ... {/if}{/if}</td>
            </tr>
          {/foreach}
          </tbody>
        </table>
      </div>
    </div>
  </div>

{/block}
