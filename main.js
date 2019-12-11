const produtos = {
  bbq: {
    nome: 'BBQ Bacon Burger',
    preco: 37.90
  },
  salad: {
    nome: 'Cheese Salad Burger',
    preco: 32.90
  },
  xburger: {
    nome: 'Cheese Burger',
    preco: 27.90
  },
  veggie: {
    nome: 'Veggie Burger',
    preco: 33.90
  }
}


window.onload = () => {
  console.log('finalizei o carregamento')
  fetch('funcoes.php?operacao=mostrarTudo')
  .then((respostaInicial) => {
    return respostaInicial.json()
  })
  .then((respostaConvertida) => {
    console.log(respostaConvertida)
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

        <input data-id="${produto.id_prod}" type="button" value="Pedir" class="btnPedido" id="bbq">
      </div>`;
      htmlProdutos = htmlProdutos + novoProdutoHtml
    })
    
    const container = document.getElementById('content')
    container.innerHTML = htmlProdutos

    adicionaAcaoBotaoPedir()
  
  })
}

function adicionaAcaoBotaoPedir () {
  const btnEscolha = document.querySelectorAll('.btnPedido')
  btnEscolha.forEach((button) => {
    button.addEventListener("click",(e) => {
      let burger = e.target.id // retorna bbq OK!
      this.burger;

      for (i in produtos) {
        if (i == burger) {
          let escolhaPedido = document.getElementById('escolhaPedido') 
          let precoB = document.getElementById('valorPedido')
          console.log(produtos[burger]['nome'])

          // window.location = "pedido.html"
          window.location = '#revisao'

          // Por Na tela a escolha
          const revisao = document.querySelector('#revisao')
          escolhaPedido.innerHTML = `Burguer escolhido: ${produtos[burger]['nome']}`
          precoB.innerHTML = `Valor: ${produtos[burger]['preco']}`
          revisao.appendChild(escolhaPedido)
          revisao.appendChild(precoB)
          // aparecer botão de efetuar pedido
          const btnEfetuarPedido = document.getElementById('efetuarPedido')
          btnEfetuarPedido.style.display = 'block';

          localStorage.setItem(produto[burger]['nome'], produto[burger]['preco'])
        }
      }
    })
  })
}
