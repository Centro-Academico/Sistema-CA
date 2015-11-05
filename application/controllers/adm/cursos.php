<?php

class Cursos extends CI_Controller{
    
    function __construct() {
        parent::__construct();            
        
        if(!$this->autenticacao->verifica_acesso()){
            
            redirect('adm/acesso_negado');
        }
        
        $this->load->model('adm/materia_model');
    }
    ///*
    //@Parametro:NULL
    //@Descrição: chama a pagina inicial de cursos
    //@Retorno: NULL
    //*/
    function index(){        
        
        $dados['titulo'] = 'Sistema de Ensino Aprendizagem';
        $dados['view']   =  'adm/cursos/index';
        
        $this->load->view('/layout',$dados);
        
    }
    ///*
    //@Parametro: ID do curso
    //@Descrição: Funcao criada para o ajax do dropdawn de cursos matérias
    //@Retorno: NULL
    //*/
    function get_materia($id){
        
        $materia = $this->materia_model->get_by_curso($id);
        
        if( empty($materia)){
            return '{"nome":"Nenhuma materia econtrada"}';
        }
        
        echo json_encode($materia);
        
        return;
    }
    
    
    
    
   
}
