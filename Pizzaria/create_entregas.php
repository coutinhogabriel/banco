<?php
include 'functions.php';
$pdo = pdo_connect_pgsql();
$msg = '';
// Verifica se os dados POST não estão vazios
if (!empty($_POST)) {
    // Se os dados POST não estiverem vazios, insere um novo registro
    // Configura as variáveis que serão inseridas. Devemos verificar se as variáveis POST existem e, se não existirem, podemos atribuir um valor padrão a elas.
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
    $msg = 'Entrega Cadastrada com Sucesso!';
}
?>


<?=template_header('Cadastro de Entregas')?>

<div class="content update">
    <h2>Registrar Entrega</h2>
    <form action="create_entregas.php" method="post">
        <label for="id">ID</label>
        <label for="nome">Nome</label>
        <input type="text" name="id" placeholder="" value="" id="id" >
        <input type="text" name="nome" placeholder="Seu Nome" id="nome">
        <label for="endereco">Endereço</label>
        <label for="telefone">Telefone</label>
        <input type="text" name="endereco" placeholder="Seu Endereço" id="endereco">
        <input type="text" name="telefone" placeholder="(XX) X.XXXX-XXXX" id="telefone">
        <label for="status">Status da Entrega</label>
        <select name="status" id="status">
            <option value="Em andamento">Em andamento</option>
            <option value="Finalizado">Finalizado</option>
        </select>
        <label for="cadastro">Data da Entrega</label>
        <input type="datetime-local" name="cadastro" value="<?=date('Y-m-d\TH:i')?>" id="cadastro">
        <input type="submit" value="Realizar Entrega">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>
