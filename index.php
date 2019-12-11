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
      <span><a href="pedido.html">PEDIDO</a></span>
      <span><a href="historico.html">HISTÓRICO DE PEDIDOS</a></span>
      <span><a href="#localizacao">LOCALIZAÇÃO</a></span>
      <span><a href="#">LOGIN</a></span>

    </nav>
  </header>

  <!-- Conteúdo - uma pg para todos os burgers -->
  <div id="content">

    <!-- <div class="produtos">
      <p class="prodTitle">BBQ Bacon Burger</p>
      <img src="bbqbaconburger.png">
      <p class="descricao">
        Delicioso hamburguer artesanal de 180gr, <br>
        no pão brioche, queijo emmenthal, bacon e <br>
        crispy de provolone.

      <p class="preco">37.90</p>
      </p>
      <a href="pedido.html" class="btnPedido">Pedir</a>
      <input type="button" value="Pedir" class="btnPedido" id="bbq">
    </div>

    <div class="produtos">
        <p class="prodTitle">Cheese Salad Burger</p>
        <img src="xsalad.png">
        <p class="descricao">
          Hamburguer de 180gr, pão brioche, alface, <br>
          tomate, queijo prato e molho barbecue.
          <p class="preco">32.90</p>
        </p>
        <input type="button" value="Pedir" class="btnPedido" id="salad">
      </div>

      <div class="produtos">
          <p id="xburger" class="prodTitle">Cheese Burger</p>
          <img src="xburger.png">
          <p class="descricao">
            Hamburguer angus de 180gr, pão da casa, <br>
            e queijo cheddar derretido. 
            <p class="preco">27.90</p>
          </p>
          <input type="button" value="Pedir" class="btnPedido" id="xburger">
        </div>

        <div class="produtos">
            <p id="veggie" class="prodTitle">Veggie Burger</p>
            <img src="veggie.png">
            <p class="descricao">
              Hamburguer vegetariano feito de brotos, <br>
               alface, tomate e queijo mussarela.
              <p class="preco">33.90</p>
            </p>
            <input type="button" value="Pedir" class="btnPedido" id="veggie">
          </div> -->
  </div>

<!-- PEDIDO NA MESMA PG -->
  <div id="revisao">
    <h1 id="addTxt">Revise seu pedido</h1>
    <div class="result">
      <p id="escolhaPedido"></p>
      <p id="valorPedido"></p>
    </div>
  
    <input type="button" value="Confirmar Pedido" id="efetuarPedido" style="display:none">
  </div>



  <script src="main.js"></script>
  <footer id="localizacao">
    <p>
    Rua ABC, nº 123 - Cidade de Marília/SP
    <br>
    Venha nos conhecer!
    </p>
  </footer>
</body>
</html>