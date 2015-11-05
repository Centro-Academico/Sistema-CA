<?php

class Usuario_model extends CI_Model {
    
    private $tabela;
    
    function __construct() {
       parent::__construct();
       
       $this->load->model('adm/funcionalidade_model');
       
       $this->tabela = 'usuario';
    }
    
    
    /**
     Funcao get_all pega todos os usuarios cadastrados
     Autor : Icaro Brito de Carvalho Messias
     Data  : 27/01/2015
     Parametro: String contendo o email.
     retorno : objeto usuário
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
    
        $this->db->select('*');
        
        $this->db->from($this->tabela);
        
        $this->db->where('id', $id);
        
        $result = $this->db->get();
        
        if($result->num_rows() > 0){
            return $result->row(0);
        }else{
            return FALSE;
        }
    }
    
    function inserir($usuario){
        
        $grupos = $usuario->grupos;
        $curso = $usuario->curso;
        
        unset($usuario->grupos);
        unset($usuario->curso);
        
        $this->db->insert($this->tabela, $usuario);
        
        $inseriu_usuario = (bool)  $this->db->affected_rows();
        
        $id = $this->db->insert_id();
        
        $inseriu_grupos = $this->salvar_grupos($id,$grupos);
        
        $inseriu_curso = $this->insert_curso($id,$curso);
        
        return($inseriu_usuario && $inseriu_grupos && $inseriu_curso);
    }
    

    function atualizar($usuario){
        
        $grupos = $usuario->grupos;
        
        $curso = $usuario->curso;
        
        unset($usuario->grupos);
        unset($usuario->curso);
        
        $this->db->where('id', (int)$usuario->id);
        
        $this->db->update($this->tabela,$usuario);
        
        $atualizou_usuario = (bool)$this->db->affected_rows();
        
        $removeu_grupos = $this->remover_grupos($usuario->id);
        
        $removeu_curso = $this->remover_curso($usuario->id);
        
        $inseriu_curso = $this->insert_curso($usuario->id, $curso);
        
        $inseriu_grupos = $this->salvar_grupos($usuario->id, $grupos);
        
        return ($atualizou_usuario || ($removeu_grupos && $inseriu_grupos) || ($removeu_curso && $inseriu_curso));
    }
    

    function remover($id){
        
        $this->db->where('id', (int)$id);
        
        $this->db->delete($this->tabela);
        
        return (bool)$this->db->affected_rows();
    }

    function salvar_grupos($id, $grupos){
        
        
        $insert_array = array();
        
        //Itera sob os grupos selecionados no formulario preparando o array para 
        // Insercao em lote
        foreach ($grupos as $g){
            
            $insert_array[] = array(
                'id_usuario' => $id,
                'id_grupo'   => $g
            );
        }
        
        // Se ha valores a serem inseridos
        if(sizeof($insert_array) > 0 ){
            
            // Realiza a insercao em lote
            $this->db->insert_batch('grupo_usuario', $insert_array);
            
            return (bool)$this->db->affected_rows();
        }
        
        return true;
    }
         

    function remover_grupos($id){
        
        $this->db->where('id_usuario',(int)$id);
        
        $this->db->delete('grupo_usuario');
        
        return (bool)$this->db->affected_rows();
    }
    
    function insert_curso($usuario,$curso){
        
        $insert_array = array();
        
        foreach ($curso as $c){
            
            $insert_array[] = array(
                'id_usuario' => $usuario,
                'id_curso'   => $c
            );
        }
        
        // Se ha valores a serem inseridos
        if(sizeof($insert_array) > 0 ){
            
            // Realiza a insercao em lote
            $this->db->insert_batch('curso_usuario', $insert_array);
            
            return (bool)$this->db->affected_rows();
        }
        
        return true;
        
    }
    
    
    function remover_curso($id){
        
        $this->db->where('id_usuario',(int)$id);
        
        $this->db->delete('curso_usuario');
        
        return (bool)$this->db->affected_rows();
    }
    
    function get_user($email){
    
        $this->db->select('*');
        
        $this->db->from($this->tabela);
        
        $this->db->where('email', $email);
        
        $result = $this->db->get();
        
        if($result->num_rows() > 0){
            return $result->row(0);
        }else{
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
    
    function get_curso_by_id($id = NULL){
        
        $this->db->select('*');
        
        $this->db->from('curso_usuario');
        
        $this->db->join('curso','curso_usuario.id_curso = curso.id');
        
        $this->db->where('id_usuario',$id);
        
        $resultado = $this->db->get();
        
        if($resultado){
            
            return $resultado->result();
        }else{
            return FALSE;
        }
        
    }
    
    
    
}
