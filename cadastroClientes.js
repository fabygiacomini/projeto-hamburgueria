window.onload = () => {
  listarClientes()
}

/**
 * Lista todos os clientes cadastrados
 * @return {undefined}
 */
function listarClientes () {
  fetch("funcoes.php?operacao=listarClientes")
  .then((result) => result.json())
  .then((clientesCadastrados) => {
    // console.log(clientesCadastrados)
    let listaDeClientes = ''
    clientesCadastrados.forEach((cliente) => {
      let novoCliente = `
      <tr>
      <td>${cliente.id_cli}</td>
      <td>${cliente.nome}</td>
      <td>${cliente.endereco}</td>
      <td>${cliente.cidade}</td>
      <td>${cliente.telefone}</td>
      <td>${cliente.email}</td>
      <td>${cliente.senha}</td>
      </tr>`;
      listaDeClientes += novoCliente;
    })

    const containerClientes = document.getElementById('tabelaClientes')
    containerClientes.innerHTML = listaDeClientes;
  })
}

/**
 * Para cadastrar um cliente no banco de dados
 */
const formularioCadastro  = document.getElementById('cadastroClientes')

formularioCadastro.addEventListener('submit', function(event) {
  event.preventDefault();

  const dadosFormulario = new FormData(this);

  fetch('funcoes.php?operacao=cadastrarClientes', {
    method: 'post',
    body: dadosFormulario
  }).then((resposta) => {
       return resposta.json()
  }).then((respostaConvertida) => {
      // console.log(respostaConvertida)
      alert(respostaConvertida.mensagem)
      listarClientes();    
  }).catch((error) => {
    console.error(error)
  })
});

/**
 * Para deletar um cliente no banco de dados
 */
const formDelete = document.getElementById('deletarCliente')
formDelete.addEventListener('submit', function(event) {
  event.preventDefault();

  const idADeletar = document.getElementById('campoId').value;
  console.log(idADeletar)
  fetch('funcoes.php?operacao=deletarCliente&id_cli=' + idADeletar)
  .then((resposta) => resposta.json())
  .then((mensagemConvertida) => {
    alert(mensagemConvertida.mensagem)
    listarClientes();
  })
  .catch((error) => console.error(error))
});