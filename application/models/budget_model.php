<?php if ( ! defined('BASEPATH')) exit('No direct script access
allowed');

class Budget_model extends CI_Model
{
protected $table = 'budget_commande';
public function __construct()
{
	// Obligatoire
	parent::__construct();
	$this->load->database();	
}
 
public function select_all_cmd($sous_rubrique)
{
	$this->db->select('*');
	$this->db->from($this->table2);
	$this->db->where('sous_rubrique',$sous_rubrique);
	$query = $this->db->get();
	$row = $query->result();
	return $row ;  	
}


public function select_montant()
{
	$this->db->select('SUM(montant_cmd) AS montant');
	$this->db->from($table);
	$this->db->group_by('sous_rubrique');
	$query = $this->db->get();
	$row = $query->result();
	return $row ;  	
}

public function ajout($nom,$montant,$total,$qte,$sous_rubrique,$ref,$date,$service,$agence,$devise)
{
	$this->db->set('nom_cmd',$nom); 
	$this->db->set('pu_cmd',$montant);
	$this->db->set('montant_cmd',$total);
	$this->db->set('sous_rubrique',$sous_rubrique);
	$this->db->set('num_cmd',$ref);
	$d=$date['year']."-".$date['mon']."-".$date['mday'];
	$this->db->set('date_cmd',$d);
	$this->db->set('budget_service',$service);
	$this->db->set('budget_agence',$agence);
	$this->db->set('qte_cmd',$qte);
	$this->db->set('devise',$devise);
	return $this->db->insert($this->table);
}

public function get_montant($sous_rubrique)
{
	$array = array('sous_rubrique' => $sous_rubrique, 'budget_validation' => 1, 'devise' => 'Ar');
	$this->db->select('SUM(montant_cmd) as total');
	$this->db->from($this->table);
	$this->db->where($array);
	//$this->db->group_by('sous_rubrique');
	$query = $this->db->get();
	$row = $query->row_array();
	return $row['total']; 
}

public function get_cmd($num_cmd)
{
	$this->db->select('*');
	$this->db->from($this->table);
	$this->db->where('num_cmd',$num_cmd);
	$query = $this->db->get();
	$row = $query->result();
	return $row ; 
}

public function compter_article($num_cmd)
{
	$this->db->select('COUNT(*) AS total');
	$this->db->from($this->table);
	$this->db->where('num_cmd',$num_cmd);
	$query = $this->db->get();
	$row = $query->row_array();
	return $row['total'] ; 
}

public function update_qte($id,$qte)
{
	$this->db->set('qte_cmd',$qte);	
	$this->db->where('id_budget',$id);
	return $this->db->update($this->table);
}

public function valid_budget($id_cmd)
{
	$this->db->set('budget_validation',1);	
	$this->db->where('num_cmd',$id_cmd);
	return $this->db->update($this->table);
}

}