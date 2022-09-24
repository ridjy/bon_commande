<!DOCTYPE HTML>
<html>
<head>
<title>Liste des bordereaux à facturer</title>
<meta charset="UTF-8" />
<meta name="Author" content="rija">
<link rel="stylesheet" type="text/css" href="<?php echo css_url('bootstrap.min')?>">
<link rel="stylesheet" type="text/css" href="<?php echo css_url('bootstrap-responsive.min')?>">
<link rel="stylesheet" type="text/css" href="<?php echo css_url('style')?>">
<link rel="stylesheet" type="text/css" href="<?php echo css_url('styletbs')?>">
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
            <?php if ($this->session->userdata('acces')=='debours') { ?>
            <li><a href="<?php echo site_url("bordereau/havas/?s=$service&a=$agence") ?>" title="Nouveau bordereau HAVAS">Havas</a></li>
            <?php } else { ?>
            <li class="divider-vertical"></li>
            <li><a href="<?php echo site_url("bordereau/formulaire/?s=$service&a=$agence") ?>" title="Nouveau bordereau">Bon de commande</a></li>
            <li class="divider-vertical"></li>
            <?php } ?>
            <li class="divider-vertical"></li>
            <li class="divider-vertical"></li>
            <li class="divider-vertical"></li>

            <li class="gauche"><a href="<?php echo site_url("welcome") ?>">Déconnexion</a></li>
            </ul>
            </div><!--/.nav-collapse -->    
        </div>
    </div>
  </div>

  <div class="container" id="fac-content">
    <input type ="hidden" id="base_url" value="<?= site_url() ?>">
    <input type ="hidden" id="service" value="<?= $service ?>">
    <input type ="hidden" id="agence" value="<?= $agence ?>">

    <div class="row">
        <div class="span8">
                <a href="<?php echo site_url("bordereau/liste_bc/?s=$service&a=$agence") ?>"><button class="btn btn-success">Bons de commande</button></a>
                <a href="<?php echo site_url("bordereau/livraison/?s=$service&a=$agence") ?>"><button class="btn btn-success">Bons de livraison</button></a>
                <a href="#"><button class="btn btn-success">Facturation</button></a> 
                <br/><br/>
                <a href="<?php echo site_url("bordereau/historique/?s=$service&a=$agence") ?>"><button class="btn btn-success">Historique</button></a>
        </div>

        <div class="span4">    
            <blockquote>Pour faire une commande (BC ou HAVAS) cliquer sur les <strong>liens</strong> sur la barre de navigation en haut
            <br/> Pour voir les <strong>listes</strong> comme les marchandises déjà livrés cliquer sur les <strong>boutons</strong> verts pour naviguer 
            </blockquote>                      
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
        </div>                    
                               
    </div>
    <br/>

    <div class="row">
        <div class="span12"> 
           <table class="table table-bordered table-striped table-condensed tablesorter" id="tabla">
            <caption>
            <h4>Liste des bordereaux facturés pour le service : <?php echo $service; ?> , agence : <?php echo $agence; ?> </h4>
            </caption>
             <thead>
                <tr>
                    <th>N° bordereau</th>
                    <th>Date</th>
                    <th>Fournisseur</th>
                    <th>REF IRIS</th>
                    <th>Montant BC TTC</th>
                    <th>Département Demandeur</th>
                    <th>N° BL</th>
                    <th>Date BL</th>
                    <th>N° facture</th>
                    <th>Date facture</th>
                    <th>Montant facture TTC</th>
                    <th>Statut</th>
                    <th>Liens</th>
                    <th>Envoyer aux comptables</th>
                </tr>
            </thead>
             <tbody>
                <?php foreach($row as $item):?>
                <tr class="info">
                    <td><?php echo $item->id_cmd;?></td>
                    <td><?php echo date('d-m-Y',strtotime($item->date));?></td>
                    <td><?php echo $item->fournisseur;?></td>
                    <td><?php echo $item->ref;?></td>
                    <td><?php echo number_format($item->ttc, 2, ',', ' ').' '.$item->cmd_devise; ?></td>
                    <td><?php echo $service ?></td>
                    <td><?php echo $item->num_bl; ?></td>
                    <td><?php echo $item->date_bl; ?></td>
                    <td><?php echo $item->num_facture; ?></td>
                    <td><?php echo date('d-m-Y',strtotime($item->date_facture)); ?></td>
                    <td></td>
                    <td></td>
                    <td><a href="<?php echo site_url("bordereau/commande/?id=$item->id_cmd&ttc=$item->ttc&date=$item->date&f=$item->fournisseur&b=$service&a=$agence");?>">Voir</a></td>
                    <td><a href="<?php echo site_url("bordereau/valider/?s=$service&a=$agence&id=$item->id_cmd") ?>">Valider</a></td>
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

    <script type="text/javascript" src="<?php echo js_url('jquery.tablesorter'); ?>"></script>

     <script type="text/javascript">
            $(document).ready(function()
            {
                $("#tabla").tablesorter();
            }
        );
        $(function () {
                $("#tabla").hpaging({ "limit": 10 });
            });

            $("#btnApply").click(function () {
                var lmt = $("#pglmt").val();
                $("#tabla").hpaging("newLimit", lmt);
            });
        </script>

</body> 