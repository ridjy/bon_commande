<!DOCTYPE HTML>
<html>
<head>
<title><?php echo $titre?></title>
<meta charset="UTF-8" />
<meta name="Author" content="rija">
<link rel="stylesheet" type="text/css" href="<?php echo css_url('jour')?>">
</head>

<body>
<a href="<?php echo site_url("excel/file/?s=$b&a=$a&mois=$m&an=$an")?>"><button>Fichier excel</button></a>  
<div class="caption">Service <?php echo $b; ?> Agence <?php echo $a; ?> , les commandes du mois de : <?php echo $m;?></div>	
<div id="table">
	<div class="header-row row">
	<span class="cell primary">N° bordereau</span>
    <span class="cell primary">Date</span>
    <span class="cell primary">Fournisseur</span>
    <span class="cell primary">Total TTC</span>
    <span class="cell">Liens</span>
      
  </div>
  <?php foreach($row as $item):?>
  <div class="row">
	<input type="radio" name="expand">
    <span class="cell primary" data-label="Vehicle"><?php echo $item->id_cmd;?></span>
    <span class="cell primary" data-label="Vehicle"><?php echo $item->date;?></span>
    <span class="cell primary" data-label="Vehicle"><?php echo $item->fournisseur;?></span>
    <span class="cell primary" data-label="Vehicle"><?php echo $item->ttc;?></span>
    <span class="cell" data-label="Exterior"><a href="<?php echo site_url("bordereau/commande/?id=$item->id_cmd&ttc=$item->ttc&date=$item->date&f=$item->fournisseur&b=$b&a=$a");?>">Voir</a></span>
</div>
<?php endforeach; ?>  


</body>

</html>