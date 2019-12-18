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
      console.log(respostaConvertida)
      alert(respostaConvertida.mensagem)    
  }).catch((error) => {
    console.error(error)
  })
});