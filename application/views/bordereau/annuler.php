<!DOCTYPE HTML>
<html>
<head>
<title><?php echo $titre?></title>
<meta charset="UTF-8" />
<meta name="Author" content="rija">
<link rel="stylesheet" type="text/css" href="<?php echo css_url('bootstrap.min')?>">
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
                <a href="<?php echo site_url("bordereau/formulaire/?s=$service&a=$agence") ?>"><button class="btn btn-success">Bons de commande</button></a>
                <a href="#"><button class="btn btn-success">Bons de livraison</button></a>
                <a href="#"><button class="btn btn-success">Facturation</button></a> 
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

    <div class="row">    
      <table align="center" width="auto">
                                <tr>
                                  <td>
                                        <label>Nombre à afficher par page</label><br>
                                    </td>
                                </tr>
                                 <tr>
                                    <td>
                                        <input id="pglmt" placeholder="Page Limit" title="Page Limit" value="10" size="7" class="form-control">
                                    </td>
                                    <td><button id="btnApply" class="btn btn-danger btn-sm">Appliquer</button>
                                    </td>
                                </tr>
                            </table>
    </div> 

    
  <div class="row">
        <div class="span12"> 
           <table class="table table-bordered table-striped table-condensed" id="tabla">
            <caption>
            <h4>Service <?php echo $service; ?> Agence <?php echo $agence; ?> </h4>
            </caption>
             <thead>
                <tr>
                    <th>N° bordereau</th>
                    <th>Date</th>
                    <th>Liens</th>
                </tr>
            </thead>

              <tbody>
                <?php foreach($row as $item):?>
                <tr class="info">
                    <td><?php echo $item->id_cmd;?></td>
                    <td><?php echo $item->mois;?></td>
                    <td><a href="<?php echo site_url("bordereau/efface/?id=$item->id_cmd&s=$service&a=$agence")?>">Effacer</a></td>
                </tr>
                <?php endforeach; ?> 
            </tbody>
            </table>
 </div> 
 </div>

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