<?

namespace App\Utils;

use App\Model\geral;

class TestRedirect{

  public static function redirecionarCoffee($router){
    geral::pre($router->current());

    $router->redirect("/quem-somos/");
    geral::pre($router);
    die("aqui");
  }
}
