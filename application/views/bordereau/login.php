<!DOCTYPE HTML>
<html>
<head>
<title>Login</title>
<meta charset="UTF-8" />
<meta name="Author" content="rija">
<link rel="stylesheet" type="text/css" href="<?php echo css_url('reset')?>">
<link rel="stylesheet" type="text/css" href="<?php echo css_url('structure')?>">
</head>

<body>
<form class="box login" method="POST" action="<?php echo site_url('bordereau/admin')?>">
	<fieldset class="boxBody">
	  <label>Utilisateur</label>
	  <input type="text" placeholder="login" name="login" required>
	  <label><a href="#" class="rLink" tabindex="5"></a>Mot de passe</label>
	  <input type="password" name="mdp" required>
	</fieldset>
	<footer>
	  <input type="submit" class="btnLogin" value="Login" tabindex="4">
	</footer>
</form>
<footer id="main">
  <a href="">&copy; Service informatique</a> | <a href="http://www.bollore-africa-logistics.com">Bollore Africa Logistics</a>
</footer>
</body>
</html>
