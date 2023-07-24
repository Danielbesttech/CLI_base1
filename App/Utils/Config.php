<?
namespace App\Utils;
use Dotenv\Dotenv;
class Config {

  static function configUtils(){
    $dotenv = Dotenv::createImmutable(__DIR__, "configUtils");
    $dotenv->load();
    session_start();

  }
}
