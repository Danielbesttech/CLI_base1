<?

namespace App\Utils\Traits;
use App\Utils\TwigUtils;

trait AdmTrait {
  public $twig;
  public function carregaTwigAdm(){
    $arrViews = [
      "base"     => "base",
      "home"     => "home",
      "login"    => "login",
      "infogeral"=> "infogeral",
      "modal"    => "modal",
    ];
    $this->twig   = TwigUtils::carregaTwig("views/admin", $arrViews);
    return $this->twig;
  }
}
