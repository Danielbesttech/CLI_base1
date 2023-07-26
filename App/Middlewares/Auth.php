<?

namespace App\Middlewares;

use App\Model\geral;
use \App\Utils\Config as UtilsConfig;
class Auth {

  public static function verificaLogado($router){

    UtilsConfig::configUtils();
    if(!isset($_SESSION[$_ENV["SISTEMA"]]["ADM"])){
     $router->redirect("rotasadmin.login");
    }
    return true;
  }

  //#ALTERAR implementar
  public static function logar($loginValido){
    if($loginValido){
      self::iniciaSession();
      UtilsConfig::configUtils();
      return true;
    }else {
      return false;
    }
  }

  public static function logout($router){

    self::finalizSession();
    $router->redirect($router->route("rotasadmin.login"));
  }

  private static function iniciaSession(){

    UtilsConfig::configUtils();

    if(!isset($_SESSION[$_ENV["SISTEMA"]]["ADM"])){
      $_SESSION[$_ENV["SISTEMA"]]["ADM"]["INICIADA"] = $_SERVER['REQUEST_TIME'];
    }

    return true;
  }

  private static function finalizSession(){
    UtilsConfig::configUtils();

    if(isset($_SESSION[$_ENV["SISTEMA"]]["ADM"])){
      self::sessionDestroy();
      unset($_SESSION[$_ENV["SISTEMA"]]["ADM"]);
    }
    return true;
  }

  protected static function sessionStart(){
    session_start();
    return true;
  }


  protected static function sessionDestroy(){
    session_destroy();
    session_unset();
    return true;
  }

  public function handle($router){
    self::verificaLogado($router);
    return true;
  }
}
