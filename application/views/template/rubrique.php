<!DOCTYPE HTML>
<html>
<head>
<title>Budget RH 2018</title>
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
            <li class="gauche"><a href="<?php echo site_url("bordereau/stat") ?>">Retour</a></li>
            
            <li class="gauche"><a href="<?php echo site_url("welcome") ?>">Déconnexion</a></li>
            </ul>
            </div><!--/.nav-collapse -->    
        </div>
    </div>
  </div>

<div class="container">

  <div class="row">
    <div class="span3">
      <form id="form" method="POST" action="<?php echo site_url("admin")?>">
      <label><b>Budget RH Année 2018</b></label>
      <!--<select name="annee" onchange="document.getElementById('form').submit();" > 
                            <option value=""></option>
                            <option value="2015">2015</option>
                            <option value="2016">2016</option>
                            <option value="2017">2017</option>
                            <option value="2018">2018</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
      </select>-->
    </form> 

    </div> 
    <div class="span4">    
                               
        </div> 
  </div>
  
  <div class="row">
     <div class="span12"> 
      <table class="table table-bordered table-condensed" id="table">
        <thead>
        <tr>
          <th><span>RUBRIQUES</span></th>
          <th><span>SOUS RUBRIQUES</span></th>
          <th><span>MONTANT PREVU</span></th>
          <th><span>MONTANT UTILISE</span></th>
          <th><span></span></th>
        </tr>
        </thead>
        <tbody>
               <?php echo $tab; ?>
        </tbody>
      </table>
      </div> 

    </div>
  </div>

</div>
</body>

</html>