<?php if (!defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="col-lg-12">
    <h1 class="page-header">
       Usuários
    </h1>
    <ol class="breadcrumb">
        <li>
            <i class="fa fa-dashboard"></i>  <a href="usuarios">Usuários</a>
        </li>
        <li class="active">
            <i class="fa fa-file"></i> <?php echo $titulo;?>
        </li>
    </ol>
    
</div>
<div class="col-lg-12">
    <?php
    echo form_open(base_url('adm/usuarios/salvar'), 'id="editar_usuario"'); 
        
    $usuario_id = (isset($usuario->id))? $usuario->id: set_value('id');
    $usuario_id = ($usuario_id === '' && isset($id))? $id: $usuario_id;
    
    
    
    $atributos = array(
        'name'  => 'id',
        'id'    => 'id_usuario',
        'value' => (isset($usuario->id))? $usuario->id: $usuario_id,
        'type'  => 'hidden'
    );
    
    echo form_input($atributos);
    ?>
    
    <div class="row">
        <div class="form-group col-lg-6">
            <?php
            echo form_label('Nome *');
            echo form_input('nome', (isset($usuario->nome)? $usuario->nome: set_value('nome')), 'id="nome" class="form-control" required="TRUE"');
            echo form_error('nome');
            ?>
        </div> 
        <div class="form-group col-lg-3">
            <?php
            echo form_label('Telefone');
            echo form_input('telefone', (isset($usuario->telefone)? $usuario->telefone: set_value('telefone')), 'class="form-control telefone " id="telefone"');
            ?>
        </div>
    </div>
    
    <div class="row">
        <div class="form-group col-lg-6">
            <?php 
            echo form_label('E-mail *');
            echo form_input('email',(isset($usuario->email)? $usuario->email: set_value('email')), 'class="form-control " id="email"');
            echo form_error('email');
            ?>
        </div>
        
    </div>
    <div class="row">
        <div class="form-group col-lg-3">
            <?php 

            echo form_label('RG *');
            echo form_input('rg',(isset($usuario->rg)? $usuario->rg: set_value('rg')), 'class="form-control " id="rg"');
            echo form_error('rg');
            ?>
        </div>
        <div class="form-group col-lg-3">
            <?php 

            echo form_label('Matricula *');
            echo form_input('matricula',(isset($usuario->matricula)? $usuario->matricula: set_value('matricula')), 'class="form-control " id="matricula"');
            echo form_error('matricula');
            ?>
        </div>
        
    </div>
    
    <div class="row">
        <div class="form-group col-lg-6">
            <?php 

            echo form_label('Senha');
            echo form_password('senha','', ' id="senha" class="form-control "');
            echo form_error('senha');
            ?>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-lg-6">
            <?php 

            echo form_label('Logradouro');
            echo form_input('logradouro',(isset($usuario->logradouro)? $usuario->logradouro: set_value('logradouro')), 'class="form-control "');

            ?>
        </div>
        <div class="form-group col-lg-3">
            <?php 

            echo form_label('Número');
            echo form_input('numero',(isset($usuario->numero)? $usuario->numero: set_value('numero')), 'class="form-control "');

            ?>
        </div>
    </div>
    
    <div class="row">
        <div class="form-group col-lg-2">
            <?php 
                
            echo form_label('Estado');
            echo form_input('estado', (isset($usuario->estado)? $usuario->estado : set_value('estado')),' id="estado" class="form-control"');
            ?>
        </div>
        <div class="form-group col-lg-4">
            <?php 

            echo form_label('Cidade');
            
            echo form_input('cidade', (isset($usuario->cidade)? $usuario->cidade: set_value('cidade')),'id="cidade" class="form-control"');
            ?>
        </div>
        <div class="form-group col-lg-3">
            <?php 

            echo form_label('Bairro');
            echo form_input('bairro',(isset($usuario->bairro)? $usuario->bairro: set_value('bairro')), 'class="form-control "');

            ?>
        </div>
    </div>
    
    <div class="row">
        <div class="form-group col-lg-3">
            <?php 

            echo form_label('Status *');

            $status_usuario = $this->config->item('status_usuario');

            echo form_dropdown('status',$status_usuario,(isset($usuario->status)? $usuario->status: set_value('status')),'class="form-control"');
            echo form_error('status');
            ?>
        </div>
        <div class="form-group col-lg-3">
            <?php 

            echo form_label('Tipo de aprendizagem');
            echo form_input('aprendizagem',(isset($usuario->aprendizagem)? $usuario->aprendizagem: set_value('aprendizagem')), 'class="form-control "');

            ?>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-lg-3 div-grupos" name="grupo" id="grupo">
            <?php 

             function pertenceGrupo($grupos_usuario, $grupo) {
                 
                foreach ($grupos_usuario as $g) {

                    if ($g === $grupo) {
                        return TRUE;
                    }
                }

                return FALSE;
            };
            
            echo form_label('Grupos *');
            
            if($usuario_id != NULL){
                
                $grupos_usuarios= $this->grupo_model->get_by_id($usuario_id);
            
                for($i = 0; $i < sizeof($grupos_usuarios); $i++){
                
                    $usuario->grupos[] = $grupos_usuarios[$i]->id_grupo;
                    
                }
                
            }
            
            
            
            foreach ($grupos as $g) {
            
                $checked = FALSE;
                
                if(isset($grupos_usuarios)){
                    
                    $checked = pertenceGrupo($usuario->grupos, $g->id);

                }
                
                $atributos = array(
                    'name'    => 'grupos[]',
                    'id'      => 'g_' . $g->id,                    
                    'value'   => $g->id,
                    'class'   => 'grupo',
                    'checked' => $checked
                );

                echo '<div class="checkbox"><label>' . form_checkbox($atributos) . '&nbsp;' . $g->nome . '</label></div>';
                
            }
            ?>
            <label for="grupos" class="" style="display: none;" id="msg_verifica_grupos">&nbsp;Selecione ao menos um grupo.</label>
        </div>
    </div>
    
    <div class="row">
        <div class="form-group col-lg-3 " name="curso" id="curso">
            <?php 

             function pertenceCurso($curso_usuario, $curso) {
                 
                foreach ($curso_usuario as $c) {

                    if ($c === $curso) {
                        return TRUE;
                    }
                }

                return FALSE;
            };
            
            echo form_label('Curso *');
            
            if($usuario_id != NULL){
                
                $curso_usuarios= $this->curso_model->get_by_id($usuario_id);   
            
                for($i = 0; $i < sizeof($curso_usuarios); $i++){
                
                    $usuario->curso[] = $curso_usuarios[$i]->id_curso;
                    
                }
            }
            
            foreach ($curso as $c) {
            
                $checked = FALSE;
                
                if(isset($curso_usuarios)){
                    
                    $checked = pertenceCurso($usuario->curso, $c->id);

                }
                
                $atributos = array(
                    'name'    => 'curso[]',
                    'id'      => 'c_' . $c->id,                    
                    'value'   => $c->id,
                    'class'   => 'curso',
                    'checked' => $checked
                );

                echo '<div class="checkbox"><label>' . form_checkbox($atributos) . '&nbsp;' . $c->nome . '</label></div>';
                
            }
            ?>
            <label for="grupos" class="" style="display: none;" id="msg_verifica_grupos">&nbsp;Selecione ao menos um grupo.</label>
        </div>
    </div>
    
    
    
    
    <div class="row" style="padding-top: 20px;">
        <div class="form-group col-lg-6">
            <?php 

            echo form_submit('salvar','Salvar', 'class="btn btn-primary"');

            echo nbs(2) . form_button('cancelar','Cancelar', ' class="btn btn-danger btn_cancelar" ');
            ?>
        </div>
    </div>
    
    <?php echo form_close(); ?>
    
</div> 