<<<<<<< HEAD
<!DOCTYPE html>
=======
`<!DOCTYPE html>
>>>>>>> d1fa3799bd29c62ddbe760aacdcb5a23586dca51
<html>

<head>
    <meta charset="utf-8">
    <title>Customer Mobile Systems</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="Content-Language" content="en, id">

    <!-- Sets initial viewport load and disables zooming  -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>


    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="orange">
<<<<<<< HEAD
	<link rel="shortcut icon" href="<?php echo site_url('assets/img/favicon.png');?>" type="image/png" />
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="/img/apple-touch-icon-144x144-precomposed.png" />
	<link rel="apple-touch-icon-precomposed" href="/img/apple-touch-icon-57x57-precomposed.png">


    <!-- Untuk Development CSS dipisah - wajib di gabung dan minified untuk live -->
    <link href="<?php echo site_url('assets/css/materialize.min.css');?>" rel="stylesheet">
    <link href="<?php echo site_url('assets/css/table-view.css');?>" rel="stylesheet">
    <link href="<?php echo site_url('assets/css/all.min.css');?>" rel="stylesheet">
    <link href="<?php echo site_url('assets/css/main.css');?>" rel="stylesheet">
	<?php 
		if(isset($extra_css)):
			foreach($extra_css as $x_css):
				echo'<link href="'.site_url("assets/css/".$x_css."").'" rel="stylesheet">';
			endforeach;
		endif;	
	?>
=======
    <link rel="shortcut icon" href="<?php echo site_url('assets/img/favicon.png'); ?>" type="image/png"/>
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/img/apple-touch-icon-144x144-precomposed.png"/>
    <link rel="apple-touch-icon-precomposed" href="/img/apple-touch-icon-57x57-precomposed.png">


    <!-- Untuk Development CSS dipisah - wajib di gabung dan minified untuk live -->
    <link href="<?php echo site_url('assets/css/materialize.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo site_url('assets/css/table-view.css'); ?>" rel="stylesheet">
    <link href="<?php echo site_url('assets/css/all.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo site_url('assets/css/main.css'); ?>" rel="stylesheet">
    <?php
    if (isset($extra_css)):
        foreach ($extra_css as $x_css):
            echo '<link href="' . site_url("assets/css/" . $x_css . "") . '" rel="stylesheet">';
        endforeach;
    endif;
    ?>
>>>>>>> d1fa3799bd29c62ddbe760aacdcb5a23586dca51
</head>

<body>

<<<<<<< HEAD
    <div id="wrap">
        <div id="header" class="container">
           <div class="header-content">
            <a href="<?php echo base_url();?>"><img src="<?php echo site_url('assets/img/'.$this->session->userdata('logosites'));?>" alt="AeroExpress Mobile" class="logo" />
            </a>
            <a href="<?php echo site_url('change');?>" class="link-settings"><i class="fa fa-cog"></i>&nbsp;Settings</a>
            <a href="<?php echo site_url('logout');?>" class="logout"><i class="fa fa-power-off"></i>&nbsp;Logout</a>
            </div>
        </div>
		<div id="menu" class="clearfix">
			<div class="menu-xs">
				<a href="#" class="open-menu">
					<span class="btn">
					<i class="fa fa-bars"></i>
					</span>
				Menu
				</a>
			</div>
			<ul class="menu-links">
			  <li><a href="<?php echo site_url('tracing');?>"><i class="fa fa-user-secret"></i>&nbsp;Trace Account</a></li>
			  <li><a href="<?php echo site_url('keyword');?>"><i class="fa fa-search"></i>&nbsp;Trace Keyword</a></li>
			   <li><a href="<?php echo site_url('invoice');?>"><i class="fa fa-envelope"></i>&nbsp;Invoice Customer</a></li>
			   <li><a href="<?php echo site_url('miletones');?>"><i class="fa fa-table"></i>&nbsp;Trace miletones</a></li>
			  <li><a href="<?php echo site_url('map');?>" target="blank"><i class="fa fa-map-marker"></i>&nbsp;Map Delivery</a></li>
			  <li><a href="<?php echo site_url('kpi');?>"><i class="fa fa-chart-bar"></i>&nbsp;KPI Graph</a></li>
			  
			</ul>
		</div>
=======
<div id="wrap">
    <div id="header" class="container">
        <div class="header-content">
            <a href="<?php echo base_url(); ?>"><img
                        src="<?php echo site_url('assets/img/' . $this->session->userdata('logosites')); ?>"
                        alt="AeroExpress Mobile" class="logo"/>
            </a>
            <a href="<?php echo site_url('change'); ?>" class="link-settings"><i
                        class="fa fa-cog"></i>&nbsp;Settings</a>
            <a href="<?php echo site_url('logout'); ?>" class="logout"><i class="fa fa-power-off"></i>&nbsp;Logout</a>
        </div>
    </div>
    <div id="menu" class="clearfix">
        <div class="menu-xs">
            <a href="#" class="open-menu">
					<span class="btn">
					<i class="fa fa-bars"></i>
					</span>
                Menu
            </a>
        </div>
        <ul class="menu-links">
            <li><a href="<?php echo site_url('tracing'); ?>"><i class="fa fa-user-secret"></i>&nbsp;Trace Account</a>
            </li>
            <li><a href="<?php echo site_url('keyword'); ?>"><i class="fa fa-search"></i>&nbsp;Trace Keyword</a></li>
            <li><a href="<?php echo site_url('invoice'); ?>"><i class="fa fa-envelope"></i>&nbsp;Invoice Customer</a>
            </li>
            <li><a href="<?php echo site_url('miletones'); ?>"><i class="fa fa-table"></i>&nbsp;Trace miletones</a></li>
            <li><a href="<?php echo site_url('map'); ?>" target="blank"><i class="fa fa-map-marker"></i>&nbsp;Map
                    Delivery</a></li>
            <li><a href="<?php echo site_url('kpi'); ?>"><i class="fa fa-chart-bar"></i>&nbsp;KPI Graph</a></li>

            <?php
            $menuPrivilege = $this->session->userdata('privilege');
            if (count($menuPrivilege) > 0) {
                foreach ($menuPrivilege as $key => $menu) {
                    if(isset($menu['masteraccesscustomermenu_route'])) {
                        echo "<li><a href='".site_url($menu['masteraccesscustomermenu_route'])."'><i class='fa fa-vr-cardboard'></i>&nbsp; ".$menu['masteraccesscustomermenu_name']."</a></li>";
                    }
                }
            }
            ?>

<!--            <li><a href="--><?php //echo site_url('ptpreport'); ?><!--"><i class="fa fa-th-large"></i>&nbsp; Report PTP</a></li>-->

        </ul>
    </div>`
>>>>>>> d1fa3799bd29c62ddbe760aacdcb5a23586dca51
