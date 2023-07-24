<?

namespace App\Middlewares;

use App\Model\geral;
use \App\Utils\Config as UtilsConfig;
class Auth {

  public static function verificaLogado(){
    // return self::iniciaSession();
    // return self::finalizSession();
    // die(geral::pre($_SESSION));
    if(!isset($_SESSION["ADM"])){
      UtilsConfig::configUtils();
      header("Location: $_ENV[URL_SITE]/admin/login");
      die;
    }else{
      return true;
    }
  }

  //#ALTERAR implementar
  public static function logar($data){
    if($data === true ){
      self::iniciaSession();
      UtilsConfig::configUtils();
      sleep(2);
      header("Location: $_ENV[URL_SITE]/admin");
      die;
    }else {
      header("Location: $_ENV[URL_SITE]/admin/login");
      die;
    }
  }

  public static function logout(){
    self::finalizSession();
    header("Location: $_ENV[URL_SITE]/admin/login");
    die;
  }

  private static function iniciaSession(){


    if(!isset($_SESSION["ADM"])){
      // self::sessionStart();
      $_SESSION["ADM"] = $_SERVER['REQUEST_TIME'];
      // geral::pre($_SESSION);
    }

    return true;
  }

  private static function finalizSession(){
    if(isset($_SESSION["ADM"])){
      unset($_SESSION["ADM"]);
    }
    return true;
  }

  protected static function sessionStart(){
    session_start();
    return true;
  }


  protected static function sessionDestroy(){
    session_destroy();
    return true;
  }
}
