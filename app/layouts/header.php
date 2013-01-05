<!DOCTYPE html>

<html>
	<head>
		<title>ESA</title>
		<link rel="stylesheet" type="text/css" href="<?php echo appendToUrl('css/reset.css'); ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo appendToUrl('css/mainStyle.css'); ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo appendToUrl('css/headerStyle.css'); ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo appendToUrl('css/leftPanelStyle.css'); ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo appendToUrl('css/mainContentStyle.css'); ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo appendToUrl('css/font-awesome.css'); ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo appendToUrl('css/font-awesome-ie7.css'); ?>" />
	</head>
	
	<body>
		<div id="topNav">
			<div id="navContaner">
				<div class="topNavLeft">
					<div id="navLogo">
						<p>ESA</p>
					</div>
				</div>
				
				<div class="topNavLeft">
					<div id="topNavLinks">
						<?php
							$topNavigation = new Template('navigationView.php', 'navigation', array('nodes' => array()));
							
							foreach($config['topNav'] as $key => $value) {
								if(strcasecmp(REQUESTED_PAGE, $key) == 0) {
									$topNavigation->nodes = 
										new Template('navigationNodeView.php', 'navigation', array(
											'label' => $key, 'url' => $value, 'linkClass' => 'selectedLink')
									);
								}
								else {
									$topNavigation->nodes = 
										new Template('navigationNodeView.php', 'navigation', array(
											'label' => $key, 'url' => $value, 'linkClass' => '')
									);
								}
							}
							
							$topNavigation->render();
						?>
					</div>
				</div>

				<div class="topNavRight" id="search-panel">
					<form>
						<input type="text" id="searchInput" value="Search" />
					</form>
				</div>
			</div>
		</div>