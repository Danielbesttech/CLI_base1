var menuBars = document.getElementById("check_menu");
var sideBar = document.querySelector('.sidebar');
var ABar = document.querySelectorAll('.sidebar a');
var spanBar = document.querySelectorAll('.sidebar a span');
var conteudo = document.querySelector('.idConteudo');
var btnDropdown = document.querySelector('.dropdown__button');
var menuDropdown = document.querySelector('.dropdown__menu');
var setaDropdown = document.querySelector('.setadrop');

menuBars.addEventListener('click', () => {
  sideBar.classList.toggle('isChekedsidebar');
  conteudo.classList.toggle('isCheckedContent');
  spanBar.forEach((spanElement) => {
    spanElement.classList.toggle('isChekedSidebarASpan');
  })
  ABar.forEach((Aelement) => {
    Aelement.classList.toggle('isChekedSidebarA');
  })
})

function toggleDropdown() {
  menuDropdown.classList.toggle('hide');
  setaDropdown.classList.toggle('fa-chevron-right')
  setaDropdown.classList.toggle('fa-chevron-down')
}

function Logout() {
  var hostnameHref = location.href;
  var hostname = hostnameHref.replace("#", "");
  var urlLogout = hostname + '/logout';
  window.location.replace(urlLogout)

}
