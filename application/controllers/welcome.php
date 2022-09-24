<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		// Obligatoire
		parent::__construct();
		// Maintenant, ce code sera exécuté chaque fois que ce contrôleur sera appelé.
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->database();
		$this->load->model('pdf_model');
		$this->load->model('gestion_model');
		$data = array();
		//pour email
	}

	public function index()
	{
		$data['titre'] = 'LOG BORDEREAU DE COMMANDE' ; 
		$this->load->view('bordereau/entree',$data);
		//$this->load->view('template/login',$data);
	}

	public function admin()
	{
		$data['titre'] = 'LOG ADMIN BORDEREAU DE COMMANDE' ; 
		//$this->load->view('bordereau/entree',$data);
		$this->load->view('template/login',$data);
	}

	public function debours()
	{
		$data['titre'] = 'LOG Debours' ; 
		$this->load->view('bordereau/entree_debours',$data);
		//$this->load->view('template/login',$data);
	}

	public function passe()
	{
		
		if($this->pdf_model->test_login($this->input->post('service'),$this->input->post('agence'),$this->input->post('mdp')))
		{
			$service=$this->input->post('service');$agence=$this->input->post('agence');$acces=$this->input->post('acces');
			//$this->formulaire($a,$service,$agence);
			$id_login=$this->gestion_model->get_login_id($this->input->post('service'),$this->input->post('agence'),$this->input->post('mdp'));
			$this->session->set_userdata('service', $service);
			$this->session->set_userdata('agence', $agence);
			$this->session->set_userdata('id_login', $id_login);
			$this->session->set_userdata('acces', $acces);//debours ou FG
			redirect('bordereau/liste_bc');
		}
		else
		{
			$data['titre'] = 'LOG BORDEREAU DE COMMANDE' ;
			//$this->load->view('bordereau/entree',$data);
			$this->load->view('bordereau/entree',$data);
			$this->load->view('bordereau/jslogin');
		}

	}

	public function test_fournisseur () 
	{
		$type = "fournisseur";
		$this->test_login($type) ;
		$data['val'] = 'Bienvenue '.$this->input->post('login').'! Vous êtes connecté!' ;
		$this->load->view('gestion/push',$data);

	}

	public function test_rubrique () 
	{
		$type = "rubrique";
		$this->test_login($type) ;
		$data['val'] = 'Bienvenue '.$this->input->post('login').'! Vous êtes connecté!' ;
		$this->load->view('gestion/push',$data);
	}

	public function test_daf () 
	{
		$data['titre'] = 'Administration' ; 
		$this->load->library('form_validation');
		$champ['login'] = $this->input->post('login');
		$champ['mdp'] = $this->input->post('mdp');
		if($this->pdf_model->login($champ['login'],$champ['mdp']))
		{
			$session['login']=$champ['login'];
			$this->session->set_userdata($session);
			redirect('bordereau/stat') ;
		}
		else
		{
			$data['titre'] = 'LOG FOURNISSEUR' ;
			$this->load->view('template/login',$data);
			/*$this->load->view('bordereau/entree',$data);*/
			$this->load->view('bordereau/jslogin');
		}
	}

	public function test_login ($type) {
	
	if($this->gestion_model->test_login($this->input->post('login'),$this->input->post('mdp'),$type))
		{
			$login=$this->input->post('login');
			$mdp=$this->input->post('mdp');
			//$this->formulaire($a,$service,$agence);
			$this->session->set_userdata('login', $login);
			$this->session->set_userdata('mdp', $mdp);
			
			if ($type == "fournisseur") {
				redirect('gestion/login_par_fournisseur');
			}
					elseif ($type == "rubrique") {
						redirect('gestion/rubrique');
					}
						else {
							redirect('bordereau/liste_bc');
						}


		}
		else
		{
			$data['titre'] = 'LOG FOURNISSEUR' ;
			$this->load->view('template/login',$data);
			/*$this->load->view('bordereau/entree',$data);*/
			$this->load->view('bordereau/jslogin');
		}
}

	public function deconnexion()
	{
		// Détruit la session
		$this->session->unset_userdata(array('service' => '', 'agence' =>''));
		if($this->session->sess_destroy())
		{
		// Redirige vers la page d'accueil
			redirect('welcome');
		}
	} 

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */