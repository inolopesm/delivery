<?php
  $success = false;
  $erro = null;

  $nome = "";
  $email = "";
  $endereco = "";

  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $db = mysql_connect("mysql", "root", "docker");
    mysql_select_db("delivery", $db);

    $nome = mysql_real_escape_string($_POST["nome"], $db);
    $email = mysql_real_escape_string($_POST["email"], $db);
    $senha = mysql_real_escape_string($_POST["senha"], $db);
    $endereco = mysql_real_escape_string($_POST["endereco"], $db);

    $countSql = "SELECT COUNT(*) count FROM empresa WHERE email = '$email'";
    $countResult = mysql_query($countSql, $db);
    $countRow = mysql_fetch_array($countResult, MYSQL_ASSOC);
    $count = intval($countRow["count"]);

    if ($count > 0) {
      $erro = "E-mail já cadastrado em nosso sistema";
    } else {
      $insertSql = "INSERT INTO empresa (nome, email, senha, endereco) VALUES ('$nome', '$email', '$senha', '$endereco')";
      mysql_query($insertSql, $db);
      $success = true;
    }
  }
?>
<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Delivery</title>
  </head>
  <body style="margin: 0; font-family: sans-serif; font-size: 16px; line-height: 1.5;">
    <section style="position: fixed; left: 0; right: 0;">
      <div style="max-width: 768px; margin: 0 auto; padding: 1rem; border-bottom: 1px solid #ccc; display: flex; justify-content: space-between; background: #fff;">
        <a href="/" style="color: #000;">Delivery</a>
        <a href="#menu" style="color: #000;">Menu</a>
      </div>
    </section>
    <main style="max-width: 768px; margin: 0 auto;">
      <div style="height: 56px;"></div>
      <section style="padding: 2.5rem 1rem;">
        <h1 style="line-height: 1.25;">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit.
        </h1>
        <p>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis placerat
          nec lectus nec iaculis. Aenean vel ornare diam.
        </p>
      </section>
      <section id="sobre" style="padding: 2.5rem 1rem;">
        <h2>Sobre nós</h2>
        <p>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis placerat
          nec lectus nec iaculis. Aenean vel ornare diam. Etiam lobortis interdum
          augue, at tincidunt eros lobortis et. Suspendisse potenti. Ut sed lectus
          a ipsum sollicitudin faucibus.
        </p>
      </section>
      <section id="entregadores" style="padding: 2.5rem 1rem;">
        <h2>Para entregadores</h2>
        <ul>
          <li>
            <strong>Vantagem:</strong> Lorem ipsum dolor sit amet, consectetur
            adipiscing elit.
          </li>
          <li>
            <strong>Vantagem:</strong> Duis placerat nec lectus nec iaculis.
            Aenean vel ornare diam.
          </li>
          <li>
            <strong>Vantagem:</strong> Etiam lobortis interdum augue, at tincidunt eros lobortis et.
          </li>
        </ul>
        <p style="text-align: center;">
          <a
            style="color: #000;"
            href="https://play.google.com/store/apps"
            target="_blank"
            rel="noreferrer noopener"
          >
            Baixar aplicativo
          </a>
        </p>
      </section>
      <section id="empresas" style="padding: 2.5rem 1rem;">
        <h2>Para empresas</h2>
        <ul>
          <li>
            <strong>Vantagem:</strong> Lorem ipsum dolor sit amet, consectetur
            adipiscing elit.
          </li>
          <li>
            <strong>Vantagem:</strong> Duis placerat nec lectus nec iaculis.
            Aenean vel ornare diam.
          </li>
          <li>
            <strong>Vantagem:</strong> Etiam lobortis interdum augue, at tincidunt eros lobortis et.
          </li>
        </ul>
        <?php if ($erro) { ?>
          <p style="color: red;">
            <?php echo $erro; ?>
          </p>
        <?php } ?>
        <?php if ($success) { ?>
          <p style="color: green;">
            Cadastro enviado com sucesso! Agora é só aguardar que entramos
            em contato.
          </p>
        <?php } ?>
        <h3>Cadastre-se</h3>
        <form method="POST">
          <p>
            <label for="nome">Nome</label><br />
            <input
              type="text"
              placeholder="Nome da empresa"
              id="nome"
              name="nome"
              maxlength="255"
              style="width: 100%; padding: 0.5rem 1rem; box-sizing: border-box;"
              value="<?php echo $nome; ?>"
              required
            />
          </p>
          <p>
            <label for="endereco">Endereço</label><br />
            <input
              type="text"
              placeholder="Rua da Cuxixola 255 Bairro Cidade Estado"
              id="endereco"
              name="endereco"
              maxlength="255"
              style="width: 100%; padding: 0.5rem 1rem; box-sizing: border-box;"
              value="<?php echo $endereco; ?>"
              required
            />
          </p>
          <p>
            <label for="email">E-mail</label><br />
            <input
              type="email"
              placeholder="nome@exemplo.com"
              id="email"
              name="email"
              maxlength="255"
              style="width: 100%; padding: 0.5rem 1rem; box-sizing: border-box;"
              value="<?php echo $email; ?>"
              required
            />
          </p>
          <p>
            <label class="form-label" for="senha">Senha</label><br />
            <input
              type="password"
              id="senha"
              name="senha"
              maxlength="255"
              style="width: 100%; padding: 0.5rem 1rem; box-sizing: border-box;"
              required
            />
          </p>
          <button type="submit" style="padding: 0.5rem 1rem;">Cadastrar</button>
        </form>
      </section>
      <section id="menu" style="padding: 1rem;">
        <p>
          <a href="/" style="color: #000;">Delivery</a>
        </p>
        <ul>
          <li>
            <a href="#" style="color: #000;">
              Início
            </a>
          </li>
          <li>
            <a href="#sobre" style="color: #000;">
              Sobre nós
            </a>
          </li>
          <li>
            <a href="#entregadores" style="color: #000;">
              Para entregadores
            </a>
          </li>
          <li>
            <a href="#empresas" style="color: #000;">
              Para empresas
            </a>
          </li>
        </ul>
        <p>
          <a href="/painel" target="_blank" style="color: #000;">Painel</a>
        </p>
      </section>
    </main>
    <?php if ($_SERVER["REQUEST_METHOD"] === "POST") { ?>
      <script>window.location.href = "#empresas";</script>
    <?php } ?>
  </body>
</html>
