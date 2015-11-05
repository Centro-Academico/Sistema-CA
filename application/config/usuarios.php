<?php if (!defined('BASEPATH'))  exit('No direct script access allowed');

$config['status_usuario'] = array(
    0 => 'Inativo',
    1 => 'Ativo'
);


$config['regras_validacao'] = array(
    array(
        'field' => 'email',
        'label' => 'email',
        'rules' => 'trim|required'
    ),
    array(
        'field' => 'nome',
        'label' => 'nome',
        'rules' => 'trim|required'
    ),
    array(
        'field' => 'rg',
        'label' => 'rg',
        'rules' => 'trim|required'
    )
);
