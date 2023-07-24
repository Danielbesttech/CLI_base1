<?
namespace App\Model;

class Constantes
{
  const ATIVO = 1;
  const INATIVO = 0;
  const DELETADO = 9;

  const ADM_OVERSEE   = 1;
  const ADM_CLIENTE   = 2;
  const ADM_CONTEUDOS = 3;

  const ID_CONHECA_NOSSSO_RESTAURANTE = 1;
  const ID_RESTAURANTE_HOME = 2;

  const PARAMETROS_INVALIDOS = "Parâmetros inválidos";

  static $extensoes = array("jpg", "jpeg", "bmp", "png", "gif");

  static $extensoesPDF = array("PDF", "pdf");

  static $extensoesAudio = array("mp3");

  static $extensoesVideo = array("mp4");

  static $Roles = array(
    self::ADM_CLIENTE   => "Administrador",
    self::ADM_CONTEUDOS => "Gerenciador de Conteúdos",
  );

  static $arrayDiasSemana = array(
    "Domingo"       =>  "domingo",
    "Segunda-feira" =>  "segunda",
    "Terca-feira"   =>  "terca",
    "Quarta-feira"  =>  "quarta",
    "Quinta-feira"  =>  "quinta",
    "Sexta-feira"   =>  "sexta",
    "Sábado"        =>  "sabado",
  );

  static function pegar_Extensoes_Permitidas()
  {
    return implode(", ", self::$extensoes);
  }

  static function pegar_Extensoes_Permitidas_Audio()
  {
    return implode(", ", self::$extensoesAudio);
  }

  static function pegar_Extensoes_Permitidas_Video()
  {
    return implode(", ", self::$extensoesVideo);
  }

  static function pegar_Extensoes_Permitidas_PDF()
  {
    return implode(", ", self::$extensoesPDF);
  }

  static function pegar_Tamanho_Maximo_Upload()
  {
    return ini_get("upload_max_filesize");
  }
}
