<?php

require_once '../core/init.php';

if(Input::exists()) {
    if(Token::check(Input::get('token'))) {

        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'nome_usuario' => array('obrigatorio' => true),
            'senha_usuario' => array('obrigatorio' => true)
        ));

        if($validation->passed()) {
            $user = new Usuario();
            $login = $user->login(Input::get('nome_usuario'), Input::get('senha_usuario'));

            if($login) {
                echo "Success!";
            } else {
                echo "Sorry, Log in Failed!";
            }
        } else {
            foreach ($validation->errors() as $error) {
                echo "$error<br/>";
            }
        }
    }
}

?>
<form action="" method="post">
    <div class="field">
        <label for="nome_usuario">Login</label>
        <input type="text" name="nome_usuario" id="nome_usuario" autocomplete="off">
    </div>
    <div class="field">
        <label for="senha_usuario">Senha</label>
        <input type="text" name="senha_usuario" id="senha_usuario" autocomplete="off">
    </div>

    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
    <input type="submit" value="Log in">
</form>
