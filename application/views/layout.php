<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

echo doctype('html5');
?>

<html>
    <head>
        <?php
        
        $meta = array(
            array('name' => 'robots', 'content' => 'no-cache'),
            array('name' => 'description', 'content' => 'Sistema de ensino aprendizagem'),
            array('name' => 'keyword', 'content' => 'ensino, aprendizagem, ifsuldeminas'),
            array('name' => 'robots', 'content' => 'no-cache'),
            array('name' => 'Content-type', 'content' => 'text/html; charset=UTF-8', 'type' => 'equiv'),
            array('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1.0')
        );
        
        //Gera as tags HTML
        echo meta($meta);
        
        //Carrega os estilos usados na pagina
        echo link_tag(base_url('assets/css/bootstrap.min.css'), 'stylesheet', 'text/css', 'screen');lnbreak();
        
        echo link_tag(base_url('assets/font-awesome/css/font-awesome.min.css'), 'stylesheet', 'text/css', 'screen');lnbreak();
        
        echo link_tag(base_url('assets/js/data/jquery-ui.min.css'), 'stylesheet', 'text/css', 'screen');lnbreak();
        
        echo link_tag(base_url('assets/css/sb-admin.css'), 'stylesheet', 'text/css', 'screen');lnbreak();
       
        ?>
        
        <title>Sistema de ensino aprendizagem</title>
    </head>
    
    <body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="dashboard">Sistema de Ensino Aprendizagem</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu message-dropdown">
                    </ul>
                </li>
                <li class="dropdown">
                    <?php 
                        $user = $this->session->userdata('nome');
                        $user = explode(' ', $user);
                        $user = $user[0];
                    ?>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo nbs(1) . $user;?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="minha_conta"><i class="fa fa-fw fa-user"></i> Minha conta</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="<?php echo base_url('adm/logout');?>">
                            <i class="fa fa-fw fa-power-off"></i> Sair</a>
                        </li>
                    </ul>
                </li>
            </ul>
            
            <?php 
            
            $new_funcionalidade = $this->session->userdata('funcionalidade');


            echo '<div class="collapse navbar-collapse navbar-ex1-collapse">';
            echo '<ul class="nav navbar-nav side-nav">';
            ?>
            <li>
                <?php 
                echo '<a href="' . base_url("adm/dashboard") .'"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>';
                ?>
            </li>
            <?php
                for($i = 0; $i < sizeof($new_funcionalidade); $i++){

                    echo ' <li>';
                    echo '<a href="' . base_url("adm/" . $new_funcionalidade[$i]->url) .'"><i class="' . $new_funcionalidade[$i]->icone . '"></i> ' .$new_funcionalidade[$i]->nome. '</a>';
                    echo ' </li>';

                }
            echo '</ul>';
            echo '</div>';
            ?>
        </nav>
        
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                            <?php $this->load->view("adm/" . (isset($view)) ? $view : ''); ?>
                </div>
             </div>
        </div>
            
    </div>

    <?php 
        
        echo script_tag('assets/js/jquery-1.10.2.js', 'text/javascript');lnbreak();
        
        echo script_tag('assets/js/bootstrap.min.js', 'text/javascript');lnbreak();
        
        echo script_tag('assets/js/data/jquery-ui.js', 'text/javascript');lnbreak();
        
        echo script_tag('assets/js/template.js', 'text/javascript');lnbreak();

        // Carrega os javascripts exclusivos de cada pagina que sao definidos nas controladoras
        if(isset($js) && is_array($js)){
           
            foreach ($js as $j){
                
                echo script_tag('assets/js/' . $j . '.js', 'text/javascript');lnbreak();
            }
        }
        
    ?>
</body>
