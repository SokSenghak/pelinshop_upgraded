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
    </div>
    <form class="navbar-form navbar-left" role="search">
      <div class="form-group">
        <div class="input-group">
          <input maxlength="15" id="search_imei" type="text" name="imei" class="form-control" placeholder="Search for..." onkeyup="NumAndTwoDecimals(event , this);" autofocus>
              <span class="input-group-btn">
                <button data-toggle="tooltip" data-original-title="Search By IMEI" id="btn_by_imei" class="btn btn-default" ><li class="glyphicon glyphicon-search"></li></button>
              </span>
        </div>
      </div>
    </form>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" aria-expanded="false" style="height: 1px;">
      <ul class="nav navbar-nav navbar-right">
        {nocache}
          <li><a><i class="glyphicon glyphicon-user"></i>: <span class='label label-info'>{$staff_name}</span></a></li>
          <li><a href="{$product_file}?task=staff"><i class=" glyphicon glyphicon-circle-arrow-right"></i> Back</a></li>
        {/nocache}
      </ul>
    </div>
  </div>
</nav>
