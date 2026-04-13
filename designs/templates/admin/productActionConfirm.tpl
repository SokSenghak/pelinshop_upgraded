{extends file="admin/layout.tpl"}
{block name="main"}
  <ul class="breadcrumb">
    <li><a href="{$admin_file}">Home</a></li>
    <li><a href="{$admin_file}?task=product"> Product</a></li>
    <li class="active"> Confirm</li>
  </ul>

  <div class="panel panel-primary">
    <div class="panel-heading"><h3 class="panel-title text-center">New Product Confirm</h3> </div>
    <div class="panel-body">
      <form role="form" action="{$admin_file}?task=product&amp;action=completed" method="post">
        <div class="table-responsive">
          <table class="table table-bordered">
            <tr>
              <td valign="top" width="200"><label>IMEI Number</label></td>
              <td>{$smarty.session.sproduct.imei}</td>
            </tr>
            <tr>
              <td valign="top" width="200"><label>Company Title</label></td>
              <td>
                {foreach from=$list_company_name item=company}
                  {if $smarty.session.sproduct.company_id eq $company.id}
                    {$company.name}
                  {/if}
                {/foreach}
              </td>
            </tr>
            <tr>
              <td><label>Product Title</label></td>
              <td>
                {foreach from=$list_product_title item=title}
                  {if $smarty.session.sproduct.titles eq $title.id}{$title.name}{/if}
                {/foreach}
                {foreach from=$list_color_name item=color}
                  {if $smarty.session.sproduct.colors_ eq $color.id}-{$color.name}{/if}
                {/foreach}
                {foreach from=$list_storage_name item=storage}
                  {if $smarty.session.sproduct.storages_ eq $storage.id}-{$storage.name}{/if}
                {/foreach}
              </td>
            </tr>
            <tr>
              <td><label>Cost</label></td>
              <td>$ {$smarty.session.sproduct.cost|number_format:2}</td>
            </tr>
            <tr>
              <td><label>Price</label></td>
              <td>$ {$smarty.session.sproduct.price|number_format:2}</td>
            </tr>
            <tr>
              <td><label>Product Maker</label></td>
              <td>
              {foreach from=$list_maker_name item=maker}
                {if $smarty.session.sproduct.maker_id eq $maker.id}{$maker.name}{/if}
              {/foreach}
              </td>
            </tr>
            <tr>
              <td><label>Product Brand</label></td>
              <td>
                {foreach from=$list_brand_name item=brand}
                  {if $smarty.session.sproduct.brand_id eq $brand.id}{$brand.name}{/if}
                {/foreach}
              </td>
            </tr>
            <tr>
              <td><label>Branch Name</label></td>
              <td>
                {if $smarty.session.sproduct.branch}
                  {foreach from=$list_branch item=branch}
                    {if $smarty.session.sproduct.branch eq $branch.id}{$branch.name}{/if}
                  {/foreach}
                {else}
                  ~
                {/if}
              </td>
            </tr>
            <tr>
              <td><label>Product Used</label></td>
              <td>
                {if $smarty.session.sproduct.pro_used_id}
                  {foreach from=$list_product_used item=pro_use}
                    {if $smarty.session.sproduct.pro_used_id eq $pro_use.id}{$pro_use.name}{/if}
                  {/foreach}
                {else}
                  ~
                {/if}
              </td>
            </tr>
            <tr>
              <td><label>Description</label></td>
              <td>{if $smarty.session.sproduct.desc eq ''} ~ {else}{$smarty.session.sproduct.desc}{/if}</td>
            </tr>
            <tr>
              <td><label>Cutting Stock</label></td>
              <td>
                  {if isset($smarty.session.sproduct) && $smarty.session.sproduct.is_cutting eq 2}
                    មិនកាត់ស្តុក
                  {else}
                    កាត់ស្តុក
                  {/if}
              </td>
            </tr>
          </table>
        </div>
        <a class="btn btn-info" href="{$index_file_name}?task=product&amp;action=add"><i class="fa fa-arrow-circle-left"></i>&nbsp;Back</a>
        <button class="btn btn-success" type="submit" name="submit"><i class="glyphicon glyphicon-save"></i>&nbsp;save</button>
      </form>
    </div>
  </div>



{/block}
