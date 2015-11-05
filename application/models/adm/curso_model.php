<?php

class Curso_model extends CI_Model {
    
    private $tabela;
    
    function __construct() {
       parent::__construct();
       
       $this->tabela = 'curso';
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
    
    function get_materia($id){
        
        $this->db->selelct('*');
        
        $this->db>-from('curso_materia');
        
        $this->db->where('id_curso',$id);
        
        $resultado = $this->db->get();
        
         if($resultado->num_rows() > 0){
            return $resultado->result();
        }else{
            return FALSE;
        }
    }
    
    function get_complemento($id){
    
        $this->db->select('*');
        
        $this->db->from('curso');
        
        $this->db->where('id',$id);
        
        $result = $this->db->get();
        
        if($result->num_rows() > 0){
            return $result->row(0);
        }else{
            return FALSE;
        }
    }
    
    function get_by_name($nome){
    
        $this->db->select('*');
        
        $this->db->from('curso');
        
        $this->db->where('nome',$nome);
        
        $result = $this->db->get();
        
        if($result->num_rows() > 0){
            return $result->row(0);
        }else{
            return FALSE;
        }
    }
    
    function get_by_id($id){
    
        $this->db->select('id_curso');
        
        $this->db->from('curso_usuario');
        
        $this->db->where('id_usuario',$id);
        
        $result = $this->db->get();
        
        if($result->num_rows() > 0){
            return $result->result();
        }else{
            return FALSE;
        }
    }
    
    function get_cursos($id){
    
        $this->db->select('*');
        
        $this->db->from('curso_usuario AS cm');
        
        $this->db->where('id_usuario', $id);
        
        $this->db->join('curso AS c', 'c.id = cm.id_curso');
        
        $result = $this->db->get();
        
        if($result->num_rows() > 0){
            return $result->result();
        }else{
            return FALSE;
        }
    }
    
    
}
    
?>