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

<div class="container" id="liv-content">
    <input type ="hidden" id="base_url" value="<?= site_url() ?>">
    <input type ="hidden" id="service" value="<?= $service ?>">
    <input type ="hidden" id="agence" value="<?= $agence ?>">

    <div class="row">
        <div class="span8">
                <a href="<?php echo site_url("bordereau/liste_bc/?s=$service&a=$agence") ?>">
                    <button class="btn btn-success">Bons de commande</button>
                </a>
                <a href="#">
                    <button class="btn btn-success">Bons de livraison</button>
                </a>
                <a href="<?php echo site_url("bordereau/facture/?s=$service&a=$agence") ?>">
                    <button class="btn btn-success">Facturation</button>
                </a> 
                <br/><br/>
                <a href="<?php echo site_url("bordereau/historique/?s=$service&a=$agence") ?>">
                    <button class="btn btn-success">Historique</button>
                </a>
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
                    <h4>Service : <i><?php echo $service; ?></i>, agence : <i><?php echo $agence; ?></i>, les BL en cours</h4>
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
                        <th>Liens</th>
                        <th>Facturation</th>
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
                            <td><?php echo date('d-m-Y',strtotime($item->date_bl)); ?></td>
                            <td><a href="<?php echo site_url("bordereau/bon_livraison/?id=$item->id_cmd&ttc=$item->ttc&date=$item->date&f=$item->fournisseur&b=$service&a=$agence");?>">Voir</a></td>
                            <!-- <td><a href="<?php echo site_url("bordereau/facturer/?s=$service&a=$agence&id=$item->id_cmd") ?>">Facturer</a></td> -->
                            <td><button type="button" class="btn btn-info btn-lg btn_facturer" id_cmd="<?= $item->id_cmd ?>" data-toggle="modal" data-target="#facturation">Facturer</button></td>
                        </tr>
                    <?php endforeach; ?> 
                </tbody>
            </table>
        </div> 
    </div>

    
    <!-- Modal -->
    <div id="facturation" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Informations sur la facturation</h4>
                </div>
                <div class="modal-body">
                    <form id="form-facturation" role="form" class="form-horizontal">
                        <div class="form-group" id="form-group-num-facture">
                            <label class="col-sm-2 control-label">N° Facture : </label>&nbsp
                            <input type="text" class="form-control input_facturation" id ="num_facture" name="num_facture">
                        </div> &nbsp
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Date facture : </label>&nbsp
                            <input type="text" value ="<?= date("d-m-Y") ?>" class="form-control input_facturation" name="date_facture" disabled>
                        </div>
                    </form>  
                </div>
                <div class="modal-footer">
                    <button type="submit" id ="btn_enregistrer_facture" class="btn btn-success">Enregistrer</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                </div>
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
    <script src="<?php echo js_url('bootstrap.min'); ?>"></script>
    <script src="<?php echo js_url('jquery.table.hpaging.min'); ?>"></script>
 <script type="text/javascript" src="<?php echo js_url('jquery.tablesorter'); ?>"></script>

     <script type="text/javascript">
        var base_url = $("#base_url").val();
        var agence = $("#agence").val();
        var service = $("#service").val();
        var id_cmd = "";
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

            $(document).on("click",".btn_facturer",function(){
                id_cmd = $(this).attr("id_cmd");
                $("input#num_facture").css("border-color","");
                $('#facturation').on('shown.bs.modal', function () {
                    $("input#num_facture").focus();
                });
            });

            $(document).on("click","#btn_enregistrer_facture",function(){
                var donnees = {};
                $(".input_facturation").each(function(){
                    donnees[$(this).attr("name")] = $(this).val();
                    return donnees;
                });

                $("input#num_facture").css("border-color","");

                if(!donnees.num_facture){
                    $("input#num_facture").css("border-color","red");
                    $("input#num_facture").focus();
                    return false;
                }

                $.post(base_url +"bordereau/enregistrerFacturation",{donnees : donnees, agence : agence , service : service ,id_cmd : id_cmd},function(response){
                    $('#facturation').on('hide.bs.modal', function(){
                      $("#liv-content").html(response);
                      return true;
                    });
                    $("#facturation").modal('hide');
                });
            });
    </script>

</body> 