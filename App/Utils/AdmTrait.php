<?

namespace App\Utils;
use App\Utils\TwigUtils;

trait AdmTrait {

  public static function carregaTwigAdm(){
    $arrViews = [
      "base"  => "base",
      "home"  => "home",
      "login" => "login",
      "config"=> "config",
    ];
    $twig   = TwigUtils::carregaTwig("views/admin", $arrViews);
    return $twig;
  }
}
