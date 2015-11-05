

<div class="col-lg-12">
    <?php 
          echo _mensagem_flashdata();
    ?>
    <h1 class="page-header">
       Aula / professor
    </h1>
    <ol class="breadcrumb">
        <li>
            <i class="fa fa-dashboard"></i>  <a href="<?php echo base_url('adm/upload');?>">Aula</a>
        </li>
    </ol>
  

    <?php 
    
        $i = 0;
        foreach ($cursos as $key => $c){
            $id_curso[$i] = $c->id;
            $nome_curso[$i] = $c->nome;
            $i++;
        }
        
        $drop_cursos = array();
        $i = 0;
        $drop_cursos[''] = 'Selecione';
        for($i = 0; $i < sizeof($id_curso); $i++){
                $drop_cursos[$id_curso[$i]] = $nome_curso[$i];        
        };
        
        
        $j = 0;
        foreach ($materias as $key => $m){
            $id_materia[$j] = $m->id;
            $nome_materia[$j] = $m->nome;
            $j++;
        }
        
        $drop_materias = array();
        $i = 0;
        $drop_materias[''] = 'Selecione';
        for($i = 0; $i < sizeof($id_curso); $i++){
                $drop_materias[$nome_materia[$i]] =  $nome_materia[$i];        
        };
    
        if(isset($caminho)){
            $path = $caminho;
        }else{
            $path = './img/defalt';
        }
        if($materia){

        $all_arquivos = array();
    
            $arquivos = $this->arquivo_model->get_by_materia($materia);
 
                    
                if($arquivos){
                    foreach ($arquivos as $a){
                        
                        $nome = explode('.', $a->nome_arquivo);
                        $all_arquivos[$i]->nome = $nome[0];
                        $all_arquivos[$i]->tipo_aprendizagem = $a->tipo_aprendizagem;
                        $all_arquivos[$i]->id = $a->id;
                        if(isset($nome[1])){

                                $all_arquivos[$i]->extencao = $nome[1];
                            }else{
                                $all_arquivos[$i]->extencao = '';
                            }

                            $all_arquivos[$i]->caminho = $path . '/' . $a->nome_arquivo;

                            $i+=1;
                    }
            }
        }else{
        
            $all_arquivos = array();
    }
    ?>
    

    <?php echo form_open_multipart(base_url('adm/upload/do_upload'), 'id="upload"');  ?>
    
    <div class="row">
            <div class="form-group col-lg-4">
                <?php
                echo form_label('Curso &nbsp;');            
                echo form_dropdown('curso', $drop_cursos,(isset($curso->nome)? $curso->nome: set_value('curso')),'required="TRUE" class="form-control" id="curso"');
                ?>
            </div>
            <div class="form-group col-lg-4">
                <?php
                echo form_label('Matéria &nbsp;');
                echo form_dropdown('materia', array('' => 'Escolha uma matéria'),'','class="form-control" required="TRUE" id="materia"');
                ?>
            </div> 
        <br>
        <div class="form-group-sm col-lg-2">
            <input type="submit" name="publish" value="Listar" class="btn btn-warning">
        </div>
    </div>
    <div class="row">
        <div class="form-group-sm col-lg-4">
            <?php
                echo form_label('Descrição &nbsp;');            
                echo form_textarea('descricao', (isset($descricao)? $descricao: set_value('descricao')),'class="form-control" id="descricao" ');
            ?>
        </div>
        <div class="form-group-sm col-lg-3">
            <?php
                echo form_label('Tipo de aprendizagem &nbsp;');            
                echo form_input('tipo_aprendizagem', (isset($tipo_aprendizagem)? $tipo_aprendizagem: set_value('tipo_aprendizagem')),'class="form-control" id="tipo_aprendizagem" ');
            ?>
        </div>
        
        <div class="form-group-sm col-lg-2">
                
                <?php 
                echo form_label('Data de visualização');
                echo '<br>';
                $dados = array(
                    'type' => 'text',
                    'id' => 'data',
                    'name' => 'data'
                    );
                echo form_input($dados);
                ?>
                
        </div>
    </div>
    <br><br>
            
</div>

        <?php
            
        if($all_arquivos){
            $this->table->set_heading('Nome','Tipo de aprendizagem','Extensão');

                foreach ($all_arquivos as $a) {

                    $acoes  = '<a href="' . base_url($a->caminho) . '" target="_blank" class="btn btn-info btn-sm">Visualizar</a>&nbsp;';
                    $remove  = '<a href="' . base_url('adm/upload/remover/' . $a->id) . '"class="btn btn-danger btn-sm">Remover</a>&nbsp;';
                    $this->table->add_row(
                            $a->nome,$a->tipo_aprendizagem,$a->extencao, $acoes,$remove
                    );
                }

                $this->table->set_template(array(
                    'table_open' => '<table class="table table-striped table-bordered table-hover">',
                ));

                echo $this->table->generate();
        }
        ?>  


    <div class="form-group-sm col-lg-2">
        <input type="file" name="userfile" size="20" />
        <br>
        <input class="btn btn-info" type="submit" name="submit" value="Enviar" />

        <?php echo form_close(); ?>
    </div>
