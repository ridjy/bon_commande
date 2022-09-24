<!DOCTYPE HTML>
<html>
<head>
<title><?php echo $titre?></title>
<meta charset="UTF-8" />
<meta name="Author" content="rija">
<link rel="stylesheet" type="text/css" href="<?php echo css_url('jour')?>">
<!--link rel="stylesheet" type="text/css" href="<?php echo css_url('bootstrap.min')?>"-->
  
</head>
<body>
    <marquee>Pour faire une commande cliquer sur Bon de Commande, pour les marchandises déjà livrés cliquer sur Bon de livraison </marquee>
    <br/>
    <br/>
	<a href="<?php echo site_url("bordereau/formulaire/?s=$service&a=$agence") ?>"><button class="btne">Bon de commande</button></a>
	<a href="<?php echo site_url("bordereau/livraison/?s=$service&a=$agence") ?>"><button class="btne">Bon de livraison</button></a>
	<a href="<?php echo site_url("bordereau/facture/?s=$service&a=$agence") ?>"><button class="btne">Facture</button></a>
	<a href="<?php echo site_url("bordereau/listedumois/?s=$service&a=$agence") ?>"><button class="btne">Liste des BC du mois</button></a>
    <a href="<?php echo site_url("gestion/accueil/?s=$service&a=$agence") ?>"><button class="btne">Gérer les fournisseurs</button></a>
    

	<div class="caption">Service <?php echo $service; ?> Agence <?php echo $agence; ?> , les BC non livrés</div>	
<div id="table">
	<div class="header-row row">
	<span class="cell primary">N° bordereau</span>
    <span class="cell primary">Date</span>
    <span class="cell primary">Fournisseur</span>
    <span class="cell primary">REF IRIS</span>
    <span class="cell primary">Total TTC</span>
    <span class="cell">Liens</span>
    <span class="cell">Livraison</span>
      
  </div>
  <?php foreach($row as $item):?>
  <div class="row">
	<input type="radio" name="expand">
    <span class="cell primary" data-label="Vehicle"><?php echo $item->id_cmd;?></span>
    <span class="cell primary" data-label="Vehicle"><?php echo $item->date;?></span>
    <span class="cell primary" data-label="Vehicle"><?php echo $item->fournisseur;?></span>
    <span class="cell primary" data-label="Vehicle"><?php echo $item->ref;?></span>
    <span class="cell primary" data-label="Vehicle"><?php echo $item->ttc;?></span>
    <span class="cell" data-label="Exterior"><a href="<?php echo site_url("bordereau/commande/?id=$item->id_cmd&ttc=$item->ttc&date=$item->date&f=$item->fournisseur&b=$service&a=$agence");?>">Voir</a></span>
    <span class="cell " data-label="Exterior"><a href="<?php echo site_url("bordereau/livrer/?s=$service&a=$agence&id=$item->id_cmd") ?>">Livré</a></span>
</div>
<?php endforeach; ?>  

</body>	