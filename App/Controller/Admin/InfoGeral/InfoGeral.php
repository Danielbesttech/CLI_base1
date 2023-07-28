<?

namespace App\Controller\Admin\InfoGeral;

use App\Model\geral;
use App\Model\InfoGeral as ModelInfoGeral;
use App\Utils\Config;
use App\Utils\Traits\PathsTrait;

class InfoGeral {
  use \App\Utils\Traits\AdmTrait;

  public $twig, $router, $params_config, $params_global, $infoGeral;

  public function __construct($router)
  {
    $this->router = $router;
    // Config::configUtils();
    $this->twig = self::carregaTwigAdm();
    $this->params_global = PathsTrait::loadPaths($this->params_global);
    $this->infoGeral = new ModelInfoGeral();
  }

  public function Home(){
    // $InfoGeral = new ModelInfoGeral();
    $Dados = $this->infoGeral->procurar();

    $dadosInfo = $this->tratarPathImgs($Dados);

    $this->params_global += [
      "DadosInfoGeral" => $dadosInfo,
    ];
    echo $this->twig->render('@infogeral/index.html.twig', $this->params_global);
  }


  public function Atualizar($data){

    $atualizar = $this->infoGeral->alterar($data);
    // geral::pre($atualizar);
    if($atualizar){
      $retorno = [
        "status_retorno" => true,
        "mensagem"       => "Dados atualizados com sucesso! "
      ];
    }else{
      $retorno = [
        "0" => 0,
        "1"       => "Não foi possível atualizar os dados! "
      ];
    }
    print json_encode($retorno);
  }


  protected function tratarPathImgs($dados){
    // $dados['anterior_banner_mobile']    = $dados['banner_mobile'];
    // $dados['anterior_banner_principal'] = $dados['banner_principal'];
    $dados['path_banner_mobile']    = $_ENV['PATH_IMG_INFOGERAL'] . $dados['banner_mobile'];
    $dados['path_banner_principal'] = $_ENV['PATH_IMG_INFOGERAL'] . $dados['banner_principal'];
    return $dados;
  }
}
