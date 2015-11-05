<?php if (!defined('BASEPATH'))     exit('No direct script access allowed');

class Acesso_negado extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        
        $autenticado = $this->autenticacao->verifica_autenticacao();
        
        if(!$autenticado){
            
            redirect($this->config->item('area_admin') . '/login');
        }
    }
    
    function index(){
        
        echo 'Acesso negado';
    }
}