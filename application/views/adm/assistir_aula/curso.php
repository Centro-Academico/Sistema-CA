<div class="col-lg-12">
    <h1 class="page-header">
       Assistir Aula / Curso
    </h1>
    <ol class="breadcrumb">
        <li>
            <i class="fa fa-dashboard"></i>  <a href="">Aula</a>
        </li>
    </ol>
  

    <?php 
        echo _mensagem_flashdata();

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
    ?>

    <?php echo form_open(base_url('adm/assistir_aula/materia'),'id=curso')?>
    
    <div class="row">
            <div class="form-group col-lg-4">
                <?php
                echo form_label('Curso &nbsp;');            
                echo form_dropdown('curso', $drop_cursos,(isset($curso->nome)? $curso->nome: set_value('curso')),'required="TRUE" class="form-control" id="curso"');
                ?>
            </div>
    </div>
    
    <div class="form-group col-lg-2">
        <input type="submit" name="publish" value="Listar" class="btn btn-warning">
    </div>