<?

namespace App\Model;

class ConhecaNossoRestaurante extends Cadastro
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

  function procurar($arrayPost)
  {
    /**
     * 1) Criar query de selecao
     * 2) Retornar lista
     */

    if (!empty($arrayPost))
      extract($arrayPost);

    $post           = array();

    $post[] = $i;
    $db     = $this->db;

    $query  = "SELECT * from conheca_nosso_restaurante WHERE id = ?";
    $res    = $db->select($query, $post);
    return $db->retornarArray($res, false);
  }

  function listar($arrayPost, $status = false)
  {
    extract($arrayPost);

    $post[] = $tipo_imagem;

    if ($status === true) {
      $add_search = ' AND status = 1';
    }

    $db     = $this->db;

    $query  = "SELECT * from conheca_nosso_restaurante WHERE tipo_imagem = ? $add_search order by ordem asc";
    $res    = $db->select($query, $post);
    return $db->retornarArray($res, true);
  }

  function inserir($arrayPost)
  {
    extract($arrayPost);

    if (!$this->checar_Arquivo_Enviado(true, "imagem")) {
      return false;
    }

    $db     = $this->db;

    $db->execute('BEGIN');

    $query = "INSERT INTO
                conheca_nosso_restaurante
                (
                  descricao,
                  tipo_imagem,
                  ordem
                )
                SELECT
                ?,
                ?,
                MAX(ordem) + 1 from conheca_nosso_restaurante";

    $post[] = $descricao;
    $post[] = $tipo_imagem;

    $result = $db->execute($query, $post);

    if (!$result) {
      $db->setLastError("Não foi possível inserir este cadastro.");
      return false;
    }
    $id_imagem = mysqli_insert_id($db->db);

    if ($id_imagem > 0) {

      # Atualizou os dados, posso mover arquivo que subiu
      $result = $this->mover_arquivo_para_pasta_do_registro($id_imagem, "imagem", "imagem");

      if ($result)
        $result = $this->mover_arquivo_para_pasta_do_registro($id_imagem, "imagem_mobile", "imagem_mobile");

      if ($result) {
        $query = "COMMIT";
        $db->execute($query);
        return $id_imagem;
      }
    }

    $query = "ROOLBACK";
    $db->execute($query);

    return false;
  }

  function alterar($arrayPost)
  {
    extract($arrayPost);

    if (!$this->checar_Arquivo_Enviado(false, "imagem")) {
      return false;
    }

    $db     = $this->db;

    $query = "UPDATE conheca_nosso_restaurante
                  SET
                    descricao = ?
                  WHERE
                    id = ?
                  ";

    $post[] = $descricao;
    $post[] = $i;

    $result = $db->execute($query, $post);

    if (!$result) {
      $db->setLastError("Não foi possível alterar este cadastro.");
      return false;
    }

    $this->mover_arquivo_para_pasta_do_registro($i, "imagem", "imagem");
    $this->mover_arquivo_para_pasta_do_registro($i, "imagem_mobile", "imagem_mobile");

    return true;
  }

  function deletar($arrayPost)
  {
    extract($arrayPost);

    extract($this->procurar(array('i' => $i)));

    $db     = $this->db;

    $query = "DELETE FROM conheca_nosso_restaurante
                  WHERE
                    id = ?
                  ";

    $post[] = $i;

    $result = $db->execute($query, $post);

    if (!$result) {
      $db->setLastError("Não foi possível alterar este cadastro.");
      return false;
    }

    if (file_exists(PATH_IMG_CONHECA .  $imagem)) {
      unlink(PATH_IMG_CONHECA .  $imagem);
    }

    if (file_exists(PATH_IMG_CONHECA .  $imagem_mobile)) {
      unlink(PATH_IMG_CONHECA .  $imagem_mobile);
    }

    return $result;
  }

  function status($arrayPost)
  {
    extract($arrayPost);

    $db     = $this->db;

    $query = "UPDATE conheca_nosso_restaurante SET status = !status WHERE id = ?";
    return $db->execute($query, array($i));
  }


  function ordem($arrayPost)
  {

    extract($arrayPost);
    $db     = $this->db;

    // ordem anterior
    $query = "UPDATE conheca_nosso_restaurante SET ordem = ? WHERE ordem = ?";
    $db->execute($query, array($ordemAnt, $ordem));

    // nova ordem
    $query = "UPDATE conheca_nosso_restaurante SET ordem = ? WHERE id = ?";
    return $db->execute($query, array($ordem, $i));
  }

  /**
   *  Essa funcao pega o arquivo que foi postado e move para a pasta do material
   *  Ela é chamada após ser checado se o arquivo é válido.
   */
  function mover_arquivo_para_pasta_do_registro($id_imagem, $nome_campo_arquivo, $campo_tabela)
  {
    #
    $db     = $this->db;

    $nome_campo             = $nome_campo_arquivo;
    $nome_arquivo           = @$_FILES[$nome_campo]["name"];
    $campo_postado          = @$_FILES[$nome_campo]["tmp_name"];

    $pasta_deste_registro     = PATH_IMG_CONHECA;

    if (empty($campo_postado)) {
      return true;
    }

    if (chmod($pasta_deste_registro, 0777)) {
      @mkdir($pasta_deste_registro, 0777);

      # Mover arquivo e apagar apenas se mover.

      $pega     = explode(".", $nome_arquivo);
      $extensao = $pega[count($pega) - 1];

      $imagem = time() . "." . $extensao;

      $novo_nome = $pasta_deste_registro . $imagem;

      if (!move_uploaded_file($campo_postado, $novo_nome)) {
        if (!copy($campo_postado, $novo_nome)) {
          return false;
        }
      }

      $dadosAntigos   = $this->procurar(array("i" => $id_imagem));
      $imagem_antiga  = $dadosAntigos[$campo_tabela];

      if ($imagem_antiga != "") {
        @unlink($pasta_deste_registro . $imagem_antiga);
      }

      $query = "UPDATE conheca_nosso_restaurante SET $campo_tabela = ? WHERE id = ?";
      $db->execute($query, array($imagem, $id_imagem));
    }
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

  function getLastError()
  {
    return $this->db->getLastError();
  }
}
