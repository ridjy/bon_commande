
<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Login</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!--<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>-->
<link rel="stylesheet" href="<?php echo css_url('log')?>" />
<script type="text/javascript" src="<?php echo js_url('JFCore'); ?>"></script>
<script type="text/javascript" src="<?php echo js_url('push.min'); ?>"></script>
<script type="text/javascript" src="<?php echo js_url('jquery-2.1.3.min'); ?>"></script>
<script type="text/javascript" src="<?php echo js_url('bootstrap.min'); ?>"></script>
<script type="text/javascript">

	</script>
		
		<!-- Set here the key for your domain in order to hide the watermark on the web server -->
		<script type="text/javascript">
			(function() {
				JC.init({
					domainKey: ''
				});
				})();
		</script>

</head>

<body style="background: url(<?php echo img_url('bg.jpg')?>) no-repeat #fff;
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-position: center;
  background-size: cover;
  font-weight: 300">

	<div class="wrap">
	<!-- tab style-1 -->
		<div class="row">
			<img src="<?php echo img_url('logo.jpg')?>">

			<div class="grid_12 columns">
				<div class="tab style-1">
		    					<dl>
		    						<dd class="fournisseur"><a class="bord active" class="frn" href="#Fournisseurs">Les fournisseurs</a></dd>
		    						<dd class="rubrique"><a class="rub" href="#Rubriques">Les rubriques</a></dd>
		    						<dd class="dafs"><a class="daf" href="#DAF"> Administrateur</a></dd>
		    						<!--<dd class="bc"><a class="bc" href="<?php echo site_url('welcome') ?>">Gestion BC</a></dd>
		    					--></dl>
		    					<ul>
		    						
		    						<li class="active"><div class="top-grids">
							      			<div class="form">	
						    					<form method="POST" action="<?php echo site_url('welcome/test_fournisseur')?>">
		
													<input type="text" name="login" required class="active textbox" placeholder="Login pour accéder au gestion des fournisseurs" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Login';}">
													<input type="password" name="mdp" required class="textbox" placeholder="Mot de passe" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Mot de passe';}">
													
													<input type="submit" value="Login">
												</form>
									    </div>
		      							</div>   		
										<div class="clear"> </div>
									</li>
		    						<li>
		    							<div class="settings">
			    							<div class="form">	
						    					<form method="POST" action="<?php echo site_url('welcome/test_rubrique')?>">
		
													<input type="text" name="login" required class="active textbox" placeholder="Login pour accéder au gestion des rubriques" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Login';}">
													<input type="password" name="mdp" required class="textbox" placeholder="Mot de passe" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Mot de passe';}">
													
													<input type="submit" value="Login">
												</form>
									    </div>
		    							</div>
		    						</li>
		    						<li>
							    		<div class="top-grids">
							      			<div class="form">	
						    					<form method="POST" action="<?php echo site_url('welcome/test_daf')?>">
		
													<input type="text" name="login" required class="active textbox" placeholder="Login DAF" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Login';}">
													<input type="password" name="mdp" required class="textbox" placeholder="Mot de passe" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Mot de passe';}">
													
													<input type="submit" value="Login">
												</form>
									    </div>
							      		</div>    		
										<div class="clear"> </div>
		    						</li>
		    						<li>
							    		<div class="top-grids">
							      			
							      		</div>    		
										<div class="clear"> </div>
		    						</li>
		    					</ul>
				</div>
		</div>            
	</div>			
	<div class="wrap">
		<!--footer-->
		<div class="footer">
			<a class="bc" href="<?php echo site_url('welcome') ?>">Application Bordereau de commande | </a><a href="">&copy; Service informatique</a> | <a href="http://www.bollore-africa-logistics.com">Bollore Africa Logistics</a>
		</div>
	<div class="clear"> </div>

</body>
</html>