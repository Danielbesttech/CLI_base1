const modalConfirm = document.getElementById('modalConfirm');
const fecharModalConfirm = document.querySelectorAll('.fechar-modal-confirm');
var tituloModal = document.querySelector('.titulo-modal-confirm')
var textoModal = document.querySelector('.article-modal-confirm')
var btnConfirmar = document.getElementById('confirmarModalConfirm')

fecharModalConfirm.forEach((btnfechar) => {
  btnfechar.addEventListener("click", (e) => {
    modalConfirm.close()
  })
})


function modalConfirmInfo(titulo, mensagem, callbackConfirm) {
  var pModal = document.createElement("p");
  var spanModal = document.createElement("span");
  spanModal.innerHTML = titulo
  pModal.innerHTML = mensagem;
  tituloModal.appendChild(spanModal)
  textoModal.appendChild(pModal);
  modalConfirm.showModal()
  window.scrollTo(0, 0)
  btnConfirmar.onclick = callbackConfirm
}

document.onkeydown = function (e) {

  if (e.key === 'Escape') {
    console.log("APERTOU ESC!")
    console.log(e.char)
    console.log(e.code)
  }

}
