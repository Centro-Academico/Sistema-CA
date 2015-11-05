<?php

class Materia_model extends CI_Model {
    
    private $tabela;
    
    function __construct() {
       parent::__construct();
       
       $this->tabela = 'materia';
    }
    

    function get_all(){
    
        $this->db->select('*');
        
        $this->db->from($this->tabela);
        
        $result = $this->db->get();
        
        if($result->num_rows() > 0){
            return $result->result();
        }else{
            return FALSE;
        }
    }
    
    function get_by_id($id = NULL){
    
        $this->db->select('*');
        
        $this->db->from($this->tabela);
        
        $this->db->where('id',$id);
        
        $result = $this->db->get();
        
        if($result->num_rows() > 0){
            return $result->result();
        }else{
            return FALSE;
        }
    }
    
    function get_curso($id){
        
        $this->db->selelct('*');
        
        $this->db>-from('curso_materia');
        
        $this->db->where('id_materia',$id);
        
        $resultado = $this->db->get();
        
         if($resultado->num_rows() > 0){
            return $resultado->result();
        }else{
            return FALSE;
        }
    }
    
    function get_by_curso($id = NULL){
        
        $this->db->select('*');
        
        $this->db->from('curso_materia');
        
        $this->db->join('materia','curso_materia.id_materia = materia.id');
        
        $this->db->where('id_curso',$id);
        
        $resultado = $this->db->get();
        
        if($resultado){
            return $resultado->result();
        }else{
            return FALSE;
        }
    }
}
    
?>