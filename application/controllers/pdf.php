<?php
class Pdf extends CI_Controller
{
public function __construct()
{ 
	// Obligatoire
	parent::__construct();
	define('FPDF_FONTPATH','system/fonts');
	//define('FPDF_FONTPATH',$this->config->item('fonts_path'));
	//define('FPDF_FONTPATH','/var/www/commande/system/fonts');
	$this->load->library('fpdf');
    $this->load->model('pdf_model');
    $this->load->model('budget_model');
}

function Footer()
{
    // Positionnement à 1,5 cm du bas
    $this->fpdf->SetY(-15);
    // Police Arial italique 8
    $this->fpdf->SetFont('Arial','I',8);
    // Numéro de page
    $this->fpdf->Cell(0,10,'Page ',0,0,'C');
}

public function bordereau()
{

	//initialisation


	$date=getdate();
	//$date['year']
	$num=explode('0',$date['year']);



	if (isset($_POST['valid']))
	{
		$n = $this->pdf_model->numeroauto();
		$this->pdf_model->incrementer();
		switch ($n) {
	    case $n < 10:
	        $n=$num[1]."0000".$n;
	        break;
	    case $n < 100:
	        $n=$num[1]."000".$n;
	        break;
	    case $n < 1000:
	        $n=$num[1]."00".$n;
	        break;
	    case $n < 10000:
	        $n=$num[1]."0".$n;
	        break;
	    case $n < 100000:
	        $n=$num[1]."".$n;
	        break;    
		}
	}
	else if(isset($_POST['preview'])) {
		$n = 'BC TEST';
	}

	/*lieu de livraison*/
	/*$b=$this->input->post('lieu');
	
	switch ($b)
	{
		case 1 : $l1=1;$l2=0;$l3=0;$l4=0;$l5=0;$l6=0;$l7=0;$l8=0;$l9=0;$l10=0;$l11=0;$l12=0;break;
		case 2 : $l1=0;$l2=1;$l3=0;$l4=0;$l5=0;$l6=0;$l7=0;$l8=0;$l9=0;$l10=0;$l11=0;$l12=0;break;
		case 3 : $l1=0;$l2=0;$l3=1;$l4=0;$l5=0;$l6=0;$l7=0;$l8=0;$l9=0;$l10=0;$l11=0;$l12=0;break;
		case 4 : $l1=0;$l2=0;$l3=0;$l4=1;$l5=0;$l6=0;$l7=0;$l8=0;$l9=0;$l10=0;$l11=0;$l12=0;break;
		case 5 : $l1=0;$l2=0;$l3=0;$l4=0;$l5=1;$l6=0;$l7=0;$l8=0;$l9=0;$l10=0;$l11=0;$l12=0;break;
		case 6 : $l1=0;$l2=0;$l3=0;$l4=0;$l5=0;$l6=1;$l7=0;$l8=0;$l9=0;$l10=0;$l11=0;$l12=0;break;
		case 7 : $l1=0;$l2=0;$l3=0;$l4=0;$l5=0;$l6=0;$l7=1;$l8=0;$l9=0;$l10=0;$l11=0;$l12=0;break;
		case 8 : $l1=0;$l2=0;$l3=0;$l4=0;$l5=0;$l6=0;$l7=0;$l8=1;$l9=0;$l10=0;$l11=0;$l12=0;break;
		case 9 : $l1=0;$l2=0;$l3=0;$l4=0;$l5=0;$l6=0;$l7=0;$l8=0;$l9=1;$l10=0;$l11=0;$l12=0;break;
		case 10 : $l1=0;$l2=0;$l3=0;$l4=0;$l5=0;$l6=0;$l7=0;$l8=0;$l9=0;$l10=1;$l11=0;$l12=0;break;
		case 11 : $l1=0;$l2=0;$l3=0;$l4=0;$l5=0;$l6=0;$l7=0;$l8=0;$l9=0;$l10=0;$l11=1;$l12=0;break;
		case 12 : $l1=0;$l2=0;$l3=0;$l4=0;$l5=0;$l6=0;$l7=0;$l8=0;$l9=0;$l10=0;$l11=0;$l12=1;break;
	}
	*/

	//radio choix stock DAD charge
	$c=$this->input->post('radio1');
	switch ($c) {
		case 'A':
			$charge='4';$stock='';
			break;
		case 'B':
			$charge='';$stock='4';
			break;	
		default:
			$charge='';$stock='';
			break;
	}

	if($this->input->post('dac')==$date['year'])
	{
		$dac='';
	}else { $dac=$this->input->post('dac'); }


	$this->fpdf->Open();
	$this->fpdf->AddPage();
	
	//$this->fpdf->Image(img_url('logo.JPG'),140,7,55);
	$this->fpdf->Image(img_url('logo.jpg'),11,5,-100);
	
	$this->fpdf->SetXY(15,23);
	$this->fpdf->SetFont('helvetica','B',15);
	$this->fpdf->Cell(40,20,'BORDEREAU DE COMMANDE ');


	$this->fpdf->SetXY(130,30);
	$this->fpdf->SetFont('Times','',11);
	$this->fpdf->Cell(20,5,utf8_decode('N°'),'');
	$this->fpdf->SetFont('Times','B',11);
	$this->fpdf->Cell(25,5,$n,'B',0,'C');
	$this->fpdf->SetXY(130,35);
	$this->fpdf->SetFont('Times','',11);
	$this->fpdf->Cell(20,5,'Date','');
	$this->fpdf->SetFont('Times','B',11);
	$this->fpdf->cell(25,5,$date['mday'].'/'.$date['mon'].'/'.$date['year'],'B',0,'C');
 	$this->fpdf->SetXY(130,43);
 	$this->fpdf->SetFont('Times','',11);
 	$this->fpdf->Cell(20,5,'REF IRIS','');
 	$this->fpdf->Cell(25,5,$this->input->post('ref'),'B',0,'C');

 	//fournisseur
 	$this->fpdf->SetXY(15,43);
 	$this->fpdf->SetFont('Times','',11);
 	$this->fpdf->Cell(25,5,'Fournisseur : ','');
 	$this->fpdf->Cell(40,5,$this->input->post('fournisseur'),'B',0,'C');

 	//
 	$this->fpdf->SetXY(15,52);
 	$this->fpdf->SetFont('Times','B',9);
 	$this->fpdf->MultiCell(0,5,utf8_decode('Nous vous prions de Joindre les références de cette commande à la facture.'),'');
 	$this->fpdf->SetXY(15,56);
 	$this->fpdf->MultiCell(0,5,utf8_decode('D\'envoyer cette dernière au service tracking fournisseur du site destinataire en 2 exemplaires.'),'');
 	$this->fpdf->SetXY(15,60);
 	$this->fpdf->MultiCell(0,5,utf8_decode('Avec nos références fiscales complètes.'),'');

 	//tableau
 	$this->fpdf->SetXY(15,68);
 	$this->fpdf->SetFont('Times','B',10);
	$this->fpdf->Cell(25,6,'QUANTITE',1,0,'C');
	$this->fpdf->Cell(85,6,'DESIGNATION',1,0,'C'); 	
	$this->fpdf->Cell(35,6,'PU HT',1,0,'C');
	$this->fpdf->Cell(40,6,'TOTAL HT',1,0,'C');
	 
	//formatage txt
	//$pu1=number_format($this->input->post('pu1'),'2',',',' ');
	$pu1=floatval($this->input->post('pu1'));
	$pu1int=intval($this->input->post('pu1'));
	//si pareil donc pas de virgule
	if ($pu1==$pu1int) { 
		$affichepu1=number_format($pu1, 0, ',', ' ');
		$affichetot1=number_format($this->input->post('total1'), 0, ',', ' '); 
	} else if ($pu1int==0) {
		$affichepu1='';$affichetot1='';
	}
	else { 
		$affichepu1=number_format($pu1, 2, ',', ' ');
		$affichetot1=number_format($this->input->post('total1'), 2, ',', ' '); 
	}

	/***************les cmd**************/
	$this->fpdf->SetXY(15,74);	
	$this->fpdf->Cell(25,6,utf8_decode($this->input->post('q1')),1,0,'C');
	$this->fpdf->Cell(85,6,utf8_decode($this->input->post('nom1')),1,0,'L');
	$this->fpdf->Cell(35,6,$affichepu1,1,0,'C');
	$this->fpdf->Cell(40,6,$affichetot1,1,0,'C');

	//ajout budget
	$this->budget_model->ajout($this->input->post('nom1'),$this->input->post('pu1'),$this->input->post('total1'),$this->input->post('q1'),$this->input->post('rub1'),$n,$date,$this->input->post('serv'),$this->input->post('agen'),$this->input->post('devise'));

	$pu2=floatval($this->input->post('pu2'));
	$pu2int=intval($this->input->post('pu2'));
	//si pareil donc pas de virgule
	if ($pu2int==0) { 
		$affichepu2='';
		$affichetot2='';
	} else if ($pu2==$pu2int) {
		$affichepu2=number_format($pu2, 0, ',', ' '); 
		$affichetot2=number_format($this->input->post('total2'), 0, ',', ' '); 
	} else { $affichepu2=number_format($pu2, 2, ',', ' ');
	$affichetot2=number_format($this->input->post('total2'), 2, ',', ' ');  }
	
	$this->fpdf->SetXY(15,80);	
	$this->fpdf->Cell(25,6,utf8_decode($this->input->post('q2')),1,0,'C');
	$this->fpdf->Cell(85,6,utf8_decode($this->input->post('nom2')),1,0,'L');
	$this->fpdf->Cell(35,6,$affichepu2,1,0,'C');
	$this->fpdf->Cell(40,6,$affichetot2,1,0,'C');
	//
	if($this->input->post('nom2')!='')
	{
		$this->budget_model->ajout($this->input->post('nom2'),$this->input->post('pu2'),$this->input->post('total2'),$this->input->post('q2'),$this->input->post('rub2'),$n,$date,$this->input->post('serv'),$this->input->post('agen'),$this->input->post('devise'));
	}
	

	$pu3=floatval($this->input->post('pu3'));
	$pu3int=intval($this->input->post('pu3'));
	//si pareil donc pas de virgule
	if ($pu3int==0) { 
		$affichepu3='';
		$affichetot3='';
	} else if ($pu3==$pu3int) {
		$affichepu3=number_format($pu3, 0, ',', ' '); 
		$affichetot3=number_format((int)$this->input->post('total3'), 0, ',', ' '); 
	} else { $affichepu3=number_format($pu3, 2, ',', ' ');
	$affichetot3=number_format($this->input->post('total3'), 2, ',', ' ');  }
	$this->fpdf->SetXY(15,86);	
	$this->fpdf->Cell(25,6,utf8_decode($this->input->post('q3')),1,0,'C');
	$this->fpdf->Cell(85,6,utf8_decode($this->input->post('nom3')),1,0,'L');
	$this->fpdf->Cell(35,6,$affichepu3,1,0,'C');
	$this->fpdf->Cell(40,6,$affichetot3,1,0,'C');
	//
	if($this->input->post('nom3')!='')
	{
		$this->budget_model->ajout($this->input->post('nom3'),$this->input->post('pu3'),$this->input->post('total3'),$this->input->post('q3'),$this->input->post('rub3'),$n,$date,$this->input->post('serv'),$this->input->post('agen'),$this->input->post('devise'));
	}


	$pu4=floatval($this->input->post('pu4'));
	$pu4int=intval($this->input->post('pu4'));
	//si pareil donc pas de virgule
	if ($pu4int==0) { 
		$affichepu4='';
		$affichetot4='';
	} else if ($pu4==$pu4int ) {
		$affichepu4=number_format($pu4, 0, ',', ' '); 
		$affichetot4=number_format((int)$this->input->post('total4'), 0, ',', ' '); 
	} else { $affichepu4=number_format($pu4, 2, ',', ' ');
	$affichetot4=number_format($this->input->post('total4'), 2, ',', ' ');
	}
	$this->fpdf->SetXY(15,92);	
	$this->fpdf->Cell(25,6,utf8_decode($this->input->post('q4')),1,0,'C');
	$this->fpdf->Cell(85,6,utf8_decode($this->input->post('nom4')),1,0,'L');
	$this->fpdf->Cell(35,6,$affichepu4,1,0,'C');
	$this->fpdf->Cell(40,6,$affichetot4,1,0,'C');
	//
	if($this->input->post('nom4')!='')
	{
		$this->budget_model->ajout($this->input->post('nom4'),$this->input->post('pu4'),$this->input->post('total4'),$this->input->post('q4'),$this->input->post('rub4'),$n,$date,$this->input->post('serv'),$this->input->post('agen'),$this->input->post('devise'));
	}

	$pu5=floatval($this->input->post('pu5'));
	$pu5int=intval($this->input->post('pu5'));
	//si pareil donc pas de virgule
	if ($pu5int==0) {
		$affichepu5='';
		$affichetot5=''; 
	} else if ($pu5==$pu5int) {
		$affichepu5=number_format($pu5, 0, ',', ' '); 
		$affichetot5=number_format((int)$this->input->post('total5'), 0, ',', ' '); 
	} else { $affichepu5=number_format($pu5, 2, ',', ' ');
	$affichetot5=number_format($this->input->post('total5'), 2, ',', ' ');
	}
	$this->fpdf->SetXY(15,98);	
	$this->fpdf->Cell(25,6,utf8_decode($this->input->post('q5')),1,0,'C');
	$this->fpdf->Cell(85,6,utf8_decode($this->input->post('nom5')),1,0,'L');
	$this->fpdf->Cell(35,6,$affichepu5,1,0,'C');
	$this->fpdf->Cell(40,6,$affichetot5,1,0,'C');
	//
	if($this->input->post('nom5')!='')
	{
		$this->budget_model->ajout($this->input->post('nom5'),$this->input->post('pu5'),$this->input->post('total5'),$this->input->post('q5'),$this->input->post('rub5'),$n,$date,$this->input->post('serv'),$this->input->post('agen'),$this->input->post('devise'));
	}

	$pu6=floatval($this->input->post('pu6'));
	$pu6int=intval($this->input->post('pu6'));
	//si pareil donc pas de virgule
	if ($pu6int==0) { 
		$affichepu6='';
		$affichetot6='';
	} else if ($pu6==$pu6int) {
		$affichepu6=number_format($pu6, 0, ',', ' '); 
		$affichetot6=number_format((int)$this->input->post('total6'), 0, ',', ' '); 
	} else { $affichepu6=number_format($pu6, 2, ',', ' ');
	$affichetot6=number_format($this->input->post('total6'), 2, ',', ' ');
	}
	$this->fpdf->SetXY(15,104);	
	$this->fpdf->Cell(25,6,utf8_decode($this->input->post('q6')),1,0,'C');
	$this->fpdf->Cell(85,6,utf8_decode($this->input->post('nom6')),1,0,'L');
	$this->fpdf->Cell(35,6,$affichepu6,1,0,'C');
	$this->fpdf->Cell(40,6,$affichetot6,1,0,'C');
	//
	if($this->input->post('nom6')!='')
	{
		$this->budget_model->ajout($this->input->post('nom6'),$this->input->post('pu6'),$this->input->post('total6'),$this->input->post('q6'),$this->input->post('rub6'),$n,$date,$this->input->post('serv'),$this->input->post('agen'),$this->input->post('devise'));
	}

	$pu7=floatval($this->input->post('pu7'));
	$pu7int=intval($this->input->post('pu7'));
	//si pareil donc pas de virgule
	if ($pu7int==0) { 
		$affichepu7='';
		$affichetot7='';
	} else if ($pu7==$pu7int) {
		$affichepu7=number_format($pu7, 0, ',', ' '); 
		$affichetot7=number_format((int)$this->input->post('total7'), 0, ',', ' ');
	} else { $affichepu7=number_format($pu7, 2, ',', ' ');
	$affichetot7=number_format($this->input->post('total7'), 2, ',', ' ');
	}
	$this->fpdf->SetXY(15,110);	
	$this->fpdf->Cell(25,6,utf8_decode($this->input->post('q7')),1,0,'C');
	$this->fpdf->Cell(85,6,utf8_decode($this->input->post('nom7')),1,0,'L');
	$this->fpdf->Cell(35,6,$affichepu7,1,0,'C');
	$this->fpdf->Cell(40,6,$affichetot7,1,0,'C');
	//
	if($this->input->post('nom7')!='')
	{
		$this->budget_model->ajout($this->input->post('nom7'),$this->input->post('pu7'),$this->input->post('total7'),$this->input->post('q7'),$this->input->post('rub7'),$n,$date,$this->input->post('serv'),$this->input->post('agen'),$this->input->post('devise'));
	}

	$pu8=floatval($this->input->post('pu8'));
	$pu8int=intval($this->input->post('pu8'));
	//si pareil donc pas de virgule
	if ($pu8int==0) {
		$affichepu8='';
		$affichetot8=''; 
	} else if ($pu8==$pu8int) {
		$affichepu8=number_format($pu8, 0, ',', ' '); 
		$affichetot8=number_format((int)$this->input->post('total8'), 0, ',', ' '); 
	} else { $affichepu8=number_format($pu8, 2, ',', ' ');
	$affichetot8=number_format($this->input->post('total8'), 2, ',', ' ');
	}
	$this->fpdf->SetXY(15,116);	
	$this->fpdf->Cell(25,6,utf8_decode($this->input->post('q8')),1,0,'C');
	$this->fpdf->Cell(85,6,utf8_decode($this->input->post('nom8')),1,0,'L');
	$this->fpdf->Cell(35,6,$affichepu8,1,0,'C');
	$this->fpdf->Cell(40,6,$affichetot8,1,0,'C');
	//
	if($this->input->post('nom8')!='')
	{
		$this->budget_model->ajout($this->input->post('nom8'),$this->input->post('pu8'),$this->input->post('total8'),$this->input->post('q8'),$this->input->post('rub8'),$n,$date,$this->input->post('serv'),$this->input->post('agen'),$this->input->post('devise'));
	}

	$pu9=floatval($this->input->post('pu9'));
	$pu9int=intval($this->input->post('pu9'));
	//si pareil donc pas de virgule
	if ($pu9int==0) { 
		$affichepu9='';
		$affichetot9='';
	} else if ($pu9==$pu9int) {
		$affichepu9=number_format($pu9, 0, ',', ' '); 
		$affichetot9=number_format((int)$this->input->post('total9'), 0, ',', ' '); 
	} else { $affichepu9=number_format($pu9, 2, ',', ' ');
	$affichetot9=number_format($this->input->post('total9'), 2, ',', ' ');
	}
	$this->fpdf->SetXY(15,122);	
	$this->fpdf->Cell(25,6,utf8_decode($this->input->post('q9')),1,0,'C');
	$this->fpdf->Cell(85,6,utf8_decode($this->input->post('nom9')),1,0,'L');
	$this->fpdf->Cell(35,6,$affichepu9,1,0,'C');
	$this->fpdf->Cell(40,6,$affichetot9,1,0,'C');
	//
	if($this->input->post('nom9')!='')
	{
		$this->budget_model->ajout($this->input->post('nom9'),$this->input->post('pu9'),$this->input->post('total9'),$this->input->post('q9'),$this->input->post('rub9'),$n,$date,$this->input->post('serv'),$this->input->post('agen'),$this->input->post('devise'));
	}

	/*********************************fin cmd**************************************/

	//test valeur

	$t1 = empty($this->input->post('total1')) ? 0 : $this->input->post('total1');
	$t2 = empty($this->input->post('total2')) ? 0 : $this->input->post('total2');
	$t3 = empty($this->input->post('total3')) ? 0 : $this->input->post('total3');
	$t4 = empty($this->input->post('total4')) ? 0 : $this->input->post('total4');
	$t5 = empty($this->input->post('total5')) ? 0 : $this->input->post('total5');
	$t6 = empty($this->input->post('total6')) ? 0 : $this->input->post('total6');
	$t7 = empty($this->input->post('total7')) ? 0 : $this->input->post('total7');
	$t8 = empty($this->input->post('total8')) ? 0 : $this->input->post('total8');
	$t9 = empty($this->input->post('total9')) ? 0 : $this->input->post('total9');


	
	// $total=$this->input->post('total1')+$this->input->post('total2')+$this->input->post('total3')+$this->input->post('total4')+$this->input->post('total5')+$this->input->post('total6')+$this->input->post('total7')+$this->input->post('total8')+$this->input->post('total9');

	$total = $t1 + $t2 + $t3 + $t4 + $t5 + $t6 + $t7 + $t8 + $t9 ;
	
	
	//remise
	if ($this->input->post('remise') != '')
	{
		$montantremise=($total*$this->input->post('remise'))/100;
		$remise='Remise '.$this->input->post('remise').' %:' .' '.number_format($montantremise,2,',',' ');
		$total=$total-($total*$this->input->post('remise'))/100;
	} else { $remise=''; }
	//


	$this->fpdf->SetXY(15,128);	
	$this->fpdf->Cell(25,6,'',1,0,'C');
	$this->fpdf->Cell(45,6,$remise,'LTB',0,'L');
	$this->fpdf->Cell(40,6,utf8_decode('TOTAL (ou à reporter)'),'TRB',0,'R');
	$this->fpdf->Cell(35,6,'',1,0,'C');
	$this->fpdf->Cell(40,6,number_format($total, 2, ',', ' ').' '.$this->input->post('devise').' HT',1,0,'R');

	if ($this->input->post('tva') != '')
	{
		$ttc=$total; $tva=0;
	} else if($this->input->post('c1')=='0.2' || $this->input->post('c2')=='0.2' || $this->input->post('c3')=='0.2' || $this->input->post('c4')=='0.2' || $this->input->post('c5')=='0.2' || $this->input->post('c6')=='0.2' || $this->input->post('c7')=='0.2' || $this->input->post('c8')=='0.2' || $this->input->post('c9')=='0.2')
	{
		$tva= $this->input->post('total1')*$this->input->post('c1')+$this->input->post('total2')*$this->input->post('c2')+$this->input->post('total3')*$this->input->post('c3')+$this->input->post('total4')*$this->input->post('c4')+$this->input->post('total5')*$this->input->post('c5')+$this->input->post('total6')*$this->input->post('c6')+$this->input->post('total7')*$this->input->post('c7')+$this->input->post('total8')*$this->input->post('c8')+$this->input->post('total9')*$this->input->post('c9') ;
		$ttc=$total+$tva;	
	}
	else { $tva=($total*20)/100;
	$ttc=$total+$tva; }

	//$ttc= number_format($ttc, 2, ',', ' ');

	$this->fpdf->SetXY(90,134);
	$this->fpdf->Cell(35,6,'TVA',1,0,'R');
	$this->fpdf->Cell(35,6,number_format($tva, 2, ',', ' ').' '.$this->input->post('devise'),1,0,'C');
	$this->fpdf->Cell(40,6,number_format($ttc, 2, ',', ' ').' '.$this->input->post('devise').'   TTC',1,2,'R');
	$this->fpdf->Cell(40,6,'Signature',0,0,'L');	
	
	$this->fpdf->SetXY(15,156);
	$this->fpdf->SetFont('Times','B',8);
	$this->fpdf->Cell(20,3,'Lieu de livraison',0,2);
	$this->fpdf->SetFont('Times','',8);
	$this->fpdf->Cell(20,3,'Tanjombato',$this->input->post('Tanjombato'),2);
	$this->fpdf->Cell(20,3,'Ivato',$this->input->post('Ivato'),2);
	$this->fpdf->Cell(20,3,'Antanimena',$this->input->post('Antanimena'),2);

	$this->fpdf->SetXY(70,159);
	$this->fpdf->Cell(20,3,'Toamasina Log',$this->input->post('Toamasina'),2);
	$this->fpdf->Cell(20,3,'Tamatave',$this->input->post('Tamatave'),2);
	$this->fpdf->Cell(20,3,'Antsirabe',$this->input->post('Antsirabe'),2);

	$this->fpdf->SetXY(125,159);
	$this->fpdf->Cell(20,3,'Mahajanga',$this->input->post('Mahajanga'),2);
	$this->fpdf->Cell(20,3,'Tolagnaro',$this->input->post('Tolagnaro'),2);
	$this->fpdf->Cell(20,3,'Toliary',$this->input->post('Toliary'),2);

	$this->fpdf->SetXY(180,159);
	$this->fpdf->Cell(20,3,'Antsiranana',$this->input->post('Antsiranana'),2);
	$this->fpdf->Cell(20,3,'Nosy Be',$this->input->post('Nosy_Be'),2);
	$this->fpdf->Cell(20,3,utf8_decode('Vohémar'),$this->input->post('Vohemar'),2);
	
	$this->fpdf->SetXY(15,168);
	$this->fpdf->SetFont('Times','',7.5);
	$this->fpdf->Cell(20,3,utf8_decode('Bolloré Transport & Logistics Madagascar'),0,2);

	$this->fpdf->SetXY(15,171);
	$this->fpdf->SetFont('Times','',8.5);
	$this->fpdf->MultiCell(0,3,'R.C.S. 2001 B 00022 du 22/06/2001 - stat: 52297 31 1967 0 00002 du 19/3/2013 - N.I.F. : 0000020309 du 19/01/11',0);	

	$this->fpdf->SetXY(15,174);
	$this->fpdf->MultiCell(0,3,utf8_decode('Siège : Rue du Capitaine Schoël - Ampasimazava - B.P 411 TOAMASINA 501'),0);
	$this->fpdf->SetXY(15,177);
	$this->fpdf->MultiCell(0,3,utf8_decode('Tél : +261 20 22 461 09 - Fax : +261 20 22 478 62 '),0);
	$this->fpdf->SetXY(15,180);
	$this->fpdf->MultiCell(0,3,'E-mail: btl.madagascar@bollore.com / btl.tmm.madagascar@bollore.com',0);
	$this->fpdf->SetXY(15,183);
	$this->fpdf->MultiCell(0,3,utf8_decode('Agences : Antananarivo - Ivato - Antsirabe - Toamasina - Mahajanga - Antsiranana - Nosy Be - Toliary - Tolagnaro - Vohémar'),0);

	$this->fpdf->SetXY(15,187);
	$this->fpdf->SetFont('Times','',11);
	$this->fpdf->MultiCell(0,3,'---------------------------------------------------------------------------------------------------------------------------------------------',0);	

	$this->fpdf->SetXY(15,190);
	$this->fpdf->SetFont('Times','B',9);
	$this->fpdf->MultiCell(0,3,utf8_decode('Débours').': (les prises en charges directes par le client ne donnent pas lieu '.utf8_decode('à une commande sous notre en-tête)'),0);

	/*$this->fpdf->SetXY(25,196);
	$this->fpdf->Cell(10,5,'MG',0,0);
	$this->fpdf->Cell(35,5,$this->input->post('IMPUTATION'),'B',0);
	$this->fpdf->Cell(20,5,'XA  ',0,0,'R');
	$this->fpdf->Cell(35,5,$this->input->post('XT'),'B',0);
	$this->fpdf->SetFont('Times','',9);
	$this->fpdf->Cell(25,5,'418100 ',0,0,'R');
	$this->fpdf->Cell(35,5,$this->input->post('41'),'B',0);
 	*/

	$this->fpdf->SetLineWidth(0.5);
	$this->fpdf->Line(15,204,200,204);
	$this->fpdf->SetLineWidth(0);

	$this->fpdf->SetXY(15,207);
	$this->fpdf->SetFont('Times','B',9);
	$this->fpdf->Cell(10,5,'UM',0,0);
	$this->fpdf->Cell(35,5,$this->input->post('UM'),'B',0);
	
	$this->fpdf->Cell(55,5,'ou',0,0,'R');
	$this->fpdf->Cell(35,5,'DAC',0,0,'C');
	$this->fpdf->SetXY(139,207);
	$this->fpdf->SetFont('Times','B',10);
	$this->fpdf->Cell(5,5,$dac,0,0);

	$this->fpdf->SetLineWidth(0.5);
	$this->fpdf->Line(15,214.5,200,214.5);
	$this->fpdf->SetLineWidth(0);

	$this->fpdf->SetXY(15,216);
	$this->fpdf->SetFont('Times','B',9);
	$this->fpdf->Cell(10,5,'CHARGE',0,0);
	$this->fpdf->SetXY(55,216);
	$this->fpdf->SetFont('zapfdingbats','',19);
	$this->fpdf->Cell(5,5,$charge,1,0);

	$this->fpdf->SetXY(115,216);
	$this->fpdf->SetFont('Times','B',9);
	$this->fpdf->Cell(10,5,'STOCK',0,0);
	$this->fpdf->SetXY(165,216);
	$this->fpdf->SetFont('zapfdingbats','',19);
	$this->fpdf->Cell(5,5,$stock,1,0);


	$this->fpdf->SetLineWidth(0.5);
	$this->fpdf->Line(15,223,200,223);
	$this->fpdf->SetLineWidth(0);
	
	$this->fpdf->SetXY(15,228);
	$this->fpdf->SetFont('Times','B',8);
	$this->fpdf->Cell(25,4,'SITE',1,0,'C');
	$this->fpdf->Cell(80,4,'DEPARTEMENT',1,0,'C');
	$this->fpdf->Cell(80,4,'DELEGATIONS ET AUTRES',1,0,'C');
	
	$this->fpdf->SetXY(15,232);
	$this->fpdf->SetFont('Times','',8);
	$this->fpdf->Cell(17,4,'ABE','LTB',0,'R');
	$this->fpdf->SetFont('zapfdingbats','',12);
 	$this->fpdf->Cell(8,4,$this->input->post('abe'),'TRB',0,'C');
	$this->fpdf->SetFont('Times','',8);
	$this->fpdf->Cell(35,4,'SHIPPING','LTB',0,'C');
	$this->fpdf->Cell(10,4,'10A01','TB',0,'C');
	$this->fpdf->SetFont('zapfdingbats','',12);
 	$this->fpdf->Cell(5,4,$this->input->post('s1'),'TB',0,'C');

 	$this->fpdf->SetFont('Times','',8);
	$this->fpdf->Cell(10,4,'10B01','TB',0,'C');
	$this->fpdf->SetFont('zapfdingbats','',12);
 	$this->fpdf->Cell(5,4,$this->input->post('s2'),'TB',0,'C'); 
 	$this->fpdf->SetFont('Times','',8);
	$this->fpdf->Cell(10,4,'10T01','TB',0,'C');
	$this->fpdf->SetFont('zapfdingbats','',12);
 	$this->fpdf->Cell(5,4,$this->input->post('s3'),'TRB',0,'C'); 	

 	$this->fpdf->SetFont('Times','',8);
	$this->fpdf->Cell(40,4,'BLX BORDEREAU','LTB',0,'C');
	$this->fpdf->Cell(30,4,'MG 1605B2','TB',0,'C');
	$this->fpdf->SetFont('zapfdingbats','',12);
 	$this->fpdf->Cell(10,4,$this->input->post('bordeaux'),'TRB',0,'C');
 	$this->fpdf->SetFont('Times','',8);


	$this->fpdf->SetXY(15,236);
	$this->fpdf->Cell(17,4,'DIE','LTB',0,'R');
	$this->fpdf->SetFont('zapfdingbats','',12);
 	$this->fpdf->Cell(8,4,$this->input->post('die'),'TRB',0,'C');
 	$this->fpdf->SetFont('Times','',8);
	$this->fpdf->Cell(35,4,'CTM','LTB',0,'C');
	$this->fpdf->Cell(10,4,'20A01','TB',0,'C');
	$this->fpdf->SetFont('zapfdingbats','',12);
 	$this->fpdf->Cell(5,4,$this->input->post('ctm1'),'TB',0,'C');
 	$this->fpdf->SetFont('Times','',8);
	$this->fpdf->Cell(10,4,'20B01','TB',0,'C');
	$this->fpdf->SetFont('zapfdingbats','',12);
 	$this->fpdf->Cell(5,4,$this->input->post('ctm2'),'TB',0,'C');
 	$this->fpdf->SetFont('Times','',8);
	$this->fpdf->Cell(10,4,'20T01','TB',0,'C');
	$this->fpdf->SetFont('zapfdingbats','',12);
 	$this->fpdf->Cell(5,4,$this->input->post('ctm3'),'TRB',0,'C');


 	$this->fpdf->SetFont('Times','',8);
	$this->fpdf->Cell(40,4,'BLX ROUEN','LTB',0,'C');
	$this->fpdf->Cell(30,4,'MG 1605A5','TB',0,'C');
	$this->fpdf->SetFont('zapfdingbats','',12);
 	$this->fpdf->Cell(10,4,$this->input->post('rouen'),'TRB',0,'C');
 	$this->fpdf->SetFont('Times','',8);
	
	$this->fpdf->SetXY(15,240);
	$this->fpdf->Cell(17,4,'FTU','LTB',0,'R');
	$this->fpdf->SetFont('zapfdingbats','',12);
 	$this->fpdf->Cell(8,4,$this->input->post('ftu'),'TRB',0,'C');
 	$this->fpdf->SetFont('Times','',8);
	$this->fpdf->Cell(35,4,'CTA','LTB',0,'C');
	$this->fpdf->Cell(10,4,'30A01','TB',0,'C');
	$this->fpdf->SetFont('zapfdingbats','',12);
 	$this->fpdf->Cell(5,4,$this->input->post('cta1'),'TB',0,'C');

 	$this->fpdf->SetFont('Times','',8);
	$this->fpdf->Cell(10,4,'30B01','TB',0,'C');
	$this->fpdf->SetFont('zapfdingbats','',12);
 	$this->fpdf->Cell(5,4,$this->input->post('cta2'),'TB',0,'C');
	$this->fpdf->SetFont('Times','',8);
	$this->fpdf->Cell(10,4,'30A02','TB',0,'C');
	$this->fpdf->SetFont('zapfdingbats','',12);
 	$this->fpdf->Cell(5,4,$this->input->post('cta3'),'TRB',0,'C');

 	$this->fpdf->SetFont('Times','',8);
	$this->fpdf->Cell(40,4,'BLX PUTEAUX','LTB',0,'C');
	$this->fpdf->Cell(30,4,'MG 1605A1','TB',0,'C');
	$this->fpdf->SetFont('zapfdingbats','',12);
 	$this->fpdf->Cell(10,4,$this->input->post('puteaux'),'TRB',0,'C');
 	$this->fpdf->SetFont('Times','',8);

	$this->fpdf->SetXY(15,244);
	$this->fpdf->Cell(17,4,'IVT','LTB',0,'R');
	$this->fpdf->SetFont('zapfdingbats','',12);
 	$this->fpdf->Cell(8,4,$this->input->post('ivt'),'TRB',0,'C');
 	$this->fpdf->SetFont('Times','',8);
	$this->fpdf->Cell(35,4,'BASE LOGISTIQUE','LTB',0,'C');
	$this->fpdf->Cell(10,4,'15I00','TB',0,'C');
	$this->fpdf->SetFont('zapfdingbats','',12);
 	$this->fpdf->Cell(5,4,$this->input->post('base1'),'TB',0,'C');
 	$this->fpdf->SetFont('Times','',8);
	$this->fpdf->Cell(10,4,'20D01','TB',0,'C');
	$this->fpdf->SetFont('zapfdingbats','',12);
 	$this->fpdf->Cell(5,4,$this->input->post('base2'),'TB',0,'C');
 	$this->fpdf->Cell(15,4,'','TRB',0,'C');

 	$this->fpdf->SetFont('Times','',8);
	$this->fpdf->Cell(40,4,'BLX STRUCTURE','LTB',0,'C');
	$this->fpdf->Cell(30,4,'MG 770700','TB',0,'C');
	$this->fpdf->SetFont('zapfdingbats','',12);
 	$this->fpdf->Cell(10,4,$this->input->post('structure'),'TRB',0,'C');
 	$this->fpdf->SetFont('Times','',8);		

	$this->fpdf->SetXY(15,248);
	$this->fpdf->Cell(17,4,'MJN','LTB',0,'R');
	$this->fpdf->SetFont('zapfdingbats','',12);
 	$this->fpdf->Cell(8,4,$this->input->post('mjn'),'TRB',0,'C');
 	$this->fpdf->SetFont('Times','',8);
	$this->fpdf->Cell(35,4,'NSN','LTB',0,'C');
	$this->fpdf->Cell(10,4,'40D00','TB',0,'C');
	$this->fpdf->SetFont('zapfdingbats','',12);
 	$this->fpdf->Cell(5,4,$this->input->post('nsn'),'TB',0,'C');
 	$this->fpdf->Cell(30,4,'','TRB',0,'C');

 	$this->fpdf->SetFont('Times','',8);
	$this->fpdf->Cell(40,4,'BLX ROISSY CDG','LTB',0,'C');
	$this->fpdf->Cell(30,4,'NZ 003030','TB',0,'C');
	$this->fpdf->SetFont('zapfdingbats','',12);
 	$this->fpdf->Cell(10,4,$this->input->post('roissycdg'),'TRB',0,'C');
 	$this->fpdf->SetFont('Times','',8);		

	$this->fpdf->SetXY(15,252);
	$this->fpdf->Cell(17,4,'NSB','LTB',0,'R');
	$this->fpdf->SetFont('zapfdingbats','',12);
	$this->fpdf->Cell(8,4,$this->input->post('nsb'),'TRB',0,'C');
 	$this->fpdf->SetFont('Times','',8);
	$this->fpdf->Cell(35,4,'DG','LTB',0,'C');
	$this->fpdf->Cell(10,4,'70B01','TB',0,'C');
	$this->fpdf->SetFont('zapfdingbats','',12);
 	$this->fpdf->Cell(5,4,$this->input->post('dg'),'TB',0,'C');
 	$this->fpdf->Cell(30,4,'','TRB',0,'C');

 	$this->fpdf->SetFont('Times','',8);
	$this->fpdf->Cell(40,4,'BL INFORMATION','LTB',0,'C');
	$this->fpdf->Cell(30,4,'NZ 003030','TB',0,'C');
	$this->fpdf->SetFont('zapfdingbats','',12);
 	$this->fpdf->Cell(10,4,$this->input->post('blinfo'),'TRB',0,'C');
 	$this->fpdf->SetFont('Times','',8);

	$this->fpdf->SetXY(15,256);
	$this->fpdf->Cell(17,4,'TJB','LTB',0,'R');
	$this->fpdf->SetFont('zapfdingbats','',12);
	$this->fpdf->Cell(8,4,$this->input->post('tjb'),'TRB',0,'C');
 	$this->fpdf->SetFont('Times','',8);
	$this->fpdf->Cell(35,4,'AGENCE','LTB',0,'C');
	$this->fpdf->Cell(10,4,'70C01','TB',0,'C');
	$this->fpdf->SetFont('zapfdingbats','',12);
 	$this->fpdf->Cell(5,4,$this->input->post('agence1'),'TB',0,'C');
 	
 	$this->fpdf->SetFont('Times','',8);
 	$this->fpdf->Cell(10,4,'70C03','TB',0,'C');
	$this->fpdf->SetFont('zapfdingbats','',12);
 	$this->fpdf->Cell(5,4,$this->input->post('agence2'),'TB',0,'C');
 	$this->fpdf->SetFont('Times','',8);
 	$this->fpdf->Cell(10,4,'70C04','TB',0,'C');
	$this->fpdf->SetFont('zapfdingbats','',12);
 	$this->fpdf->Cell(5,4,$this->input->post('agence3'),'TRB',0,'C');
 	
 	$this->fpdf->SetFont('Times','',8);
	$this->fpdf->Cell(40,4,'BLUE STORAGE','LTB',0,'C');
	$this->fpdf->Cell(30,4,'NZ 003030','TB',0,'C');
	$this->fpdf->SetFont('zapfdingbats','',12);
 	$this->fpdf->Cell(10,4,$this->input->post('blstorage'),'TRB',0,'C');
 	$this->fpdf->SetFont('Times','',8);

	$this->fpdf->SetXY(15,260);
	$this->fpdf->Cell(17,4,'TMM','LTB',0,'R');
	$this->fpdf->SetFont('zapfdingbats','',12);
	$this->fpdf->Cell(8,4,$this->input->post('tmm'),'TRB',0,'C');
 	$this->fpdf->SetFont('Times','',8);
	$this->fpdf->Cell(35,4,'DF','LTB',0,'C');
	$this->fpdf->Cell(10,4,'70E01','TB',0,'C');
	$this->fpdf->SetFont('zapfdingbats','',12);
 	$this->fpdf->Cell(5,4,$this->input->post('df'),'TB',0,'C');
 	$this->fpdf->Cell(30,4,'','TRB',0,'C');

 	$this->fpdf->SetFont('Times','',8);
	$this->fpdf->Cell(80,4,'AUTRES ('.utf8_decode('à préciser').') :',1,0);	

	$this->fpdf->SetXY(15,264);
	$this->fpdf->Cell(17,4,'TUL','LTB',0,'R');
	$this->fpdf->SetFont('zapfdingbats','',12);
	$this->fpdf->Cell(8,4,$this->input->post('tul'),'TRB',0,'C');
 	$this->fpdf->SetFont('Times','',8);
	$this->fpdf->Cell(35,4,'INFORMATIQUE','LTB',0,'C');
	$this->fpdf->Cell(10,4,'70F01','TB',0,'C');
	$this->fpdf->SetFont('zapfdingbats','',12);
 	$this->fpdf->Cell(5,4,$this->input->post('info'),'TB',0,'C');
 	$this->fpdf->Cell(30,4,'','TRB',0,'C');
 	$this->fpdf->SetFont('Times','',8);
	$this->fpdf->Cell(80,4,$this->input->post('autre1'),1,0,'C');	

	$this->fpdf->SetXY(15,268);
	$this->fpdf->Cell(25,4,'',1,0,'C'); 
	$this->fpdf->Cell(35,4,'PERSONNEL','LTB',0,'C');
	$this->fpdf->Cell(10,4,'70G01','TB',0,'C');
	$this->fpdf->SetFont('zapfdingbats','',12);
 	$this->fpdf->Cell(5,4,$this->input->post('perso'),'TB',0,'C');
 	$this->fpdf->Cell(30,4,'','TRB',0,'C');
 	$this->fpdf->SetFont('Times','',8);
	$this->fpdf->Cell(80,4,$this->input->post('autre2'),1,0,'C');

	$this->fpdf->SetXY(15,272);
	$this->fpdf->Cell(25,4,'',1,0,'C');
	$this->fpdf->Cell(35,4,'COMMERCIAL','LTB',0,'C');
	$this->fpdf->Cell(10,4,'20T00','TB',0,'C');
	$this->fpdf->SetFont('zapfdingbats','',12);
 	$this->fpdf->Cell(5,4,$this->input->post('transit'),'TB',0,'C');
 	$this->fpdf->Cell(30,4,'','TRB',0,'C');
 	$this->fpdf->SetFont('Times','',8);
	$this->fpdf->Cell(80,4,$this->input->post('autre3'),1,0,'C');

	$this->fpdf->SetAutoPageBreak(0,1);

	$this->fpdf->SetXY(45,280);
	$this->fpdf->SetFont('Times','',10);
	$this->fpdf->Cell(120,4,'Bollore Transport & Logistics / BLX.MDG.ACH.F.0122 Bordereau de commande / V04 du 05/07/2016 ');
	
	$this->fpdf->Output();

	$etat='BC';
	$i=1;
	while ( $this->input->post("nom".$i) )
	{
	$data[] = array ( $this->input->post("nom".$i)  => array ( $this->input->post("q".$i) => $this->input->post("total".$i) )
                );
	$i++;
	}

	if (isset($_POST['valid']))
	{
		$this->pdf_model->ajout($n,$data,$this->input->post('agen'),$this->input->post('serv'),$this->input->post('fournisseur'),$this->input->post('ref'),$date,$ttc,$etat,$this->input->post('devise'));
	}
	
	unset($data);
} 

public function havas()
{
	$date=getdate();
	//$date['year']
	$num=explode('0',$date['year']);

	if (isset($_POST['valid']))
	{
		$n = $this->pdf_model->numeroauto();
		$this->pdf_model->incrementer();
		switch ($n) {
		    case $n < 10:
		        $n=$num[1]."0000".$n.'H';
		        break;
		    case $n < 100:
		        $n=$num[1]."000".$n.'H';
		        break;
		    case $n < 1000:
		        $n=$num[1]."00".$n.'H';
		        break;
		    case $n < 10000:
		        $n=$num[1]."0".$n.'H';
		        break;
		    case $n < 100000:
		        $n=$num[1]."".$n.'H';
		        break;    
			}
		}
		else if(isset($_POST['preview'])) {
			$n = 'TEST HAVAS';
		}
	
	/*lieu de livraison*/
	$b=$this->input->post('lieu');
	
	switch ($b)
	{
		case 1 : $l1=1;$l2=0;$l3=0;$l4=0;$l5=0;$l6=0;$l7=0;$l8=0;$l9=0;$l10=0;$l11=0;$l12=0;break;
		case 2 : $l1=0;$l2=1;$l3=0;$l4=0;$l5=0;$l6=0;$l7=0;$l8=0;$l9=0;$l10=0;$l11=0;$l12=0;break;
		case 3 : $l1=0;$l2=0;$l3=1;$l4=0;$l5=0;$l6=0;$l7=0;$l8=0;$l9=0;$l10=0;$l11=0;$l12=0;break;
		case 4 : $l1=0;$l2=0;$l3=0;$l4=1;$l5=0;$l6=0;$l7=0;$l8=0;$l9=0;$l10=0;$l11=0;$l12=0;break;
		case 5 : $l1=0;$l2=0;$l3=0;$l4=0;$l5=1;$l6=0;$l7=0;$l8=0;$l9=0;$l10=0;$l11=0;$l12=0;break;
		case 6 : $l1=0;$l2=0;$l3=0;$l4=0;$l5=0;$l6=1;$l7=0;$l8=0;$l9=0;$l10=0;$l11=0;$l12=0;break;
		case 7 : $l1=0;$l2=0;$l3=0;$l4=0;$l5=0;$l6=0;$l7=1;$l8=0;$l9=0;$l10=0;$l11=0;$l12=0;break;
		case 8 : $l1=0;$l2=0;$l3=0;$l4=0;$l5=0;$l6=0;$l7=0;$l8=1;$l9=0;$l10=0;$l11=0;$l12=0;break;
		case 9 : $l1=0;$l2=0;$l3=0;$l4=0;$l5=0;$l6=0;$l7=0;$l8=0;$l9=1;$l10=0;$l11=0;$l12=0;break;
		case 10 : $l1=0;$l2=0;$l3=0;$l4=0;$l5=0;$l6=0;$l7=0;$l8=0;$l9=0;$l10=1;$l11=0;$l12=0;break;
		case 11 : $l1=0;$l2=0;$l3=0;$l4=0;$l5=0;$l6=0;$l7=0;$l8=0;$l9=0;$l10=0;$l11=1;$l12=0;break;
		case 12 : $l1=0;$l2=0;$l3=0;$l4=0;$l5=0;$l6=0;$l7=0;$l8=0;$l9=0;$l10=0;$l11=0;$l12=1;break;
	}
	//
	//$this->fpdf->Image(img_url('coche.png'),105,23,5)
	//radio choix stock DAD charge
	$c=$this->input->post('radio1');
	switch ($c) {
		case 'A':
			$charge='4';$stock='';
			break;
		case 'B':
			$charge='';$stock='4';
			break;	
		default:
			$charge='';$stock='';
			break;
	}

	if($this->input->post('dac')==$date['year'])
	{
		$dac='';
	}else { $dac=$this->input->post('dac'); }


	$this->fpdf->Open();
	$this->fpdf->AddPage();
	
	//$this->fpdf->Image(img_url('logo.JPG'),140,7,55);
	$this->fpdf->Image(img_url('havas.JPG'),16,5,-100);
	
	$this->fpdf->SetXY(15,23);
	$this->fpdf->SetFont('helvetica','B',15);
	$this->fpdf->Cell(40,20,'BORDERAU DE COMMANDE');


	$this->fpdf->SetXY(130,30);
	$this->fpdf->SetFont('Times','',11);
	$this->fpdf->Cell(20,5,utf8_decode('N°'),'');
	$this->fpdf->SetFont('Times','B',11);
	$this->fpdf->Cell(25,5,$n,'B',0,'C');
	$this->fpdf->SetXY(130,35);
	$this->fpdf->SetFont('Times','',11);
	$this->fpdf->Cell(20,5,'Date','');
	$this->fpdf->SetFont('Times','B',11);
	$this->fpdf->cell(25,5,$date['mday'].'/'.$date['mon'].'/'.$date['year'],'B',0,'C');
 	$this->fpdf->SetXY(130,43);
 	$this->fpdf->SetFont('Times','',11);
 	$this->fpdf->Cell(20,5,'REF IRIS','');
 	$this->fpdf->Cell(25,5,$this->input->post('ref'),'B',0,'C');

 	//fournisseur
 	$this->fpdf->SetXY(15,43);
 	$this->fpdf->SetFont('Times','',11);
 	$this->fpdf->Cell(25,5,'Fournisseur : ','');
 	$this->fpdf->Cell(40,5,$this->input->post('fournisseur'),'B',0,'C');

 	//
 	$this->fpdf->SetXY(15,52);
 	$this->fpdf->SetFont('Times','B',9);
 	$this->fpdf->MultiCell(0,5,utf8_decode('Nous vous prions de Joindre les références de cette commande à la facture.'),'');
 	$this->fpdf->SetXY(15,56);
 	$this->fpdf->MultiCell(0,5,utf8_decode('D\'envoyer cette dernière au service tracking fournisseur du site destinataire en 2 exemplaires.'),'');
 	$this->fpdf->SetXY(15,60);
 	$this->fpdf->MultiCell(0,5,utf8_decode('Avec nos références fiscales complètes.'),'');

 	//tableau
 	$this->fpdf->SetXY(15,68);
 	$this->fpdf->SetFont('Times','B',10);
	$this->fpdf->Cell(25,6,'QUANTITE',1,0,'C');
	$this->fpdf->Cell(85,6,'DESIGNATION',1,0,'C'); 	
	$this->fpdf->Cell(35,6,'PU HT',1,0,'C');
	$this->fpdf->Cell(40,6,'TOTAL HT',1,0,'C');
	 

	$this->fpdf->SetXY(15,74);	
	$pu1=floatval($this->input->post('pu1'));
	$pu1int=intval($this->input->post('pu1'));
	//si pareil donc pas de virgule
	if ($pu1int==0) { 
		$affichepu1='';
		$affichetot1='';
	} else if ($pu1==$pu1int) {
		$affichepu1=number_format($pu1, 0, ',', ' '); 
		$affichetot1=number_format((int)$this->input->post('total1'), 0, ',', ' ');
	} else { $affichepu1=number_format($pu1, 2, ',', ' ');
	$affichetot1=number_format($this->input->post('total1'), 2, ',', ' ');
	}
	$this->fpdf->Cell(25,6,utf8_decode($this->input->post('q1')),1,0,'C');
	$this->fpdf->Cell(85,6,utf8_decode($this->input->post('nom1')),1,0,'L');
	$this->fpdf->Cell(35,6,$affichepu1,1,0,'C');
	$this->fpdf->Cell(40,6,$affichetot1,1,0,'C');
	//

	$this->fpdf->SetXY(15,80);	
	$pu2=floatval($this->input->post('pu2'));
	$pu2int=intval($this->input->post('pu2'));
	//si pareil donc pas de virgule
	if ($pu2int==0) { 
		$affichepu2='';
		$affichetot2='';
	} else if ($pu2==$pu2int) {
		$affichepu2=number_format($pu2, 0, ',', ' '); 
		$affichetot2=number_format((int)$this->input->post('total2'), 0, ',', ' ');
	} else { $affichepu2=number_format($pu2, 2, ',', ' ');
	$affichetot2=number_format($this->input->post('total2'), 2, ',', ' ');
	}
	$this->fpdf->Cell(25,6,utf8_decode($this->input->post('q2')),1,0,'C');
	$this->fpdf->Cell(85,6,utf8_decode($this->input->post('nom2')),1,0,'L');
	$this->fpdf->Cell(35,6,$affichepu2,1,0,'C');
	$this->fpdf->Cell(40,6,$affichetot2,1,0,'C');
	//
	
	$this->fpdf->SetXY(15,86);	
	$pu3=floatval($this->input->post('pu3'));
	$pu3int=intval($this->input->post('pu3'));
	//si pareil donc pas de virgule
	if ($pu3int==0) { 
		$affichepu3='';
		$affichetot3='';
	} else if ($pu3==$pu3int) {
		$affichepu3=number_format($pu3, 0, ',', ' '); 
		$affichetot3=number_format((int)$this->input->post('total3'), 0, ',', ' ');
	} else { $affichepu3=number_format($pu3, 2, ',', ' ');
	$affichetot3=number_format($this->input->post('total3'), 2, ',', ' ');
	}	
	$this->fpdf->Cell(25,6,utf8_decode($this->input->post('q3')),1,0,'C');
	$this->fpdf->Cell(85,6,utf8_decode($this->input->post('nom3')),1,0,'L');
	$this->fpdf->Cell(35,6,$affichepu3,1,0,'C');
	$this->fpdf->Cell(40,6,$affichetot3,1,0,'C');
	//

	$this->fpdf->SetXY(15,92);	$pu4=floatval($this->input->post('pu4'));
	$pu4int=intval($this->input->post('pu4'));
	//si pareil donc pas de virgule
	if ($pu4int==0) { 
		$affichepu4='';
		$affichetot4='';
	} else if ($pu4==$pu4int) {
		$affichepu4=number_format($pu4, 0, ',', ' '); 
		$affichetot4=number_format((int)$this->input->post('total4'), 0, ',', ' ');
	} else { $affichepu4=number_format($pu4, 2, ',', ' ');
	$affichetot4=number_format($this->input->post('total4'), 2, ',', ' ');
	}
	$this->fpdf->Cell(25,6,utf8_decode($this->input->post('q4')),1,0,'C');
	$this->fpdf->Cell(85,6,utf8_decode($this->input->post('nom4')),1,0,'L');
	$this->fpdf->Cell(35,6,$affichepu4,1,0,'C');
	$this->fpdf->Cell(40,6,$affichetot4,1,0,'C');
	//

	$this->fpdf->SetXY(15,98);	$pu5=floatval($this->input->post('pu5'));
	$pu5int=intval($this->input->post('pu5'));
	//si pareil donc pas de virgule
	if ($pu5int==0) { 
		$affichepu5='';
		$affichetot5='';
	} else if ($pu5==$pu5int) {
		$affichepu5=number_format($pu5, 0, ',', ' '); 
		$affichetot5=number_format((int)$this->input->post('total5'), 0, ',', ' ');
	} else { $affichepu5=number_format($pu5, 2, ',', ' ');
	$affichetot5=number_format($this->input->post('total5'), 2, ',', ' ');
	}
	$this->fpdf->Cell(25,6,utf8_decode($this->input->post('q5')),1,0,'C');
	$this->fpdf->Cell(85,6,utf8_decode($this->input->post('nom5')),1,0,'L');
	$this->fpdf->Cell(35,6,$affichepu5,1,0,'C');
	$this->fpdf->Cell(40,6,$affichetot5,1,0,'C');
	//

	$this->fpdf->SetXY(15,104);	$pu6=floatval($this->input->post('pu6'));
	$pu6int=intval($this->input->post('pu6'));
	//si pareil donc pas de virgule
	if ($pu6int==0) { 
		$affichepu6='';
		$affichetot6='';
	} else if ($pu6==$pu6int) {
		$affichepu6=number_format($pu6, 0, ',', ' '); 
		$affichetot6=number_format((int)$this->input->post('total6'), 0, ',', ' ');
	} else { $affichepu6=number_format($pu6, 2, ',', ' ');
	$affichetot6=number_format($this->input->post('total6'), 2, ',', ' ');
	}
	$this->fpdf->Cell(25,6,utf8_decode($this->input->post('q6')),1,0,'C');
	$this->fpdf->Cell(85,6,utf8_decode($this->input->post('nom6')),1,0,'L');
	$this->fpdf->Cell(35,6,$affichepu6,1,0,'C');
	$this->fpdf->Cell(40,6,$affichetot6,1,0,'C');
	//
	
	$this->fpdf->SetXY(15,110);	
	$pu7=floatval($this->input->post('pu7'));
	$pu7int=intval($this->input->post('pu7'));
	//si pareil donc pas de virgule
	if ($pu7int==0) { 
		$affichepu7='';
		$affichetot7='';
	} else if ($pu7==$pu7int) {
		$affichepu7=number_format($pu7, 0, ',', ' '); 
		$affichetot7=number_format((int)$this->input->post('total7'), 0, ',', ' ');
	} else { $affichepu7=number_format($pu7, 2, ',', ' ');
	$affichetot7=number_format($this->input->post('total7'), 2, ',', ' ');
	}
	$this->fpdf->Cell(25,6,utf8_decode($this->input->post('q7')),1,0,'C');
	$this->fpdf->Cell(85,6,utf8_decode($this->input->post('nom7')),1,0,'L');
	$this->fpdf->Cell(35,6,$affichepu7,1,0,'C');
	$this->fpdf->Cell(40,6,$affichetot7,1,0,'C');
	//
	
	$this->fpdf->SetXY(15,116);	
	$pu8=floatval($this->input->post('pu8'));
	$pu8int=intval($this->input->post('pu8'));
	//si pareil donc pas de virgule
	if ($pu8int==0) {
		$affichepu8='';
		$affichetot8=''; 
	} else if ($pu8==$pu8int) {
		$affichepu8=number_format($pu8, 0, ',', ' '); 
		$affichetot8=number_format((int)$this->input->post('total8'), 0, ',', ' '); 
	} else { $affichepu8=number_format($pu8, 2, ',', ' ');
	$affichetot8=number_format($this->input->post('total8'), 2, ',', ' ');
	}
	$this->fpdf->Cell(25,6,utf8_decode($this->input->post('q8')),1,0,'C');
	$this->fpdf->Cell(85,6,utf8_decode($this->input->post('nom8')),1,0,'L');
	$this->fpdf->Cell(35,6,$affichepu8,1,0,'C');
	$this->fpdf->Cell(40,6,$affichetot8,1,0,'C');
	//

	$this->fpdf->SetXY(15,122);	
	$pu9=floatval($this->input->post('pu9'));
	$pu9int=intval($this->input->post('pu9'));
	//si pareil donc pas de virgule
	if ($pu9int==0) { 
		$affichepu9='';
		$affichetot9='';
	} else if ($pu9==$pu9int) {
		$affichepu9=number_format($pu9, 0, ',', ' '); 
		$affichetot9=number_format((int)$this->input->post('total9'), 0, ',', ' '); 
	} else { $affichepu9=number_format($pu9, 2, ',', ' ');
	$affichetot9=number_format($this->input->post('total9'), 2, ',', ' ');
	}
	$this->fpdf->Cell(25,6,utf8_decode($this->input->post('q9')),1,0,'C');
	$this->fpdf->Cell(85,6,utf8_decode($this->input->post('nom9')),1,0,'L');
	$this->fpdf->Cell(35,6,$affichepu9,1,0,'C');
	$this->fpdf->Cell(40,6,$affichetot9,1,0,'C');
	//

	$this->fpdf->SetXY(15,128);	
	$pu10=floatval($this->input->post('pu10'));
	$pu10int=intval($this->input->post('pu10'));
	//si pareil donc pas de virgule
	if ($pu10int==0) { 
		$affichepu10='';
		$affichetot10='';
	} else if ($pu10==$pu10int) {
		$affichepu10=number_format($pu10, 0, ',', ' '); 
		$affichetot10=number_format((int)$this->input->post('total10'), 0, ',', ' '); 
	} else { $affichepu10=number_format($pu10, 2, ',', ' ');
	$affichetot10=number_format($this->input->post('total10'), 2, ',', ' ');
	}
	$this->fpdf->Cell(25,6,utf8_decode($this->input->post('q10')),1,0,'C');
	$this->fpdf->Cell(85,6,utf8_decode($this->input->post('nom10')),1,0,'L');
	$this->fpdf->Cell(35,6,$affichepu10,1,0,'C');
	$this->fpdf->Cell(40,6,$affichetot10,1,0,'C');
	//

	$this->fpdf->SetXY(15,134);	
	$pu11=floatval($this->input->post('pu11'));
	$pu11int=intval($this->input->post('pu11'));
	//si pareil donc pas de virgule
	if ($pu11int==0) { 
		$affichepu11='';
		$affichetot11='';
	} else if ($pu11==$pu11int) {
		$affichepu11=number_format($pu11, 0, ',', ' '); 
		$affichetot11=number_format((int)$this->input->post('total11'), 0, ',', ' '); 
	} else { $affichepu11=number_format($pu11, 2, ',', ' ');
	$affichetot11=number_format($this->input->post('total11'), 2, ',', ' ');
	}
	$this->fpdf->Cell(25,6,utf8_decode($this->input->post('q11')),1,0,'C');
	$this->fpdf->Cell(85,6,utf8_decode($this->input->post('nom11')),1,0,'L');
	$this->fpdf->Cell(35,6,$affichepu11,1,0,'C');
	$this->fpdf->Cell(40,6,$affichetot11,1,0,'C');
	//


	$this->fpdf->SetXY(15,140);	
	$pu12=floatval($this->input->post('pu12'));
	$pu12int=intval($this->input->post('pu12'));
	//si pareil donc pas de virgule
	if ($pu12int==0) { 
		$affichepu12='';
		$affichetot12='';
	} else if ($pu12==$pu12int) {
		$affichepu12=number_format($pu12, 0, ',', ' '); 
		$affichetot12=number_format((int)$this->input->post('total12'), 0, ',', ' '); 
	} else { $affichepu12=number_format($pu12, 2, ',', ' ');
	$affichetot12=number_format($this->input->post('total12'), 2, ',', ' ');
	}	
	$this->fpdf->Cell(25,6,utf8_decode($this->input->post('q12')),1,0,'C');
	$this->fpdf->Cell(85,6,utf8_decode($this->input->post('nom12')),1,0,'L');
	$this->fpdf->Cell(35,6,$affichepu12,1,0,'C');
	$this->fpdf->Cell(40,6,$affichetot12,1,0,'C');
	//


	$this->fpdf->SetXY(15,146);	
	$pu13=floatval($this->input->post('pu13'));
	$pu13int=intval($this->input->post('pu13'));
	//si pareil donc pas de virgule
	if ($pu13int==0) { 
		$affichepu13='';
		$affichetot13='';
	} else if ($pu13==$pu13int) {
		$affichepu13=number_format($pu13, 0, ',', ' '); 
		$affichetot13=number_format((int)$this->input->post('total13'), 0, ',', ' '); 
	} else { $affichepu13=number_format($pu13, 2, ',', ' ');
	$affichetot13=number_format($this->input->post('total13'), 2, ',', ' ');
	}
	$this->fpdf->Cell(25,6,utf8_decode($this->input->post('q13')),1,0,'C');
	$this->fpdf->Cell(85,6,utf8_decode($this->input->post('nom13')),1,0,'L');
	$this->fpdf->Cell(35,6,$affichepu13,1,0,'C');
	$this->fpdf->Cell(40,6,$affichetot13,1,0,'C');
	//

	$this->fpdf->SetXY(15,152);	
	$pu14=floatval($this->input->post('pu14'));
	$pu14int=intval($this->input->post('pu14'));
	//si pareil donc pas de virgule
	if ($pu14int==0) { 
		$affichepu14='';
		$affichetot14='';
	} else if ($pu14==$pu14int) {
		$affichepu14=number_format($pu14, 0, ',', ' '); 
		$affichetot14=number_format((int)$this->input->post('total14'), 0, ',', ' '); 
	} else { $affichepu14=number_format($pu14, 2, ',', ' ');
	$affichetot14=number_format($this->input->post('total14'), 2, ',', ' ');
	}
	$this->fpdf->Cell(25,6,utf8_decode($this->input->post('q14')),1,0,'C');
	$this->fpdf->Cell(85,6,utf8_decode($this->input->post('nom14')),1,0,'L');
	$this->fpdf->Cell(35,6,$affichepu14,1,0,'C');
	$this->fpdf->Cell(40,6,$affichetot14,1,0,'C');
	//


	$this->fpdf->SetXY(15,158);	
	$pu15=floatval($this->input->post('pu15'));
	$pu15int=intval($this->input->post('pu15'));
	//si pareil donc pas de virgule
	if ($pu15int==0) { 
		$affichepu15='';
		$affichetot15='';
	} else if ($pu15==$pu15int) {
		$affichepu15=number_format($pu15, 0, ',', ' '); 
		$affichetot15=number_format((int)$this->input->post('total15'), 0, ',', ' '); 
	} else { $affichepu15=number_format($pu15, 2, ',', ' ');
	$affichetot15=number_format($this->input->post('total15'), 2, ',', ' ');
	}
	$this->fpdf->Cell(25,6,utf8_decode($this->input->post('q15')),1,0,'C');
	$this->fpdf->Cell(85,6,utf8_decode($this->input->post('nom15')),1,0,'L');
	$this->fpdf->Cell(35,6,$affichepu15,1,0,'C');
	$this->fpdf->Cell(40,6,$affichetot15,1,0,'C');
	//

	$this->fpdf->SetXY(15,164);	
	$pu16=floatval($this->input->post('pu16'));
	$pu16int=intval($this->input->post('pu16'));
	//si pareil donc pas de virgule
	if ($pu16int==0) { 
		$affichepu16='';
		$affichetot16='';
	} else if ($pu16==$pu16int) {
		$affichepu16=number_format($pu16, 0, ',', ' '); 
		$affichetot16=number_format((int)$this->input->post('total16'), 0, ',', ' '); 
	} else { $affichepu16=number_format($pu16, 2, ',', ' ');
	$affichetot16=number_format($this->input->post('total16'), 2, ',', ' ');
	}
	$this->fpdf->Cell(25,6,utf8_decode($this->input->post('q16')),1,0,'C');
	$this->fpdf->Cell(85,6,utf8_decode($this->input->post('nom16')),1,0,'L');
	$this->fpdf->Cell(35,6,$affichepu16,1,0,'C');
	$this->fpdf->Cell(40,6,$affichetot16,1,0,'C');
	//

	$total=$this->input->post('total1')+$this->input->post('total2')+$this->input->post('total3')+$this->input->post('total4')+$this->input->post('total5')+$this->input->post('total6')+$this->input->post('total7')+$this->input->post('total8')+$this->input->post('total9')+$this->input->post('total10')+$this->input->post('total11')+$this->input->post('total12')+$this->input->post('total13')+$this->input->post('total14')+$this->input->post('total15')+$this->input->post('total16');
	//remise
	if ($this->input->post('remise') != '')
	{
		$remise='Remise '.$this->input->post('remise').' %:' .' '.($total*$this->input->post('remise'))/100;
		$total=$total-($total*$this->input->post('remise'))/100;
	} else { $remise=''; }
	//


	$this->fpdf->SetXY(15,170);	
	$this->fpdf->Cell(25,6,'',1,0,'C');
	$this->fpdf->Cell(45,6,$remise,'LTB',0,'L');
	$this->fpdf->Cell(40,6,utf8_decode('TOTAL (ou à reporter)'),'TRB',0,'R');
	$this->fpdf->Cell(35,6,'',1,0,'C');
	$this->fpdf->Cell(40,6,number_format($total, 2, ',', ' ').' '.$this->input->post('devise').' HT',1,0,'R');

	if ($this->input->post('tva') != '')
	{
		$ttc=$total; $tva=0;
	} else if($this->input->post('c1')=='0.2' || $this->input->post('c2')=='0.2' || $this->input->post('c3')=='0.2' || $this->input->post('c4')=='0.2' || $this->input->post('c5')=='0.2' || $this->input->post('c6')=='0.2' || $this->input->post('c7')=='0.2' || $this->input->post('c8')=='0.2' || $this->input->post('c9')=='0.2' || $this->input->post('c10')=='0.2' || $this->input->post('c11')=='0.2' || $this->input->post('c12')=='0.2' || $this->input->post('c13')=='0.2' || $this->input->post('c14')=='0.2' || $this->input->post('c15')=='0.2' || $this->input->post('c15')=='0.2')
	{
		$tva= $this->input->post('total1')*$this->input->post('c1')+$this->input->post('total2')*$this->input->post('c2')+$this->input->post('total3')*$this->input->post('c3')+$this->input->post('total4')*$this->input->post('c4')+$this->input->post('total5')*$this->input->post('c5')+$this->input->post('total6')*$this->input->post('c6')+$this->input->post('total7')*$this->input->post('c7')+$this->input->post('total8')*$this->input->post('c8')+$this->input->post('total9')*$this->input->post('c9')+$this->input->post('total10')*$this->input->post('c10')+$this->input->post('total11')*$this->input->post('c11')+$this->input->post('total12')*$this->input->post('c12')+$this->input->post('total13')*$this->input->post('c13')+$this->input->post('total14')*$this->input->post('c14')+$this->input->post('total15')*$this->input->post('c15')+$this->input->post('total16')*$this->input->post('c16') ;
		$ttc=$total+$tva;	
	}
	else { $tva=($total*20)/100;
	$ttc=$total+$tva; }

	//$ttc= number_format($ttc, 2, ',', ' ');

	$this->fpdf->SetXY(90,176);
	$this->fpdf->Cell(35,6,'TVA',1,0,'R');
	$this->fpdf->Cell(35,6,number_format($tva, 2, ',', ' ').' '.$this->input->post('devise'),1,0,'C');
	$this->fpdf->Cell(40,6,number_format($ttc, 2, ',', ' ').' '.$this->input->post('devise').'   TTC',1,2,'R');
	$this->fpdf->Cell(40,6,'Signature',0,0,'L');

	$this->fpdf->SetXY(15,210);
	$this->fpdf->SetFont('Times','B',9);
	$this->fpdf->Cell(20,3,'Lieu de livraison',0,2);
	$this->fpdf->SetFont('Times','',9);
	$this->fpdf->Cell(20,3,'Tanjombato',$l1,2);
	$this->fpdf->Cell(20,3,'Ivato',$l2,2);
	$this->fpdf->Cell(20,3,'Antanimena',$l3,2);

	$this->fpdf->SetXY(70,214);
	$this->fpdf->Cell(20,3,'Toamasina Log',$l4,2);
	$this->fpdf->Cell(20,3,'Tamatave',$l5,2);
	$this->fpdf->Cell(20,3,'Antsirabe',$l6,2);

	$this->fpdf->SetXY(125,214);
	$this->fpdf->Cell(20,3,'Mahajanga',$l7,2);
	$this->fpdf->Cell(20,3,'Tolagnaro',$l8,2);
	$this->fpdf->Cell(20,3,'Toliary',$l9,2);

	$this->fpdf->SetXY(180,214);
	$this->fpdf->Cell(20,3,'Antsiranana',$l10,2);
	$this->fpdf->Cell(20,3,'Nosy Be',$l11,2);
	$this->fpdf->Cell(20,3,utf8_decode('Vohémar'),$l12,2);


	$this->fpdf->SetXY(15,228);
	$this->fpdf->Cell(15,5,'IMPUTATION',0,0);
	$this->fpdf->SetXY(40,228);
	$this->fpdf->Cell(25,5,$this->input->post('imputation'),'B',0,'C');
	/*$this->fpdf->Cell(20,5,$this->input->post('imputation'),0,0,'R');
	$this->fpdf->Cell(35,5,'','B',0);
	$this->fpdf->SetFont('Times','',9);
	$this->fpdf->Cell(25,5,'418100 ',0,0,'R');
	$this->fpdf->Cell(35,5,'','B',0);
	*/	
	$this->fpdf->SetXY(15,240);
	$this->fpdf->SetFont('Times','b',9.5);
	$this->fpdf->Cell(20,3,utf8_decode('HAVAS Madagascar'),0,2);

	$this->fpdf->SetXY(15,246);
	$this->fpdf->SetFont('Times','',9);
	$this->fpdf->MultiCell(0,3,'S.A. avec Conseil d\'Administration au capital de Ar.547.200.000',0);	

	$this->fpdf->SetXY(15,250);
	$this->fpdf->MultiCell(0,3,utf8_decode('R.C.S 2017 B 00996 DU 19/09/2017 - Stat : 73101 11 2017 0 11059 du 19/09/2017 - N.I.F : 4002822947 du 19/09/2017 '),0);
	$this->fpdf->SetXY(15,254);
	$this->fpdf->MultiCell(0,3,utf8_decode('C.I.F : 0231086 / DGI-E du 20/09/2017 '),0);
	$this->fpdf->SetXY(15,258);
	$this->fpdf->MultiCell(0,3,utf8_decode('Siège : ZI Forello - Tanjombato - B.P. 514 ANTANANARIVO 101'),0);	
	$this->fpdf->SetXY(15,262);
	$this->fpdf->MultiCell(0,3,utf8_decode('Tél : +261 20 22 461 09 - Fax : +261 20 22 478 62 - www.havas.com'),0);
	$this->fpdf->SetXY(15,266);
	$this->fpdf->MultiCell(0,3,'E-mail: havas.madagascar@bollore.com',0);
	$this->fpdf->SetXY(15,270);
	$this->fpdf->MultiCell(0,3,'Agence : Antananarivo',0);

	$this->fpdf->SetXY(15,285);
	$this->fpdf->SetFont('Times','',11);
	//$this->fpdf->MultiCell(0,3,'---------------------------------------------------------------------------------------------------------------------------------------------',0);	

	
	$this->fpdf->Output();

	$etat='BC';
	$i=1;
	while ( $this->input->post("nom".$i) )
	{
	$data[] = array ( $this->input->post("nom".$i)  => array ( $this->input->post("q".$i) => $this->input->post("total".$i) )
                );
	$i++;
	}

	if (isset($_POST['valid']))
	{
		$this->pdf_model->ajout($n,$data,$this->input->post('agen'),$this->input->post('serv'),$this->input->post('fournisseur'),$this->input->post('ref'),$date,$ttc,$etat,$this->input->post('devise'));
	}
	unset($data);
} 


public function bordereau_debours()
{

	$date=getdate();
	//$date['year']
	$num=explode('0',$date['year']);

	if (isset($_POST['valid']))
	{
		$n = $this->pdf_model->numeroauto();
		$this->pdf_model->incrementer();
		switch ($n) {
	    case $n < 10:
	        $n=$num[1]."0000".$n;
	        break;
	    case $n < 100:
	        $n=$num[1]."000".$n;
	        break;
	    case $n < 1000:
	        $n=$num[1]."00".$n;
	        break;
	    case $n < 10000:
	        $n=$num[1]."0".$n;
	        break;
	    case $n < 100000:
	        $n=$num[1]."".$n;
	        break;    
		}
	}
	else if(isset($_POST['preview'])) {
		$n = 'TEST Debours';
	}

	
	/*lieu de livraison*/
	$b=$this->input->post('lieu');
	
	switch ($b)
	{
		case 1 : $l1=1;$l2=0;$l3=0;$l4=0;$l5=0;$l6=0;$l7=0;$l8=0;$l9=0;$l10=0;$l11=0;$l12=0;break;
		case 2 : $l1=0;$l2=1;$l3=0;$l4=0;$l5=0;$l6=0;$l7=0;$l8=0;$l9=0;$l10=0;$l11=0;$l12=0;break;
		case 3 : $l1=0;$l2=0;$l3=1;$l4=0;$l5=0;$l6=0;$l7=0;$l8=0;$l9=0;$l10=0;$l11=0;$l12=0;break;
		case 4 : $l1=0;$l2=0;$l3=0;$l4=1;$l5=0;$l6=0;$l7=0;$l8=0;$l9=0;$l10=0;$l11=0;$l12=0;break;
		case 5 : $l1=0;$l2=0;$l3=0;$l4=0;$l5=1;$l6=0;$l7=0;$l8=0;$l9=0;$l10=0;$l11=0;$l12=0;break;
		case 6 : $l1=0;$l2=0;$l3=0;$l4=0;$l5=0;$l6=1;$l7=0;$l8=0;$l9=0;$l10=0;$l11=0;$l12=0;break;
		case 7 : $l1=0;$l2=0;$l3=0;$l4=0;$l5=0;$l6=0;$l7=1;$l8=0;$l9=0;$l10=0;$l11=0;$l12=0;break;
		case 8 : $l1=0;$l2=0;$l3=0;$l4=0;$l5=0;$l6=0;$l7=0;$l8=1;$l9=0;$l10=0;$l11=0;$l12=0;break;
		case 9 : $l1=0;$l2=0;$l3=0;$l4=0;$l5=0;$l6=0;$l7=0;$l8=0;$l9=1;$l10=0;$l11=0;$l12=0;break;
		case 10 : $l1=0;$l2=0;$l3=0;$l4=0;$l5=0;$l6=0;$l7=0;$l8=0;$l9=0;$l10=1;$l11=0;$l12=0;break;
		case 11 : $l1=0;$l2=0;$l3=0;$l4=0;$l5=0;$l6=0;$l7=0;$l8=0;$l9=0;$l10=0;$l11=1;$l12=0;break;
		case 12 : $l1=0;$l2=0;$l3=0;$l4=0;$l5=0;$l6=0;$l7=0;$l8=0;$l9=0;$l10=0;$l11=0;$l12=1;break;
	}
	//
	//$this->fpdf->Image(img_url('coche.png'),105,23,5)
	//radio choix stock DAD charge
	$c=$this->input->post('radio1');
	switch ($c) {
		case 'A':
			$charge='4';$stock='';
			break;
		case 'B':
			$charge='';$stock='4';
			break;	
		default:
			$charge='';$stock='';
			break;
	}

	if($this->input->post('dac')==$date['year'])
	{
		$dac='';
	}else { $dac=$this->input->post('dac'); }


	$this->fpdf->Open();
	$this->fpdf->AddPage();
	
	//$this->fpdf->Image(img_url('logo.JPG'),140,7,55);
	$this->fpdf->Image(img_url('logo.JPG'),11,5,-100);
	
	$this->fpdf->SetXY(15,23);
	$this->fpdf->SetFont('helvetica','B',15);
	$this->fpdf->Cell(40,20,'BORDEREAU DE COMMANDE ');

	$this->fpdf->SetXY(15,28);
	$this->fpdf->SetFont('helvetica','',11);
	$this->fpdf->Cell(40,20,$this->input->post('radio2'));


	$this->fpdf->SetXY(130,30);
	$this->fpdf->SetFont('Times','',11);
	$this->fpdf->Cell(20,5,utf8_decode('N°'),'');
	$this->fpdf->SetFont('Times','B',11);
	$this->fpdf->Cell(25,5,$n,'B',0,'C');
	$this->fpdf->SetXY(130,35);
	$this->fpdf->SetFont('Times','',11);
	$this->fpdf->Cell(20,5,'Date','');
	$this->fpdf->SetFont('Times','B',11);
	$this->fpdf->cell(25,5,$date['mday'].'/'.$date['mon'].'/'.$date['year'],'B',0,'C');
 	$this->fpdf->SetXY(130,43);
 	$this->fpdf->SetFont('Times','',11);
 	$this->fpdf->Cell(20,5,'REF IRIS','');
 	$this->fpdf->Cell(25,5,$this->input->post('ref'),'B',0,'C');

 	//fournisseur
 	$this->fpdf->SetXY(15,43);
 	$this->fpdf->SetFont('Times','',11);
 	$this->fpdf->Cell(25,5,'Fournisseur : ','');
 	$this->fpdf->Cell(40,5,$this->input->post('fournisseur'),'B',0,'C');

 	//
 	$this->fpdf->SetXY(15,52);
 	$this->fpdf->SetFont('Times','B',9);
 	$this->fpdf->MultiCell(0,5,utf8_decode('Nous vous prions de Joindre les références de cette commande à la facture.'),'');
 	$this->fpdf->SetXY(15,56);
 	$this->fpdf->MultiCell(0,5,utf8_decode('D\'envoyer cette dernière au service tracking fournisseur du site destinataire en 2 exemplaires.'),'');
 	$this->fpdf->SetXY(15,60);
 	$this->fpdf->MultiCell(0,5,utf8_decode('Avec nos références fiscales complètes.'),'');

 	//tableau
 	$this->fpdf->SetXY(15,68);
 	$this->fpdf->SetFont('Times','B',10);
	$this->fpdf->Cell(25,6,'QUANTITE',1,0,'C');
	$this->fpdf->Cell(85,6,'DESIGNATION',1,0,'C'); 	
	$this->fpdf->Cell(35,6,'PU HT',1,0,'C');
	$this->fpdf->Cell(40,6,'TOTAL HT',1,0,'C');
	 

	$this->fpdf->SetXY(15,74);	
	$this->fpdf->Cell(25,6,utf8_decode($this->input->post('q1')),1,0,'C');
	$this->fpdf->Cell(85,6,utf8_decode($this->input->post('nom1')),1,0,'L');
	$this->fpdf->Cell(35,6,utf8_decode($this->input->post('pu1')),1,0,'C');
	$this->fpdf->Cell(40,6,utf8_decode($this->input->post('total1')),1,0,'C');

	$this->fpdf->SetXY(15,80);	
	$this->fpdf->Cell(25,6,utf8_decode($this->input->post('q2')),1,0,'C');
	$this->fpdf->Cell(85,6,utf8_decode($this->input->post('nom2')),1,0,'L');
	$this->fpdf->Cell(35,6,utf8_decode($this->input->post('pu2')),1,0,'C');
	$this->fpdf->Cell(40,6,utf8_decode($this->input->post('total2')),1,0,'C');
	
	$this->fpdf->SetXY(15,86);	
	$this->fpdf->Cell(25,6,utf8_decode($this->input->post('q3')),1,0,'C');
	$this->fpdf->Cell(85,6,utf8_decode($this->input->post('nom3')),1,0,'L');
	$this->fpdf->Cell(35,6,utf8_decode($this->input->post('pu3')),1,0,'C');
	$this->fpdf->Cell(40,6,utf8_decode($this->input->post('total3')),1,0,'C');
	
	$this->fpdf->SetXY(15,92);	
	$this->fpdf->Cell(25,6,utf8_decode($this->input->post('q4')),1,0,'C');
	$this->fpdf->Cell(85,6,utf8_decode($this->input->post('nom4')),1,0,'L');
	$this->fpdf->Cell(35,6,utf8_decode($this->input->post('pu4')),1,0,'C');
	$this->fpdf->Cell(40,6,utf8_decode($this->input->post('total4')),1,0,'C');
	
	$this->fpdf->SetXY(15,98);	
	$this->fpdf->Cell(25,6,utf8_decode($this->input->post('q5')),1,0,'C');
	$this->fpdf->Cell(85,6,utf8_decode($this->input->post('nom5')),1,0,'L');
	$this->fpdf->Cell(35,6,utf8_decode($this->input->post('pu5')),1,0,'C');
	$this->fpdf->Cell(40,6,utf8_decode($this->input->post('total5')),1,0,'C');
	
	$this->fpdf->SetXY(15,104);	
	$this->fpdf->Cell(25,6,utf8_decode($this->input->post('q6')),1,0,'C');
	$this->fpdf->Cell(85,6,utf8_decode($this->input->post('nom6')),1,0,'L');
	$this->fpdf->Cell(35,6,utf8_decode($this->input->post('pu6')),1,0,'C');
	$this->fpdf->Cell(40,6,utf8_decode($this->input->post('total6')),1,0,'C');
	
	$this->fpdf->SetXY(15,110);	
	$this->fpdf->Cell(25,6,utf8_decode($this->input->post('q7')),1,0,'C');
	$this->fpdf->Cell(85,6,utf8_decode($this->input->post('nom7')),1,0,'L');
	$this->fpdf->Cell(35,6,utf8_decode($this->input->post('pu7')),1,0,'C');
	$this->fpdf->Cell(40,6,utf8_decode($this->input->post('total7')),1,0,'C');
	
	$this->fpdf->SetXY(15,116);	
	$this->fpdf->Cell(25,6,utf8_decode($this->input->post('q8')),1,0,'C');
	$this->fpdf->Cell(85,6,utf8_decode($this->input->post('nom8')),1,0,'L');
	$this->fpdf->Cell(35,6,utf8_decode($this->input->post('pu8')),1,0,'C');
	$this->fpdf->Cell(40,6,utf8_decode($this->input->post('total8')),1,0,'C');
	
	$this->fpdf->SetXY(15,122);	
	$this->fpdf->Cell(25,6,utf8_decode($this->input->post('q9')),1,0,'C');
	$this->fpdf->Cell(85,6,utf8_decode($this->input->post('nom9')),1,0,'L');
	$this->fpdf->Cell(35,6,utf8_decode($this->input->post('pu9')),1,0,'C');
	$this->fpdf->Cell(40,6,utf8_decode($this->input->post('total9')),1,0,'C');



	$total=$this->input->post('total1')+$this->input->post('total2')+$this->input->post('total3')+$this->input->post('total4')+$this->input->post('total5')+$this->input->post('total6')+$this->input->post('total7')+$this->input->post('total8')+$this->input->post('total9');
	//remise
	if ($this->input->post('remise') != '')
	{
		$remise='Remise '.$this->input->post('remise').' %:' .' '.($total*$this->input->post('remise'))/100;
		$total=$total-($total*$this->input->post('remise'))/100;
	} else { $remise=''; }
	//


	$this->fpdf->SetXY(15,128);	
	$this->fpdf->Cell(25,6,'',1,0,'C');
	$this->fpdf->Cell(45,6,$remise,'LTB',0,'L');
	$this->fpdf->Cell(40,6,utf8_decode('TOTAL (ou à reporter)'),'TRB',0,'R');
	$this->fpdf->Cell(35,6,'',1,0,'C');
	$this->fpdf->Cell(40,6,number_format($total, 2, ',', ' ').' '.$this->input->post('devise').' HT',1,0,'R');

	if ($this->input->post('tva') != '')
	{
		$ttc=$total; $tva=0;
	} else if($this->input->post('c1')=='0.2' || $this->input->post('c2')=='0.2' || $this->input->post('c3')=='0.2' || $this->input->post('c4')=='0.2' || $this->input->post('c5')=='0.2' || $this->input->post('c6')=='0.2' || $this->input->post('c7')=='0.2' || $this->input->post('c8')=='0.2' || $this->input->post('c9')=='0.2')
	{
		$tva= $this->input->post('total1')*$this->input->post('c1')+$this->input->post('total2')*$this->input->post('c2')+$this->input->post('total3')*$this->input->post('c3')+$this->input->post('total4')*$this->input->post('c4')+$this->input->post('total5')*$this->input->post('c5')+$this->input->post('total6')*$this->input->post('c6')+$this->input->post('total7')*$this->input->post('c7')+$this->input->post('total8')*$this->input->post('c8')+$this->input->post('total9')*$this->input->post('c9') ;
		$ttc=$total+$tva;	
	}
	else { $tva=($total*20)/100;
	$ttc=$total+$tva; }

	//$ttc= number_format($ttc, 2, ',', ' ');

	$this->fpdf->SetXY(90,134);
	$this->fpdf->Cell(35,6,'TVA',1,0,'R');
	$this->fpdf->Cell(35,6,number_format($tva, 2, ',', ' ').' '.$this->input->post('devise'),1,0,'C');
	$this->fpdf->Cell(40,6,number_format($ttc, 2, ',', ' ').' '.$this->input->post('devise').'   TTC',1,2,'R');
	$this->fpdf->Cell(40,6,'Signature',0,0,'L');	
	
	$this->fpdf->SetXY(15,156);
	$this->fpdf->SetFont('Times','B',8);
	$this->fpdf->Cell(20,3,'Lieu de livraison',0,2);
	$this->fpdf->SetFont('Times','',8);
	$this->fpdf->Cell(20,3,'Tanjombato',$l1,2);
	$this->fpdf->Cell(20,3,'Ivato',$l2,2);
	$this->fpdf->Cell(20,3,'Antanimena',$l3,2);

	$this->fpdf->SetXY(70,159);
	$this->fpdf->Cell(20,3,'Toamasina Log',$l4,2);
	$this->fpdf->Cell(20,3,'Tamatave',$l5,2);
	$this->fpdf->Cell(20,3,'Antsirabe',$l6,2);

	$this->fpdf->SetXY(125,159);
	$this->fpdf->Cell(20,3,'Mahajanga',$l7,2);
	$this->fpdf->Cell(20,3,'Tolagnaro',$l8,2);
	$this->fpdf->Cell(20,3,'Toliary',$l9,2);

	$this->fpdf->SetXY(180,159);
	$this->fpdf->Cell(20,3,'Antsiranana',$l10,2);
	$this->fpdf->Cell(20,3,'Nosy Be',$l11,2);
	$this->fpdf->Cell(20,3,utf8_decode('Vohémar'),$l12,2);
	
	$this->fpdf->SetXY(15,168);
	$this->fpdf->SetFont('Times','',7.5);
	$this->fpdf->Cell(20,3,utf8_decode('Bolloré Transport & Logistics Madagascar'),0,2);

	$this->fpdf->SetXY(15,171);
	$this->fpdf->SetFont('Times','',8.5);
	$this->fpdf->MultiCell(0,3,'R.C.S. 2001 B 00022 du 22/06/2001 - stat: 52297 31 1967 0 00002 du 19/3/2013 - N.I.F. : 0000020309 du 19/01/11',0);	

	$this->fpdf->SetXY(15,174);
	$this->fpdf->MultiCell(0,3,utf8_decode('Siège : Rue du Capitaine Schoël - Ampasimazava - B.P 411 TOAMASINA 501'),0);
	$this->fpdf->SetXY(15,177);
	$this->fpdf->MultiCell(0,3,utf8_decode('Tél : +261 20 22 461 09/ +261 20 53 471 09 - Fax : +261 20 22 478 62 / +261 20 53 310 18'),0);
	$this->fpdf->SetXY(15,180);
	$this->fpdf->MultiCell(0,3,'E-mail: btl.madagascar@bollore.com / btl.tmm.madagascar@bollore.com',0);
	$this->fpdf->SetXY(15,183);
	$this->fpdf->MultiCell(0,3,'Agences : Antananarivo - Ivato - Antsirabe - Toamasina - Mahajanga - Antsiranana - Nosy Be - Toliary - Tolagnaro',0);

	$this->fpdf->SetXY(15,187);
	$this->fpdf->SetFont('Times','',11);
	$this->fpdf->MultiCell(0,3,'---------------------------------------------------------------------------------------------------------------------------------------------',0);	

	$this->fpdf->SetXY(15,190);
	$this->fpdf->SetFont('Times','B',9);
	$this->fpdf->MultiCell(0,3,utf8_decode('Débours').': (les prises en charges directes par le client ne donnent pas lieu'.utf8_decode('à une commande sous notre en-tête)'),0);

	$this->fpdf->SetXY(25,196);
	$this->fpdf->Cell(10,5,'XM',0,0);
	$this->fpdf->Cell(35,5,$this->input->post('XM'),'B',0);
	$this->fpdf->Cell(20,5,'XT  ',0,0,'R');
	$this->fpdf->Cell(35,5,$this->input->post('XT'),'B',0);
	$this->fpdf->SetFont('Times','',9);
	$this->fpdf->Cell(25,5,'418100 ',0,0,'R');
	$this->fpdf->Cell(35,5,$this->input->post('41'),'B',0);

	$this->fpdf->SetLineWidth(0.5);
	$this->fpdf->Line(15,204,200,204);
	$this->fpdf->SetLineWidth(0);

	$this->fpdf->SetXY(15,207);
	$this->fpdf->SetFont('Times','B',9);
	$this->fpdf->Cell(10,5,'UM',0,0);
	$this->fpdf->Cell(35,5,$this->input->post('UM'),'B',0);
	
	$this->fpdf->Cell(55,5,'ou',0,0,'R');
	$this->fpdf->Cell(35,5,'DAC',0,0,'C');
	$this->fpdf->SetXY(139,207);
	$this->fpdf->SetFont('Times','B',10);
	$this->fpdf->Cell(5,5,$dac,0,0);

	$this->fpdf->SetLineWidth(0.5);
	$this->fpdf->Line(15,214.5,200,214.5);
	$this->fpdf->SetLineWidth(0);

	$this->fpdf->SetXY(15,216);
	$this->fpdf->SetFont('Times','B',9);
	$this->fpdf->Cell(10,5,'CHARGE',0,0);
	$this->fpdf->SetXY(55,216);
	$this->fpdf->SetFont('zapfdingbats','',19);
	$this->fpdf->Cell(5,5,$charge,1,0);

	$this->fpdf->SetXY(115,216);
	$this->fpdf->SetFont('Times','B',9);
	$this->fpdf->Cell(10,5,'STOCK',0,0);
	$this->fpdf->SetXY(165,216);
	$this->fpdf->SetFont('zapfdingbats','',19);
	$this->fpdf->Cell(5,5,$stock,1,0);


	$this->fpdf->SetLineWidth(0.5);
	$this->fpdf->Line(15,223,200,223);
	$this->fpdf->SetLineWidth(0);
	
	$this->fpdf->SetXY(15,228);
	$this->fpdf->SetFont('Times','B',8);
	$this->fpdf->Cell(25,4,'SITE',1,0,'C');
	$this->fpdf->Cell(80,4,'DEPARTEMENT',1,0,'C');
	$this->fpdf->Cell(80,4,'DELEGATIONS ET AUTRES',1,0,'C');
	//
	
	$this->fpdf->SetXY(15,232);
	$this->fpdf->SetFont('Times','',8);
	$this->fpdf->Cell(17,4,'ABE','LTB',0,'R');
	$this->fpdf->SetFont('zapfdingbats','',12);
 	$this->fpdf->Cell(8,4,$this->input->post('abe'),'TRB',0,'C');
	$this->fpdf->SetFont('Times','',8);
	$this->fpdf->Cell(35,4,'SHIPPING','LTB',0,'C');
	
 	$this->fpdf->SetFont('Times','',8);
 	$this->fpdf->Cell(45,4,$this->input->post('d1'),'TRB',0,'C');
 	$this->fpdf->SetFont('Times','',8);
 	$this->fpdf->Cell(80,4,$this->input->post('autre2'),'TRBL',0,'C');

	$this->fpdf->SetXY(15,236);
	$this->fpdf->Cell(17,4,'DIE','LTB',0,'R');
	$this->fpdf->SetFont('zapfdingbats','',12);
 	$this->fpdf->Cell(8,4,$this->input->post('die'),'TRB',0,'C');
 	$this->fpdf->SetFont('Times','',8);
	$this->fpdf->Cell(35,4,'CTM','LTB',0,'C');
	
	$this->fpdf->SetFont('Times','',8);
 	$this->fpdf->Cell(45,4,$this->input->post('d2'),'TRB',0,'C');
 	$this->fpdf->SetFont('Times','',8);
 	$this->fpdf->Cell(80,4,$this->input->post('autre2'),'TRBL',0,'C');	

	$this->fpdf->SetXY(15,240);
	$this->fpdf->Cell(17,4,'FTU','LTB',0,'R');
	$this->fpdf->SetFont('zapfdingbats','',12);
 	$this->fpdf->Cell(8,4,$this->input->post('ftu'),'TRB',0,'C');
 	$this->fpdf->SetFont('Times','',8);
	$this->fpdf->Cell(35,4,'CTA','LTB',0,'C');
	
	$this->fpdf->SetFont('Times','',8);
 	$this->fpdf->Cell(45,4,$this->input->post('d3'),'TRB',0,'C');
 	$this->fpdf->SetFont('Times','',8);
 	$this->fpdf->Cell(80,4,$this->input->post('autre3'),'TRBL',0,'C');	


	$this->fpdf->SetXY(15,244);
	$this->fpdf->Cell(17,4,'IVT','LTB',0,'R');
	$this->fpdf->SetFont('zapfdingbats','',12);
 	$this->fpdf->Cell(8,4,$this->input->post('ivt'),'TRB',0,'C');
 	$this->fpdf->SetFont('Times','',8);
	$this->fpdf->Cell(35,4,'BASE LOGISTIQUE','LTB',0,'C');
	
	$this->fpdf->SetFont('Times','',8);
 	$this->fpdf->Cell(45,4,$this->input->post('d4'),'TRB',0,'C');
 	$this->fpdf->SetFont('Times','',8);
 	$this->fpdf->Cell(80,4,$this->input->post('autre4'),'TRBL',0,'C');	

	$this->fpdf->SetXY(15,248);
	$this->fpdf->Cell(17,4,'MJN','LTB',0,'R');
	$this->fpdf->SetFont('zapfdingbats','',12);
 	$this->fpdf->Cell(8,4,$this->input->post('mjn'),'TRB',0,'C');
 	$this->fpdf->SetFont('Times','',8);
	$this->fpdf->Cell(35,4,'NSN','LTB',0,'C');
	
	$this->fpdf->SetFont('Times','',8);
 	$this->fpdf->Cell(45,4,$this->input->post('d5'),'TRB',0,'C');
 	$this->fpdf->SetFont('Times','B',10);
 	$this->fpdf->Cell(30,4,'DOSSIER N','TBL',0,'C');
 	$this->fpdf->SetFont('Times','',8);	
 	$this->fpdf->Cell(50,4,$this->input->post('autre5'),'TRB',0,'C');	

	$this->fpdf->SetXY(15,252);
	$this->fpdf->Cell(17,4,'NSB','LTB',0,'R');
	$this->fpdf->SetFont('zapfdingbats','',12);
	$this->fpdf->Cell(8,4,$this->input->post('nsb'),'TRB',0,'C');
 	$this->fpdf->SetFont('Times','',8);
	$this->fpdf->Cell(35,4,'DG','LTB',0,'C');
	
	$this->fpdf->SetFont('Times','',8);
 	$this->fpdf->Cell(45,4,$this->input->post('d6'),'TRB',0,'C');
 	$this->fpdf->SetFont('Times','',8);
 	$this->fpdf->Cell(80,4,$this->input->post('autre6'),'TRBL',0,'C');	

	$this->fpdf->SetXY(15,256);
	$this->fpdf->Cell(17,4,'TJB','LTB',0,'R');
	$this->fpdf->SetFont('zapfdingbats','',12);
	$this->fpdf->Cell(8,4,$this->input->post('tjb'),'TRB',0,'C');
 	$this->fpdf->SetFont('Times','',8);
	$this->fpdf->Cell(35,4,'AGENCE','LTB',0,'C');
	
	$this->fpdf->SetFont('Times','',8);
 	$this->fpdf->Cell(45,4,$this->input->post('d7'),'TRB',0,'C');
 	$this->fpdf->SetFont('Times','',8);
 	$this->fpdf->Cell(80,4,$this->input->post('autre7'),'TRBL',0,'C');	

	$this->fpdf->SetXY(15,260);
	$this->fpdf->Cell(17,4,'TMM','LTB',0,'R');
	$this->fpdf->SetFont('zapfdingbats','',12);
	$this->fpdf->Cell(8,4,$this->input->post('tmm'),'TRB',0,'C');
 	$this->fpdf->SetFont('Times','',8);
	$this->fpdf->Cell(35,4,'DF','LTB',0,'C');
	
	$this->fpdf->SetFont('Times','',8);
 	$this->fpdf->Cell(45,4,$this->input->post('d8'),'TRB',0,'C');
 	$this->fpdf->SetFont('Times','',8);
 	$this->fpdf->Cell(80,4,$this->input->post('autre8'),'TRBL',0,'C');	

	$this->fpdf->SetXY(15,264);
	$this->fpdf->Cell(17,4,'TUL','LTB',0,'R');
	$this->fpdf->SetFont('zapfdingbats','',12);
	$this->fpdf->Cell(8,4,$this->input->post('tul'),'TRB',0,'C');
 	$this->fpdf->SetFont('Times','',8);
	$this->fpdf->Cell(35,4,'INFORMATIQUE','LTB',0,'C');
	
	$this->fpdf->SetFont('Times','',8);
 	$this->fpdf->Cell(45,4,$this->input->post('d9'),'TRB',0,'C');
 	$this->fpdf->SetFont('Times','',8);
 	$this->fpdf->Cell(80,4,$this->input->post('autre9'),'TRBL',0,'C');	


	$this->fpdf->SetXY(15,268);
	$this->fpdf->Cell(25,4,'',1,0,'C'); 
	$this->fpdf->Cell(35,4,'PERSONNEL','LTB',0,'C');
	$this->fpdf->SetFont('Times','',8);
 	$this->fpdf->Cell(45,4,$this->input->post('d10'),'TRB',0,'C');
 	$this->fpdf->SetFont('Times','',8);
 	$this->fpdf->Cell(80,4,$this->input->post('autre10'),'TRBL',0,'C');	


	$this->fpdf->SetXY(15,272);
	$this->fpdf->Cell(25,4,'',1,0,'C');
	$this->fpdf->Cell(35,4,'COMMERCIAL','LTB',0,'C');
	
	$this->fpdf->SetFont('Times','',8);
 	$this->fpdf->Cell(45,4,$this->input->post('d11'),'TRB',0,'C');
 	$this->fpdf->SetFont('Times','',8);
 	$this->fpdf->Cell(80,4,$this->input->post('autre11'),'TRBL',0,'C');	


	$this->fpdf->SetAutoPageBreak(0,1);

	$this->fpdf->SetXY(45,280);
	$this->fpdf->SetFont('Times','',10);
	$this->fpdf->Cell(120,4,'Bollore Transport & Logistics / BLX.MDG.ACH.F.0122 Bordereau de commande / V04 du 05/07/2016 ');
	
	$this->fpdf->Output();

	$etat='HAVAS';
	$i=1;
	while ( $this->input->post("nom".$i) )
	{
	$data[] = array ( $this->input->post("nom".$i)  => array ( $this->input->post("q".$i) => $this->input->post("total".$i) )
                );
	$i++;
	}

	if (isset($_POST['valid']))
	{
	
		$this->pdf_model->ajout($n,$data,$this->input->post('agen'),$this->input->post('serv'),$this->input->post('fournisseur'),$this->input->post('ref'),$date,$ttc,$etat);
	}
	unset($data);
} 
}

/*$this->fpdf->SetFont('zapfdingbats','',11);
 	$this->fpdf->Cell(25,5,chr(52),'');*/
