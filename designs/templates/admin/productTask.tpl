{extends file="admin/layout.tpl"}
{block name="main"}
  <ul class="breadcrumb">
    <li><a href="{$admin_file}">ទំព័រដើម (Home)</a></li>
    <li class="active">ព័ត៌មានផលិតផល (Product information)</li>
  </ul>
  <div class="panel panel-primary">
    <div class="panel-heading">
      <form method="get" class="form-inline" action="#">
        <a class="btn btn-md btn-success " href="{$admin_file}?task=product&amp;action=add"><i class="glyphicon glyphicon-plus"></i>&nbsp;ផលិតផលថ្មី (New Product)</a>
        <div class="form-group">
          <input type="number" id="num_print" maxlength="2" class="form-control" style="width: 65px;" onchange="number_print()">
        </div>
        <div class="btn-group">
          <a class="btn btn-md btn-danger" id="href_print" href="{$admin_file}?task=product&amp;action=all_qrcode_print&amp;num_print=0" target="_blank"><i class="fa fa fa-print"></i>
            បោះពុម្ព Qrcode ដោយការជ្រើសរើស (Print Qrcode By Select) <span class="badge" id="total_sel">{if $smarty.session.pro_id}{$smarty.session.pro_id|COUNT}{else}0{/if}</span>
          </a>
          <button type="button" class="btn btn-primary" id="remove_pro">X</button>
        </div>

      </form>

    </div>
    <div class="panel-body">
      <div class="row">
        <div class="col-md-12">
          <form role="form" method="get" action="{$admin_file}?task=product" class="form-inline">
            <input type="hidden" name="task" value="product">
            <div class="form-group" style="margin-bottom: 5px;">
              <select name="maker" class="form-control" style="padding:0px">
                <option value="">---ជ្រើសរើសក្រុមហ៊ុនផលិត (Choose Product Maker)---</option>
                {foreach from=$list_maker_name item=maker}
                  <option value="{$maker.id}" {if $smarty.get.maker eq $maker.id}selected{/if}>{$maker.name}</option>
                {/foreach}
              </select>
            </div>
            <div class="form-group" style="margin-bottom: 5px;">
              <select name="brand" class="form-control" style="padding:0px">
                <option value="">---ជ្រើសរើសម៉ាកផលិតផល (Choose Brand Name)---</option>
                {foreach from=$list_brand_name item=brand}
                  <option value="{$brand.id}" {if $smarty.get.brand eq $brand.id}selected{/if}>{$brand.name}</option>
                {/foreach}
              </select>
            </div>
            <div class="form-group" style="margin-bottom: 5px;">
              <select name="branch_id" class="form-control" style="padding:0px">
              <option value="">---ជ្រើសរើសសាខា (Select Branch Name)---</option>
              {foreach from=$list_branch item=branch}
                <option value="{$branch.id}" {if $smarty.get.branch_id eq $branch.id}selected{/if}>{$branch.name}</option>
              {/foreach}
              </select>
            </div>
            <div class="form-group" style="margin-bottom: 5px;">
              <select name="pr_st_id" class="form-control" style="padding:0px">
              <option value="">---ជ្រើសរើសទំហំផ្ទុក (Select Product Storage)---</option>
              {foreach from=$product_storage item=data}
                <option value="{$data.id}" {if $smarty.get.pr_st_id eq $data.id}selected{/if}>{$data.name}</option>
              {/foreach}
              </select>
            </div>
            <div class="form-group" style="margin-bottom: 5px;">
              <div class="input-group date">
                <input type="text" id="date_from" value ="{$smarty.get.from|escape}" class="form-control" name="from" placeholder="ពីកាលបរិច្ឆេទបញ្ជាទិញ (Order Date From)"/>
                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
                </span>
              </div>
            </div>
            <div class="form-group" style="margin-bottom: 5px;">
              <div class="input-group date" >
                <input type="text" id="date_to" value ="{$smarty.get.to|escape}" class="form-control" name="to" placeholder="ទៅកាលបរិច្ឆេទបញ្ជាទិញ (Order Date To)" />
                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
                </span>
              </div>
            </div>
            <div class="form-group" style="margin-bottom: 5px;">
              <div class="input-group">
                <input type="text" value="{$smarty.get.kwd|escape}" name="kwd" class="form-control" style="padding:0px" placeholder=" ស្វែងរកតាមលេខ IMEI ឬឈ្មោះផលិតផល (Search by IMEI Number or Title)" autofocus>
                  <span class="input-group-btn">
                    <button class="btn btn-success" type="submit"><li class="glyphicon glyphicon-search"></li>&nbsp;ស្វែងរក (Search)</button>
                </span>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <!-- Nav tabs -->
          <ul class="nav nav-pills" role="tablist">
              <li role="presentation" class="{if !$smarty.get.tab or $smarty.get.tab eq 1 } active {/if} khmer-first-font"><a href="{$admin_file_name}?task=product&maker={$smarty.get.maker}&brand={$smarty.get.brand}&branch_id={$smarty.get.branch_id}&pr_st_id={$smarty.get.pr_st_id}&from={$smarty.get.from}&to={$smarty.get.to}&kwd={$smarty.get.kwd}&tab=1"><i class="fa fa-line-chart"></i> ព័ត៌មានផលិតផល កាត់ស្តុក</a></li>
              <li role="presentation" class="{if $smarty.get.tab and $smarty.get.tab eq 2 } active {/if} khmer-first-font"><a href="{$admin_file_name}?task=product&maker={$smarty.get.maker}&brand={$smarty.get.brand}&branch_id={$smarty.get.branch_id}&pr_st_id={$smarty.get.pr_st_id}&from={$smarty.get.from}&to={$smarty.get.to}&kwd={$smarty.get.kwd}&tab=2"><i class="fa fa-flag"></i> ព័ត៌មានផលិតផល មិនកាត់ស្តុក</a></li>
          </ul>
          <!-- Tab panes -->
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane {if !$smarty.get.tab or $smarty.get.tab eq 1 } active {/if}" id="cutting">
              <hr style="margin-top:5px;margin-bottom:5px;" />
              <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table_header">
                      <tr>
                        <th></th>
                        <th>
                          <div class="checkbox">
                            <label><input type="checkbox" id="chk_print_all"></label>
                          </div>
                        </th>
                        <th class="text-center" width="185">សកម្មភាព (Action)</th>
                        <th class="text-center">សាខា (Branch)</th>
                        <th class="text-center">លេខ IMEI (IMEI Number)</th>
                        <th class="text-center">ឈ្មោះផលិតផល (Title)</th>
                        <th class="text-center">ឈ្មោះក្រុមហ៊ុន (Company Name)</th>
                        {if $smarty.session.is_login_role eq 2}
                        <th class="text-center">តម្លៃដើម (Cost)</th>
                        {/if}
                        <th class="text-center">តម្លៃលក់ (Price)</th>
                        <th class="text-center">ក្រុមហ៊ុនផលិត (Maker)</th>
                        <th class="text-center">ម៉ាកផលិតផល (Brand)</th>
                        <th class="text-center">គុណភាព (Pro-Used)</th>
                        <th class="text-center">រូបភាព (Image)</th>
                        <th class="text-center" width="100">កាលបរិច្ឆេទចូល (Date In)</th>
                      </tr>
                    </thead>
                    <tbody>
                      {if $list_product_data|@count gt 0}
                      {foreach from=$list_product_data item=data key=k name=foo}
                      <tr {if $smarty.foreach.foo.first}class="active"{/if}>
                        <td class="text-center">{if $smarty.get.next eq 1 OR $smarty.get.next eq '' }{counter}{else}{$smarty.foreach.foo.iteration+$smarty.get.next-1}{/if}</td>
                        <td valign="top">
                          <div class="checkbox">
                            <label><input type="checkbox" value="{$data.id}" class="chk_print" {foreach from=$smarty.session.pro_id item=vp}{if $vp eq $data.id}checked{/if}{/foreach}></label>
                          </div>
                        </td>
                        <td class="text-center" valign="top" width="155px;">
        
                          <span title="បញ្ជូនត្រឡប់​ទៅ​ក្រុមហ៊ុន (Return Back To Company)" data-toggle="tooltip" data-placement="top">
                            <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#myReturn_{$data.id}" ><i class="fa fa-reply"></i></button>
                          <!-- Modal -->
                          </span>
                          <div class="modal fade" id="myReturn_{$data.id}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                                  </button>
                                  <h4 class="modal-title" id="myModalLabel">ការបញ្ជាក់ (Confirmation)</h4>
                                </div>
                                <div class="modal-body">តើ​អ្នក​ពិតជា​ចង់​បញ្ជូនត្រឡប់​ទៅ​ក្រុមហ៊ុន​វិញ​នូវ​ផលិតផលដែលមានលេខលេខ IMEI ​នេះ (Are you sure want to return back to company this product IMEI number) <label class="label label-danger">{$data.imei}</label> ? </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-xs btn-default" data-dismiss="modal">　បោះបង់ (Cancel) </button>
                                  <a class="btn btn-xs btn-danger" href="{$admin_file}?task=product&amp;action=return_back&amp;id={$data.id}"> បាទ/ចាស (Yes)</a>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!--End Modal-->
        
                          <a class="btn btn-xs btn-primary" href="{$admin_file}?task=product&amp;action=detail&amp;id={$data.id}" data-toggle="tooltip" data-placement="top" title="ផលិតផលលម្អិត & Qrcode (Detail Product & Qrcode)">
                            <i class="glyphicon glyphicon-eye-open"></i>
                          </a>
                          {if $smarty.session.is_login eq 'admin'}
                          <a class="btn btn-xs btn-primary" href="{$admin_file}?task=product&amp;action=edit&amp;id={$data.id}" data-toggle="tooltip" data-original-title="កែប្រែផលិតផល (Edit Product)">
                            <i class="glyphicon glyphicon-edit"></i>
                          </a>
                          {/if}
                          <a class="btn btn-xs btn-primary" href="{$admin_file}?task=product&amp;action=upload&amp;id={$data.id}" data-toggle="tooltip" data-original-title="ដាក់រូបភាពផលិតផល (Upload Product Image)">
                            <i class="glyphicon glyphicon-picture"></i>
                          </a>
                          <a class="btn btn-xs btn-primary" onclick="viewModal('{$data.id}', '{$data.imei}'); return false;" href="#" title="ចុចដើម្បីក្លូនផលិតផល (Click to clone product)" data-toggle="tooltip" data-placement="top">
                            <i class="glyphicon glyphicon-copy"></i></a>
                          {if $smarty.session.is_login eq 'admin' OR $smarty.session.is_login eq 'sub_admin'}
                          <span title="លុបផលិតផល (Delete Product)" data-toggle="tooltip" data-placement="top">
                            <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#myModal_{$data.id}" ><i class="glyphicon glyphicon-trash"></i></button>
                          <!-- Modal -->
                          </span>
                          <div class="modal fade" id="myModal_{$data.id}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                                  </button>
                                  <h4 class="modal-title" id="myModalLabel">តម្រូវឱ្យមានការបញ្ជាក់ (Confirmation Required)</h4>
                                </div>
                                <div class="modal-body">តើអ្នកពិតជាចង់លុបលេខ IMEI របស់ផលិតផលនេះ (Are you sure want to delete this product IMEI number) <label class="label label-danger">{$data.imei}</label> ? </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-xs btn-default" data-dismiss="modal">　បោះបង់ (Cancel) </button>
                                  <a class="btn btn-xs btn-danger" href="{$admin_file}?task=product&amp;action=delete&amp;id={$data.id}">　លុប (Delete)</a>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!--End Modal-->
                          {/if}
                        </td>
                        <td class="text-center" valign="top">{$data.branch_name}</td>
                        <td class="text-center" valign="top" width="140px;">{$data.imei} 
                        {if isset($data) && $data.is_cutting eq 2}
                          <br><span style="color: red;">(មិនកាត់ស្តុក)</span> 
                        {/if}
                        </td>
                        <td>{$data.title}
                          {if $data.color_name}-{$data.color_name}{/if}
                          {if $data.storage_name}-{$data.storage_name}{/if}
                        </td>
                        <td class="text-center">{$data.company_title}</td>
                        {if $smarty.session.is_login_role eq 2}
                        <td class="text-center" valign="top" width="100px;">$ {$data.cost|number_format:2}</td>
                        {/if}
                        <td class="text-center" valign="top" width="100px;">$ {$data.price|number_format:2}</td>
                        <td class="text-center">{$data.maker_name}</td>
                        <td class="text-center">{$data.brand_name}</td>
                        <td class="text-center">{$data.pro_used_name}</td>
                        <td class="text-center" valign="top" width="90px;">
                          {if $data.photoone}
                            <a href="{$shop_site}images/product/{$data.photoone}" data-lightbox="{$data.photoone}">
                              <img src="{$shop_site}images/product/thumbnail__{$data.photoone}" class="img-thumbnail"  />
                            </a>
                          {/if}
                        </td>
                        <td class="text-center">{$data.created_at|date_format}</td>
                      </tr>
                      {/foreach}
                      {else}
                      <tr><td class="text-center" colspan="13"><h4>មិនមានព័ត៌មានអំពីផលិតផលទេ។ (There is no product information.)</h4></td></tr>
                      {/if}
                    </tbody>
                </table>
              </div>
            </div>
            <div role="tabpanel" class="tab-pane {if $smarty.get.tab and $smarty.get.tab eq 2 } active {/if}" id="no-cutting">
              <hr style="margin-top:5px;margin-bottom:5px;" />
              <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table_header">
                      <tr>
                        <th></th>
                        <th>
                          <div class="checkbox">
                            <label><input type="checkbox" id="chk_print_all"></label>
                          </div>
                        </th>
                        <th class="text-center" width="185">សកម្មភាព (Action)</th>
                        <th class="text-center">សាខា (Branch)</th>
                        <th class="text-center">លេខ IMEI (IMEI Number)</th>
                        <th class="text-center">ឈ្មោះផលិតផល (Title)</th>
                        <th class="text-center">ឈ្មោះក្រុមហ៊ុន (Company Name)</th>
                        {if $smarty.session.is_login_role eq 2}
                        <th class="text-center">តម្លៃដើម (Cost)</th>
                        {/if}
                        <th class="text-center">តម្លៃលក់ (Price)</th>
                        <th class="text-center">ក្រុមហ៊ុនផលិត (Maker)</th>
                        <th class="text-center">ម៉ាកផលិតផល (Brand)</th>
                        <th class="text-center">គុណភាព (Pro-Used)</th>
                        <th class="text-center">រូបភាព (Image)</th>
                        <th class="text-center" width="100">កាលបរិច្ឆេទចូល (Date In)</th>
                      </tr>
                    </thead>
                    <tbody>
                      {if $list_product_data|@count gt 0}
                      {foreach from=$list_product_data item=data key=k name=foo}
                      <tr {if $smarty.foreach.foo.first}class="active"{/if}>
                        <td class="text-center">{if $smarty.get.next eq 1 OR $smarty.get.next eq '' }{counter}{else}{$smarty.foreach.foo.iteration+$smarty.get.next-1}{/if}</td>
                        <td valign="top">
                          <div class="checkbox">
                            <label><input type="checkbox" value="{$data.id}" class="chk_print" {foreach from=$smarty.session.pro_id item=vp}{if $vp eq $data.id}checked{/if}{/foreach}></label>
                          </div>
                        </td>
                        <td class="text-center" valign="top" width="155px;">
        
                          <span title="បញ្ជូនត្រឡប់​ទៅ​ក្រុមហ៊ុន (Return Back To Company)" data-toggle="tooltip" data-placement="top">
                            <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#myReturn_{$data.id}" ><i class="fa fa-reply"></i></button>
                          <!-- Modal -->
                          </span>
                          <div class="modal fade" id="myReturn_{$data.id}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                                  </button>
                                  <h4 class="modal-title" id="myModalLabel">ការបញ្ជាក់ (Confirmation)</h4>
                                </div>
                                <div class="modal-body">តើ​អ្នក​ពិតជា​ចង់​បញ្ជូនត្រឡប់​ទៅ​ក្រុមហ៊ុន​វិញ​នូវ​ផលិតផលដែលមានលេខលេខ IMEI ​នេះ (Are you sure want to return back to company this product IMEI number) <label class="label label-danger">{$data.imei}</label> ? </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-xs btn-default" data-dismiss="modal">　បោះបង់ (Cancel) </button>
                                  <a class="btn btn-xs btn-danger" href="{$admin_file}?task=product&amp;action=return_back&amp;id={$data.id}"> បាទ/ចាស (Yes)</a>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!--End Modal-->
        
                          <a class="btn btn-xs btn-primary" href="{$admin_file}?task=product&amp;action=detail&amp;id={$data.id}" data-toggle="tooltip" data-placement="top" title="ផលិតផលលម្អិត & Qrcode (Detail Product & Qrcode)">
                            <i class="glyphicon glyphicon-eye-open"></i>
                          </a>
                          {if $smarty.session.is_login eq 'admin'}
                          <a class="btn btn-xs btn-primary" href="{$admin_file}?task=product&amp;action=edit&amp;id={$data.id}" data-toggle="tooltip" data-original-title="កែប្រែផលិតផល (Edit Product)">
                            <i class="glyphicon glyphicon-edit"></i>
                          </a>
                          {/if}
                          <a class="btn btn-xs btn-primary" href="{$admin_file}?task=product&amp;action=upload&amp;id={$data.id}" data-toggle="tooltip" data-original-title="ដាក់រូបភាពផលិតផល (Upload Product Image)">
                            <i class="glyphicon glyphicon-picture"></i>
                          </a>
                          <a class="btn btn-xs btn-primary" onclick="viewModal('{$data.id}', '{$data.imei}'); return false;" href="#" title="ចុចដើម្បីក្លូនផលិតផល (Click to clone product)" data-toggle="tooltip" data-placement="top">
                            <i class="glyphicon glyphicon-copy"></i></a>
                          {if $smarty.session.is_login eq 'admin' OR $smarty.session.is_login eq 'sub_admin'}
                          <span title="លុបផលិតផល (Delete Product)" data-toggle="tooltip" data-placement="top">
                            <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#myModal_{$data.id}" ><i class="glyphicon glyphicon-trash"></i></button>
                          <!-- Modal -->
                          </span>
                          <div class="modal fade" id="myModal_{$data.id}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                                  </button>
                                  <h4 class="modal-title" id="myModalLabel">តម្រូវឱ្យមានការបញ្ជាក់ (Confirmation Required)</h4>
                                </div>
                                <div class="modal-body">តើអ្នកពិតជាចង់លុបលេខ IMEI របស់ផលិតផលនេះ (Are you sure want to delete this product IMEI number) <label class="label label-danger">{$data.imei}</label> ? </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-xs btn-default" data-dismiss="modal">　បោះបង់ (Cancel) </button>
                                  <a class="btn btn-xs btn-danger" href="{$admin_file}?task=product&amp;action=delete&amp;id={$data.id}">　លុប (Delete)</a>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!--End Modal-->
                          {/if}
                        </td>
                        <td class="text-center" valign="top">{$data.branch_name}</td>
                        <td class="text-center" valign="top" width="140px;">{$data.imei}
                          {if isset($data) && $data.is_cutting eq 2}
                            <br> 
                            <a class="btn btn-md btn-success text-center" href="#" onclick="addStockModal('{$data.id}' , '{$data.stock}'); return false;" data-toggle="tooltip" data-placement="top">
                              <i class="glyphicon glyphicon-plus"></i> បន្ថែមស្តុក <span class="badge">{$data.stock}</span>
                              </a>
                          {/if}
                        </td>
                        <td>{$data.title}
                          {if $data.color_name}-{$data.color_name}{/if}
                          {if $data.storage_name}-{$data.storage_name}{/if}
                        </td>
                        <td class="text-center">{$data.company_title}</td>
                        {if $smarty.session.is_login_role eq 2}
                        <td class="text-center" valign="top" width="100px;">$ {$data.cost|number_format:2}</td>
                        {/if}
                        <td class="text-center" valign="top" width="100px;">$ {$data.price|number_format:2}</td>
                        <td class="text-center">{$data.maker_name}</td>
                        <td class="text-center">{$data.brand_name}</td>
                        <td class="text-center">{$data.pro_used_name}</td>
                        <td class="text-center" valign="top" width="90px;">
                          {if $data.photoone}
                            <a href="{$shop_site}images/product/{$data.photoone}" data-lightbox="{$data.photoone}">
                              <img src="{$shop_site}images/product/thumbnail__{$data.photoone}" class="img-thumbnail"  />
                            </a>
                          {/if}
                        </td>
                        <td class="text-center">{$data.created_at|date_format}</td>
                      </tr>
                      {/foreach}
                      {else}
                      <tr><td class="text-center" colspan="13"><h4>មិនមានព័ត៌មានអំពីផលិតផលទេ។ (There is no product information.)</h4></td></tr>
                      {/if}
                    </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--Add Stock Modal -->
  <div class="modal fade" id="showAddModal" tabindex="-1" role="dialog" aria-labelledby="Add Stock" aria-hidden="true">
  <div class="modal-dialog">
      <div class="panel panel-primary modal-content">
          <div class="panel-heading modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="panel-title modal-title"> ស្តុកផលិតផល (Add Quantity of Product Stock)</h3>
          </div>
          <div class="modal-body">
              <!-- The form is placed inside the body of modal -->
            <form class="form" data-toggle="validator" onsubmit='addQuantityProduct(); return false;' id="clone_form" method="post">
              <div class="row">
                <div class="col-md-12" style="margin-bottom:15px">
                  <div class="input-group">
                    <span class="input-group-addon">ចំនួនផលិតផលក្នុងស្តុក (Quantity of Product Stock)</span>
                    <input type="hidden" name="product_id" id="product_id">
                    <input type="text" id="quantity" name="quantity" maxlength="5" class="form-control" placeholder="សូមបញ្ចូលចំនួនផលិតផល" onkeyup="NumAndTwoDecimals(event , this);">
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary">រក្សាទុក (Save)</button>
            </form>
          </div>
      </div>
  </div>
