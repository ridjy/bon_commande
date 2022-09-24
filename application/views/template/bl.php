<!DOCTYPE HTML>
<html>
<head>
<title><?php echo $titre?></title>
<meta charset="UTF-8" />
<meta name="Author" content="rija">
<link rel="stylesheet" type="text/css" href="<?php echo css_url('cmd')?>">
<link rel="stylesheet" type="text/css" href="<?php echo css_url('bootstrap.min')?>">
<link rel="stylesheet" type="text/css" href="<?php echo css_url('bootstrap-responsive.min')?>">
</head>
<body>
<div >
  <br/>
  <div>
   <!-- <a href="<?php //echo site_url("bordereau/retour")?>" class="btn btn-warning">retour</a>  -->
  </div>
  <br/>
  
  <form method="POST" action="<?php echo site_url('bordereau/modif_bl'); ?>"> 
	<table>
  <caption>Commande n°<?php echo $id; ?> du fournisseur <?php echo $f?></caption>
  <input type="hidden" name="id" value="<?php echo $id; ?>">
  <thead>
    <tr>
      <th>Designation</th>
      <th>Quantité</th>
      <th>Prix</th>
      <th>Total</th>
    </tr>
  </thead> 

  <tbody>
    
    <?php $i=1; foreach ($row as $item) : ?>
     <tr>
      
      <td><?php $devise=$item->devise;echo $item->nom_cmd; ?></td>
      <input type="hidden" name="<?php echo $i;?>" value="<?php echo $item->id_budget;?>">
      <input type="hidden" name="s" value="<?php echo $b;?>">
      <input type="hidden" name="a" value="<?php echo $a;?>">
      <td><input type="int" style="width:60px" name="<?php echo $item->id_budget;?>" value="<?php echo $item->qte_cmd; ?>"> </td>
      <td><?php echo number_format($item->pu_cmd,0,',',' '); ?></td>
      <td><?php echo number_format($item->pu_cmd*$item->qte_cmd,0,',',' '); ?></td>
      
     </tr>
     <?php $i++; endforeach ?> 
     
   </form>
  </tbody>
  <tfoot>
    <tr>
      <th colspan="3">TTC</th>
      <th><?php echo number_format($ttc,0,',',' ').' '.$devise;?></th>
    </tr>
  </tfoot>
</table>

<?php 
//echo print_r($row); ?><br/>
<input type="submit" class="btn btn-warning" value="modifier">
</form>
</div>
</body>
</html>