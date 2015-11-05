<?php

class Minha_conta extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        
         $this->load->model(array(
            'adm/usuario_model',
            'adm/grupo_model'
        ));
        
        $this->load->library('form_validation');
        
        $this->load->helper('form');
    }
    
    function index(){
        
        $id = $this->session->userdata('usuario_id');
        
        $dados['usuario'] = $this->usuario_model->get_by_id($id);        
        $dados['grupos']  = $this->grupo_model->get_all();
        
        $dados['titulo'] = 'Minha conta';
        $dados['view']   = 'adm/usuarios/editar';        
        
        $this->load->view('/layout',$dados);
    }
    ///*
    //@Parametro: NULL
    //@Descrição: Funcao que salva alterações do usuario logado
    //@Retorno: NULL
    //*/
    function salvar(){
        
        // Seta o html das mensagens de validacao
        $this->form_validation->set_error_delimiters('<label class="error">', '</label>');
        
        
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
        $usuario->status            = "1";
        $usuario->grupos            = $this->input->post('grupos');
        
//        echo '<pre>';
//        print_r($usuario);
//        die('</pre>');
        
            //die("validacao true");
//            // Caso os dados sejam validos salva no banco de dados
//            
            $senha = $this->input->post('senha');
            
            
            // Se foi informada a senha do usuario criptografa ela
            if (!empty($senha)) {

                $usuario->senha = $senha;
                
            }else{
                if(empty($id)){
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
