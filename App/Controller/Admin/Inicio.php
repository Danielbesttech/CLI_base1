<?

namespace App\Controller\Admin;

use App\Middlewares\Auth as MiddlewaresAuth;
use App\Model\geral;
use App\Model\Usuarios;
use App\Utils\TwigUtils;
use App\Utils\AdmTrait;
class Inicio
{
  public $router, $base_css, $base_routers, $base_template, $params_global, $templates, $loader, $twig;

  public function __construct($router)
  {
    $this->router = $router;
    // $arrViews = [
    //   "base"  => "base",
    //   "home"  => "home",
    //   "login" => "login"
    // ];
    // $this->twig   = TwigUtils::carregaTwig("views/admin", $arrViews);
    $this->twig = AdmTrait::carregaTwigAdm();
    self::loadRotasAdmin();
  }

  public function loadRotasAdmin(){
    return $this->params_global = [
      "rotaAdmConfig" => $this->router->route("rotasadmin.config"),
    ];
  }


  public function Home($data){

    // MiddlewaresAuth::verificaLogado($this->router);
    $arrAdm = $this->params_global;
    echo $this->twig->render('@home/index.html.twig', $arrAdm);
  }

  public function Login($data){
    // $add = $Usuario->inserir(["roleid"=>2, "nome"=>"Teste Oversee", "ovrusr"=>"Oversee", "ovrpwd"=>123]);
    echo $this->twig->render('@login/index.html.twig');
  }

  public function Logout(){

    MiddlewaresAuth::logout($this->router);
  }

  public function Logar($data){
    $login = $data["login"];
    $senha = base64_decode($data["senha"]);
    $Usuario = new Usuarios();
    $logando = $Usuario->login(["ovrusr"=>$login,"ovrpwd"=>$senha]);

    $logando = MiddlewaresAuth::logar($logando);

    if(!$logando){
      print_r(json_encode(["0"=> 0, "1"=>" login e/ou senha incorretos! "]));
      return false;
    }
      print_r(json_encode([ "0"=>true,"1" => $_ENV['URL_ADM']]));
      return true;
  }
}
