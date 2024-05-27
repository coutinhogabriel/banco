<?php
include 'functions.php';
$pdo = pdo_connect_pgsql();
$msg = '';
// Verifica se os dados POST não estão vazios
if (!empty($_POST)) {
    // Se os dados POST não estiverem vazios, insere um novo registro
    // Configura as variáveis que serão inserid as. Devemos verificar se as variáveis POST existem e, se não existirem, podemos atribuir um valor padrão a elas.
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    // Verifica se a variável POST "nome" existe, se não existir, atribui o valor padrão para vazio, basicamente o mesmo para todas as variáveis
    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    $endereco = isset($_POST['endereco']) ? $_POST['endereco'] : '';
    $telefone = isset($_POST['telefone']) ? $_POST['telefone'] : '';
    $status = isset($_POST['status']) ? $_POST['status'] : '';
    $cadastro = isset($_POST['cadastro']) ? $_POST['cadastro'] : date('Y-m-d H:i:s');
    // Insere um novo registro na tabela contacts
    $stmt = $pdo->prepare('INSERT INTO entregas (id, nome, endereco, telefone, status, cadastro) VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute([$id, $nome, $endereco, $telefone, $status, $cadastro]);
    // Mensagem de saída
    $msg = 'Pedido Realizado com Sucesso!';
}
?>


<?=template_header('Cadastro de Pedidos')?>

<div class="content update">
	<h2>Registrar Pedido</h2>
    <form action="create_entregas.php" method="post">
        <label for="id">ID</label>
        <label for="nome">Nome</label>
        <input type="text" name="id" placeholder="" value="" id="id" >
        <input type="text" name="nome" placeholder="Seu Nome" id="nome">
        <label for="endereco">endereco</label>
        <label for="telefone">telefone</label>
        <input type="text" name="endereco" placeholder="endereco" id="endereco">
        <input type="text" name="telefone" placeholder="(XX) X.XXXX-XXXX" id="telefone">
        <label for="status"> status</label>
        <label for="cadastro">Data do Pedido</label>
        <input type="text" name="status" placeholder="status" id="status">
        <input type="datetime-local" name="Criar" value="<?=date('Y-m-d\TH:i')?>" id="cadastro">
        <input type="submit" value="Realizar Entrega">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>