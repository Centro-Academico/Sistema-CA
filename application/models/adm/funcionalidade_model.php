<?php

class Funcionalidade_model extends CI_Model {
    
    private $tabela;
    
    function __construct() {
       parent::__construct();
       
       $this->tabela = 'funcionalidade';
    }
    
    /**
     Funcao get_all para capturar todas as funcionalidades cadastradas
     Autor : Icaro Brito de Carvalho Messias
     Data  : 27/01/2015
     Parametro: Void
     retorno : array
    */
    function get_all(){
    
        $this->db->select('*');
        
        $this->db->from($this->tabela);
        
        $resultado = $this->db->get();
        
        if($resultado->num_rows() > 0){
            return $resultado->result();
        }else{
            return FALSE;
        }
    }
    
    /**
     Funcao get_by_id para capturar as informações da funcionalidade cadastrada
     Autor : Icaro Brito de Carvalho Messias
     Data  : 28/01/2015
     Parametro: int
     retorno : array
    */
    function get_by_id($id){
    
        $this->db->select('*');
        
        $this->db->from($this->tabela);
        
        $this->db->where('id',$id);
        
        $resultado = $this->db->get();
        
        if($resultado->num_rows() > 0){
            return $resultado->row(0);
        }else{
            return FALSE;
        }
    }
}
