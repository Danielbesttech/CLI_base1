$(document).ready(function () {

  $('#banner_principal').on("change", function () {
    carregarImgNoCampo('banner_principal', 'preview_imagem_banner_principal');
  });
  $('#banner_mobile').on("change", function () {
    carregarImgNoCampo('banner_mobile', 'preview_imagem_banner_mobile');
  });

});

function atualizarInfoGeral() {
  const callbackConfirm = () => {
    console.log("funcionou")
    // window.location.replace('https://localhost/developer/admin')
    var formulario = document.getElementById('formModalInput')
    var formData = new FormData(formulario)
    var validaForm = validarForm("formModalInput")
    console.log(validaForm)
    console.log(formData)

    $.ajax({
      type: 'POST',
      data: formData,
      url: 'https://localhost/developer/admin/teste',
      cache: false,
      contentType: false,
      processData: false,
      success: function () {
      }
    })
  }

  var inputs = [
    {
      "label": "TesteLabel",
      "campo": "testeCampo",
      "tipo": "text",
      "obrigatorio": true
    },
    {
      "label": "TesteLabel2",
      "campo": "testeCampo2",
      "tipo": "text",
      "obrigatorio": false
    },
  ]
  modalInputInfo("Teste", "teste de confirm ", inputs, "callbackConfirm")
  // var formulario = document.getElementById('frm');
  // var formData = new FormData(formulario);

  // var validaForm = validarForm("frm")
  // if (validaForm) {
  //   var urlSalvar = location.href + "/atualizar";
  //   $.ajax({
  //     type: 'POST',
  //     data: formData,
  //     url: urlSalvar,
  //     cache: false,
  //     contentType: false,
  //     processData: false,
  //     beforeSend: (data) => {
  //       inserirLoading("preview_imagem_banner_mobile")
  //     },
  //     success: function (data) {
  //       data = JSON.parse(data)
  //       removerLoading();
  //       modalAlertInfo("Dados De Informações Gerais ", data['mensagem']);
  //     }
  //   },)
  // }
}
