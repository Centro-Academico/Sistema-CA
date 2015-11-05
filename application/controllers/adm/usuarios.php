<?php

class Usuarios extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        
        if(!$this->autenticacao->verifica_acesso()){
            
            redirect('adm/acesso_negado');
        }
        
         $this->load->model(array(
            'adm/usuario_model',
            'adm/grupo_model',
            'adm/curso_model'
        ));
         
         $this->load->config('usuarios');
        
        $this->load->library('form_validation');
        
    }
    
    function index(){
        
        $dados['usuarios'] = $this->usuario_model->get_all();
        $dados['view']   =  'adm/usuarios/index';
        $dados['titulo'] = 'Gerenciar usuários';
        
        $this->load->view('/layout',$dados);
    }
    
    function cadastrar(){
        
        $dados['grupos'] = $this->grupo_model->get_all();
        $dados['curso'] = $this->curso_model->get_all();
        
        $dados['titulo'] = 'Cadastrar usuário';
        $dados['view']   = 'adm/usuarios/editar';
        $dados['js'][]   = 'plugins/jquery.validate';
        $dados['js'][]   = 'jquery.mask.min';
        $dados['js'][]   = 'pages/editar_usuario';
        
        $this->load->view('/layout',$dados);
        
    }
    
    function editar($id = NULL){
        
        $dados['usuario'] = $this->usuario_model->get_by_id($id);        
        $dados['grupos']  = $this->grupo_model->get_all();
        $dados['curso']  = $this->curso_model->get_all();
        
        $dados['titulo'] = 'Editar usuário';
        $dados['view']   = 'adm/usuarios/editar';        
        $dados['js'][]   = 'plugins/jquery.validate';
        $dados['js'][]   = 'jquery.mask.min';
        $dados['js'][]   = 'pages/editar_usuario';
        
        $this->load->view('/layout',$dados);
    }
    
    ///*
    //@Parametro: NULL
    //@Descrição: Valida e chama a model para salvar os dados de cadastro de um usuario
    //@Retorno: NULL
    //*/
    function salvar(){
        
         // Busca as regras de validacao nos arquivos de configuracao
        $regras = $this->config->item('regras_validacao');
        
        // Seta as regras na library de validacao
        $this->form_validation->set_rules($regras);
        
        // Seta o html das mensagens de validacao
        $this->form_validation->set_error_delimiters('<label class="control-label" for="inputError">', '</label>');
        
        
        $usuario = new stdClass();

        $id                         = $this->input->post('id');
        $usuario->nome              = $this->input->post('nome');
        $usuario->email             = $this->input->post('email');
        $usuario->rg                = $this->input->post('rg');
        $usuario->telefone          = $this->input->post('telefone');
        $usuario->logradouro        = $this->input->post('logradouro');
        $usuario->numero            = $this->input->post('numero');
        $usuario->matricula         = $this->input->post('matricula');
        $usuario->bairro            = $this->input->post('bairro');
        $usuario->cidade            = $this->input->post('cidade');
        $usuario->estado            = $this->input->post('estado');
        $usuario->status            = $this->input->post('status');
        $usuario->grupos            = $this->input->post('grupos');
        $usuario->curso             = $this->input->post('curso');
        $usuario->aprendizagem      = $this->input->post('aprendizagem');
        
        $senha = $this->input->post('senha');
        
        
        if ($this->form_validation->run() === FALSE) {
            
            // Caso os dados sejam invalidos exibe o formulario de validacao novamente
            
            $usuario->id = $id;
            $dados['usuario'] = $usuario; 
            $dados['grupos']  = $this->grupo_model->get_all();
            $dados['curso']  = $this->curso_model->get_all();
            
            $dados['titulo'] = 'Editar usuário';
            $dados['view']   = 'adm/usuarios/editar';
            $dados['js'][]   = 'pages/editar_usuario';
            
            $this->load->view('/layout',$dados);
        } else {
        
            
            // Se foi informada a senha do usuario criptografa ela
            if (!empty($senha)) {

                $usuario->senha = $senha;
            } else {
                if (empty($id)) {
                    $mensagem = array('msg' => 'erro', 'tipo' => 'danger');

                    $this->session->set_flashdata('msg', $mensagem);

                    redirect('adm/usuarios', 'refresh');
                }
            }

        // Verifica se deve atualizar ou inserir o registro
            
            if (empty($id)) {
                    
                // Caso nao seja informado o ID do registro a ser atualizado insere um novo
                $resultado = $this->usuario_model->inserir($usuario);
            } else {
                $usuario->id = $id;
                $resultado = $this->usuario_model->atualizar($usuario);
            }

            // Captura o resultado da operacao e seta a mensagem a ser exibida para o usuario
            if ($resultado) {

                if (empty($id)) {

                    $mensagem = array('msg' => 'insert-ok', 'tipo' => 'success');
                } else {

                    $mensagem = array('msg' => 'update-ok', 'tipo' => 'info');
                }
            } else {
                $mensagem = array('msg' => 'erro', 'tipo' => 'danger');
            }

            // Grava a mensagem numa flashdata
            $this->session->set_flashdata('msg', $mensagem);

            // Redireciona o usuario para a tela de gerenciamento
            redirect('adm/usuarios', 'refresh');
        }
    }
    
    function remover($id){
        
        // informa o banco de dados qual registro deve ser removido
        $resultado = $this->usuario_model->remover($id);
        
        // Captura o resultado da operacao
        if($resultado){
            
            $mensagem = array('msg' =>'delete-ok', 'tipo'=> 'success');
        }
        else{
            $mensagem = array('msg' =>'erro', 'tipo'=> 'danger');
        }
        
        // Seta a mensagem numa flashdata
        $this->session->set_flashdata('msg',$mensagem);
        
        //Redireciona para a tela de gerenciamento
        redirect('adm/usuarios', 'refresh');
    }
}
