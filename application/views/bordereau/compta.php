<!DOCTYPE HTML>
<html> 
<head>
<title><?php echo $titre?></title>
<meta charset="UTF-8" />
<meta name="Author" content="rija">

<link rel="stylesheet" type="text/css" href="<?php echo css_url('bootstrap.min')?>">
</head>
<body>

<div class="container">

	<div class="caption info"><h3>Service : <?php echo $service; ?>   Agence : <?php echo $agence; ?></h3></div>	
    <table class="table table-bordered table-striped table-condensed">
    <caption>
    <h4>Les bordereau en attente de validation par le comptable</h4>
    </caption>
    <thead>
        <tr>
            <th>Service</th>
            <th>Agence</th>
            <th>Nombre</th>
            <th>Liens</th>
        </tr>
    </thead>
     
    <tbody>
        <?php foreach($row as $item):?>
        <tr>
            <td><?php echo $item->service;?></td>
            <td><?php echo $item->agence;?></td>
            <td><?php echo $item->total;?></td>
            <td><a href="<?php echo site_url("bordereau/servicecompta/?s=$item->service&a=$item->agence") ?>">Voir</a></td>
        </tr>
        <?php endforeach; ?> 
    </tbody>
    </table>
</div>

</body> 

