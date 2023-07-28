const modalInput = document.getElementById('modalInput');
const fecharmodalInput = document.querySelectorAll('.fechar-modal-input');
var tituloModal = document.querySelector('.titulo-modal-input')
var textoModal = document.querySelector('.article-modal-input')
var btnConfirmarInput = document.getElementById('confirmarModalInput')
var formModalInput = document.getElementById('formModalInput')

fecharmodalInput.forEach((btnfechar) => {
  btnfechar.addEventListener("click", (e) => {
    modalInput.close()
  })
})

/**
 * // formModalInput - id do form(para uso de formData na callback)
 * @param {string} titulo
 * @param {string} mensagem
 * @param {Array} inputs [campo: nome do campo, tipo: tipo do input, label: titulo da label, obrigatorio: true|false]
 * @param {function}callbackConfirm function printInfo(()=>{console.log})
 */
function modalInputInfo(titulo, mensagem, inputs, callbackConfirm) {
  console.log(callbackConfirm instanceof Function)
  alimentarModal(titulo, mensagem, inputs)

  modalInput.showModal()
  window.scrollTo(0, 0)
  if (callbackConfirm instanceof Function) {
    btnConfirmarInput.onclick = callbackConfirm
  } else {
    alert("Não foi possível realizar a operação, tente novamente mais tarde! Erro: #ModalInputCallback")
    location.reload()
  }
}


function alimentarModal(titulo, mensagem, inputs) {
  var pModal = document.createElement("p");
  var spanModal = document.createElement("span");
  spanModal.innerHTML = titulo
  pModal.innerHTML = mensagem;
  tituloModal.appendChild(spanModal)
  formModalInput.style.padding = "0.8rem"
  formModalInput.appendChild(pModal);
  setarInputsModal(inputs)

}

function setarInputsModal(inputs) {
  inputs = Array.isArray(inputs) ? inputs : [inputs]
  inputs.forEach((inputInfo) => {
    let inputModal = document.createElement('input')
    let divModal = document.createElement('div')
    let labelModal = document.createElement('label')
    let spanErroModal = document.createElement('span')

    divModal.classList.add("campos")
    labelModal.setAttribute("for", inputInfo.campo)
    labelModal.innerHTML = inputInfo.label

    inputModal.setAttribute("type", inputInfo.tipo)
    inputModal.setAttribute("id", inputInfo.campo)
    inputModal.setAttribute("name", inputInfo.campo)
    if (inputInfo.obrigatorio) {
      inputModal.setAttribute("required", '')
    }

    spanErroModal.classList.add('error')

    formModalInput.appendChild(divModal)
    divModal.appendChild(labelModal)
    divModal.appendChild(inputModal)
    divModal.appendChild(spanErroModal)
  })
}

document.onkeydown = function (e) {

  if (e.key === 'Escape') {
    console.log("APERTOU ESC!")
    console.log(e.char)
    console.log(e.code)
  }

}
