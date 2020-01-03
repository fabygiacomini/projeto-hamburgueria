window.onload = () => {
  listarPedidos()
}

/**
 * Lista todos os pedidos
 * @return {undefined}
 */
function listarPedidos() {  // histórico
  fetch("funcoes.php?operacao=listarTodosPedidos")
  .then((respostaSemConversao) => respostaSemConversao.json())
  .then((respostaConvertida) => {
    let historicoPedidos = ''
    respostaConvertida.forEach((pedido) => {

      let novoPedidoTabelaHistorico = 
      `<tr>
      <td>${pedido.id_pedido}</td>
      <td>${pedido.nomeProd}</td>
      <td>${pedido.nomeCliente}</td>
      <td>${pedido.dataFormatada}</td>
      <td>${pedido.total}</td>
      </tr>`;
      historicoPedidos += novoPedidoTabelaHistorico;
    })

    const containerPedidos = document.getElementById('tabelaHistorico')
    containerPedidos.innerHTML = historicoPedidos
  })
}


const btnFiltro = document.getElementById('filtrar')
btnFiltro.addEventListener("click", () => {
  listarPedidosPorData()
})

/**
 * Lista os pedidos a partir de uma determinada data
 * @return {undefined}
 */
function listarPedidosPorData() {
const dataSelecionada = document.getElementById('filtroData')
  fetch("funcoes.php?operacao=filtrar&dataFormatada=" + dataSelecionada.value)
  .then((datasPedidos) => datasPedidos.json())
  .then((pedidosPorData) => {
    let historicoPedidos = ''
    pedidosPorData.forEach((pedido) => {

      let novoPedidoTabelaHistorico = 
      `<tr>
      <td>${pedido.id_pedido}</td>
      <td>${pedido.nomeProd}</td>
      <td>${pedido.nomeCliente}</td>
      <td>${pedido.dataFormatada}</td>
      <td>${pedido.total}</td>
      </tr>`;
      historicoPedidos += novoPedidoTabelaHistorico;
    })

    const containerPedidos = document.getElementById('tabelaHistorico')
    containerPedidos.innerHTML = historicoPedidos
  })
}

const btnVoltar = document.getElementById('mostrarTudo')
btnVoltar.addEventListener("click", () => {
  listarPedidos()
})