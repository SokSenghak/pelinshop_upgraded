<!-- Navbar-->
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a style="font-size: 20px;" class="navbar-brand" href="{$order_file}"><span class="label label-sm label-success"> PELIN SHOP</span></a>
    </div>
    {if $smarty.get.task|escape != 'history' and $smarty.get.task|escape ne 'order_list'}
    <form class="navbar-form navbar-left" role="search">
      <div class="form-group">
        <div class="input-group">
          <input maxlength="25" id="search_imei" type="text" name="imei" class="form-control" placeholder="វាយបញ្ចូល IMEI នៅទីនេះ (Type IMEI here)" autofocus onkeyup="removeSpace(event , this);">
              <span class="input-group-btn">
                <button data-toggle="tooltip" title="Search By IMEI" id="btn_by_imei" class="btn btn-default" ><li class="glyphicon glyphicon-search"></li></button>
              </span>
        </div> 
      </div>
    </form>
    {/if}
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" aria-expanded="false" style="height: 1px;">
        <ul class="nav navbar-nav">
        <li class="{if $current_page == 'order.php'}active{/if}"><a href="order.php"><i class="fa fa-chevron-circle-right"></i> បញ្ជាទិញ (Order)</a></li>
        <li class="{if $current_page == 'new_order.php'}active{/if}"><a href="new_order.php"><i class="fa fa-chevron-circle-right"></i> បញ្ជាទិញថ្មី (New Order)</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        {nocache}
          <div class="dropdown" >
            <ul class="nav navbar-nav" aria-labelledby="about-us">
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false"><i class="fa fa-user"></i> {$staff_name} <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#" class="not-active"><strong>{$branch.name} : </strong><strong>{$staff_name}</strong></a></li>
                  <li class="{if $current_page == 'order.php'}active{/if}"><a href="order.php?task=history"><i class="fa fa-chevron-circle-right"></i> ប្រវត្តិបញ្ជាទិញ (Order History)</a></li>
                  <li><a href="{$product_file}?task=logout"><i class="glyphicon glyphicon-log-out"></i> ចាកចេញ (Logout)</a></li>
                </ul>
              </li>
            </ul>
          </div>
          {* <li><a href="#" class="not-active"><strong>{$branch.name} : </strong><strong>{$staff_name}</strong></a></li>
          <li><a href="{$product_file}?task=logout"><i class="glyphicon glyphicon-log-out"></i> ចាកចេញ (Logout)</a></li> *}
        {/nocache}
      </ul>
    </div>
  </div>
</nav>
