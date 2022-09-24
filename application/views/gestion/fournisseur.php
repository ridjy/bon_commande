<!DOCTYPE HTML>
<html>
<head>
<title>Gestion des fournisseurs</title>
<meta charset="UTF-8" />
<meta name="Author" content="rija">
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
 		<div class="span2">
 			<a href="<?php echo site_url('gestion/login_par_fournisseur') ?>" class="btn btn-warning">Retour</a>
 		</div>	
 		<div class="span10">
 			<h4 align='center'><?php echo 'Liste des fournisseurs du service : '.$rowlogin['service'].', agence : '.$rowlogin['agence']; ?></h4>
 		</div>
 	</div>

	<div class="row">
		<!--<div class="col-md-4">
		</div>-->	
		<div class="span4">	
				<form method='POST' class="well" action="<?php echo site_url('gestion/valid_fournisseur') ?>" >
					<fieldset>
					<legend>Ajouter un fournisseur</legend>
					<input type="hidden" name="id_login" value="<?php echo $id_login;?>">
					<label for="nom">Fournisseur : </label>
					<input type="text" name="nom" value="<?php echo set_value('nom'); ?>" /> <?php echo form_error('nom'); ?><br/>
					<label for="ref">REF IRIS :</label>
					<input type="text" name="ref" value="<?php echo set_value('ref'); ?>" /> <?php echo form_error('ref'); ?><br/>
					<input type="submit" class="btn btn-primary" value="Enregistrer" />
					</fieldset>
				</form>
		</div>
		<div class="span8">	
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Fournisseurs</th>
						<th>REF IRIS</th>
						<th>Suppression</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($row as $item):?>
					<tr class="info">
						<td><?php echo $item->nom_fournisseur;?></td>
						<td><?php echo $item->ref_iris;?></td>
						<td><a href="<?php echo site_url("gestion/efface_fournisseur/?id=$item->id_fournisseur") ?>">Supprimer</a></td>
					</tr>
				<?php endforeach; ?>  
				</tbody>
				<tfooter><?php echo $total.' résultat(s)'; ?></tfooter>
			</table>   
		</div>
	</div>
		
</div>
	<script type="text/javascript" src="<?php echo js_url('jquery-2.1.3.min'); ?>"></script>
	<script type="text/javascript">

	</script>
</body>			