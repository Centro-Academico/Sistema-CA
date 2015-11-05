<?php

class Assistir_aula extends CI_Controller{
    
    function __construct() {
        parent::__construct();            
        
        //Verifica acesso de acordo com o grupo
        if(!$this->autenticacao->verifica_acesso()){
            
            redirect('adm/acesso_negado');
        }
        
        //Carrega as models que serão necessarias
        $this->load->model(array(
                        'adm/usuario_model',
                        'adm/materia_model',
                        'adm/arquivo_model',
                        'adm/curso_model'));
        //Carrega  a library de validação do codeigniter
        $this->load->library('form_validation');
    }
    
    ///*
    //@Parametro: String contendo o caminho a ser mostrado
    //@Descrição: Pega os cursos e chama view de assistir aula
    //@Retorno: NULL
    //*/
    function index($value = null)
    {	
       
        $id =  $this->session->userdata('usuario_id');
        
        $dados['cursos'] = $this->usuario_model->get_curso_by_id($id);
        $dados['titulo'] = 'Sistema de Ensino Aprendizagem';
        $dados['view']   =  'adm/assistir_aula/curso';
        $dados['caminho']     =  $value;   
        $dados['js']     =  array('pages/editar_curso');
        
        $this->load->view('/layout',$dados);
        
    }
    
    
    ///*
    //@Parametro: NULL
    //@Descrição: Mostra a segunda view, onde o aluno escolhe o curso e lista as materias
    //@Retorno: NULL
    //*/
    function materia()
    {	
        $curso   = $this->input->post('curso');
        $dados['curso']  =  $curso; 
        $dados['titulo'] = 'Sistema de Ensino Aprendizagem';
        $dados['view']   =  'adm/assistir_aula/index';
        $dados['js']     =  array('pages/editar_curso');
        
        $this->load->view('/layout',$dados);
        
    }
    ///*
    //@Parametro: ID da materia, ID do Curso
    //@Descrição: Chama a view que mostra o conteudo da matéria escolhida
    //@Retorno: NULL
    //*/
    function listar($materia = NULL, $curso = NULL)
    {
        $a_materia = $this->materia_model->get_by_id($materia);
        
        if($materia){
            $dados['materia'] = $a_materia[0]->nome;
            $dados['materia_id'] = $a_materia[0]->id;
            $dados['all_arquivos'] = $this->arquivo_model->get_all();
            $dados['curso'] = $curso;
            $dados['titulo'] = 'Sala online';
            $dados['view'] = "adm/assistir_aula/aula";
            $this->load->view('/layout',$dados);
        }
            
    }	
    
    
    
   
}
