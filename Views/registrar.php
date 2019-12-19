<?php

require_once '../Core/init.php';

if(Input::exists()) {
    if(Token::check(Input::get('token'))) {
    $validate = new Validate();
    $validate->check($_POST, array(
        'nome_usuario' => array(
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
        Session::flash('success', 'Usuário Registrado com sucesso!');
        header("Location: index.php");
    } else {
        print_r($validate->errors());
    }
    }
}
?>

<form method="post">

    <div class="field">
        <label for="nome_usuario">Nome de Usuário</label>
        <input type="text" name="nome_usuario" id="nome_usuario" value="<?php echo escape(Input::get('nome_usuario'));?>" autocomplete="off">
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

