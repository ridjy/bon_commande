<?php if ( ! defined('BASEPATH')) exit('No direct script access
allowed');

class Gestion_model extends CI_Model
{
protected $table = 'fournisseur';
protected $tab = 'rubrique' ;
protected $t = 'sous_rubrique' ;
protected $table_login = 'login' ;
public function __construct()
{
	// Obligatoire
	parent::__construct();
	$this->load->database();	
}
 
public function select_fournisseur($id)
{
	$this->db->select('*');
	$this->db->from('fournisseur');
	$this->db->where('id_login',$id);
	$query = $this->db->get();
	$row = $query->result();
	return $row ;  	
}

public function count_fournisseur($id)
{
	$this->db->select('COUNT(*) as total');
	$this->db->from('fournisseur');
	$this->db->where('id_login',$id);
	$query = $this->db->get();
	$row = $query->row_array();
	return $row['total']; 
}

public function ajout_fournisseur($id,$nom,$ref,$id_login)
{
	$this->db->set('id_fournisseur',$id);
	$this->db->set('nom_fournisseur',$nom);
	$this->db->set('ref_iris',$ref);
	$this->db->set('id_login',$id_login);
	return $this->db->insert($this->table);
}

public function test_fournisseur($nom,$id_login)
{
	$array=array('nom_fournisseur' => $nom, 'id_login' => $id_login);
	$this->db->select('nom_fournisseur');
	$this->db->from('fournisseur');
	$this->db->where($array);
	$this->db->limit(1);
	$query = $this->db->get();
	if ($query->num_rows() > 0) {
	return TRUE ; } 
	else { return FALSE ; }
}

public function efface_fournisseur($id)
{
	return $this->db->where('id_fournisseur', $id )->delete($this->table);
	return TRUE ;
}

public function get_ref($f)
{
	$this->db->select('ref_iris');
	$this->db->from('fournisseur');
	$this->db->where('nom_fournisseur',$f);
	$this->db->limit(1);
	$query = $this->db->get();
	$row = $query->row_array();
	return $row['ref_iris'];
}


public function test_login($s,$mdp,$type)
{
	$query = $this->db->query('SELECT * FROM user WHERE user_login="'.$s.'" AND user_mdp="'.$mdp.'" AND user_type="'.$type.'" LIMIT 1' );
	if ($query->num_rows() > 0) 
		{
			return TRUE; 
		}
	else{ return FALSE; }
}

/*****************sous_rubrique**********************/

public function test_sous_rubrique($lib)
{
	$this->db->select('sr_lib');
	$this->db->from('sous_rubrique');
	$this->db->where('sr_lib',$lib);
	$this->db->limit(1);
	$query = $this->db->get();
	if ($query->num_rows() > 0) {
	return TRUE ; } 
	else { return FALSE ; }
}

public function ajout_sous_rubrique($id,$val,$sous_rub,$montant)
{
	$this->db->set('sr_id',$id);
	$this->db->set('rub_id',$val);
	$this->db->set('sr_lib',$sous_rub);
	$this->db->set('sr_montant',$montant);
	return $this->db->insert($this->t);
}


public function count_sous_rubrique()
{
	$this->db->select('COUNT(*) as total');
	$this->db->from('sous_rubrique');
	$query = $this->db->get();
	$row = $query->row_array();
	return $row['total']; 
}

public function select_sous_rubrique()
{
	$this->db->select('s.sr_id,r.rub_lib,s.sr_lib,s.sr_montant');
	$this->db->from('sous_rubrique s');
	$this->db->join('rubrique r','r.rub_id = s.rub_id','left');
	$query = $this->db->get();
	$res = $query->result();
	return $res ;  	
}

public function efface_sous_rubrique($id)
{
	return $this->db->where('sr_id', $id )->delete($this->t);
	return TRUE ;
}


/*****************rubrique***************/

public function test_rubrique($rub)
{
	$this->db->select('rub_lib');
	$this->db->from('rubrique');
	$this->db->where('rub_lib',$rub);
	$this->db->limit(1);
	$query = $this->db->get();
	if ($query->num_rows() > 0) {
	return TRUE ; } 
	else { return FALSE ; }
}

public function ajout_rubrique($id,$rub)
{
	$this->db->set('rub_id',$id);
	$this->db->set('rub_lib',$rub);
	return $this->db->insert($this->tab);
}

public function select_rubrique()
{
	$this->db->select('*');
	$this->db->from('rubrique');
	$query = $this->db->get();
	$row = $query->result();
	return $row ;  	
}

public function get_rubrique($lib)
{
	$this->db->select('rub_id');
	$this->db->from('rubrique');
	$this->db->where('rub_lib',$lib);
	$query = $this->db->get();
	$getrub = $query->result();
	return $getrub;  	
}

public function count_rubrique()
{
	$this->db->select('COUNT(*) as total');
	$this->db->from('rubrique');
	$query = $this->db->get();
	$row = $query->row_array();
	return $row['total']; 
}

public function efface_rubrique($id)
{
	return $this->db->where('rub_id', $id )->delete($this->tab);
	return TRUE ;
}

/*******************login***************/

public function select_login()
{
	$this->db->select('*');
	$this->db->from('login');
	$query = $this->db->get();
	$row = $query->result();
	return $row ;  	
}

public function test_login_ajout($service,$agence)
{
	$array = array('agence' => $agence, 'service' => $service);
	$this->db->select('service');
	$this->db->from('login');
	$this->db->where($array);
	$this->db->limit(1);
	$query = $this->db->get();
	if ($query->num_rows() > 0) {
	return TRUE ; } 
	else { return FALSE ; }
}

public function count_login()
{
	$this->db->select('COUNT(*) as total');
	$this->db->from('login');
	$query = $this->db->get();
	$row = $query->row_array();
	return $row['total']; 
}

public function ajout_login($id,$service,$agence,$mdp)
{
	$this->db->set('id_login',$id);
	$this->db->set('service',$service);
	$this->db->set('agence',$agence);
	$this->db->set('mdp',$mdp);
	return $this->db->insert($this->table_login);
}

public function efface_login($id)
{
	return $this->db->where('id_login', $id )->delete($this->table_login);
	return TRUE ;
}

public function get_login($id)
{
	$this->db->select('*');
	$this->db->from('login');
	$this->db->where('id_login',$id);
	$query = $this->db->get();
	$row = $query->row_array();
	return $row ;
}

public function get_login_id($service,$agence,$mdp)
{
	$array = array('service' => $service, 'agence' => $agence,'mdp' => $mdp);
	$this->db->select('id_login');
	$this->db->from('login');
	$this->db->where($array);
	$query = $this->db->get();
	$row = $query->row_array();
	return $row['id_login'] ;
}

}