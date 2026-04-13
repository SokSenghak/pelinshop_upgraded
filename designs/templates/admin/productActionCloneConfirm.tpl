{extends file="admin/layout.tpl"}
{block name="main"}
  <ul class="breadcrumb">
    <li><a href="{$admin_file}">Home</a></li>
    <li><a href="{$admin_file}?task=product"> Product</a></li>
    <li class="active"> Clone Confirm</li>
  </ul>

  <div class="panel panel-primary">
    <div class="panel-heading"><h3 class="panel-title text-center">Clone Product Confirm</h3> </div>
    <div class="panel-body">
      <form role="form" action="{$admin_file}?task=product&amp;action=clone_completed&amp;id={$id}" method="post">
        <div class="table-responsive">
          <table class="table table-bordered">
            <tr>
              <td valign="top" width="200"><label>IMEI Number</label></td>
              <td>{$smarty.session.clone_pro.imei}</td>
            </tr>
            <tr>
              <td><label>Cost</label></td>
              <td>$ {$smarty.session.clone_pro.cost|number_format:2}</td>
            </tr>
            <tr>
              <td><label>Price</label></td>
              <td>$ {$smarty.session.clone_pro.price|number_format:2}</td>
            </tr>
          </table>
        </div>
        <a class="btn btn-info" href="{$index_file_name}?task=product&amp;action=clone&amp;id={$id}"><i class="fa fa-arrow-circle-left"></i> Back</a>
        <button class="btn btn-success" type="submit" name="submit"><i class="glyphicon glyphicon-copy"></i>&nbsp;Clone</button>
      </form>
    </div>
  </div>



{/block}
