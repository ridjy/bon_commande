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

	<div class="caption info"><h3></h3></div>	
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


    <table class="table table-bordered table-striped table-condensed" id="tabla">
    <caption>
    <h3>Les bordereau en attente de validation par le comptable Service <?php echo $service; ?> Agence <?php echo $agence; ?></h3>
    </caption>
    <a href='#'><button class='btn-info'>Fichier Excel</button></a>
    <thead>
        <tr>
            <th>Num. bordereau</th>
            <th>Date</th>
            <th>Fournisseur</th>
            <th>Total TTC</th>
            <th>Facture reçu</th>
        </tr>
    </thead>
     
    <tbody>
        <?php foreach($row as $item):?>
        <tr>
            <td><?php echo $item->id_cmd;?></td>
            <td><?php echo $item->date;?></td>
            <td><?php echo $item->fournisseur;?></td>
            <td><?php echo $item->ttc;?></td>
            <td><a href="<?php echo site_url("bordereau/facturecompta/?i=$item->id_cmd&s=$item->service&a=$item->agence") ?>">Reçu</a></td>
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

