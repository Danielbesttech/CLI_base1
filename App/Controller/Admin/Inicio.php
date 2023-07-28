<?

namespace App\Controller\Admin;

use App\Middlewares\Auth as MiddlewaresAuth;
use App\Model\geral;
use App\Model\Usuarios;
use App\Utils\Traits\PathsTrait;
class Inicio
{
  use \App\Utils\Traits\AdmTrait;
  public $router, $base_css, $base_routers, $base_template, $params_global, $templates, $loader, $twig;

  public function __construct($router)
  {

    $this->router = $router;
    $this->twig = self::carregaTwigAdm();
    $this->params_global = PathsTrait::loadPaths($this->params_global);
    self::loadRotasAdmin();

  }

  /**
  * Essa função é utilizada para ...
  *
  * @return array|false
  */
   public function Teste($data){

    print json_encode($data);
   }

  public function loadRotasAdmin(){
    return $this->params_global += [
      "rotaAdmConfig" => $this->router->route("rotasadmin.infogeral"),
    ];
  }

  public function Home($data){

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
