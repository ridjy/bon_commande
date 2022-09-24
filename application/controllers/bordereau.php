<?php
class Bordereau extends CI_Controller
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
	//$this->formulaire();
}
	
public function liste_bc()
{
	$serv=$this->session->userdata('service');
	if($serv=='')
	//if(isset($this->CI->session))
	{
		redirect('welcome'); 
	} else
	{
		//liste des BC
		if ($this->session->userdata('service')=='compta') {
			$this->accueilcompta($this->session->userdata('service'),$this->session->userdata('agence'));
		}
		else
		{	
			$data['titre'] = 'Acceuil bon de commande' ;
			$data['service'] = $this->session->userdata('service'); $data['agence']= $this->session->userdata('agence');
			$data['row'] = $this->pdf_model->bc($data['agence'],$data['service']);
			$data['ref'] = 'bc';
			$this->load->view('template/accueil',$data); } 
	}
				
}

public function livraison()
{
	$data['ref'] = 'bl';
	$data['service'] = $_GET["s"] ; $data['agence']= $_GET["a"] ;
	$data['row'] = $this->pdf_model->bl($data['agence'],$data['service']);
	$this->load->view('template/livraison',$data);
}


public function facture()
{
	$data['service'] = $_GET["s"] ; $data['agence']= $_GET["a"] ;
	$data['row'] = $this->pdf_model->facture($data['agence'],$data['service']);
	$this->load->view('template/facture',$data);
}

public function historique()
{
	$data['service'] = $_GET["s"] ; $data['agence']= $_GET["a"] ;
	$data['row'] = $this->pdf_model->annee($data['service'],$data['agence']);
	$this->load->view('template/historique',$data);
}

public function stat()
{
	if ($this->session->userdata('login')!='') {
	//$data['a'] = $a;	
	$data['titre'] = 'Statistique des commandes effectués par année' ;
	$data['row'] = $this->pdf_model->statistique(); 
	$this->load->view('template/stat',$data); }
	else { redirect('bordereau/login');}
}

public function mois()
{
	$data['titre'] = 'Statistique des commandes effectués par mois' ;
	$data['a']=$_GET["a"]; $data['b']=$_GET["b"];$data['an']=$_GET["an"];$data['retour']=$_GET["retour"];
	$data['row'] = $this->pdf_model->mois($data['a'],$data['b'],$data['an']);
	$this->load->view('template/mois',$data);
}

public function jours()
{
	$data['titre'] = 'Statistique des commandes effectués par jour' ;
	$data['a']=$_GET["a"]; $data['b']=$_GET["b"];$data['an']=$_GET["an"];$data['m']=$_GET["m"];$data['retour']=$_GET["retour"];
	$data['row'] = $this->pdf_model->jour($data['a'],$data['b'],$data['m'],$data['an']);
	$this->load->view('template/jour',$data);
}

public function accueilcompta($service,$agence)
{
	$data['titre'] = 'Accueil bon de commande' ;
	$data['service'] = $service; $data['agence']= $agence;
	$data['row'] = $this->pdf_model->accueilcompta();
	$this->load->view('compta/accueil',$data); 	 
}

public function accueilcomptabilite()
{
	$data['titre'] = 'Accueil bon de commande' ;
	$data['service'] = $_GET["s"]; $data['agence']= $_GET["a"];
	$data['row'] = $this->pdf_model->accueilcompta();
	$this->load->view('compta/accueil',$data); 	 
}

public function servicecompta()
{
	$data['titre'] = 'Par service' ;
	$data['service'] = $_GET["s"] ; $data['agence']= $_GET["a"] ;
	$data['row'] = $this->pdf_model->servicecompta($data['agence'],$data['service']);
	$this->load->view('compta/servicecompta',$data); 
	
}

public function archivecompta()
{
	$data['titre'] = 'Archive des bons de commande' ;
	$data['service'] = $this->session->userdata('service'); $data['agence']= $this->session->userdata('agence');
	$data['row'] = $this->pdf_model->statistique();
	$this->load->view('compta/archive',$data);
}

public function trie()
{
	if ($this->session->userdata('agence') == '') { redirect('bordereau/entree'); }
	$this->load->library('form_validation');
	$data['agence'] = $this->session->userdata('agence');
	$data['service'] = $this->session->userdata('service');
	$data['annee'] = $this->input->post('annee');
	if ($data['annee'] != 'tous')
	{ 
		$data['row'] = $this->pdf_model->stat($data['annee']);
	  	$this->load->view('compta/archive',$data); 
	}
	else { $a='jeton' ;
		$this->archivecompta() ; }  
}


public function agence()
{
	$data['titre'] = 'Statistique des commandes effectués par année' ;
	$data['a']=$_GET["a"];$data['retour']=$_GET["retour"];
	$data['row'] = $this->pdf_model->agence($data['a']);
	$this->load->view('compta/agence',$data);
}

