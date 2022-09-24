<!DOCTYPE HTML>
<html>
<head>
<title>Gestion des fournisseurs</title>
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
        <div class="span4">
        </div>
        <div class="span4">
            <label><b>Nombre à afficher par page</b></label>
            <input id="pglmt" class="pglimit" placeholder="Page Limit" title="Page Limit" value="10" size="4" class="form-control">
            <button id="btnApply" class="btn btn-danger btn-sm">Appliquer</button> 
        </div>
        <div class="span4">
        	<p><?php echo $total." enregistrements trouvés"?></p>
        </div>                    
                               
    </div>
    <br/>
	<div class="row">
		<!--<div class="col-md-4">
		</div>-->
		<div class="span8 offset2">	
			<table id="liste_login" class="table table-bordered tablesorter">
				<thead>
					<tr>
						<th>Service</th>
						<th>Agence</th>
						<th>Mot de passe</th>
						<th>Fournisseurs</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($row as $item):?>
					<tr class="info">
						<td><?php echo $item->service;?></td>
						<td><?php echo $item->agence;?></td>
						<td><?php echo $item->mdp;?></td>
						<td><a href="<?php echo site_url("gestion/fournisseur/?id=$item->id_login") ?>">Gérer</a></td>
					</tr>
				<?php endforeach; ?>  
				</tbody>
				<tfooter><?php //echo $total.' résultat(s)'; ?></tfooter>
			</table>   
		</div>
	</div>
		
</div>
	<script src="<?php echo js_url('jquery-1.12.4'); ?>"></script>
    <script src="<?php echo js_url('jquery-ui'); ?>"></script>  
    <script src="<?php echo js_url('bootstrap.min'); ?>"></script>
	<script src="<?php echo js_url('jquery.table.hpaging.min'); ?>"></script>
    <script type="text/javascript" src="<?php echo js_url('jquery.tablesorter'); ?>"></script>
	<script type="text/javascript">
		$(document).ready(function()
           {
            $("#liste_login").tablesorter();

           }
        );
         $(function () {
                $("#liste_login").hpaging({ "limit": 10 });
            });

            $("#btnApply").click(function () {
                var lmt = $("#pglmt").val();
                $("#liste_login").hpaging("newLimit", lmt);
            });
	</script>
</body>			