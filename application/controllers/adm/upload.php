<?php

class Upload extends CI_Controller {
	
    
    public function __construct() {
        parent::__construct();
         
        if(!$this->autenticacao->verifica_acesso()){
            
            redirect('adm/acesso_negado');
        }
            $this->load->helper(array('form', 'url'));
            
            $this->load->model(array(
            'adm/curso_model',
            'adm/materia_model',
            'adm/arquivo_model'
        ));
    }
	
    ///*
    //@Parametro: String value contendo o caminho a ser mostrado,Int valida que verifica upload ou não, Int id com
    // o id da materia
    //@Descrição: Chama a view principal de upload
    //@Retorno: NULL
    //*/
    function index($value = null,$valida = null,$mat = null)
    {	

            $id = $this->session->userdata('usuario_id');
            
            $dados['cursos']      = $this->curso_model->get_cursos($id);
            $dados['materias']    = $this->materia_model->get_all();
            $dados['caminho']     =  $value; 
            $dados['materia']     = $mat;
        
            $dados['titulo'] = 'Sistema de Ensino Aprendizagem';
            $dados['view']   =  'adm/enviar_aula/index';
            $dados['js']     =  array('pages/editar_curso');
            $dados['error'] = 'teste';
            
            if($valida == 1){
                 redirect('adm/upload/', 'refresh');
            }else{
                $this->load->view('/layout',$dados);
            }

            
    }
    ///*
    //@Parametro: NULL
    //@Descrição: Carrega a view contendo os botões de de arquivo, faz upload ou lista
    //@Retorno: NULL
    //*/
    function do_upload()
    {
        $arquivo = new stdClass();

        $arquivo->curso_id             = $this->input->post('curso');
        $arquivo->materia_id           = $this->input->post('materia');
        $arquivo->data_registro        = $this->input->post('data');
        $arquivo->descricao            = $this->input->post('descricao');
        $arquivo->tipo_aprendizagem    = $this->input->post('tipo_aprendizagem');
        $arquivo->nome_arquivo         = $_FILES['userfile']['name'];
        $arquivo->caminho = './img/' . $arquivo->curso_id . '/' . $arquivo->materia_id;
        $arquivo->status = "1";
        
        //Se for submit, se foi enviado um aquivo para upload
        if(isset($_POST['submit'])){

            //Configurações para upload do arquivo
            $config['upload_path'] = $arquivo->caminho;
            //Todos os tipos de arquivos que são aceitos
            $config['allowed_types'] = 'gif|jpg|png|pdf';
            //tamanho maximo do arquivo
            $config['max_size']	= '1000';
            $config['max_width']  = '0';
            $config['max_height']  = '0';
            
            //Se não existir a pasta do curso/materia, criar
            if(!file_exists($config['upload_path'])){
                mkdir('./img/' . $arquivo->curso_id . '/' . $arquivo->materia_id, 0777, TRUE);
            }

            $this->upload->initialize($config);
            
            //Validação de erro
            if ( ! $this->upload->do_upload())
            {
                    $dados['erro'] = array('error' => $this->upload->display_errors());
                    $dados['view'] = 'adm/enviar_aula/erro';
                    $this->load->view('/layout', $dados);
            }	
            else{
                $arquivo->status = "1";
                               
                if($this->arquivo_model->inserir($arquivo)){
                        
                    $mensagem = array('msg' => 'sucesso', 'tipo' => 'success');
                  
                    $this->session->set_flashdata('msg', $mensagem);
                    $valida = 1;
                }

                $this->index($config['upload_path'],$valida);

            }
        }else if(isset($_POST['publish'])){
            
            $this->index($arquivo->caminho,0,$_POST['materia']);
        }
    }	
    
    function remover($id){
        
        $arquivo = $this->arquivo_model->get_by_id($id);
  
        if($this->arquivo_model->remover($arquivo)){
            redirect('adm/upload/', 'refresh');
        }
    }
}
?>