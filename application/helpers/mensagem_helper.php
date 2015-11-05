<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


if(!function_exists('_mensagem_flashdata')){
    
    function _mensagem_flashdata(){
        
        $CI = &get_instance();
        
        $mensagem = $CI->session->flashdata('msg');
        
        $html_mensagem = '';
        
        if(!empty($mensagem)){
            
            $html_mensagem  = '<div class="row col-lg-12">';
            $html_mensagem .= '<div class="alert alert-' . $mensagem['tipo'] . ' alert-dismissable">';
            $html_mensagem .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
            $html_mensagem .= $CI->config->item($mensagem['msg']);
            $html_mensagem .= '</div>';
            $html_mensagem .= '</div>';            
        }
        return $html_mensagem;
    }
}