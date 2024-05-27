<?php
include 'functions.php';
$pdo = pdo_connect_pgsql();
$msg = '';
// Verifica se os dados POST não estão vazios
if (!empty($_POST)) {
    // Se os dados POST não estiverem vazios, insere um novo registro
    // Configura as variáveis que serão inserid_completo as. Devemos verificar se as variáveis POST existem e, se não existirem, podemos atribuir um valor padrão a elas.
    $id_completo = isset($_POST['id_completo']) && !empty($_POST['id_completo']) && $_POST['id_completo'] != 'auto' ? $_POST['id_completo'] : NULL;
    // Verifica se a variável POST "nome" existe, se não existir, atribui o valor padrão para vazio, basicamente o mesmo para todas as variáveis
    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $cel = isset($_POST['cel']) ? $_POST['cel'] : '';
    $pizza = isset($_POST['pizza']) ? $_POST['pizza'] : '';
    $cadastro = isset($_POST['cadastro']) ? $_POST['cadastro'] : date('Y-m-d H:i:s');
    // Insere um novo registro na tabela contacts
    $stmt = $pdo->prepare('INSERT INTO contatos (id_completo, nome, email, cel, pizza, cadastro) VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute([$id_completo, $nome, $email, $cel, $pizza, $cadastro]);
    // Mensagem de saída
    $msg = 'Pedido Realizado com Sucesso!';
}
?>


<?=template_header('Cadastro de Pedidos')?>

<div class="content update">
	<h2>Registrar Pedido</h2>
    <form action="create.php" method="post">
        <label for="id_completo">ID</label>
        <label for="nome">Nome</label>
        <input type="text" name="id_completo" placeholder="" value="" id_completo="id_completo" >
        <input type="text" name="nome" placeholder="Seu Nome" id_completo="nome">
        <label for="email">Email</label>
        <label for="cel">Celular</label>
        <input type="text" name="email" placeholder="seuemail@seuprovedor.com.br" id_completo="email">
        <input type="text" name="cel" placeholder="(XX) X.XXXX-XXXX" id_completo="cel">
        <label for="pizza">Sabor Pizza</label>
        <label for="cadastro">Data do Pedido</label>
        <input type="text" name="pizza" placeholder="Pizza" id_completo="pizza">
        <input type="datetime-local" name="Criar" value="<?=date('Y-m-d\TH:i')?>" id_completo="cadastro">
        <input type="submit" value="Realizar Pedido">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>