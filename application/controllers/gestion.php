<?php
class Gestion extends CI_Controller
{	
public function __construct()
{
	// Obligatoire
	parent::__construct();
	// Maintenant, ce code sera exécuté chaque fois que ce contrôleur sera appelé.
	$this->load->helper('url');
	$this->load->library('session');
	$this->load->database();
	$this->load->model('gestion_model');
	$data = array();
	//pour email
}

public function index()
{
	$this->accueil();
}

public function login_par_fournisseur()
{
	$data['titre'] = 'Gestion des fournisseurs par service' ;
	//$data['erreur'] = $e ;
	$data['row'] = $this->gestion_model->select_login();
	$data['total'] = $this->gestion_model->count_login();
	//$this->load->view('gestion/entete',$data); 
	$this->load->view('gestion/login_par_fournisseur',$data);	
}

public function fournisseur()
{	
	$data['id_login'] = $_GET['id'];
	if (empty($_GET['id'])){
		redirect('gestion/login_par_fournisseur');
	} else {
		$data['titre'] = 'Gestion des fournisseurs' ;
		//$data['erreur'] = $e ;
		$data['rowlogin'] = $this->gestion_model->get_login($data['id_login']);
		$data['row'] = $this->gestion_model->select_fournisseur($data['id_login']);
		$data['total'] = $this->gestion_model->count_fournisseur($data['id_login']);
		//$this->load->view('gestion/entete',$data); 
		$this->load->view('gestion/fournisseur',$data);
	}
}

public function valid_fournisseur()
{	
	// Chargement de la bibliothèque
	$this->load->library('form_validation');
	$this->form_validation->set_rules('nom','"Fournisseur"','trim|required|min_length[3]|max_length[52]|alpha_dash|encode_php_tags|xss_clean');
	$this->form_validation->set_rules('ref','"REF IRIS"','trim|required|min_length[3]|max_length[52]|alpha_dash|encode_php_tags|xss_clean');
	if($this->form_validation->run())
	{
		// Le formulaire est valide
		$id='';	
		//tester si le fournisseur existe déjà
		if(!$this->gestion_model->test_fournisseur($this->input->post('nom'), $this->input->post('id_login')))
		{		
			$this->gestion_model->ajout_fournisseur($id,$this->input->post('nom'),$this->input->post('ref'),$this->input->post('id_login'));
			//$this->input->post('nom')='';$this->input->post('ref')='';
			redirect('gestion/fournisseur/?id='.$this->input->post('id_login'));
		}
		else
		{
			$data['id_login']=$this->input->post('id_login');
			$this->load->view('gestion/existejs',$data);
		}
		
	}
	else
	{
	// Le formulaire est invalide ou vide
	redirect('gestion/fournisseur');
	}
}

public function efface_fournisseur()
{
	$id=$_GET['id'];
	$this->gestion_model->efface_fournisseur($id);
	$this->fournisseur();
}

public function get_refiris()
{
	$fournisseur=$_GET['f'];
	$ref=$this->gestion_model->get_ref($fournisseur);
	echo $ref;
}


/*****************rubrique*********************/


public function rubrique(){
	$data['titre'] = 'Gestion des rubriques' ;
	//$data['erreur'] = $e ;
	$data['service'] = $this->session->userdata('service') ; $data['agence']= $this->session->userdata('agence') ;
	$data['row'] = $this->gestion_model->select_rubrique();
	$data['total'] = $this->gestion_model->count_rubrique();
	$data['val'] = "Nouvelle rubrique enregistrée!";
	$data['img'] = img_url('rubrique.png') ;

	//$this->load->view('gestion/entete',$data); 
	$this->load->view('gestion/rubrique',$data);
}

public function valid_rubrique()
{	
	// Chargement de la bibliothèque
	$this->load->library('form_validation');
	//$this->form_validation->set_rules('libelle','"Libellé"','trim|required|min_length[3]|max_length[52]|alpha_dash|encode_php_tags|xss_clean');
	$this->form_validation->set_rules('libelle','"Libellé"','required');

	if($this->form_validation->run())
	{
		// Le formulaire est valide
		$id='';	
		//tester si la rubrique existe déjà
		if(!$this->gestion_model->test_rubrique($this->input->post('libelle')))
		{		
			$this->gestion_model->ajout_rubrique($id,$this->input->post('libelle'));
			$data['val'] = "Nouvelle rubrique enregistrée!";
			$this->rubrique();
			$this->load->view('gestion/push',$data) ;	

	
		}
		else
		{
			$this->load->view('gestion/existejsrub');
		}
		
	}
	else
	{
	// Le formulaire est invalide ou vide
	redirect('gestion/rubrique');
	}
}

public function efface_rubrique()
{
	$id=$_GET['id'];
	$this->gestion_model->efface_rubrique($id);
	$this->rubrique();
}


/****************sous_rubrique******************/

public function sous_rubrique(){
	$data['titre'] = 'Gestion des sous_rubrique' ;
	//$data['erreur'] = $e ;
	$data['service'] = $this->session->userdata('service') ; $data['agence']= $this->session->userdata('agence') ;
	$data['row'] = $this->gestion_model->select_rubrique();
	$data['total'] = $this->gestion_model->count_sous_rubrique();
	$data['res'] = $this->gestion_model->select_sous_rubrique();
	$data['val'] = 'Nouvelle sous rubrique enregistrée!' ;
	$data['img'] = img_url('sousrub.png') ;

	//$this->load->view('gestion/entete',$data); 
	$this->load->view('gestion/sous_rubrique',$data);	
}

public function valid_sous_rubrique()
{	
	// Chargement de la bibliothèque
	$this->load->library('form_validation');
	$this->form_validation->set_rules('rub','"Rubrique"','required');
	$this->form_validation->set_rules('sous_rub','"Sous rubrique"','required');
	$this->form_validation->set_rules('montant','"Montant"','required');
	if($this->form_validation->run())
	{
		// Le formulaire est valide
		$id='';	
		//tester si la sous_rubrique existe déjà
		if(!$this->gestion_model->test_sous_rubrique($this->input->post('sous_rub')))
		{	

			$this->gestion_model->ajout_sous_rubrique($id,set_value('rub'),$this->input->post('sous_rub'),$this->input->post('montant'));
			$data['val'] = 'Nouvelle sous rubrique enregistrée!' ;
			$this->sous_rubrique();
			$this->load->view('gestion/push',$data);
		}
		else
		{
			$this->load->view('gestion/existejssrub');
		}
		
	}
	else
	{
	// Le formulaire est invalide ou vide
	redirect('gestion/sous_rubrique');
	}
}

public function efface_sous_rubrique()
{
	$id=$_GET['id'];
	$this->gestion_model->efface_sous_rubrique($id);
	$this->sous_rubrique();
}

/********************login***************************/
public function login()
{
	$data['titre'] = 'Gestion des utilisateurs' ;
	$data['row'] = $this->gestion_model->select_login();
	$data['total'] = $this->gestion_model->count_login();
	//$this->load->view('gestion/entete',$data); 
	$this->load->view('gestion/liste_login',$data);

}

public function valid_login()
{	
	// Chargement de la bibliothèque
	$this->load->library('form_validation');
	//$this->form_validation->set_rules('libelle','"Libellé"','trim|required|min_length[3]|max_length[52]|alpha_dash|encode_php_tags|xss_clean');
	$this->form_validation->set_rules('service','"service"','required');

	if($this->form_validation->run())
	{
		// Le formulaire est valide
		$id='';	
		//tester si la rubrique existe déjà
		if(!$this->gestion_model->test_login_ajout($this->input->post('service'),$this->input->post('agence')))
		{		
			$this->gestion_model->ajout_login($id,$this->input->post('service'),$this->input->post('agence'),$this->input->post('mdp'));
			$data['val'] = "Login enregistré!";
			$data['img'] = img_url('rubrique.png');
			$this->login();
			$this->load->view('gestion/push',$data) ;	
		}
		else
		{
			$this->load->view('gestion/existejslogin');
		}
		
	}
	else
	{
	// Le formulaire est invalide ou vide
	redirect('gestion/login');
	}
}

public function efface_login()
{
	$id=$_GET['id'];
	$this->gestion_model->efface_login($id);
	redirect('gestion/login');
}

} 