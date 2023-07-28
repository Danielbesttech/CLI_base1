function validarForm(id_form) {
  const form = document.getElementById(id_form);

  const formElements = Array.from(form.elements);

  // const fields = document.querySelectorAll("[required]");
  let fields = [];

  formElements.forEach((elm) => {
    if (elm.hasAttribute("required")) {
      fields.push(elm);
    }
  });

  function ValidateField(field) {
    // logica para verificar se existem erros
    function verifyErrors() {
      let foundError = false;
      for (let error in field.validity) {
        // se não for customError
        // então verifica se tem erro
        if (field.validity[error] && !field.validity.valid) {
          foundError = error;
        }
      }
      return foundError;
    }

    function customMessage(typeError) {
      const messages = {
        text: {
          valueMissing: "Por favor, preencha este campo",
        },
        email: {
          valueMissing: "Email é obrigatório",
          typeMismatch: "Por favor, preencha um email válido",
        },
        date: {
          valueMissing: "Por favor, selecione uma data",
          typeMismatch: "Por favor, preencha um email válido",
        },
        radio: {
          valueMissing: "Por favor, selecione uma data",
          typeMismatch: "Por favor, preencha um email válido",
        },
        password: {
          valueMissing: "Por favor, insira a senha",
          typeMismatch: "Por favor, preencha uma senha válido",
        },
        file: {
          valueMissing: "Por favor, insira uma imagem",
          typeMismatch: "Por favor, insira uma imagem válida"
        }
      };

      return messages[field.type][typeError];
    }

    function setCustomMessage(message) {
      const spanError = field.parentNode.querySelector("span.error");
      if (message) {
        spanError.classList.add("active");
        spanError.innerHTML = message;
      } else {
        spanError.classList.remove("active");
        spanError.innerHTML = "";
      }
    }

    const error = verifyErrors();

    if (error) {
      const message = customMessage(error);

      field.style.borderColor = "red";
      setCustomMessage(message);
      return false;
    } else {
      field.style.borderColor = "green";
      setCustomMessage();
      return true;
    }
  }

  for (field of fields) {
    if (!ValidateField(field)) {
      return false;
    }
  }

  return true;
}

function inserirLoading(id_div) {
  const div = document.getElementById(id_div);
  div.style.position = "relative";
  var width = div.getBoundingClientRect().width;
  var height = div.getBoundingClientRect().height;

  width = width > window.innerWidth ? window.innerWidth : width;
  height = height > window.innerHeight ? window.innerHeight : height;

  div.insertAdjacentHTML(
    "beforeEnd",
    `<div id='div-loading' style="width:${width}px; height:${height}px" class='div-loading'> <div class='loading'></div> </div>`
  );
}

function removerLoading() {
  document.getElementById("div-loading").remove();
}

function carregarImgNoCampo(id_input_file, id_img_preview) {

  var preview = document.querySelector('#' + id_img_preview);
  var file = document.querySelector('#' + id_input_file).files[0];
  var reader = new FileReader();

  reader.onloadend = function () {
    preview.src = reader.result;
  }

  if (file) {
    reader.readAsDataURL(file);
  } else {
    preview.src = "";
  }
}
