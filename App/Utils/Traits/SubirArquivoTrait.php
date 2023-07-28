<?
namespace App\Utils\Traits;

use App\Model\geral;

trait SubirArquivoTrait
{
  /**
   * Retorna o nome do arquivo que subiu ou falso
   *
   * @param pasta_deste_registro Ex: PATH_IMG_EXAMPLE
   * @param id_registro          Ex: 42
   * @param nome_campo_arquivo   Ex: imagem
   *
   * @return string|false
   */
  static function subir($pasta_deste_registro, $id_registro, $nome_campo_arquivo, $obrigatorio_subir = false, $arquivo_anterior = "")
  {
    $nome_arquivo           = @$_FILES[$nome_campo_arquivo]["name"];
    $campo_postado          = @$_FILES[$nome_campo_arquivo]["tmp_name"];
    // geral::pre($nome_arquivo);
    // geral::pre($campo_postado);
    if (empty($campo_postado)) {
      return !$obrigatorio_subir; // retorna false se obrigatorio_subir = true e campo não foi postado
    }

    $pasta_do_id_registro = $_SERVER["DOCUMENT_ROOT"] . $pasta_deste_registro .  '/' . $id_registro;

    @mkdir($pasta_do_id_registro, 0777, true);

    if (chmod($pasta_do_id_registro, 0777)) {
      $pega     = explode(".", $nome_arquivo);
      $extensao = $pega[count($pega) - 1];

      if (in_array(strtolower($extensao), ["php", "js", "css"])) {
        // extensão não permitida
        return false;
      }
      // geral::pre($pasta_deste_registro);
      $nome_arquivo_subiu = microtime() . "." . $extensao;

      $novo_nome = $pasta_do_id_registro . "/" . $nome_arquivo_subiu;

      if (!move_uploaded_file($campo_postado, $novo_nome)) {
        if (!copy($campo_postado, $novo_nome)) {
          return !$obrigatorio_subir;
        }
      }

      /**
       * se chegou aqui é por que subiu
       *
       * Se tiver passado um arquivo anterior, checa se não é um arquivo de sistema para apagar
       **/
      if ($arquivo_anterior != "") {
        $arquivo_anterior = $pasta_do_id_registro . "/" . $arquivo_anterior;

        if (is_file($arquivo_anterior)) {
          unlink($arquivo_anterior);
        }
      }


      return $nome_arquivo_subiu;
    }
    return !$obrigatorio_subir;
  }
}
