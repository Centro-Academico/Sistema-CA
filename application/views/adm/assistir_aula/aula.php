<?php

$user_id = $this->session->userdata('usuario_id');
        
$aux = $this->curso_model->get_complemento($curso);

$curso_nome = $aux->nome;

?>

<div class="col-lg-12">
    <h1 class="page-header">
       <?php 
        echo $curso_nome;
        ?>
    </h1>
    <ol class="breadcrumb">
        <li>
            <i class="fa fa-dashboard"></i>  <a><?php echo $materia;?></a>
        </li>
    </ol>
    
    <div class="row">
        <?php   
                
            $this->table->set_heading();

                $ano = $this->arquivo_model->get_by_materia_curso($curso,$materia_id);
                    
                if($ano){
                
                    foreach($ano as $a){
                        $acoes  = '<a href="' . base_url($a->caminho . '/' . $a->nome_arquivo ) . '" target="_blank" class="btn btn-info btn-sm">Visualizar</a>&nbsp;';
                        $mes = explode('/', $a->data_registro);
                        
                        if($mes[1] == "01"){
                            
                            $dados['jan'][] = array(
                                $a->descricao , $a->data_registro ,$acoes
                            );
                        }
                        if($mes[1] == "02"){
                           
                            $dados['fev'][] = array(
                                $a->descricao , $a->data_registro ,$acoes
                            );
                        echo '</div>';
                        }
                        if($mes[1] == "03"){
                            
                            $dados['mar'][] = array(
                                $a->descricao , $a->data_registro ,$acoes
                            );
                        }
                        if($mes[1] == "04"){
                            
                           $dados['abr'][] = array(
                               $a->descricao , $a->data_registro ,$acoes
                            );
                        }
                        if($mes[1] == "05"){
                            
                            $dados['mai'][] = array(
                                $a->descricao , $a->data_registro ,$acoes
                            );
                        }
                        if($mes[1] == "06"){
                            
                            $dados['jun'][] = array(
                                $a->descricao , $a->data_registro ,$acoes
                            );
                        }
                        if($mes[1] == "07"){
                            
                            $dados['jul'][] = array(
                                $a->descricao , $a->data_registro ,$acoes
                            );
                        }
                        if($mes[1] == "08"){
                            
                            $dados['ago'][] = array(
                                $a->descricao , $a->data_registro ,$acoes
                            );
                        }
                        if($mes[1] == "09"){
                            
                            $dados['set'][] = array(
                                $a->descricao , $a->data_registro ,$acoes
                            );
                        }
                        if($mes[1] == "10"){
                            
                            $dados['out'][] = array(
                                $a->descricao , $a->data_registro ,$acoes
                            );
                        }
                        if($mes[1] == "11"){
                            
                            $dados['nov'][] = array(
                                $a->descricao , $a->data_registro ,$acoes
                            );
                        }
                        if($mes[1] == "12"){
                            
                           $dados['dez'][] = array(
                                $a->descricao , $a->data_registro ,$acoes
                            );
                        }
                    }

                    
                    if(isset($dados['jan'])){
                       $aux = "<div class=''><b>Janeiro</b></div>";
                        $this->table->add_row($aux);
                        for($i = 0; $i < sizeof($dados['jan']); $i++){
                            echo '<div class="row">';
                                $this->table->add_row(
                                        $dados['jan'][$i]
                                );
                            echo '</div>';
                        }
                    }
                    
                    if(isset($dados["fev"])){
                        
                        $aux = "<div class=''><b>Fevereiro</b></div>";
                        $this->table->add_row($aux);
                        
                        for($i = 0; $i < sizeof($dados['fev']); $i++){
                            echo '<div class="row">';
                                $this->table->add_row(
                                        $dados['fev'][$i]
                                );
                            echo '</div>';
                        }
                    }
                    if(isset($dados["mar"])){
                        $aux = "<div class=''><b>Março</b></div>";
                        $this->table->add_row($aux);
                        for($i = 0; $i < sizeof($dados['mar']); $i++){
                            echo '<div class="row">';
                                $this->table->add_row(
                                        $dados['mar'][$i]
                                );
                            echo '</div>';
                        }
                    }
                    if(isset($dados['abr'])){
                       $aux = "<div class=''><b>Abril</b></div>";
                        $this->table->add_row($aux);
                        for($i = 0; $i < sizeof($dados['abr']); $i++){
                            echo '<div class="row">';
                                $this->table->add_row(
                                        $dados['abr'][$i]
                                );
                            echo '</div>';
                        }
                    }
                    
                    if(isset($dados["mai"])){
                        
                        $aux = "<div class=''><b>Maio</b></div>";
                        $this->table->add_row($aux);
                        
                        for($i = 0; $i < sizeof($dados['mai']); $i++){
                            echo '<div class="row">';
                                $this->table->add_row(
                                        $dados['mai'][$i]
                                );
                            echo '</div>';
                        }
                    }
                    if(isset($dados["jun"])){
                        $aux = "<div class=''><b>Junho</b></div>";
                        $this->table->add_row($aux);
                        for($i = 0; $i < sizeof($dados['jun']); $i++){
                            echo '<div class="row">';
                                $this->table->add_row(
                                        $dados['jun'][$i]
                                );
                            echo '</div>';
                        }
                    }
                    
                    if(isset($dados['jul'])){
                       $aux = "<div class=''><b>Julho</b></div>";
                        $this->table->add_row($aux);
                        for($i = 0; $i < sizeof($dados['jul']); $i++){
                            echo '<div class="row">';
                                $this->table->add_row(
                                        $dados['jul'][$i]
                                );
                            echo '</div>';
                        }
                    }
                    
                    if(isset($dados["ago"])){
                        
                        $aux = "<div class=''><b>Agosto</b></div>";
                        $this->table->add_row($aux);
                        
                        for($i = 0; $i < sizeof($dados['ago']); $i++){
                            echo '<div class="row">';
                                $this->table->add_row(
                                        $dados['ago'][$i]
                                );
                            echo '</div>';
                        }
                    }
                    if(isset($dados["set"])){
                        $aux = "<div class=''><b>Setembro</b></div>";
                        $this->table->add_row($aux);
                        for($i = 0; $i < sizeof($dados['set']); $i++){
                            echo '<div class="row">';
                                $this->table->add_row(
                                        $dados['set'][$i]
                                );
                            echo '</div>';
                        }
                    }
                    if(isset($dados['out'])){
                       $aux = "<div class=''><b>Outubro</b></div>";
                        $this->table->add_row($aux);
                        for($i = 0; $i < sizeof($dados['out']); $i++){
                            echo '<div class="row">';
                                $this->table->add_row(
                                        $dados['out'][$i]
                                );
                            echo '</div>';
                        }
                    }
                    
                    if(isset($dados["nov"])){
                        
                        $aux = "<div class=''><b>Novembro</b></div>";
                        $this->table->add_row($aux);
                        
                        for($i = 0; $i < sizeof($dados['nov']); $i++){
                            echo '<div class="row">';
                                $this->table->add_row(
                                        $dados['nov'][$i]
                                );
                            echo '</div>';
                        }
                    }
                    if(isset($dados["dez"])){
                        $aux = "<div class=''><b>Dezembro</b></div>";
                        $this->table->add_row($aux);
                        for($i = 0; $i < sizeof($dados['dez']); $i++){
                            echo '<div class="row">';
                                $this->table->add_row(
                                        $dados['dez'][$i]
                                );
                            echo '</div>';
                        }
                    }   

                    $this->table->set_template(array(
                        'table_open' => '<table class="table table-hover table-striped">',
                    ));

                    echo $this->table->generate();
                    
                }else{
                    ?>
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <span>
                                    Nenhum material encontrado para essa matéria!
                                </span>
                            </div>
                        </div><?php
                }
        ?>
    </div>
</div>