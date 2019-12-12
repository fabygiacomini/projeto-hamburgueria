<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Valbernielson's Hamburgueria</title>
  <link rel="stylesheet" href="styleMain.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,500,700|Oswald:300,400,700" rel="stylesheet">
</head>
<body>
  <header>
    <!-- logo da hamburgueria e menu -->
    <img src="logoprov.png" alt="logo" id="logo">
    <nav>
      <span><a href="#content">MENU</a></span>
      <span><a href="historico.html">HISTÓRICO DE PEDIDOS</a></span>
      <span><a href="#localizacao">LOCALIZAÇÃO</a></span>
      <!-- <span><a href="#">LOGIN</a></span> -->

    </nav>
  </header>

  <!-- Conteúdo - Menu de burgers / add via window.onload (main.js) -->
  <div id="content">


  </div>

<!-- PEDIDO NA MESMA PG -->
  <div id="revisao">
    <h1 id="addTxt">Revise seu pedido</h1>
    <div class="result"></div>
  
    <input type="button" value="Confirmar Pedido" id="efetuarPedido" style="display:none">
  </div>



  <script src="main.js"></script>
  <footer id="localizacao">
    <p>
    Rua ABC, nº 123 - Marília/SP
    <br>
    Venha nos conhecer!
    </p>
  </footer>
</body>
</html>