</div>

  <!--Check Stock Modal -->
    <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="Check Stock" aria-hidden="true">
      <div class="modal-dialog">
          <div class="panel panel-primary modal-content">
              <div class="panel-heading modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="panel-title modal-title"> ក្លូនផលិតផល (Clone Product)</h3>
              </div>
              <div class="modal-body">
                  <!-- The form is placed inside the body of modal -->
                <form class="form" data-toggle="validator" onsubmit='cloneProduct(); return false;' id="clone_form" method="post">
                  <div class="row ck_imei">
                    <div class="col-md-12" style="margin-bottom:15px">
                      <div class="input-group">
                        <span class="input-group-addon">លេខ IMEI ផលិតផល (Product IMEI)</span>
                        <input type="hidden" name="product_id" id="product_id">
                        <input type="text" id="phone_imei" name="imei" maxlength="15" class="form-control" placeholder="លេខ IMEI (១៥ ខ្ទង់) (IMEI Number (15 digits))" required onkeyup="NumAndTwoDecimals(event , this);">
                      </div>
                    </div>
                  </div>
                  <div class="row ck_serial">
                    <input type="checkbox" name="check_serial" id="check_id" >
                    <div class="col-md-12" style="margin-bottom:15px">
                      <div class="input-group">
                        <span class="input-group-addon">លេខ Serial ផលិតផល (Product Serial)</span>
                        <input type="text" id="phone_serial" name="imei" maxlength="15" class="form-control" placeholder="លេខ Serial (១៥ ខ្ទង់) (Serial Number (15 digits))" required onkeyup="removeSpace(event , this);">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12" style="margin-bottom:15px">
                      <div class="form-group">
                        <div class="col-md-5" style="margin-top: 10px;"><label>កាត់ស្តុក (Cutting Stock): </label></div>
                          <div class="col-md-7">
                            <div class="checkbox">
                            <label><input type="checkbox" id="is_cutting" name="is_cutting" value="2" {if $smarty.get.tab eq 2}checked{/if}><span style="color:red">( ប្រសិនបើធីក មិនកាត់ចេញពីស្តុកនៅពេលលក់ )</span></label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary">ក្លូន (Clone)</button>
                </form>
              </div>
          </div>
      </div>
    </div>
    <!-- confirmAddStockBox -->
    <div class="modal fade bs-example-modal-sm" id="confirmAddBox" role="dialog">
      <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-center"> ព័ត៌មាន (Information)</h4></div>
          <div class="modal-body text-center">
            <p><strong>ផលិតផលត្រូវបានបន្ថែមចំនួនក្នុងស្តុក ដោយជោគជ័យ! (Product has been update stock successfully!)</strong></p>
          </div>
        </div>
      </div>
    </div>
