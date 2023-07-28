<?
namespace App\Utils\Traits;

use App\Model\geral;
use App\Utils\Config;

trait PathsTrait {

  public static function loadPaths($params_global){
    Config::configUtils();

    return $params_global = [
      "PATH_IMG_BASE"      => $_ENV['PATH_IMG_BASE'],
      "PATH_CSS_SITE"      => $_ENV['PATH_CSS_SITE'],
      "PATH_CSS_ADM"       => $_ENV['PATH_CSS_ADM'],
      "PATH_JS_SITE"       => $_ENV['PATH_JS_SITE'],
      "PATH_IMG_SEM"       => $_ENV['PATH_IMG_SEM'],
      "PATH_IMG_INFOGERAL" => $_ENV['PATH_IMG_INFOGERAL'],
    ];
  }
}
