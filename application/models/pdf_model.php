<?php if ( ! defined('BASEPATH')) exit('No direct script access
allowed');

class Pdf_model extends CI_Model
{
protected $table = 'bordereau';
protected $table2 = 'commandes';
public function __construct()
{
	// Obligatoire
	parent::__construct();
	$this->load->database();
	
}
 
public function numeroauto()
{
	$this->db->select('num');
	$this->db->from('bordereau');
	$this->db->limit(1);
	$query = $this->db->get();
	if ($query->num_rows() > 0) {
	$row = $query->row_array();
	return $row['num'] ; } 
	else { return FALSE ; }
}

public function incrementer()
{
	$this->db->select('num');
	$this->db->from('bordereau');
	$this->db->limit(1);
	$query = $this->db->get();
	$row = $query->row_array();
	$this->db->set('num',$row['num']+1);
	return $this->db->update($this->table);
}

public function decrementer()
{
	$this->db->select('num');
	$this->db->from('bordereau');
	$this->db->limit(1);
	$query = $this->db->get();
	$row = $query->row_array();
	$this->db->set('num',$row['num']-1);
	return $this->db->update($this->table);
}

public function numerohavas()
{
	$this->db->select('num_havas');
	$this->db->from('bordereau');
	$this->db->limit(1);
	$query = $this->db->get();
	if ($query->num_rows() > 0) {
	$row = $query->row_array();
	return $row['num_havas'] ; } 
	else { return FALSE ; }
}

public function incremente_havas()
{
	$this->db->select('num_havas');
	$this->db->from('bordereau');
	$this->db->limit(1);
	$query = $this->db->get();
	$row = $query->row_array();
	$this->db->set('num_havas',$row['num_havas']+1);
	return $this->db->update($this->table);
}


public function test_login($s,$a,$mdp)
{
	$query = $this->db->query('SELECT * FROM login WHERE service="'.$s.'" AND agence="'.$a.'" AND mdp="'.$mdp.'" LIMIT 1' );
	if ($query->num_rows() > 0) 
		{
			return TRUE; 
		}
	else{ return FALSE; }
}

public function login($a,$b){
	$query = $this->db->query('SELECT * FROM administrateur WHERE login="'.$a.'" AND mdp="'.$b.'" LIMIT 1' );
	if ($query->num_rows() > 0) 
		{
			return TRUE; 
		}
	else{ return FALSE; }
}


public function ajout($id,$data,$agence,$service,$fournisseur,$ref,$date,$ttc,$etat,$devise)
{
	$this->db->set('id_cmd',$id);
	$this->db->set('liste',serialize($data));
	$this->db->set('agence',$agence); 
	$this->db->set('service',$service);
	$this->db->set('fournisseur',$fournisseur);
	$this->db->set('ref',$ref);
	$d=$date['year']."-".$date['mon']."-".$date['mday'];
	$this->db->set('date',$d);
	$this->db->set('ttc',$ttc);
	$this->db->set('etat',$etat);
	$this->db->set('cmd_devise',$devise);
	return $this->db->insert($this->table2);
}

public function statistique()
{
	$this->db->select('id_cmd, COUNT(id_cmd) as total, service, agence, year(date) as an, etat');
	$this->db->from('commandes');
	$this->db->where("etat",'fc');
	$this->db->group_by(array("year(date)", "service", "agence" )); 
	$query = $this->db->get();
	$row=$query->result();
	return $row;	
}

public function stat($a)
{
	$this->db->select('id_cmd, COUNT(id_cmd) as total, service, agence, year(date) as an');
	$this->db->from('commandes');
	$this->db->where("year(date)",$a);
	$this->db->group_by(array("year(date)", "service", "agence" )); 
	$query = $this->db->get();
	$row=$query->result();
	return $row;	
}

public function agence($a)
{
	$array = array('agence' => $a, 'etat' => 'fc');
	$this->db->select('id_cmd, COUNT(id_cmd) as total, service, agence, year(date) as an');
	$this->db->from('commandes');
	$this->db->where($array);
	$this->db->group_by(array("year(date)", "service")); 
	$query = $this->db->get();
	$row=$query->result();
	return $row;		
}

public function service($s)
{
	$array = array('service' => $s, 'etat' => 'fc');
	//$this->db->where("etat",'fc');
	$this->db->select('id_cmd, COUNT(id_cmd) as total, service, agence, year(date) as an');
	$this->db->from('commandes');
	$this->db->where($array);
	$this->db->group_by(array("year(date)", "agence")); 
	$query = $this->db->get();
	$row=$query->result();
	return $row;		
}

public function annuler($a,$b)
{
	$c=getdate();
	$d=$c['year'].'-'.$c['mon'].'-'.$c['mday'];
	$array = array('agence' => $a, 'service' => $b, 'date' => $d);
	$this->db->select('id_cmd, service, agence,date as mois');
	$this->db->from('commandes');
	$this->db->where($array);
	$query = $this->db->get();
	$row=$query->result();
	return $row;
}

public function annul($a,$b)
{
	$c=getdate();
	$d=$c['year'].'-'.$c['mon'].'-'.$c['mday'];
	$array = array('agence' => $a, 'service' => $b, 'date' => $d);
	$this->db->select('id_cmd, service, agence,date as mois');
	$this->db->from('commandes');
	$this->db->where($array);
	$query = $this->db->get();
	$row=$query->result();
	return $row;
}
 
public function efface($id)
{
	return $this->db->where('id_cmd', $id )->delete($this->table2);
	return TRUE ;
}

public function mois($a,$b,$an)
{
	$array = array('agence' => $a, 'service' => $b,'year(date)' => $an, 'etat' => 'fc', 'cmd_devise' => 'Ar' );
	$this->db->select('id_cmd, COUNT(id_cmd) as total, service, agence, monthname(date) as mois, Sum(ttc) as taxe, etat');
	$this->db->from('commandes');
	$this->db->where($array);
	$this->db->group_by("mois");
	$query = $this->db->get();
	$row=$query->result();
	return $row;
}

public function jour($a,$b,$m,$an)
{
	$array = array('agence' => $a, 'service' => $b,'year(date)' => $an,'monthname(date)' => $m, 'etat' => 'fc');
	$this->db->select('id_cmd,date,fournisseur,ttc,cmd_devise');
	$this->db->from('commandes');
	$this->db->where($array);
	$query = $this->db->get();
	$row=$query->result();
	return $row;
}

public function cmd($id)
{
	$this->db->select('liste');
	$this->db->from('commandes');
	$this->db->where('id_cmd',$id);
	$query = $this->db->get();
	$row = $query->row_array();
	$a= unserialize($row['liste']);
	return $a;

}


public function bc($a,$s)
{
	$e='BC';
	$array = array('agence' => $a, 'service' => $s, 'etat'=>$e);
	$this->db->select('*');
	$this->db->from('commandes');
	$this->db->where($array);
	$query = $this->db->get();
	$row=$query->result();
	return $row;
}


public function bl($a,$s)
{
	$e='BL';
	$array = array('agence' => $a, 'service' => $s, 'etat'=>$e);
	$this->db->select('*');
	$this->db->from('commandes');
	$this->db->where($array);
	$query = $this->db->get();
	$row=$query->result();
	return $row;
}

public function facture($a,$s)
{
	$e='f';
	$array = array('agence' => $a, 'service' => $s, 'etat'=>$e);
	$this->db->select('*');
	$this->db->from('commandes');
	$this->db->where($array);
	$query = $this->db->get();
	$row=$query->result();
	return $row;
}

public function accueilcompta()
{
	$tmp='';
	$array = array('etat' => $tmp);
	$this->db->select('id_cmd, COUNT(id_cmd) as total,service,agence');
	$this->db->from('commandes');
	$this->db->where($array);
	//$this->db->group_by("service","agence"); 
	$this->db->group_by("service"); 
	$query = $this->db->get();
	$row=$query->result();
	return $row;
}

public function archivecompta()
{
	$tmp='fc';
	$array = array('etat' => $tmp);
	$this->db->select('id_cmd, COUNT(id_cmd) as total,service,agence');
	$this->db->from('commandes');
	$this->db->where($array);
	//$this->db->group_by("service","agence"); 
	$this->db->group_by("service"); 
	$query = $this->db->get();
	$row=$query->result();
	return $row;
}

public function servicecompta($a,$s)
{
	$tmp='';
	$array = array('etat' => $tmp,'agence' => $a, 'service' => $s);
	$this->db->select('*');
	$this->db->from('commandes');
	$this->db->where($array);
	$query = $this->db->get();
	$row=$query->result();
	return $row;
}

public function facturecompta($id)
{
	$d=getdate();
	$date=$d['year'].'-'.$d['mon'].'-'.$d['mday'];
	$this->db->set('etat','fc');
	$this->db->set('date_compta',$date);	
	$this->db->where('id_cmd',$id);
	$this->db->limit(1);
	return $this->db->update($this->table2);
}

public function livrer($id)
{
	$this->db->set('etat','BL');
	$this->db->where('id_cmd',$id);
	$this->db->limit(1);
	return $this->db->update($this->table2);
}

public function facturer($id)
{
	
	$this->db->select('etat');
	$this->db->from('commandes');
	$this->db->set('etat','f');
	$this->db->where('id_cmd',$id);
	$this->db->limit(1);
	return $this->db->update($this->table2);
}

public function valider($id)
{
	$this->db->set('etat',' ');
	$this->db->where('id_cmd',$id);
	$this->db->limit(1);
	return $this->db->update($this->table2);
}

public function annee($b, $a)
{
	$array = array('agence' => $a, 'service' => $b, 'etat' => 'fc', 'cmd_devise' => 'Ar');
	$this->db->select('id_cmd, COUNT(id_cmd) as total,year(date) as an');
	$this->db->from('commandes');
	$this->db->where($array);
	$this->db->group_by("year(date)"); 
	$query = $this->db->get();
	$row=$query->result();
	return $row;
}

public function get_fournisseur($id_login)
{
	$this->db->select('nom_fournisseur');
	$this->db->from('fournisseur');
	$this->db->where('id_login',$id_login);
	$query = $this->db->get();
	$row = $query->result();
	return $row ;  	
}

public function get_ss_rubrique($id)
{
	$this->db->select('*');
	$this->db->from('sous_rubrique');
	$this->db->where('rub_id',$id);
	$query = $this->db->get();
	$row = $query->result();
	return $row ;  	
}

public function get_rubrique()
{
	$this->db->select('rub_lib,rub_id');
	$this->db->from('rubrique');
	$query = $this->db->get();
	$row = $query->result();
	return $row ;  	
}

public function enregistrer_livraison($data,$id_cmd){
	$this->db->set("num_bl",$data['num_bl'])
			 ->set("date_bl",date("Y-m-d"))
			 ->set("etat",$data['etat'])
			 ->where("id_cmd",$id_cmd);
	$res = $this->db->update('commandes');
	return $res ;
}

public function enregistrer_facture($data,$id_cmd){
	$date = "";
	$this->db->set("num_facture",$data['num_facture'])
			 ->set("date_facture",date("Y-m-d"))
			 ->set("etat",$data['etat'])
			 ->where("id_cmd",$id_cmd);
	$res = $this->db->update('commandes');
	return $res ;
}

}
