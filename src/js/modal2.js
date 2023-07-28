var modalOverlay = document.querySelector(".modal-overlay")

modalOverlay.addEventListener('click', () => {
  var modal = document.querySelectorAll(".modal")

  for (var modals of modal) {
    modals.classList.toggle("closed", true)
  }
  modalOverlay.classList.toggle("closed", true)
  isOpen = false;

})
