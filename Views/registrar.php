<?php

require_once '../Core/init.php';

var_dump(Token::check(Input::get('token')));

if(Input::exists()) {
    if(Token::check(Input::get('token'))) {
    $validate = new Validate();
    $validation = $validate->check($_POST, array(
        'n_usuario' => array(
            'obrigatorio' => true,
            'min' => 2,
            'max' => 20,
            'unico' => 'usuarios'
        ),
        's_usuario' => array(
            'obrigatorio' => true,
            'min' => 6
        ),
        's_usuario2' => array(
            'obrigatorio' => true,
            'combinam' => 's_usuario'
        ),
        'nome_u' => array(
            'obrigatorio' => true,
            'min' => 2,
            'max' => 50
        )));



    if($validate->passed()) {
        echo "Pode Registrar!";
    } else {
        print_r($validation->errors());
    }
    }
}
?>

<form action="" method="post">

    <div class="field">
        <label for="n_usuario">Nome de Usuário</label>
        <input type="text" name="n_usuario" id="n_usuario" value="<?php echo escape(Input::get('n_usuario'));?>" autocomplete="off">
    </div>

    <div class="field">
        <label for="s_usuario">Digite uma senha</label>
        <input type="password" name="s_usuario" id="s_usuario">
    </div>

    <div class="field">
        <label for="s_usuario2">Repita a senha</label>
        <input type="password" name="s_usuario2" id="s_usuario2">
    </div>

    <div class="field">
        <label for="nome_u">Qual seu nome?</label>
        <input type="text" name="nome_u" id="nome_u" value="<?php echo escape(Input::get('nome_u'));?>">
    </div>
    <input type="hidden" name="token" value="<?php echo Token::generate();?>">
    <input type="submit" value="Registrar">

</form>

