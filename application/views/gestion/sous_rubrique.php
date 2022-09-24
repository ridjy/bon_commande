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
		
		<div class="span4">	
				<form method='POST' class="well" action="<?php echo site_url('gestion/valid_sous_rubrique') ?>" >
					<fieldset>
					<legend>Ajouter une sous-rubrique</legend>
					<label for="rub">Rubrique : </label>
					<div id ="parallele">
							<select name ="rub">
			                    <?php foreach($row as $item):?>
			                    <option name ="rub" value="<?php echo $item->rub_id; ?>"><?php echo $item->rub_lib; ?></option>
			                    <?php endforeach; ?>
                			</select> 
					</div>
					<label for="sous_rub">Sous rubriques : </label>
					<input type="text" name="sous_rub" value="<?php echo set_value('sous_rub'); ?>" /> <?php echo form_error('sous_rub'); ?><br/>
					<label for="montant">Montant : </label>
					<input type="text" name="montant" value="<?php echo set_value('montant'); ?>" /> <?php echo form_error('montant'); ?><br/>
					<input type="submit" class="btn btn-primary" value="Enregistrer" /> 
					
		
					</fieldset>
				</form>
				<a href="<?php echo site_url("gestion/rubrique/") ?>"><button class="btn btn-success" title="Gérer les rubriques">Rubriques</button></a>
		</div>
		<div class="span8">	
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Rubrique</th>
						<th>Sous rubrique</th>
						<th>Montant</th>
						<th>Suppression</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($res as $item):?>
					<tr class="info">
						<td><?php echo $item->rub_lib;?></td>
						<td><?php echo $item->sr_lib;?></td>
						<td><?php echo number_format($item->sr_montant,0,',',' ');?></td>
						<td><a href="<?php echo site_url("gestion/efface_sous_rubrique/?id=$item->sr_id") ?>">Supprimer</a></td>
					</tr>
			.	<?php endforeach; ?>  
				</tbody>
				<tfooter><?php echo $total.' résultat(s)'; ?></tfooter>
			</table>   
		</div>
	</div>
		
	</div>
		
	</div>
	<script type="text/javascript" src="<?php echo js_url('jquery-2.1.3.min'); ?>"></script>
	<script type="text/javascript" src="<?php echo js_url('bootstrap.min'); ?>"></script>
	<script type="text/javascript" src="<?php echo js_url('push.min'); ?>"></script>

	<script type="text/javascript">

	</script>
</body>

