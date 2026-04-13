{extends file="admin/layout.tpl"}
{block name="main"}
  <ul class="breadcrumb">
    <li><a href="{$admin_file}">Home</a></li>
    <li><a href="{$admin_file}?task=product">Product</a> </li>
    <li class="active">View information</li>
  </ul>

  <div class="panel panel-primary">
    <div class="panel-heading"><h3 class="panel-title text-center">Product Information</h3> </div>
    <div class="panel-body">
      <div class="table-responsive">
        <table class="table table-bordered">
          <tr>
            <td valign="top" width="200px;"><label>IMEI Number</label></td>
            <td>{$list_product_data.imei}</td>
          </tr>
          <tr>
            <td><label>Product Title</label></td>
            <td>{$list_product_data.title}</td>
          </tr>
          <tr>
            <td><label>In Stock</label></td>
            <td>{$list_product_data.stock}</td>
          </tr>
          <tr>
            <td><label>Cost</label></td>
            <td>$ {$list_product_data.cost|number_format:2}</td>
          </tr>
          <tr>
            <td><label>Price</label></td>
            <td>$ {$list_product_data.price|number_format:2}</td>
          </tr>
          <tr>
            <td><label>Product Maker</label></td>
            <td>
            {foreach from=$list_maker_name item=maker}
              {if $list_product_data.maker_id eq $maker.id}{$maker.name}{/if}
            {/foreach}
            </td>
          </tr>
          <tr>
            <td><label>Product brand</label></td>
            <td>
            {foreach from=$list_brand_name item=brand}
              {if $list_product_data.brand_id eq $brand.id}{$brand.name}{/if}
            {/foreach}
            </td>
          </tr>
          <tr>
            <td><label>Product Image</label></td>
            <td>
              {if $list_product_data.photoone}
                <a href="{$shop_site}images/product/{$list_product_data.photoone}" data-lightbox="{$list_product_data.photoone}">
                  <img src="{$shop_site}images/product/thumbnail__{$list_product_data.photoone}" class="img-thumbnail"  /></a>
              {else}
                <label> ~ </label>
              {/if}
            </td>
          </tr>
          <tr>
            <td><label>Description</label></td>
            <td>{if $list_product_data.description}{$list_product_data.description|nl2br}{else} ~ {/if}</td>
          </tr>
        </table>
      </div>
    </div>
  </div>



{/block}
