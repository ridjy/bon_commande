<?php
class Budget extends CI_Controller
{	
public function __construct()
{
	// Obligatoire
	parent::__construct();
	// Maintenant, ce code sera exécuté chaque fois que ce contrôleur sera appelé.
	$this->load->helper('url');
	$this->load->library('session');
	$this->load->database();
	$this->load->model('pdf_model');
    $this->load->model('budget_model');
	$data = array();
	//test session
	
}

public function index()
{
	$data['annee']=($this->input->post('annee')=='') ? '2018' : $this->input->post('annee');
    $data['titre'] = 'BUDGET RH' ;
	$rubrique = $this->pdf_model->get_rubrique();
	$data['tab']='';
	$gt=0; $utilise_total=0;
	foreach($rubrique as $item)
		{
			//$item->rub_lib
                $data['tab'].="<tr class='success'>
                <td>$item->rub_lib</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                </tr>" ;
                $ssrubrique = $this->pdf_model->get_ss_rubrique($item->rub_id); 
                $total=0; $aff_utilise=0; 
                foreach($ssrubrique as $me)
                {
                	//$me->sr_lib   $me->sr_lib
                    $utilise=$this->budget_model->get_montant($me->sr_lib);
                	$data['tab'].="<tr>
                	<td></td>
                	<td>$me->sr_lib</td>
                	<td>".number_format($me->sr_montant,'0',',','.')." Ariary</td>
                	<td>".number_format($utilise,'0',',','.')." Ariary</td>
                	<td>".number_format($this->pourcentage($utilise,$me->sr_montant),'2',',','.')."%</td> 
                	</tr>";
                	$total+=$me->sr_montant;
                    $aff_utilise+=$utilise;
                }                 
                $data['tab'].="<tr class='error'>
                    	<td></td>
                    	<td>SOUS-TOTAL</td>
                    	<td>".number_format($total,'0',',','.')." Ariary</td>
                    	<td>".number_format($aff_utilise,'0',',','.')." Ariary</td>
                    	<td>".number_format($this->pourcentage($aff_utilise,$total),'2',',','.')."%</td> 
                    	</tr>"; 
                $gt+=$total;
                $utilise_total+=$aff_utilise;    	    	           
		}
        $data['tab'].="<tr class='info'>
            	<td></td>
            	<td>TOTAL</td>
            	<td>".number_format($gt,'0',',','.')." Ariary</td>
            	<td>".number_format($utilise_total,'0',',','.')." Ariary</td>
            	<td>".number_format($this->pourcentage($utilise_total,$gt),'2',',','.')."%</td> 
            	</tr>";

		$this->load->view('template/rubrique',$data);
	
}

public function pourcentage($valeur,$cent)
{
    $pce=($valeur*100)/$cent;
    return $pce;
}	

}


