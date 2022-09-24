<!DOCTYPE HTML>
<html>
<head>
<title>Gestion des rubriques</title>
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
		<!--<div class="col-md-4">
		</div>-->	

		<div class="span4">	
				<form method='POST' class="well" action="<?php echo site_url('gestion/valid_rubrique') ?>" >
					<fieldset>
					<legend>Ajouter une rubrique</legend>
					<label for="libelle">Libellé : </label>
					<input type="text" name="libelle" value="<?php echo set_value('libelle'); ?>" /> <?php echo form_error('libelle'); ?><br/>
					<input type="submit" class="btn btn-primary" value="Enregistrer" /> 
					</fieldset>
				</form>
					 <a href="<?php echo site_url("gestion/sous_rubrique") ?>"><button class="btn btn-success" title="Gérer les rubriques">Sous-rubriques</button></a>

		</div>
		<div class="span8">	
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Libellé</th>
						<th>Suppression</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($row as $item):?>
					<tr class="info">
						<td><a href="<?php echo site_url("gestion/sous_rubrique");?>" ><?php echo $item->rub_lib;?></a></td>
						<td><a href="<?php echo site_url("gestion/efface_rubrique/?id=$item->rub_id") ?>">Supprimer</a></td>
					</tr>
			.	<?php endforeach; ?>  
				</tbody>
				<tfooter><?php echo $total.' résultat(s)'; ?></tfooter>
			</table>   
		</div>
	</div>
	 </form>
	
</div>
	<script type="text/javascript" src="<?php echo js_url('jquery-2.1.3.min'); ?>"></script>
	<script type="text/javascript" src="<?php echo js_url('bootstrap.min'); ?>"></script>
	<script type="text/javascript" src="<?php echo js_url('push.min'); ?>"></script>

	<script type="text/javascript">

	</script>
</body>			