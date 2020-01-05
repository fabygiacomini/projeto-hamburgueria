let carrinho = [];

// Carrega na página os hamburgueres cadastrados no banco de dados
window.onload = () => {
  fetch('funcoes.php?operacao=mostrarTudo')
  .then((respostaInicial) => {
    return respostaInicial.json()
  })
  .then((respostaConvertida) => {
    let htmlProdutos = ''
    respostaConvertida.forEach((produto) => {
      let novoProdutoHtml = 
        `<div class="produtos">
        <p class="prodTitle">
          ${produto.nome}
        </p>
        <img src="${produto.imagem}">
        <p class="descricao">
          ${produto.descricao}
          <p class="preco">
            ${produto.preco}
          </p>
        </p>

        <input 
          data-id="${produto.id_prod}"
          data-nome="${produto.nome}"
          data-preco=${produto.preco}
        type="button" value="Pedir" class="btnPedido" id="bbq">
      </div>`;
      htmlProdutos = htmlProdutos + novoProdutoHtml
    })
    
    const container = document.getElementById('content')
    container.innerHTML = htmlProdutos

    adicionaAcaoBotaoPedir(); // adiciona item escolhido no carrinho
  
  })
}

// ação de clicar vai inserir um novo pedido no banco (chama funcao insereNovoPedido())
const efetuarPedido = document.querySelector('#efetuarPedido');
efetuarPedido.addEventListener('click', (event) => {
  insereNovoPedido(carrinho);
});



/////////////
// FUNCOES //
/////////////

/**
 * Ao clicar no botão, cria item html mostrando nome/preco do item selecionado, cria novo obj para esse item e adiciona no carrinho através do push(), bem como libera o botão para confirmar o pedido
 * 
 * @return {undefined}
 */
function adicionaAcaoBotaoPedir () { // botao de cada lanche
  
  const btnEscolha = document.querySelectorAll('.btnPedido')
  btnEscolha.forEach((button) => {
    button.addEventListener("click", (e) => {
      let burger = e.target.dataset; // retorna um array com os atributos data-

      // monta o html que irá ser adicionado no final da pagina com as informacoes do burgers
      const htmlNovoItem = `
        <p id="escolhaPedido">${burger.nome}</p>
        <p id="valorPedido">${burger.preco}</p>`;
      let carrinhoDeItens = document.querySelector('.result');
      carrinhoDeItens.innerHTML += htmlNovoItem;
      
      // Cria um objeto com as informacoes do burger sendo adicionado
      const novoItemAdicionado = {
        id_prod: burger.id,
        nome: burger.nome,
        preco: burger.preco,
        quantidade: 1, // valor fixo para exemplificar
      };

      // insere o burger clicado no array carrinho
      carrinho.push(novoItemAdicionado);

      window.location = '#revisao'
      

      if (carrinho.length > 0) {
        const efetuarPedido = document.querySelector('#efetuarPedido');
        efetuarPedido.style.display = 'block';
      }
    })
  })
}

/**
 * Envia uma requisicao para criar um novo pedido no banco de dados
 * @param {array} carrinho carrinho de compras com os lanches
 * @param {int} idCliente id do cliente atualmente comprando
 * 
 * @return {undefined}
 */
function insereNovoPedido(carrinho, idCliente = 1) { // cliente exemplo criado manualmente no banco de dados

  const itensDoPedidoJSON = JSON.stringify(carrinho);

  fetch("funcoes.php?operacao=novoPedido&id_cli=" + idCliente, {
    method: "POST",
    body: itensDoPedidoJSON
  })
  .then((respostaSemCoversao) => respostaSemCoversao.json())
  .then((respostaConvertida) => {
    alert(respostaConvertida.mensagem);
    const idDoPedidoNovo = respostaConvertida.id_pedido;


    localStorage.setItem('cliente_atual_id', idCliente);  // "mini bd do navegador" que guarda pares chave/valor
    localStorage.setItem('cliente_atual_pedido', idDoPedidoNovo);
    
    window.location = 'resumoPedido.html'

  })
}


