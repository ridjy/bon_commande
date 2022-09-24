<!DOCTYPE HTML>
<html>
<head>
<title><?php echo $titre?></title>
<meta charset="UTF-8" />
<meta name="Author" content="rija">
<link rel="stylesheet" type="text/css" href="<?php echo css_url('mois')?>">
</head>
 
<body>
<section class="container">
<center><h2>Les statistiques par mois de l'année <?php echo $an; ?></h2>
  <p>Service : &nbsp; <b><?php echo $b; ?></b> &nbsp; Agence:  &nbsp; <b><?php echo $a; ?></b></p>
</center>
<div class="pricing_table_wdg">
        <?php foreach($row as $item):?>
        <ul>
            <li><?php echo $item->mois;?></li>
            <li><?php echo $item->taxe. 'ariary';?></li>
            <li><?php echo $item->total.' bordereaux';?></li>
            <li><a href="<?php echo site_url("bordereau/jours/?a=$a&b=$b&m=$item->mois&an=$an"); ?>" class="buy_now">Afficher</a></li>
        </ul>
        <?php endforeach; ?>
</div>
  </section>
   
</body>
</html>