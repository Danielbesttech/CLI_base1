<?php

namespace App\Model;

class InfoGeral
{
  private $db;

  function __construct($db = null)
  {
    if ($db != null) {
      $this->db = $db;
    } else {
      $this->db                       = new dbConnect();
    }
  }

  function alterar($arrayPost)
  {
    if (empty($arrayPost)) {
      $this->db->setLastError(Constantes::PARAMETROS_INVALIDOS);
      return false;
    }
    extract($arrayPost);

    if (!$this->checar_Arquivo_Enviado(false, "banner_principal")) {
      return false;
    }

    if (!$this->checar_Arquivo_Enviado(false, "banner_mobile")) {
      return false;
    }

    $db = $this->db;

    $query = "UPDATE infogeral
                SET
                  endereco             = ?,
                  bairro               = ?,
                  cep                  = ?,
                  cidade               = ?,
                  estado               = ?,
                  titulo_contato       = ?,
                  subtitulo1_contato   = ?,
                  descricao1_contato   = ?,
                  subtitulo2_contato   = ?,
                  descricao2_contato   = ?,
                  twitter              = ?,
                  instagram            = ?,
                  youtube              = ?,
                  facebook             = ?,
                  telefone             = ?,
                  whatsapp             = ?
                WHERE id = 1
                ";

    $post[] = $endereco;
    $post[] = $bairro;
    $post[] = $cep;
    $post[] = $cidade;
    $post[] = $estado;
    $post[] = $titulo_contato;
    $post[] = $subtitulo1_contato;
    $post[] = $descricao1_contato;
    $post[] = $subtitulo2_contato;
    $post[] = $descricao2_contato;
    $post[] = $twitter;
    $post[] = $instagram;
    $post[] = $youtube;
    $post[] = $facebook;
    $post[] = $telefone;
    $post[] = $whatsapp;
    // $post[] = $titulo_banner;
    // $post[] = $texto_banner;

    $db     = $this->db;

    $result = $db->execute($query, $post);

    if (!$result) {
      $db->setLastError("Não foi possível alterar as configurações.");
      return false;
    }

    # Atualizou os dados, posso mover arquivo que subiu
    $this->mover_arquivo_para_pasta_do_registro(1, "banner_principal");
    $this->mover_arquivo_para_pasta_do_registro(1, "banner_mobile");

    return true;
  }

  function alterarHistoria($arrayPost)
  {
    if (empty($arrayPost)) {
      $this->db->setLastError(Constantes::PARAMETROS_INVALIDOS);
      return false;
    }
    extract($arrayPost);

    $db = $this->db;

    $query = "UPDATE infogeral
                SET
                  texto_nossa_historia = ?
                WHERE id = 1
                ";

    $post[] = $texto_nossa_historia;

    $db     = $this->db;

    $result = $db->execute($query, $post);

    if (!$result) {
      $db->setLastError("Não foi possível alterar as configurações.");
      return false;
    }

    # Atualizou os dados, posso mover arquivo que subiu
    $this->mover_arquivo_para_pasta_do_registro(1, "img_nossa_historia");

    return true;
  }

  function checar_Arquivo_Enviado($inserindo, $nome_campo)
  {
    // CAMPO NO FORMULÁRIO DEVE SER NOMEADO COMO "ARQUIVO"

    $arquivo_valido         = false;
    $campo_postado          = @$_FILES[$nome_campo];
    $tem_arquivo_postado    = !empty($campo_postado["size"]);

    if ($tem_arquivo_postado) {
      $pega     = explode(".", $campo_postado["name"]);
      $extensao = strtolower($pega[count($pega) - 1]);

      $arquivo_valido = in_array($extensao, Constantes::$extensoes);
    }

    if (
      ($arquivo_valido) ||
      (!$inserindo && !$tem_arquivo_postado)
    ) {
      return true;
    } else {
      $erro = Language::$erros["ARQUIVO_INVALIDO"];
      $erro = str_replace("[extensoes]", "<span style='color: red; font-weight: bold'>" . Constantes::pegar_Extensoes_Permitidas() . "</span>", $erro);
      $erro = str_replace("[tamanho]",   "<span style='color: red; font-weight: bold'>" . Constantes::pegar_Tamanho_Maximo_Upload() . "</span>", $erro);

      $this->db->setLastError($erro);
      return false;
    }
  }

  /**
   *  Essa funcao pega o arquivo que foi postado e move para a pasta do material
   *  Ela é chamada após ser checado se o arquivo é válido.
   */
  function mover_arquivo_para_pasta_do_registro($id_imagem, $nome_campo)
  {
    #
    $db     = $this->db;

    $nome_arquivo           = @$_FILES[$nome_campo]["name"];
    $campo_postado          = @$_FILES[$nome_campo]["tmp_name"];

    if (empty($campo_postado)) {
      return true;
    }
    $pasta_deste_registro     = PATH_IMG_NOSSA_HISTORIA;

    if (chmod($pasta_deste_registro, 0777)) {
      @mkdir($pasta_deste_registro, 0777);

      # Mover arquivo e apagar apenas se mover.

      $pega     = explode(".", $nome_arquivo);
      $extensao = $pega[count($pega) - 1];

      $imagem = time() . "." . $extensao;

      $novo_nome = $pasta_deste_registro . "/" . $imagem;

      if (!move_uploaded_file($campo_postado, $novo_nome)) {
        if (!copy($campo_postado, $novo_nome)) {
          return false;
        }
      }

      $dadosAntigos   = $this->procurar($db);

      $imagem_antiga  = $dadosAntigos[$nome_campo];

      if ($imagem_antiga != "") {
        @unlink($pasta_deste_registro . $imagem_antiga);
      }

      $query = "UPDATE infogeral SET $nome_campo = ? WHERE id = ?";
      $db->execute($query, array($imagem, $id_imagem));
    }
    return true;
  }

  function procurar()
  {
    $db = $this->db;
    return $db->retornarArray($db->select("SELECT * from infogeral"), false);
  }

  function getLastError()
  {
    return $this->db->getLastError();
  }
}