<!-- confirmAddStockBox -->
	<!-- confirmBox -->
    <div class="modal fade bs-example-modal-sm" id="confirmBox" role="dialog">
      <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-center"> ព័ត៌មាន (Information)</h4></div>
          <div class="modal-body text-center">
            <p><strong>ផលិតផលថ្មីត្រូវបានក្លូនដោយជោគជ័យ! (New product was cloned successfully!)</strong></p>
          </div>
        </div>
      </div>
    </div>
<!-- confirmBox -->
    <div class="modal fade bs-example-modal-sm" id="ExistedImei" role="dialog">
      <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-center"> ព័ត៌មាន (Information)</h4></div>
          <div class="modal-body text-center">
            <p><strong>IMEI ផលិតផលមានរួចហើយ ឬមានបញ្ហា។ (Product imei have existed or have sth problems.)</strong></p>
          </div>
        </div>
      </div>
    </div>
  {include file="common/paginate.tpl"}
{/block}
{block name="javascript"}
	<script>
		function isNumeric(val) {
			return /^-?\d+$/.test(val);
		}
		function NumAndTwoDecimals(e , field)
		{
			var val = field.value;
			var reg = /^([0-9]+[\.]?[0-9]?[0-9]?|[0-9]+)/g;
			val = reg.exec(val);
			if (val) {
				field.value = val[0];
			}
			else
			{
				field.value = "";
			}
		}

		$(document).ready(function()
		{
			$('#date_from').datetimepicker({
				lang: 'en',
				format: 'Y-m-d',
				timepicker: false
			});
			$('#date_to').datetimepicker({
				lang: 'en',
				format: 'Y-m-d',
				timepicker: false
			});

			$('[data-toggle="tooltip"]').tooltip({
				placement : 'top'
			});

			var sum = 0;
			$('.chk_print').each(function(i, el){
				if(el.checked == true) sum += 1;
			});

			if(sum == 30) $("#chk_print_all").prop("checked", true);

		});

    function addStockModal(product_id, stock) 
		{
			$('#showAddModal').modal('show');
			$('#showAddModal').on('shown.bs.modal', function () {
				$('#quantity').focus();
			})
			$('#product_id').val(product_id);
			$('#showAddModal').on('hidden.bs.modal', function (e) {
			$(this)
				.find("input")
				.val('')
				.end()
			})
		}

    function addQuantityProduct() 
		{
			var product_id = $("#product_id").val();
      var quantity = $("#quantity").val();
      
			if(quantity == '')
			{
				alert("សូមបញ្ចូលចំនួនផលិតផល។ (Please enter quantity of product.)");
				return;
			}

			var param_data = { product_id: product_id, stock: quantity };
			
			jQuery.ajax( {
				type: 'POST',
				url: 'admin.php?task=product&action=increase_stock',
				dataType:'json',
				data: param_data,
				success:function(data){
          if(data.product_id !== null) {
            $("#confirmAddBox").modal('show');
            setTimeout(function(){  $('#confirmAddBox').modal('hide')  }, 2000);
            location.reload();
          }
				},
				error: function(data) {
				  alert('Your process has problem!.');
				}
			} );
		}
		function viewModal(product_id, imei) 
		{
			$("#phone_imei").val('');
			$("#phone_serial").val('');

			if (isNumeric(imei) == true) 
			{
				$("#phone_imei").prop("disabled", false);
				$("#phone_serial").prop("disabled", true);
				
				$('.ck_imei').show();
				$('.ck_serial').hide();
			}else{

				$("#phone_imei").prop("disabled", true);
				$("#phone_serial").prop("disabled", false);

				$('.ck_imei').hide();
				$('.ck_serial').show();
			}

			$('#showModal').modal('show');
			$('#showModal').on('shown.bs.modal', function () {
				$('#phone_imei').focus();
        $('#phone_serial').focus();
			})
			$('#product_id').val(product_id);
			$('#showModal').on('hidden.bs.modal', function (e) {
			$(this)
				.find("input")
				.val('')
				.end()
			})
		}

		function cloneProduct() 
		{
      var is_checked = '';
			var product_id = $("#product_id").val();
      var ischeck = $("#is_cutting").is(':checked');
      if(ischeck){
        var is_checked = 2;
      }
			{* var ischeck = $("#check_id").is(':checked'); *}
      
			if($("#phone_serial").val()) {
				var product_imei = $("#phone_serial").val();
			}

			if($("#phone_imei").val()) {
				var product_imei = $("#phone_imei").val();
			}

			if(product_imei == '')
			{
				alert("សូមបញ្ចូល imei។ (Please enter Imei.)");
				return;
			}

			if (isNumeric(product_imei) == true) 
			{
				if(product_imei.length < 15) {
					alert("Imei មិនគ្រប់ ១៥ ខ្ទង់ទេ។ (IMEI Number not equal 15 digits)");
					return;
				}
			}

			var param_data = { product_id: product_id, product_imei: product_imei, is_cutting: is_checked };
			
			jQuery.ajax( {
				type: 'POST',
				url: 'admin.php?task=product&action=clone',
				dataType:'json',
				data: param_data,
				success:function(data){
				if(data.product_id !== null) {
					$("#confirmBox").modal('show');
					setTimeout(function(){  $('#confirmBox').modal('hide')  }, 2000);
					location.reload();
				} else {
					$("#ExistedImei").modal('show');
					setTimeout(function(){  $('#ExistedImei').modal('hide')  }, 2000);
				}

				},
				error: function(data) {
				alert('Your process clone has problem!.');
				}
			} );
		}

		function remove(array, element) {
			const index = array.indexOf(element);
			if (index !== -1) {
				array.splice(index, 1);
			}
		}

		function removeSpace(e , field)
		{
			var val = field.value.replace(/\s/g, "");
			if(val) {
				field.value = val;
			} else {
				field.value = "";
			}
		}

		$(document).on('click','.chk_print',function()
		{
			$('.loader').show();
			var value = this.value;
			var status = 0;
			if(this.checked == true)
			{
				var status = 2;
			} else {
				status = 1;
			}
			var param_data = { product_id: value, status: status };

			$.ajax({
				type: 'POST',
				url: 'admin.php?task=product&action=data_print',
				dataType:'json',
				data: param_data,
				success:function(data)
				{
					var sum = 0;
					$('.chk_print').each(function(i, el){
						if(el.checked == true) sum += 1;
					});
					if(sum == 30)
					{
						$("#chk_print_all").prop("checked", true);
					} else {
						$("#chk_print_all").prop("checked", false);
					}

					$('#total_sel').text(data);
					$('.loader').hide();
				},
					error: function(data) {
					alert('Your process check has problem!.');
				}
			});
		});

		$(document).on('click','#remove_pro',function()
		{
			$('.loader').show();

			var param_data = { status: 3 };

			$.ajax({
				type: 'POST',
				url: 'admin.php?task=product&action=data_print',
				dataType:'json',
				data: param_data,
				success:function(data){
					if(data == 0)
					{
						$(".chk_print").prop("checked", false);
					}
					var sum = 0;
					$('.chk_print').each(function(i, el){
						if(el.checked == true) sum += 1;
					});
					if(sum == 30)
					{
						$("#chk_print_all").prop("checked", true);
					} else {
						$("#chk_print_all").prop("checked", false);
					}

					$('#total_sel').text(data);
					$('.loader').hide();
				},
					error: function(data) {
					alert('Your process remove has problem!.');
				}
			} );
		});

		$(document).on('click','#chk_print_all',function()
		{
			$('.loader').show();
			var product = [];
			var value = this.value;

			$('.chk_print').each(function(i, el){
				var val = $(el).val();
				product.push(val);
			});

			if(this.checked == true)
			{
				var status = 2;
			} else {
				var status = 1;
			}

			var param_data = { status: status,  product_id: JSON.stringify(product) };

			$.ajax({
				type: 'POST',
				url: 'admin.php?task=product&action=data_print_all',
				dataType:'json',
				data: param_data,
				success:function(data){
					if(status == 1)
					{
						$(".chk_print").prop("checked", false);
					} else {
						$(".chk_print").prop("checked", true);
					}
					$('#total_sel').text(data);
					$('.loader').hide();
				},
					error: function(data) {
					alert('Your process select all has problem!.');
				}
			});


		});

		function number_print()
		{
			var num_p = $('#num_print').val();
			$('#href_print').attr('href', '{$admin_file}?task=product&action=all_qrcode_print&num_print='+num_p);
		}

		$(document).ready(function(){
			{* $("#check_id").click(function(){
				$(".ck_imei").toggle();
				var ischeck = $(this).is(':checked');
				if (ischeck == true) {
					$("#phone_serial").prop("disabled", false);
					$("#phone_serial").val('');
				}else{
					$("#phone_serial").prop("disabled", true);
					$("#phone_imei").val('');
					$("#phone_serial").val('');
				}
			}); *}
		});
	</script>
{/block}
