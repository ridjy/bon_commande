<!DOCTYPE HTML>
<html>
<head>
<title><?php echo $titre?></title>
<meta charset="UTF-8" />
<meta name="Author" content="rija">
<link rel="stylesheet" type="text/css" href="<?php echo css_url('bootstrap.min')?>">
<link rel="stylesheet" type="text/css" href="<?php echo css_url('bootstrap-responsive.min')?>">
<link rel="stylesheet" type="text/css" href="<?php echo css_url('style')?>">
</head>

<body>
<div class="container">

   <div class="navbar navbar-inverse navbar-fixed-top">
    <!--navbar-inverse noir-->
    <div class="navbar-inner">
        <div class="container">
            <div class="nav-collapse">
            <ul class="nav">
            <li></li>
            <li class="divider-vertical"></li>
            <li></li>
            <li class="divider-vertical"></li>
            <li> </li>
            <li class="divider-vertical"></li>
            <li class="divider-vertical"></li>
            <li class="divider-vertical"></li>
            <li class="gauche"><a href="<?php echo site_url("welcome") ?>">Déconnexion</a></li>
            </ul>
            </div><!--/.nav-collapse -->    
        </div>
    </div>
  </div>

  <div class="row">
    <div class="span3">
       <a href="<?php echo site_url("bordereau/archivecompta/?s=$b&a=$a") ?>"><button class="btn btn-lg btn-warning">retour</button></a>
    </div>
  </div>  

<div class="row">
     <div class="span12"> 
      <table class="table table-bordered table-striped table-condensed" id="tabla">
        <caption>
        	<h3>Les statistiques par mois de l'année <?php echo $an; ?></h3>
          	<p>Service : &nbsp; <b><?php echo $b; ?></b> &nbsp; Agence:  &nbsp; <b><?php echo $a; ?></b></p>
        </caption>
        <thead>
        <tr>
          <th><span>Mois</span></th>
          <th><span>Total ttc (en MGA, les bordereaux en Euro et dollar sont exclus)</span></th>
          <th><span>Nombre</span></th>
          <th><span>Liens</span></th>
        </tr>
        </thead>
        <tbody>
          <?php foreach($row as $item):?>
          <tr class="info">
            <td class="lalign"><?php echo $item->mois;?></td>
            <td><?php echo number_format($item->taxe, 2, ',', ' '). ' ariary';?></td>
            <td><?php echo $item->total.' bordereaux';?></td>
            <td><a href="<?php echo site_url("bordereau/jourarchive/?a=$a&b=$b&m=$item->mois&an=$an"); ?>" >Afficher</a></td>
          </tr>
          <?php endforeach; ?>      
        </tbody>
      </table>
      </div> 

    </div>
  
</div>
</body>    