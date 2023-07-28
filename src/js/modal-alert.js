const modalAlert = document.getElementById('modalAlert');
const fecharModalAlert = document.querySelectorAll('.fechar-modal-alerta');
var tituloModal = document.querySelector('.titulo-modal-alerta')
var textoModal = document.querySelector('.article-modal-alerta')

fecharModalAlert.forEach((btnfechar) => {
  btnfechar.addEventListener("click", (e) => {
    modalAlert.close()
  })
})


function modalAlertInfo(titulo, mensagem) {
  var pModal = document.createElement("p");
  var spanModal = document.createElement("span");
  spanModal.innerHTML = titulo
  pModal.innerHTML = mensagem;
  tituloModal.appendChild(spanModal)
  textoModal.appendChild(pModal);
  modalAlert.showModal()
  window.scrollTo(0, 0)
  setTimeout(() => {
    fecharModalAlert[0].click()
    location.reload()
  }, 3000)
}
