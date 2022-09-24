<!DOCTYPE HTML>
<html>
<head>
<title>BC par année</title>
<meta charset="UTF-8" />
<meta name="Author" content="rija">
<link rel="stylesheet" type="text/css" href="<?php echo css_url('tableau')?>">
</head>

<body>
  <div id="an">
    <form id="form" method="POST" action="<?php echo site_url("bordereau/trie")?>">
      <label>Trie par année</label>
      <select name="annee" onchange="document.getElementById('form').submit();"> <option value=""></option>
                            <option value="tous">tous</option>
                            <option value="2015">2015</option>
                            <option value="2016">2016</option>
                            <option value="2017">2017</option>
                            <option value="2018">2018</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
      </select>
    </form> 
  <div>
 
 <div id="wrapper">
  <h1>BC par année pour le service : <?php echo $service; ?>, agence: <?php echo $agence; ?> </h1>
  
  
  <table id="keywords" cellspacing="0" cellpadding="0">
    <thead>
      <tr>
        <th><span>Année</span></th>
        <th><span>Nbre de bordereaux</span></th>
        <th><span>Lien</span></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($row as $item):?>
      <tr>
        <td class="lalign"><?php echo $item->an;?></td>
        <td><?php echo $item->total;?></td>
        <td><a href="<?php echo site_url("bordereau/mois/?a=$agence&b=$service&an=$item->an") ?>">Voir</a></td>
      </tr>
      <?php endforeach; ?>      
    </tbody>
  </table>

 </div> 
</body>
</html>
