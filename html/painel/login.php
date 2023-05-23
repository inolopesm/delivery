<?php
  session_start();

  if (isset($_SESSION["authenticated"])) {
    header("Location: /painel");
    exit;
  }

  $erro = null;

  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $db = mysql_connect("mysql", "root", "docker");
    mysql_select_db("delivery", $db);

    $email = mysql_real_escape_string($_POST["email"], $db);
    $senha = mysql_real_escape_string($_POST["senha"], $db);

    $sql = "SELECT * FROM empresa WHERE email = '$email' AND senha = '$senha'";
    $result = mysql_query($sql, $db);
    $empresa = mysql_fetch_array($result, MYSQL_ASSOC);

    if (!$empresa) {
      $erro = "As credenciais informadas são inválidas. Tente novamente";
    } else {
      if ($empresa["status"] === "EM_ABERTO") {
        $erro = "Entre em contato com o nosso suporte para poder acessar o painel.";
      } else {
        mysql_query("UPDATE empresa SET last_login_at = CURRENT_TIMESTAMP WHERE email = '$email'", $db);

        $_SESSION["authenticated"] = true;
        $_SESSION["tipo"] = "EMPRESA";
        $_SESSION["empresa"] = $empresa;

        header("Location: /painel");
        exit;
      }
    }
  }
?>
<html>
  <body>
    <h1>Delivery</h1>
    <h2>Login</h2>
    <form method="POST">
      <?php if ($erro): ?>
        <p style="color: red;">
          <?php echo $erro ?>
        </p>
      <?php endif; ?>
      <p>
        <label for="email">Email</label>
        <br />
        <input id="email" name="email" />
      </p>
      <p>
        <label for="senha">Senha</label>
        <br />
        <input type="password" id="senha" name="senha" />
      </p>
      <button type="submit">Entrar</button>
    </form>
</html>
