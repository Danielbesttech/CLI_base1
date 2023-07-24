<?

namespace App\Controller\Admin;

use App\Middlewares\Auth as MiddlewaresAuth;
use App\Model\geral;
use App\Utils\TwigUtils;
class Inicio
{
  public $router, $base_css, $base_routers, $base_template, $params_global, $templates, $loader, $twig;

  public function __construct($router)
  {
    $this->router = $router;
    $arrViews = [
      "base"  => "base",
      "home"  => "home",
      "login" => "login"
    ];
    $this->twig   = TwigUtils::carregaTwig("views/admin", $arrViews);
  }

  public function Home($data){
    // die(geral::pre($_SESSION));
    MiddlewaresAuth::verificaLogado();
    echo $this->twig->render('@home/index.html.twig');
  }

  public function Login($data){
    // geral::pre($_SESSION);
    // MiddlewaresAuth::logar(true);
    echo $this->twig->render('@login/index.html.twig');
  }

  public function Logout(){

    MiddlewaresAuth::logout();
  }

  public function Logar($data){
    geral::pre($data);
    geral::pre(base64_decode($data));


  }
}
