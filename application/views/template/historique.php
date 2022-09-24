<!DOCTYPE HTML>
<html>
<head>
<title>Liste des bordereaux livrés</title>
<meta charset="UTF-8" />
<meta name="Author" content="rija">
<link rel="stylesheet" type="text/css" href="<?php //echo css_url('jour')?>">
<link rel="stylesheet" type="text/css" href="<?php echo css_url('bootstrap.min')?>">
<link rel="stylesheet" type="text/css" href="<?php echo css_url('bootstrap-responsive.min')?>">
<link rel="stylesheet" type="text/css" href="<?php echo css_url('style')?>">
<style>

</style>
</head>

<body>
<div class="navbar navbar-inverse navbar-fixed-top">
    <!--navbar-inverse noir-->
    <div class="navbar-inner">
        <div class="container">
            <div class="nav-collapse">
            <ul class="nav">
        
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
    <div class="span3">
       <a href="<?php echo site_url("bordereau/liste_bc/?s=$service&a=$agence") ?>"><button class="btn btn-lg btn-warning">retour</button></a>
    </div>

    <div class="span3">
      <!--<form id="form" method="POST" action="<?php echo site_url("bordereau/trie")?>">
      <label>Trie par année</label>
      <select name="annee" onchange="document.getElementById('form').submit();" > 
                            <option value=""></option>
                            <option value="tous">Tous</option>
                            <option value="2015">2015</option>
                            <option value="2016">2016</option>
                            <option value="2017">2017</option>
                            <option value="2018">2018</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
      </select>
    </form>--> 

    </div> 
    <div class="span4">    
            <blockquote>Ceci est un récapitulatif des <strong>bons de commandes</strong> déjàs livrés et comptabilisés.<br/> 
              Les BC en Euro et Dollar étant exclus dans le total.
            </blockquote>                      
        </div> 
  </div>
  
  <div class="row">
     <div class="span12"> 
      <table class="table table-bordered table-striped table-condensed" id="tabla">
        <caption>
        <h4>Service : <i><?php echo $service; ?></i>, agence : <i><?php echo $agence; ?></i>, historique des BC par année</h4>  
        </caption>
        <thead>
        <tr>
          <th><span>Année</span></th>
          <th><span>Nbre de bordereaux</span></th>
          <th><span>Lien</span></th>
        </tr>
        </thead>
        <tbody>
          <?php foreach($row as $item):?>
          <tr class="info">
            <td class="lalign"><?php echo $item->an;?></td>
            <td><?php echo $item->total;?></td>
            <td><a href="<?php echo site_url("bordereau/mois/?a=$agence&b=$service&an=$item->an&retour=historique") ?>">Voir</a></td>
          </tr>
          <?php endforeach; ?>      
        </tbody>
      </table>
      </div> 

    </div>
  </div>

</div>
</body>

</html>