<?php

require_once '../Core/init.php';

/*$userInsert = DB::getInstance()->insert('usuarios', array(
    'nome_usuario' => 'Joana',
    'senha'        => 'password',
    'salt'         => 'salt',
    'nome'         => 'Joana Doe',
    'data_cadastro'=> '2019-12-15 00:00',
    'grupo'        => 1));

if($userInsert) {
    echo "Usuario Inserido com Sucesso";
} else {
    echo "Não foi possível inserir usuário";
}
*/
/*$userUpdate = DB::getInstance()->update('usuarios', 20, array(
    'nome_usuario' => 'Joana2',
    'senha'        => 'password2',
    'salt'         => 'salt2',
    'nome'         => 'Joana Doe2',
    'data_cadastro'=> '2029-12-15 00:00',
    'grupo'        => 1
));

if($userUpdate) {
    echo "Usuario atualizado com sucesso";
} else {
    echo "Não foi possível atualizar usuario";
}*/

 if(Session::exists('home')) {
    echo '<p>' . Session::flash('home') . '</p>';
 }

 $user = new Usuario();
 if($user->isLoggedIn()) {
     ?>
    <p>Olá, <a href="#"><?php echo escape($user->data()->nome_usuario); ?></a>!</p>
     <ul>
         <li><a href="logout.php">Sair</a></li>
     </ul>
     <?php
 } else {
     echo "<p>Você precisa <a href='login.php'>logar</a> ou <a href='registrar.php'>registrar</a>.</p>";
 }









