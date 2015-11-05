<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        
        if($this->autenticacao->verifica_autenticacao()){
            
            redirect("adm/dashboard");
        }
        
        $this->load->library('form_validation');
        
        $this->load->library('session');
        
        $this->load->model('adm/usuario_model');
        
        $this->load->helper('form');
        
    }
    
    function index(){
        
        $this->load->view('adm/login/index');
    }
    
    ///*
    //@Parametro: NULL
    //@Descrição: Faz a validaçãod dos dados do login, autentica e redireciona.
    //@Retorno: NULL
    //*/
    function autenticar(){
        
        $regras = array(
            array(
                'field' => 'email',
                'label' => 'e-mail',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'senha',
                'label' => 'Senha',
                'rules' => 'trim|required'
            ),
        );
        
        $this->form_validation->set_rules($regras);
        
        $this->form_validation->set_error_delimiters('<label class="error">', '</label>');
        
        //Se a validação dos campos for false, atualiza a pagina,se nao autentica
        if($this->form_validation->run() == FALSE){
            $this->load->view('adm/login/index');
            
        }else{
            
            $email = $this->input->post('email');
            $senha = $this->input->post('senha');
            
            $result = $this->autenticacao->autenticar($email,$senha);
            
            if($result){
                //Se a autenticacao ocorreu com sucesso, redireciona para a dashboard
                redirect("adm/dashboard");
            }else{
                $verifica = $this->usuario_model->get_user($email);
            
                    if($verifica){
                        if($verifica->senha != $senha){
                        
                            $dados['msg'] = 'Senha incorreta';

                            $this->load->view('adm/login/index',$dados);
                        }
                    }else{
                        $dados['msg'] = 'Email não encontrado';

                        $this->load->view('adm/login/index',$dados);
                    }
            }
                    
            
        }
    }

}


