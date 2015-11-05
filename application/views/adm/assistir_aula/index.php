
    <?php 
        echo _mensagem_flashdata();
        
        
        if(isset($caminho)){
            $path = $caminho;
        }else{
            $path = './img/defalt';
        }
        
        $diretorio = dir($path);
        
        
        $all_arquivos = array();
        $i = 0;
        while ($arquivo = $diretorio->read()) {
            if(($arquivo != '.') && ($arquivo != '..')){
                $nome = explode('.', $arquivo);
                $all_arquivos[$i]->nome = $nome[0];
                
                if(isset($nome[1])){
                    
                    $all_arquivos[$i]->extencao = $nome[1];
                }else{
                    $all_arquivos[$i]->extencao = '';
                }
                
                $all_arquivos[$i]->caminho = $path . '/' . $arquivo;
                
                $i+=1;
            }
        }
        $diretorio -> close();
        
        $materias = $this->materia_model->get_by_curso($curso);
        
        $usuario_curso = $this->curso_model->get_complemento($curso);

    ?>
    

    <div class="col-lg-12">
    <h1 class="page-header">
       <?php 
        echo $usuario_curso->nome;
        ?>
    </h1>
    
    <div class="row">
        <?php 
        for($i = 0; $i < sizeof($materias); $i++){
            $link  = base_url('adm/assistir_aula/listar/' . $materias[$i]->id_materia . "/" . $curso);
            echo '<a href="' . $link . '">';
            echo '<h4>';
            echo $materias[$i]->nome;
            echo '</h4>';
            echo '</a>';
        }
        ?>
                
    </div>
    
</div>