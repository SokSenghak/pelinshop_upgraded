<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content=""/>
  <meta name="keywords" content="Shop"/>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="/css/style.css" type="text/css"/>
  <title>MY SHOP</title>
</head>
<body>
<div class="container">
  <div class="row">
    <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
      <div class="panel panel-primary">
        <div class="panel-heading"><h3 class="panel-title">For Staff Work</h3></div>
        <div class="panel-body">
          <h4 class="text-muted">Please select your name.</h4>
          <hr style="margin-bottom:10px;margin-top:10px;">
          <form role="form" method="post" action="{$product_file}" class="form-horizontal">
            <div class="form-group">
              <label class="col-md-3">Staff Name:<span style="color:red">*</span></label>
              <div class="col-md-9">
                <select name="staff_id" class="form-control">
                  <option value="">Select Staff</option>
                  {foreach from=$list_staff_name item="staff"}
                    <option value="{$staff.id}" >{$staff.name}</option>
                  {/foreach}
                </select>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-3">
                <div class="btn-group" role="group">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-sign-in"></i> Assign</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      <hr />
    </div>
  </div>
  {include file="common/footer.tpl"}
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</body>
</html>

