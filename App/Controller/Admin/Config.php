<?

namespace App\Controller\Admin;

use App\Model\geral;
use App\Utils\AdmTrait;

class Config {

  public $twig, $router, $params_config;

  public function __construct($router)
  {
    $this->router = $router;

    $this->twig = AdmTrait::carregaTwigAdm();
  }

  public function Home(){
    echo $this->twig->render('@config/index.html.twig');
  }
}
