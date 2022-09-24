<?php
class Excel extends CI_Controller
{	
public function __construct()
{
	// Obligatoire
	parent::__construct();
	// Maintenant, ce code sera exécuté chaque fois que ce contrôleur sera appelé.
	$this->load->helper('url');
	$this->load->database();
	$this->load->model('pdf_model');
	define('FPDF_FONTPATH',$this->config->item('fonts_path'));
	$this->load->library('PHPExcel');
}

public function file()
{

/* données à entrer*/
$data['a']=$_GET["a"]; $data['s']=$_GET["s"];$data['an']=$_GET["an"];$data['m']=$_GET["mois"];
$data['row'] = $this->pdf_model->jour($data['a'],$data['s'],$data['m'],$data['an']);
$this->load->view('excel/fichier',$data);	

}
}