public function service()
{
	$data['titre'] = 'Statistique des commandes effectués par service' ;
	$data['s']=$_GET["s"];$data['retour']=$_GET["retour"];
	$data['row'] = $this->pdf_model->service($data['s']);
	$this->load->view('compta/service',$data);

}

public function moisarchive()
{
	$data['titre'] = 'Statistique des commandes effectués par mois' ;
	$data['a']=$_GET["a"]; $data['b']=$_GET["b"];$data['an']=$_GET["an"];
	$data['row'] = $this->pdf_model->mois($data['a'],$data['b'],$data['an']);
	$this->load->view('compta/mois',$data);
}

public function jourarchive()
{
	$data['titre'] = 'Statistique des commandes effectués par jour' ;
	$data['a']=$_GET["a"]; $data['b']=$_GET["b"];$data['an']=$_GET["an"];$data['m']=$_GET["m"];
	$data['row'] = $this->pdf_model->jour($data['a'],$data['b'],$data['m'],$data['an']);
	$this->load->view('compta/jour',$data);
}

public function commandearchive()
{
	$data['id']=$_GET["id"];$data['ttc']=$_GET["ttc"];$data['f']=$_GET["f"];$data['d']=$_GET["date"];$data['a']=$_GET["a"];$data['b']=$_GET["b"];
	$data['m']=$_GET["m"];$data['an']=$_GET["an"];
	$data['titre'] = 'Détails du BC' ;
	$data['row'] = $this->pdf_model->cmd($data['id']);
	$this->load->view('compta/commande',$data);
}

public function commande()
{
	$data['id']=$_GET["id"];$data['ttc']=$_GET["ttc"];$data['f']=$_GET["f"];$data['d']=$_GET["date"];$data['a']=$_GET["a"];$data['b']=$_GET["b"];
	$data['titre'] = 'Détails du BC' ;
	//$data['row'] = $this->pdf_model->cmd($data['id']);
	$data['row'] = $this->budget_model->get_cmd($data['id']);
	$this->load->view('bordereau/commande',$data);
}

public function bon_livraison()
{
	$data['id']=$_GET["id"];$data['ttc']=$_GET["ttc"];$data['f']=$_GET["f"];$data['d']=$_GET["date"];$data['a']=$_GET["a"];$data['b']=$_GET["b"];
	$data['titre'] = 'Détails du BC' ;
	$data['row'] = $this->budget_model->get_cmd($data['id']);
	$this->load->view('template/bl',$data);
}


public function modif_bl()
{
	$nbre=$this->budget_model->compter_article($this->input->post('id'));
	$s=$this->input->post('s');
	$a=$this->input->post('a');
	for($i=1;$i<=$nbre;$i++)
	{
		$nom=$this->input->post($i);
		$qte=$this->input->post($nom);
		$bool=$this->budget_model->update_qte($nom,$qte);
		//echo $a;		
	}
	redirect("bordereau/livraison?s=$s&a=$a");	
}

public function havas()
{	
	$data['titre'] = 'Havas' ;
	$data['service'] = $_GET["s"] ; $data['agence']= $_GET["a"] ;
	#$data['fournisseur'] = $this->pdf_model->get_fournisseur();
	#if ($data['service']=='DEBTMM'|$data['service']=='DEBTJB') {
		# code...
		$service = $_GET["s"] ; $agence= $_GET["a"] ;	
		$this->formulairedebours($service,$agence);
	#}
	#else
	 #{
		//$this->load->view('bordereau/havas',$data); 	# code...
		#$this->load->view('bordereau/havas_courant',$data); 	# code...
	#}
	
}

public function formulaire()
{	
	$data['titre'] = 'BORDEREAU DE COMMANDE' ;
	$data['service'] = $_GET["s"] ; $data['agence']= $_GET["a"] ;
	$data['fournisseur'] = $this->pdf_model->get_fournisseur($this->session->userdata('id_login'));
	//rubriques
	$rubrique = $this->pdf_model->get_rubrique();
	if ($data['service']=='DEBTMM'|$data['service']=='DEBTJB') {
		# code...
		$service = $_GET["s"] ; $agence= $_GET["a"] ;	
		$this->formulairedebours($service,$agence);
	}
	else
	 {
		$data['select']='';
		foreach($rubrique as $item)
		{
                $data['select'].='<optgroup label="'.$item->rub_lib.'"> ' ;
                $ssrubrique = $this->pdf_model->get_ss_rubrique($item->rub_id); 
                foreach($ssrubrique as $me)
                {
                	$data['select'].="<option value='".$me->sr_lib."'>".$me->sr_lib."</option> ";
                }
                $data['select'].=" </optgroup>"; 
                        
		}
		$this->load->view('bordereau/formulairenew',$data); 	# code...
	}
	
}

public function formulairedebours($service,$agence)
{	
	$data['titre'] = 'BORDEREAU DE COMMANDE' ;
	$data['service'] = $service ; $data['agence']= $agence ;
	$rubrique = $this->pdf_model->get_rubrique();
	$data['fournisseur'] = $this->pdf_model->get_fournisseur($this->session->userdata('id_login')); 
	if(empty($data['fournisseur'])) {
		redirect('bordereau/liste_bc') ; 		
	}
	$data['select']='';
		foreach($rubrique as $item)
		{
                $data['select'].='<optgroup label="'.$item->rub_lib.'"> ' ;
                $ssrubrique = $this->pdf_model->get_ss_rubrique($item->rub_id); 
                foreach($ssrubrique as $me)
                {
                	$data['select'].="<option value='".$me->sr_lib."'>".$me->sr_lib."</option> ";
                }
                $data['select'].=" </optgroup>"; 
                        
		} 
	$this->load->view('bordereau/formulaire_debours',$data);
	//var_dump($data['fournisseur']);
}

 
public function facturecompta()
{
	$data['titre'] = 'Valide' ;
	$data['id_cmd'] = $_GET["i"] ; $data['service'] = $_GET["s"] ; $data['agence']= $_GET["a"] ;
	$data['row'] = $this->pdf_model->facturecompta($data['id_cmd']);
	$this->budget_model->valid_budget($data['id_cmd']);	
	$this->load->view('bordereau/jsfacturecompta',$data); 
	
} 

public function livrer()
{
	$data['service'] = $_GET["s"] ; $data['agence']= $_GET["a"] ; $id=$_GET["id"] ;
	if($this->pdf_model->livrer($id))
	{
		$this->load->view('bordereau/facturejs',$data);	
	}
	
}

public function facturer()
{
	$data['service'] = $_GET["s"] ; $data['agence']= $_GET["a"] ; $id=$_GET["id"] ;
	if($this->pdf_model->facturer($id))
	{
		$this->load->view('bordereau/facturejs',$data);	
	}
	
}

public function valider()
{
	$data['service'] = $_GET["s"] ; $data['agence']= $_GET["a"] ; $id=$_GET["id"] ;
	if($this->pdf_model->valider($id))
	{
		$this->load->view('bordereau/validerjs',$data);	
	}
	
}

public function annulation()
{
	$data['titre'] = 'Annulation de certaines commandes' ;
	$data['agence']=$_GET["a"]; $data['service']=$_GET["s"]; 
	$data['row'] = $this->pdf_model->annuler($data['agence'],$data['service']);
	$this->load->view('bordereau/annuler',$data);	
}

public function annul()
{
	$data['titre'] = 'Annuler le dernier bordereau' ;
	$data['agence']=$_GET["a"]; $data['service']=$_GET["s"]; 
	$data['row'] = $this->pdf_model->annul($data['agence'],$data['service']);
	$this->load->view('bordereau/annuler',$data);	
}

public function efface()
{
	$data['id']=$_GET["id"];$data['a']=$_GET["a"]; $data['s']=$_GET["s"]; 
	if ($this->pdf_model->efface($data['id']))
	{
		//$this->pdf_model->decrementer();
		$this->load->view('bordereau/effacejs',$data);		
	}
} 

public function login(){
	$data['titre'] = 'login' ; 
	$this->load->view('template/login',$data);
}




 
 public function retour(){
 	if ($data['ref'] !='bl') {
 			$data['titre'] = 'Acceuil bon de commande' ;
			$data['service'] = $this->session->userdata('service'); $data['agence']= $this->session->userdata('agence');
			$data['row'] = $this->pdf_model->bc($data['agence'],$data['service']);
			$this->load->view('template/accueil',$data);
 	}
 	else {
 		$data['service'] = $_GET["s"] ; $data['agence']= $_GET["a"] ;
		$data['row'] = $this->pdf_model->bl($data['agence'],$data['service']);
		$this->load->view('template/livraison',$data);
 	}
 }


 public function enregistrerLivraison(){
 	$data['service'] = $_POST["service"];
 	$data['agence']= $_POST["agence"];
 	$id_cmd = $_POST["id_cmd"] ;
 	$res = array(
 		'num_bl' => $_POST['donnees']['num_bl'],
 		'date_bl' => $_POST['donnees']['date_bl'],
 		'etat' => 'BL'
 	);
 	$this->pdf_model->enregistrer_livraison($res,$id_cmd);
 	$data['row'] = $this->pdf_model->bl($data['agence'],$data['service']);
 	$this->load->view("template/livraison",$data);
 }

 public function enregistrerFacturation(){
 	$data['service'] = $_POST["service"];
 	$data['agence']= $_POST["agence"];
 	$id_cmd = $_POST["id_cmd"] ;
 	$res = array(
 		'num_facture' => $_POST['donnees']['num_facture'],
 		'date_facture' => $_POST['donnees']['date_facture'],
 		'etat' => 'f'
 	);
 	$this->pdf_model->enregistrer_facture($res,$id_cmd);
 	$data['row'] = $this->pdf_model->facture($data['agence'],$data['service']);
 	$this->load->view("template/facture",$data);
 }

/*public function deconnexion()
{
	redirect('bordereau/formulaire',$champ);
}*/


}
