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
    <!--<a href="<?php echo site_url("bordereau/jourarchive/?a=$a&b=$b&m=$m&an=$an")?>" class="btn btn-warning">retour</a>-->
  </div>
  <br/>
  
	<table>
  <caption>Commande n°<?php echo $id; ?> du fournisseur <?php echo $f?></caption>
  <thead>
    <tr>
      <th>Designation</th>
      <th>Quantité</th>
      <th>Prix</th>
      <th>Total</th>
    </tr>
  </thead>
  <tbody>
    <?php
function afficher_tableau1($tableau)  
    { 
    // tableau des resultats pour chaque commande
    foreach ($tableau as $cle=>$valeur)  
        { 
        // on crée la ligne pour chaque tableau
        echo '<tr>';  
        if(is_array($valeur))  
            { 
            // on affiche le 1er tableau  
            afficher_tableau2($valeur);  
            //   
            }       
        }
          
    }  
function afficher_tableau2($tableau)
{
  foreach ($tableau as $cle=>$valeur)
  {
    if(is_array($valeur))  
            { 
            // on affiche le 1er tableau  
            echo '<td>'.$cle.'</td>';
            affiche_tableau3($valeur);  
            //   
            }   
  }
}

function affiche_tableau3($tableau)
{
  foreach ($tableau as $cle=>$valeur)
  {
    if ($cle == 0) {
      echo '<td>'.$cle.'</td><td> </td><td>'.$valeur.'</td></tr>';    
    }else { 
      echo '<td>'.$cle.'</td><td>'.$valeur/$cle.'</td><td>'.$valeur.'</td></tr>';}
  }
}

?>

  <?php afficher_tableau1($row); ?>
     

  </tbody>
  <tfoot>
    <tr>
      <th colspan="3">TTC</th>
      <th><?php echo $ttc;?></th>
    </tr>
  </tfoot>
</table>

<?php 
//echo print_r($row); ?>

</div>
</body>
</html>