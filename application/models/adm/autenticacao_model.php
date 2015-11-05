<?php

class Autenticacao_model extends CI_Model {
    
    function __construct() {
       parent::__construct();
       
       $this->load->model('adm/funcionalidade_model');
       
    }
    
    function get_user($email){
       
        $this->db->select('u.id, u.nome, u.email,u.senha, gu.id_grupo');
        
        $this->db->join('grupo_usuario AS gu', 'gu.id_usuario = u.id');
        
        $this->db->from('usuario AS u');
        
        
        $this->db->where('u.email', $email);
        
        $this->db->where('u.status',1);
        
        $resultado = $this->db->get();
        
        if($resultado->num_rows() > 0){
            
            $funcionalidades = $this->get_itens_menu($resultado->row(0)->id);
            
            $funcionalidades = $this->menu->retira_iguais($funcionalidades);
            
            $usuario = $resultado->row(0);
            $usuario->grupos = array();
            
            foreach ($resultado->result() as $g){
                
                $usuario->grupos[]          = $g->id_grupo;
            }
            
            $usuario->funcionalidades = $funcionalidades;
            
            return $usuario;
        }
        else{
            return FALSE;
        }
    }
    
    function get_itens_menu($id){
        
        $this->db->select('id_grupo');
        
        $this->db->from('grupo_usuario');
        
        $this->db->where('id_usuario', $id);
        
        $grupos = $this->db->get();
        
        $resultado = $grupos->result();
        
        for($i = 0; $i < sizeof($resultado); $i++ ){
            
            $fun = $this->get_funcionalidade($resultado[$i]->id_grupo);

            if($fun){
                for($j = 0; $j < sizeof($fun); $j++){
                    $new_fun = $this->funcionalidade_model->get_by_id($fun[$j]->id_funcionalidade);
                    $funcionalidade[] = $new_fun;    
                }
            }
        }
        
        if(sizeof($funcionalidade) > 0){
            return $funcionalidade;
        }else{
            return FALSE;
        }
    }
    
    function get_funcionalidade($id_grupo){
        
        $this->db->select('id_funcionalidade');
        
        $this->db->from('funcionalidade_grupo');
        
        $this->db->where('id_grupo', $id_grupo);
        
        $funcionalidade = $this->db->get();
        
        if($funcionalidade->num_rows() > 0){
            return $funcionalidade->result();
        }else{
            return FALSE;
        }
    }
    
    
    
    function get_permission($url, $grupos){
        
        $this->db->select('fg.*,f.url');
        
        $this->db->from('funcionalidade_grupo AS fg');
        
        $this->db->join('funcionalidade AS f', 'f.id = fg.id_funcionalidade');

        $this->db->where('f.url',$url);
        
        $this->db->where_in('fg.id_grupo',$grupos);
        
        $resultado = $this->db->get();
        
        if($resultado->num_rows() > 0){
            
            // Retorna a primeira permissao
            return $resultado->row(0);
        }
        else{

            // Caso nao encontre permissoes retorna FALSE
            return FALSE;
        }
        
    }
    
    
}