<!DOCTYPE html>
<html xmlns="https://www.w3.org/1999/xhtml" xml:lang="en" lang="en" xmlns:og="https://ogp.me/ns#" xmlns:fb="https://www.facebook.com/2008/fbml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content=""/>
  <meta name="keywords" content="Pelin Phone Shop"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  {* <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script> *}
  <script type="text/javascript" src="/js/jquery-ui.min.js"></script>
  <script src="/js/jquery.appendGrid-1.6.0.js"></script>
  <script src="/js/bootstrap-maxlength.js"></script>
  <script src="/js/jquery.datetimepicker.js"></script>
  <script src="/js/lightbox.js"></script>
  <script src="js/kjua-0.1.1.min.js"></script>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/ui-lightness/jquery-ui.css" />
  {* <link rel="stylesheet" href="https://appendgrid.apphb.com/Content/css/jquery-ui/jquery-ui.theme.min.css" /> *}
  <link rel="stylesheet" type="text/css" href="/css/jquery-ui.theme.min.css" />
  <link rel="stylesheet" href="https://code.jquery.com/qunit/qunit-1.18.0.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css">
  <link rel="stylesheet" href="/css/style.css" type="text/css"/>
  <link rel="stylesheet" type="text/css" href="/css/jquery.datetimepicker.css">
  <link rel="stylesheet" type="text/css" href="/css/lightbox.css" >
  <link rel="stylesheet" type="text/css" href="/css/jquery.appendGrid-1.6.0.css" >
  <link rel="stylesheet" type="text/css" href="/css/switch.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Battambang&family=Hanuman&family=Siemreap&display=swap" rel="stylesheet">
  {* <link href="https://fonts.googleapis.com/css2?family=Battambang|Hanuman:wght@300&family=Siemreap&display=swap" rel="stylesheet"> *}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <!-- <title>PELIN PHONE-ADMIN{block name="title"}{/block}</title> -->
  <title>ADMIN{block name="title"}{/block}</title>
</head>
<script>
    $(document).ready(function(){
        $(window).load(function() { $(".loader").fadeOut("slow"); });
    });

</script>
<body>
{include file="admin/menu.tpl" }
<div class="container">
  <div class="row">
    <div class="col-md-12">
      {block name="main"}
      {/block}
    </div>
  </div>
  <hr />
  <div class="loader"></div>
  {include file="common/footer.tpl"}
</div>
<!-- <script src="/js/switch.js"></script> -->
<script src="/js/moment.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>
{block name="javascript"}

{/block}
</body>
</html>
