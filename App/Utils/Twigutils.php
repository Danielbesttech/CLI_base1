<?

namespace App\Utils;

use Twig\Environment as constructTwig;
use Twig\Loader\FilesystemLoader as loaderUtils;
use Twig\Cache\FilesystemCache as cacheUtils;

class TwigUtils {

  /**
   * @param string $view like "views/client"
   * @param array $arrViews like ["folder_name" => "alias"]
   * @param boolean $cacheAtivo like TRUE or nothing
   */
  static public function carregaTwig($view, $arrViews, $cacheAtivo = false){
    $loader = new loaderUtils('./'.$view);
    foreach ($arrViews as $key => $value) {
      $loader->addPath(dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . $view .'/'. $key, $value);
    }

    if($cacheAtivo){
      $cache = new cacheUtils('./'.$view.'/'.'cache/', cacheUtils::FORCE_BYTECODE_INVALIDATION);
      $loaderCache = [
        'cache' => $cache,
        'auto_reload' => true
      ];
    }else {
      $loaderCache = [];
    }

    $twig = new constructTwig($loader, $loaderCache);

    return $twig;
  }
}
