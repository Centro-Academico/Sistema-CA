<?php

class Grupo_model extends CI_Model {
    
    private $tabela;
    
    function __construct() {
       parent::__construct();
       
       $this->tabela = 'grupo';
    }
    
    /**
     Funcao get_all para capturar todas os grupos cadastradas
     Autor : Icaro Brito de Carvalho Messias
     Data  : 27/01/2015
     Parametro: Void
     retorno : array
    */
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
    
    function get_by_id($id){
    
        $this->db->select('id_grupo');
        
        $this->db->from('grupo_usuario');
        
        $this->db->where('id_usuario',$id);
        
        $result = $this->db->get();
        
        if($result->num_rows() > 0){
            return $result->result();
        }else{
            return FALSE;
        }
    }
}
