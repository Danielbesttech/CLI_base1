<?php

require_once 'vendor/autoload.php';
// require_once "db_conec_db.php";

use App\Model\geral;
use CoffeeCode\Router\Router;
use App\Utils\Config as utilsConfig;

utilsConfig::configUtils();

$router = new Router($_ENV['URL_SITE']);
$router->namespace("App\Controller");

$router->get("/",                    "Inicio:Home",               "rotas.home");

$router->get("/contato/",            "Inicio:Contato",            "rotas.contato");
$router->get("/contato/formulario/", "Inicio:ContatoFormulario",  "rotas.contatoForm");
$router->post("/contato/salvar/",    "Inicio:SalvarForm",         "rotas.contatoSalvar");
// $router->get("/contato",        "Inicio:Contato",              "rotas.contato");

$router->get("/quem-somos/",         "Inicio:QuemSomos",          "rotas.quem_somos");
// $router->get("/quem-somos",    "Inicio:QuemSomos",       "     rotas.quem_somos");

$router->get("/cardapio/",           "Inicio:Cardapio",           "rotas.cardapio");
$router->get("/cardapio",            "Inicio:Cardapio",           "rotas.cardapio");

$router->get("/categoria/{id}/",     "Inicio:Categoria",          "rotas.categoria");
// geral::pre($router);
$router->namespace("App\Controller\Admin")->group("admin");
$router->get("/", "Inicio:Home", "rotas.adm.home");
$router->get("/login", "Inicio:Login", "rotas.admin.login");
$router->get("/logout", "Inicio:Logout", "rotas.admin.logout");
$router->post('/logar', "Inicio:Logar", "rotas.admin.logar");
// $router->get("/", function(){
//   geral::pre("rota admin");
//   die;
// });
/**
 * This method executes the routes
 */
$router->dispatch();

// /**
//  * Group Error
//  * This monitors all Router errors. Are they: 400 Bad Request, 404 Not Found, 405 Method Not Allowed and 501 Not Implemented
//  */
// $router->group("error")->namespace("Test");
// $router->get("/{errcode}", "Coffee:notFound");

// /**
//  * This method executes the routes
//  */

// /*
//  * Redirect all errors
//  */
if ($router->error()) {
  // $router->redirect("/error/{$router->error()}");
  $router->redirect($router->route("rotas.home"));
}
