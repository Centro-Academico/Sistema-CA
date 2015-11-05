<?php

class Dashboard extends CI_Controller{
    
    function __construct() {
        parent::__construct();            
        
    }
    
    function index(){        
        
        $dados['titulo'] = 'Sistema de Ensino Aprendizagem';
        $dados['view']   =  'adm/dashboard/index';       
        
        $this->load->view('/layout',$dados);
        
    }
    
    
    
   
}
