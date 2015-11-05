<?php

class Arquivo_model extends CI_Model {
    
    private $tabela;
    
    function __construct() {
       parent::__construct();
       
       $this->tabela = 'arquivos';
    }
    
    function get_all(){
    
        $this->db->select('*');
        
        $this->db->where('status',1);
        
        $this->db->from($this->tabela);
        
        $result = $this->db->get();
        
        if($result->num_rows() > 0){
            return $result->result();
        }else{
            return FALSE;
        }
    }
    
    function inserir($arquivo){                 
        
        $this->db->insert($this->tabela, $arquivo);
        
        $inseriu_arquivo = (bool)  $this->db->affected_rows();
        
        
        return $inseriu_arquivo;
    }
    

    function atualizar($arquivo){
        
        $this->db->where('id', (int)$arquivo->id);
        
        $this->db->update($this->tabela,$arquivo);
        
        $atualizou_arquivo = (bool)$this->db->affected_rows();
        
        
        return $atualizou_arquivo;
    }
    
    function get_by_id($id = NULL){
        
        $this->db->select('*');
        
        $this->db->from($this->tabela);
        
        $this->db->where('id',$id);
        
        $this->db->where('status','1');
        
        $result = $this->db->get();
        
        if($result->num_rows() > 0){
            return $result->result();
        }else{
            return FALSE;
        }
    }
    
    function get_by_materia($id = NULL){
        
        $this->db->select('*');
        
        $this->db->from($this->tabela);
        
        $this->db->where('materia_id',$id);
        
        $this->db->where('status',1);
        
        $result = $this->db->get();
        
        if($result->num_rows() > 0){
            return $result->result();
        }else{
            return FALSE;
        }
    }
    
    function get_by_mes($id = NULL,$data = NULL){
        
        $this->db->select('*');
        
        $this->db->from($this->tabela);
        
        $this->db->where('materia_id',$id);
        
        $this->db->like('data_registro',$data);
        
        $result = $this->db->get();
        
        if($result->num_rows() > 0){
            return $result->result();
        }else{
            return FALSE;
        }
    }
    
    function get_by_materia_curso($curso = NULL,$materia = NULL){
        
        $this->db->select('*');
        
        $this->db->from($this->tabela);
        
        $this->db->where('materia_id',$materia);
        $this->db->where('curso_id',$curso);
        $this->db->where('status',1);
        
        $result = $this->db->get();
        
        if($result->num_rows() > 0){
            return $result->result();
        }else{
            return FALSE;
        }
    }
    
     function remover($arquivo){
         
        $arquivo[0]->status = 0;
        
        $this->db->where('id', $arquivo[0]->id);
        
        $this->db->update($this->tabela,$arquivo[0]);
        
        return (bool)$this->db->affected_rows();
    }
    
    
    
    
    
}
    
?>