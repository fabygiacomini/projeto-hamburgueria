let idDoClienteDoPedido = localStorage.getItem('cliente_atual_id')
let idDoPedidoFeito = localStorage.getItem('cliente_atual_pedido')

window.onload = () => {
  acompanharPedido()
}

/**
 * Mostra o resumo do pedido realizado
 * @return {undefined}
 */

function acompanharPedido () {
  fetch("funcoes.php?operacao=acompanharPedido&idPedido=" + idDoPedidoFeito)
  .then(resumoNaoFormatado => resumoNaoFormatado.json())
  .then((resumoFormatado) => {

    let htmlTodosItensPedido = ''
    let tituloPedido = `
    <h3>Número do Pedido: ${resumoFormatado[0].id_pedido}</h3><br>
    <p>Status: ${resumoFormatado[0].status}</p>`
    const idPedido = document.getElementById('idPedido')
    idPedido.innerHTML += tituloPedido

    resumoFormatado.forEach((itemPedido) => {

      let htmlItemPedido = `
      <tr>
        <td>${itemPedido.id_item}</td>
        <td>${itemPedido.nome}</td>
        <td>${itemPedido.preco}</td>
      </tr>
      `
      htmlTodosItensPedido += htmlItemPedido 
    })
    const dadosDoPedido = document.getElementById('dadosPedido')
    dadosDoPedido.innerHTML += htmlTodosItensPedido
  })
}