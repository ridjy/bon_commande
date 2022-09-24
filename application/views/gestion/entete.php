<!DOCTYPE HTML>
<html>
<head>
<title><?php echo $titre?></title>
<meta charset="UTF-8" />
<meta name="Author" content="rija">
<link rel="stylesheet" type="text/css" href="<?php echo css_url('bootstrap.min')?>">
<link rel="stylesheet" type="text/css" href="<?php echo css_url('style')?>">
 
</head>
<body>

<div class="navbar navbar-inverse navbar-fixed-top">
    <!--navbar-inverse noir-->
    <div class="navbar-inner">
        <div class="container">
            <div class="nav-collapse">
            <ul class="nav">
            <li><a href="<?php echo site_url("bordereau/havas/?s=$service&a=$agence") ?>" title="Nouveau bordereau HAVAS">Havas</a></li>
            <li class="divider-vertical"></li>
            <li><a href="<?php echo site_url("bordereau/formulaire/?s=$service&a=$agence") ?>" title="Nouveau bordereau">Bon de commande</a></li>
            <li class="divider-vertical"></li>
            <li> <a href="<?php echo site_url('bordereau/login') ?>">Voir les commandes effectués</a> </li>
            <li class="divider-vertical"></li>
            <li class="divider-vertical"></li>
            <li class="divider-vertical"></li>
            <li class="gauche"><a href="<?php echo site_url("welcome") ?>">Déconnexion</a></li>
            </ul>
            </div><!--/.nav-collapse -->    
        </div>
    </div>
</div>

<div class="container">

    <div class="row">
        <div class="span8">
                <a href="<?php echo site_url("bordereau/liste_bc") ?>"><button class="btn btn-success">Bons de commande</button></a>
                <a href="<?php echo site_url("bordereau/livraison/?s=$service&a=$agence") ?>"><button class="btn btn-success">Bons de livraison</button></a>
                <a href="<?php echo site_url("bordereau/facture/?s=$service&a=$agence") ?>"><button class="btn btn-success">Facturation</button></a> 
                <br/><br/>
                <a href="<?php echo site_url("bordereau/listedumois/?s=$service&a=$agence") ?>"><button class="btn btn-success">Tous les BC (du mois)</button></a>
                <a href="<?php echo site_url("gestion/fournisseur/?s=$service&a=$agence") ?>"><button class="btn btn-success" title="Gérer les fournisseurs">Fournisseurs</button></a>
        </div>

        <div class="span4">    
            <blockquote>Pour faire une commande (BC ou HAVAS) cliquer sur les <strong>liens</strong> sur la barre de navigation en haut
            <br/> Pour voir les <strong>listes</strong> comme les marchandises déjà livrés cliquer sur les <strong>boutons</strong> verts pour naviguer 
            </blockquote>                      
        </div>

    </div>

<!-- header -->