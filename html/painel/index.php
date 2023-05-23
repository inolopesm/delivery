<?php

session_start();

if (!isset($_SESSION["authenticated"])) {
  header("Location: /painel/login.php");
  exit;
}

header("Content-Type: text/plain");
echo "Hmm, você está logado... Eu não estou pronto para lidar com isso";
