<!DOCTYPE HTML>
<html>
<head>
<title>Statistique des commandes effectués par année</title>
<meta charset="UTF-8" />
<meta name="Author" content="rija">
<link rel="stylesheet" type="text/css" href="<?php echo css_url('tableau')?>">
</head>

<body>
 <div id="wrapper">
  <h1>Statistique des commandes effectués par année pour le service <?php echo $s; ?></h1>
 
  <table id="keywords" cellspacing="0" cellpadding="0">
    <thead>
      <tr>
        <th><span>Année</span></th>
        <th><span>Service</span></th>
        <th><span>Agence</span></th>
        <th><span>Nbre de bordereaux</span></th>
        <th><span>Liens</span></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($row as $item):?>
      <tr>
        <td class="lalign"><?php echo $item->an;?></td>
        <td><?php echo $item->service;?></td>
        <td><?php echo $item->agence;?></td>
        <td><?php echo $item->total;?></td>
        <td><a href="<?php echo site_url("bordereau/mois/?a=$item->agence&b=$item->service&an=$item->an") ?>">Voir</a></td>
      </tr>
      <?php endforeach; ?> 
    </tbody>
  </table>

 </div> 
</body>
</html>