{extends file="order/layout.tpl"}
{block name="main"}

  <div class="table-responsive">
    <table class="table table-bordered">
      {*<thead>*}
      {*<th>Image</th>*}
      {*<th>Title</th>*}
      {*<th>Product Maker</th>*}
      {*<th>Product Brand</th>*}
      {*<th>Price</th>*}
      {*<th>Action</th>*}
      {*</thead>*}
      <tbody>
      {foreach from=$list_product_data item=data}
      <tr>
        <td>
          {if $data.photoone}
            <a href="{$shop_site}images/product/{$data.photoone}" data-lightbox="{$data.photoone}">
              <img src="{$shop_site}images/product/thumbnail__{$data.photoone}" class="img-thumbnail"  /></a>
          {else}
            <label> ~ </label>
          {/if}
        </td>
        <td>{$data.title}</td>
        <td>
          {foreach from=$list_maker_name item=maker}
            {if $data.maker_id eq $maker.id}{$maker.name}{/if}
          {/foreach}
        </td>
        <td>
          {foreach from=$list_brand_name item=brand}
            {if $data.brand_id eq $brand.id}{$brand.name}{/if}
          {/foreach}
        </td>
        <td>$ <b>{$data.price|number_format:2}</b></td>
        <td width="350px">
          <a class="btn btn-success" href="{$index_file}?task=product&amp;action=view&amp;pid={$data.id}">
            <i class="glyphicon glyphicon-list"></i> Detail
          </a>
          <a class="btn btn-success" href="{$index_file}?task=shopping&amp;action=order&amp;pid={$data.id}">
            <i class="glyphicon glyphicon-shopping-cart"></i> Add To Cart
          </a>

      </tr>
      {/foreach}
    </table>
  </div>


{/block}
