<!DOCTYPE HTML>
<html>
<head>
<title>Liste des bordereaux livrés</title>
<meta charset="UTF-8" />
<meta name="Author" content="rija">
<link rel="stylesheet" type="text/css" href="<?php echo css_url('jour')?>">
</head>

<body>
  
  <nav>
    <a href="<?php echo site_url("bordereau/formulaire/?s=$service&a=$agence") ?>"><button>Bon de commande</button></a>
    <a href="<?php echo site_url("bordereau/facture/?s=$service&a=$agence") ?>"><button>Facture</button></a>
    <a href="<?php echo site_url("bordereau/listedumois/?s=$service&a=$agence") ?>"><button>Liste des BC du mois</button></a>
  </nav> 

  <div class="caption">Liste des bordereaux livrés pour le service : <?php echo $service; ?> , agence : <?php echo $agence; ?> </div> 
<div id="table">
  <div class="header-row row">
  <span class="cell primary">N° bordereau</span>
    <span class="cell primary">Date</span>
    <span class="cell primary">Fournisseur</span>
    <span class="cell primary">REF IRIS</span>
    <span class="cell primary">Total TTC</span>
    <span class="cell primary">Liens</span>
    <span class="cell">Facturation</span>
 </div>
  <?php foreach($row as $item):?>
  <div class="row">
  <input type="radio" name="expand">
    <span class="cell primary" data-label="Vehicle"><?php echo $item->id_cmd;?></span>
    <span class="cell primary" data-label="Vehicle"><?php echo $item->date;?></span>
    <span class="cell primary" data-label="Vehicle"><?php echo $item->fournisseur;?></span>
    <span class="cell primary" data-label="Vehicle"><?php echo $item->ref;?></span>
    <span class="cell primary" data-label="Vehicle"><?php echo $item->ttc;?></span>
    <span class="cell primary" data-label="Vehicle"><a href="<?php echo site_url("bordereau/commande/?id=$item->id_cmd&ttc=$item->ttc&date=$item->date&f=$item->fournisseur&b=$service&a=$agence");?>">Voir</a></span>
    <span class="cell " data-label="Exterior"><a href="<?php echo site_url("bordereau/facturer/?s=$service&a=$agence&id=$item->id_cmd") ?>">Facturer</a></span>
</div>
<?php endforeach; ?>   
</body>
</html>