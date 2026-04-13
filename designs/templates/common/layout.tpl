<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="It is a one-stop website for looking or posting internship information in Cambodia. It is FREE service for both students and organizations. Join us now!"/>
<meta name="keywords" content="Internship, Intern, Cambodia, Job, Khmer"/>
<meta property="fb:app_id" content="485106888242137"/>
<meta property="fb:admins" content="563370747"/>
{block name="opengraph"}
<meta property="og:title" content="Internship in Cambodia"/>
<meta property="og:type" content="website"/>
<meta property="og:url" content="http://internship.e-khmer.com/"/>
<meta property="og:image" content="http://internship.e-khmer.com/img/oglogo.png"/>
<meta property="og:site_name" content="Internship in Cambodia"/>
<meta property="og:description" content="It is a one-stop website for looking or posting internship information in Cambodia. It is FREE service for both students and organizations. Join us now!"/>
{/block}
<link rel="alternate" type="application/rss+xml" title="Rss" href="feed.php"/>
<link rel="alternate" type="application/rss+xml" title="sitemap" href="sitemap.php"/>
<link rel="stylesheet" href="/css/bootstrap.min.css" type="text/css"/>
<link rel="stylesheet" href="/css/bootstrap-responsive.min.css" type="text/css"/>
<link rel="stylesheet" href="/css/datepicker.css" type="text/css"/>
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
<link rel="stylesheet" href="/css/default.css" type="text/css"/>
<link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
<title>MP Project{block name="title"}{/block}</title>
</head>
<body>
{if $mode eq "admin" }{include file="admin/menu.tpl" }{/if}
{if $mode eq "index" }{include file="index/menu.tpl" }{/if}
<div class="container">

	{block name="facebook"}
	{/block}

	{block name="hero"}
	{/block}
	<div class="row">
		<div class="span3 hidden-phone">
			{block name="side"}
			{/block}
		</div>
		<div class="span9">
			{block name="main"}
			{/block}
		</div>
	</div>
	<hr />
	<div class="row">
		<div class="span12">
			{block name="footer"}
			{/block}
			<a href="index.php?task=blog&amp;action=detail&amp;id=7">Suggestion</a> |
			<a href="index.php?task=blog&amp;action=detail&amp;id=1">Terms of Service</a> |
			<a href="index.php?task=blog&amp;action=detail&amp;id=2">Privacy</a>
			<br />
			<span class="muted">E-mail: <a href="mailto:support@e-khmer.com">support@e-khmer.com</a></span><br />
			<span class="muted">© 2013 <a href="http://www.e-khmer.com">E-KHMER</a> Technology Co., Ltd. All rights reserved</span>

		</div>
	</div>


</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/bootstrap-datepicker.js"></script>
<script src='http://platform.twitter.com/widgets.js' type="text/javascript"></script>
<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
<script src="//platform.linkedin.com/in.js" type="text/javascript"></script>
{block name="javascript"}
{/block}
</body>
</html>
