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
    .pagination { display: inline-block; text-align: center; }
    .pagination a {
      color: black;
      float: left;
      padding: 8px 16px;
      text-decoration: none;
    }
    .pagination a.active {
      background-color: #4CAF50;
      color: white;
    }
    .pagination a:hover:not(.active) { background-color: #ddd; }

    </style>
</head>
<body>

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

<div class="container">

  <div class="row">
    <div class="span3">
       <a href="<?php echo site_url("bordereau/").'/'.$retour ?>"><button class="btn btn-lg btn-warning">retour</button></a>
    </div>
  </div>

<div class="row">    
        <div class="span4">
        </div>
        <div class="span4">
            <label><b>Nombre à afficher par page</b></label>
            <input id="pglmt" class="pglimit" placeholder="Page Limit" title="Page Limit" value="10" size="4" class="form-control">
            <button id="btnApply" class="btn btn-danger btn-sm">Appliquer</button> 
        </div>
         <div class="span4">
      <!--<form id="form" method="POST" action="<?php echo site_url("bordereau/trieagence")?>">
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
      </select>
    </form>--> 
    </div>                     
                               
    </div>    

 

 <table class="table table-bordered table-striped table-condensed" id="tabla">
    <caption>
    <h4>Statistique des commandes effectués par année pour le service <?php echo $s; ?></h4>
    </caption>
    <thead>
        <tr>
            <th>Année</th>
            <th>Service</th>
            <th>Agence</th>
            <th>Nombre de bordereau</th>
            <th>Liens</th>
        </tr>
    </thead>
     
    <tbody>
        <?php foreach($row as $item):?>
        <tr>
            <td><?php echo $item->an;?></td>
            <td><?php echo $item->service;?></td>
            <td><?php echo $item->agence;?></td>
            <td><?php echo $item->total;?></td>
            <td><a href="<?php echo site_url("bordereau/moisarchive/?a=$item->agence&b=$item->service&an=$item->an") ?>">Voir</a></td>
        </tr>
        <?php endforeach; ?> 
    </tbody>
    </table>

    <div class="col-md-12 text-center">
      <ul class="pagination pagination-lg pager" id="myPager"></ul>
    </div> 

</div>
<!--   Core JS Files   -->
    <script src="<?php echo js_url('jquery-1.12.4'); ?>"></script>
    <script src="<?php echo js_url('jquery-ui'); ?>"></script>  
    <script src="<?php echo js_url('jquery.table.hpaging.min'); ?>"></script>

     <script type="text/javascript">
            $(function () {
                $("#tabla").hpaging({ "limit": 10 });
            });

            $("#btnApply").click(function () {
                var lmt = $("#pglmt").val();
                $("#tabla").hpaging("newLimit", lmt);
            });
        </script>

</body> 

