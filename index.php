<?php

require_once 'vendor/autoload.php';
// require_once "db_conec_db.php";

use App\Model\geral;
use CoffeeCode\Router\Router;
use App\Utils\Config as utilsConfig;
use App\Middlewares\Middlewares;

utilsConfig::configUtils();

$router = new Router($_ENV['URL_SITE']);

/** ROTAS DO SITE */
$router->namespace("App\Controller");
//Rota inicial
$router->get("/",                    "Inicio:Home",               "rotas.home");
//rotas do menu e internas
$router->get("/contato/",            "Inicio:Contato",               "rotas.contato");
$router->get("/contato/formulario/", "Inicio:ContatoFormulario",  "rotas.contatoForm");
$router->post("/contato/salvar/",    "Inicio:SalvarForm",         "rotas.contatoSalvar");
$router->get("/quem-somos/",         "Inicio:QuemSomos",      "rotas.quem_somos"  );
$router->get("/cardapio/",           "Inicio:Cardapio",           "rotas.cardapio");
$router->get("/restaurate",          "Inicio:Cardapio",         "rotas.restaurante");
$router->get("/categoria/{id}/",     "Inicio:Categoria",          "rotas.categoria");

/** ROTAS DA ÁREA ADMINISTRATIVA */
$router->group("admin")->namespace("App\Controller\Admin");
//Entrada ADM
$router->get("/", "Inicio:Home",  "rotasadmin.home" , Middlewares::AUTH);
//Rotas de Login/Logout
$router->get("/login", "Inicio:Login", "rotasadmin.login");
$router->get("/logout", "Inicio:Logout", "rotasadmin.logout");
$router->post('/logar', "Inicio:Logar", "rotasadmin.logar");
$router->post("/teste", "Inicio:Teste", "rotasadmin.teste");

//Rotas Menus Administrativos
$router->group("admin/infogeral")->namespace("App\Controller\Admin\InfoGeral");
$router->get("/", "InfoGeral:Home", "rotasadmin.infogeral", Middlewares::AUTH);
$router->post("/atualizar", "InfoGeral:Atualizar", "rotasadmin.infogeral_atualizar", Middlewares::AUTH);

//Executa as rotas
$router->dispatch();

//rotas não encontradas são redirecionadas
if ($router->error()) {
  // $router->redirect("/error/{$router->error()}");
  $router->redirect($router->route("rotas.home"));
}
