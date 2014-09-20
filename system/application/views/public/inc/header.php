<!DOCTYPE html>

<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8"/>
  <title>CRM</title>
  
  <link rel="stylesheet" type="text/css" href="<?=base_url();?>css/jqueryui.css" media="screen, projection" />
  <link rel="stylesheet" type="text/css" href="<?=base_url();?>fancybox/jquery.fancybox-1.3.4.css" media="screen, projection" />
  <!--Jquery TE-->
  <link rel="stylesheet" type="text/css" href="<?=base_url();?>css/jquery-te-1.4.0.css" media="screen, projection" />
  
  <link rel="stylesheet" type="text/css" href="<?=base_url();?>css/bootstrap.css" media="screen, projection" />
  <link rel="stylesheet" type="text/css" href="<?=base_url();?>css/bootswatch.min.css" media="screen, projection" />
  <link rel="stylesheet" type="text/css" href="<?=base_url();?>css/chosen.css" media="screen, projection" />
  
  <!--
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
  

  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/jquery-ui.min.js"></script>
 -->

  <script  type="text/javascript"  src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
 <script src="<?=base_url();?>js/jquery-ui-1.10.4.min.js"></script>
 </head>
 <body>

<div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <a href="../" class="navbar-brand">Project System</a>
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
          <ul class="nav navbar-nav">
            <li>
              <?php echo anchor('service/show', 'Service'); ?>
            </li>
            
          </ul>
        </div>
      </div>
    </div>