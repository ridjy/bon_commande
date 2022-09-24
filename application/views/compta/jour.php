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
       <a href="<?php echo site_url("bordereau/moisarchive/?b=$b&a=$a&an=$an") ?>"><button class="btn btn-lg btn-warning">retour</button></a>
       
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
          <a href="<?php echo site_url("excel/file/?s=$b&a=$a&mois=$m&an=$an")?>"><button class="btn btn-lg btn-success">Exporter sur excel</button></a>
        </div>                    
                               
    </div>
    <br/>

<div class="row">
     <div class="span12"> 
      <table class="table table-bordered table-striped table-condensed" id="tabla">
        <caption>
          <h3>Les BC du mois de <?php echo $m; ?></h3>
            <p>Service : &nbsp; <b><?php echo $b; ?></b> &nbsp; Agence:  &nbsp; <b><?php echo $a; ?></b></p>
        </caption>
        <thead>
        <tr>
          <th><span>N° bordereau</span></th>
          <th><span>Date</span></th>
          <th><span>Fournisseur</span></th>
          <th><span>Total TTC</span></th>
          <th><span>Liens</span></th>
        </tr>
        </thead>
        <tbody>
          <?php foreach($row as $item):?>
          <tr class="info">
            <td class="lalign"><?php echo $item->id_cmd;?></td>
            <td class="lalign"><?php echo date('d-m-Y',strtotime($item->date));?></td>
            <td class="lalign"><?php echo $item->fournisseur;?></td>
            <td><?php echo number_format($item->ttc, 2, ',', ' '). ' ariary';?></td>
            <td><a href="<?php echo site_url("bordereau/commandearchive/?id=$item->id_cmd&ttc=$item->ttc&date=$item->date&f=$item->fournisseur&b=$b&a=$a&m=$m&an=$an");?>" >Afficher</a></td>
          </tr>
          <?php endforeach; ?>      
        </tbody>
      </table>
      </div> 

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