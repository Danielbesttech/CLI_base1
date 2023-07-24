<?
namespace App\Model;

class Produtos extends Cadastro
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

    $query  = "SELECT *, id_tipo_produto as idTipoProduto from produtos WHERE id = ?";
    $res    = $db->select($query, $post);
    return $db->retornarArray($res, false);
  }

  function listarProdutosPorTipo($arrayPost, $status = 0)
  {
    extract($arrayPost);

    $post[] = $i;

    $db     = $this->db;

    if ($status > 0)
      $add_pesquisa = " AND status = 1";

    $query  = "SELECT * from produtos WHERE id_tipo_produto = ? $add_pesquisa ORDER BY ordem ASC";
    $res    = $db->select($query, $post);
    return $db->retornarArray($res, true);
  }

  function listarProdutos()
  {
    $db     = $this->db;

    $query  = "SELECT * from produtos";
    $res    = $db->select($query, array());
    return $db->retornarArray($res, true);
  }

  function listarDestaques()
  {
    $db = $this->db;

    $query = "SELECT p.*, tp.id_categoria 
              FROM produtos p
              INNER JOIN tipo_produto tp ON (tp.id = p.id_tipo_produto) 
              WHERE destaque = 1";
    $res    = $db->select($query, array());
    return $db->retornarArray($res, true);
  }

  function inserir($arrayPost)
  {
    extract($arrayPost);

    if (!$this->checar_Arquivo_Enviado(true, "img_produto")) {
      return false;
    }

    $db     = $this->db;

    $db->execute('BEGIN');

    $idCategoriaProduto = $this->getCategoriaPorID(array('i' => $id_tipo_produto));
    extract($idCategoriaProduto);

    $query = "INSERT INTO produtos (
                titulo,
                subtitulo,
                descricao,
                preco,
                preco_promo,
                id_tipo_produto,
                destaque,
                status,
                ordem
              )
                SELECT
              ?,
              ?,
              ?,
              ?,
              ?,
              ?,
              ?,
              ?,
              MAX(ordem) + 1 from produtos";

    $post[] = $titulo;
    $post[] = $subtitulo;
    $post[] = $descricao;
    $post[] = str_replace(array('.', ','), '', $preco);
    $post[] = str_replace(array('.', ','), '', $preco_promo);
    $post[] = $id_tipo_produto;
    $post[] = isset($destaque) ? 1 : '0';
    $post[] = Constantes::ATIVO;

    $result = $db->execute($query, $post);

    if (!$result) {
      $db->setLastError("Não foi possível inserir este cadastro.");
      return false;
    }
    $id_imagem = mysqli_insert_id($db->db);

    if ($id_imagem > 0) {

      # Atualizou os dados, posso mover arquivo que subiu
      $result = $this->mover_arquivo_para_pasta_do_registro($id_imagem, "img_produto", "img_produto", $idCategoria, $id_tipo_produto);

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

    if (!$this->checar_Arquivo_Enviado(false, "img_produto")) {
      return false;
    }

    $db     = $this->db;

    $query = "UPDATE produtos
                  SET
                    titulo          = ?,
                    subtitulo       = ?,
                    descricao       = ?,
                    preco           = ?,
                    preco_promo     = ?,
                    id_tipo_produto = ?,
                    destaque        = ?
                  WHERE
                    id = ?
                  ";



    $post[] = $titulo;
    $post[] = $subtitulo;
    $post[] = $descricao;
    $post[] = str_replace(array('.', ','), '', $preco);
    $post[] = str_replace(array('.', ','), '', $preco_promo);
    $post[] = $id_tipo_produto;
    $post[] = isset($destaque) ? 1 : '0';
    $post[] = $i;

    $result = $db->execute($query, $post);


    if (!$result) {
      $db->setLastError("Não foi possível alterar este cadastro.");
      return false;
    }

    $idCategoriaProduto = $this->getCategoriaPorID(array('i' => $id_tipo_produto));
    extract($idCategoriaProduto);

    $this->mover_arquivo_para_pasta_do_registro($i, "img_produto", "img_produto", $idCategoria, $id_tipo_produto);

    return true;
  }

  function deletar($arrayPost)
  {
    extract($arrayPost);

    extract($this->procurar(array('i' => $i)));

    $db     = $this->db;

    $query = "DELETE FROM produtos WHERE id = ?";

    $post[] = $i;

    $result = $db->execute($query, $post);

    if (!$result) {
      $db->setLastError("Não foi possível alterar este cadastro.");
      return false;
    }

    $idCategoriaProduto = $this->getCategoriaPorID(array('i' => $id_tipo_produto));
    extract($idCategoriaProduto);

    if (file_exists(PATH_IMG_CATEGORIAS_PRODUTO . $idCategoria . '/' . $id_tipo_produto . '/' . $id . '/' . $img_produto)) {
      unlink(PATH_IMG_CATEGORIAS_PRODUTO . $idCategoria . '/' . $id_tipo_produto . '/' . $id . '/' . $img_produto);
      rmdir(PATH_IMG_CATEGORIAS_PRODUTO . $idCategoria . '/' . $id_tipo_produto . '/' . $id);
    }

    return $result;
  }

  function status($arrayPost)
  {
    extract($arrayPost);

    $db     = $this->db;

    $query = "UPDATE produtos SET status = !status WHERE id = ?";
    return $db->execute($query, array($i));
  }

  function ordem($arrayPost)
  {
    extract($arrayPost);
    $db     = $this->db;

    // ordem anterior
    $query = "UPDATE produtos SET ordem = ? WHERE ordem = ?";
    $db->execute($query, array($ordemAnt, $ordem));

    // nova ordem
    $query = "UPDATE produtos SET ordem = ? WHERE id = ?";
    return $db->execute($query, array($ordem, $i));
  }

  /**
   *  Essa funcao pega o arquivo que foi postado e move para a pasta do material
   *  Ela é chamada após ser checado se o arquivo é válido.
   */
  function mover_arquivo_para_pasta_do_registro($id_imagem, $nome_campo_arquivo, $campo_tabela, $idCategoriaProduto, $idTipoProduto)
  {
    #
    $db     = $this->db;

    $nome_campo             = $nome_campo_arquivo;
    $nome_arquivo           = @$_FILES[$nome_campo]["name"];
    $campo_postado          = @$_FILES[$nome_campo]["tmp_name"];

    $pasta_deste_registro     = PATH_IMG_CATEGORIAS_PRODUTO;

    if (empty($campo_postado)) {
      return true;
    }

    if (chmod($pasta_deste_registro, 0777)) {
      @mkdir($pasta_deste_registro .  $idCategoriaProduto . '/' . $idTipoProduto . '/' . $id_imagem, 0777, true);

      # Mover arquivo e apagar apenas se mover.

      $pega     = explode(".", $nome_arquivo);
      $extensao = $pega[count($pega) - 1];

      $imagem = time() . "." . $extensao;

      $novo_nome = $pasta_deste_registro .  $idCategoriaProduto . '/' . $idTipoProduto . '/' . $id_imagem . "/" . $imagem;

      if (!move_uploaded_file($campo_postado, $novo_nome)) {
        if (!copy($campo_postado, $novo_nome)) {
          return false;
        }
      }

      $dadosAntigos   = $this->procurar(array("i" => $id_imagem));
      $imagem_antiga  = $dadosAntigos[$campo_tabela];

      if ($imagem_antiga != "") {
        @unlink($pasta_deste_registro . $id_imagem . "/" . $imagem_antiga);
      }

      $query = "UPDATE produtos SET $campo_tabela = ? WHERE id = ?";
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

  function getCategoriaPorID($arrayPost)
  {
    extract($arrayPost);

    $res = $this->db->select('SELECT id_categoria as idCategoria FROM tipo_produto WHERE id = ?', array('i' => $i));
    return $this->db->retornarArray($res, false);
  }

  function getLastError()
  {
    return $this->db->getLastError();
  }
}
