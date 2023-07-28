<?
 namespace App\Utils\Traits;

 trait SubirImagem {
  use \App\Utils\Traits\SubirArquivoTrait;
  public function subirImagem($path_img, $nome_campo){
    $classe = new self;
    $dadosAnteriores = $classe->procurar();
    $subir_banner_principal = self::subir($_ENV[$path_img], "", $nome_campo, false, $dadosAnteriores[$nome_campo]);
    $imagem = is_null(filter_var($subir_banner_principal, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE)) ? $subir_banner_principal : $dadosAnteriores[$nome_campo];
    return $imagem;
  }
 }
