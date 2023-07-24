<?

namespace App\Model;
use App\Model\TipoProduto;

class CategoriaProduto extends Cadastro
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

    $db     = $this->db;

    $post[] = $i;

    $query  = "SELECT * FROM categoria_produto WHERE id = ?";
    $res    = $db->select($query, $post);
    return $db->retornarArray($res, false);
  }

  function listarCategoriasProdutos($status = 0)
  {
    $db     = $this->db;

    if ($status > 0)
      $add_pesquisa = " WHERE status = 1";

    $query = "SELECT *
              FROM categoria_produto
              $add_pesquisa ORDER BY ordem ASC";
    $res    = $db->select($query, array());
    return $db->retornarArray($res, true);
  }

  function listarProdutosMenu()
  {
    $db = $this->db;

    $CategoriaProduto = new CategoriaProduto();
    $TipoProduto = new TipoProduto();
    $Produtos = new Produtos();

    $listaProdutos = $CategoriaProduto->listarCategoriasProdutos(Constantes::ATIVO);

    foreach ($listaProdutos as $key => $value) {
      $listaTipoProduto = $TipoProduto->listarTipoProdutoPorCategoria(array('i' => $value['id']), Constantes::ATIVO);

      foreach ($listaTipoProduto as $key2 => $dadosTipoProduto) {
        $arrProdutos = $Produtos->listarProdutosPorTipo(array('i' => $dadosTipoProduto['id']), Constantes::ATIVO);

        if (!empty($arrProdutos)) {
          $arrMenu[$value['id']] = [
            'id' => $value['id'],
            'titulo' => $value['titulo'],
            'img_categoria' => $value['img_categoria']
          ];
        }
      }
    }

    return $arrMenu;
  }

  function inserir($arrayPost)
  {
    extract($arrayPost);

    if (!$this->checar_Arquivo_Enviado(true, "img_categoria")) {
      return false;
    }

    $db     = $this->db;

    $db->execute('BEGIN');

    $query = "INSERT INTO categoria_produto (
                titulo,
                texto,
                status,
                ordem)
                SELECT
                  ?,
                  ?,
                  ?,
                  MAX(ordem) + 1 from categoria_produto";

    $post[] = $titulo;
    $post[] = $texto;
    $post[] = Constantes::ATIVO;

    $result = $db->execute($query, $post);

    if (!$result) {
      $db->setLastError("Não foi possível inserir este cadastro.");
      return false;
    }
    $id_imagem = mysqli_insert_id($db->db);

    if ($id_imagem > 0) {

      # Atualizou os dados, posso mover arquivo que subiu
      $result = $this->mover_arquivo_para_pasta_do_registro($id_imagem, "img_categoria", "img_categoria");

      if ($result) {
        $query = "COMMIT";
        $db->execute($query);
        return $id_imagem;
      }
    }

    $query = "ROLLBACK";
    $db->execute($query);

    return false;
  }
  function alterar($arrayPost)
  {
    extract($arrayPost);

    if (!$this->checar_Arquivo_Enviado(false, "img_categoria")) {
      return false;
    }

    $db     = $this->db;
    $db->execute('BEGIN');

    $query = "UPDATE categoria_produto
                  SET
                titulo      = ?,
                texto       = ?
                  WHERE
                    id = ?
                  ";

    $post[] = $titulo;
    $post[] = $texto;
    $post[] = $i;

    $result = $db->execute($query, $post);

    if (!$result) {
      $db->setLastError("Não foi possível alterar este cadastro.");
      return false;
    }

    if (!empty($_FILES['img_categoria']['name'])) {
      $result = $this->mover_arquivo_para_pasta_do_registro($i, "img_categoria", "img_categoria");
    }

    if ($result) {
      $query = "COMMIT";
      $db->execute($query);
      return true;
    }

    $query = "ROOLBACK";
    $db->execute($query);

    return false;
  }

  function status($arrayPost)
  {
    extract($arrayPost);

    $db     = $this->db;

    $query = "UPDATE categoria_produto SET status = !status WHERE id = ?";
    return $db->execute($query, array($i));
  }

  function deletar($arrayPost)
  {
    extract($arrayPost);

    extract($this->procurar(array('i' => $i)));

    $TipoProduto = new TipoProduto();
    $tipoProdutoPorCategoria = $TipoProduto->listarTipoProdutoPorCategoria(array('i' => $i));

    $db = $this->db;
    $db->execute('BEGIN');

    foreach ($tipoProdutoPorCategoria as $key => $value) {
      $result = $TipoProduto->deletar(array('i' => $value['id']));
    }

    if (!$result) {
      $db->setLastError("Não foi possível deletar este cadastro. (1)");
      $db->execute('ROLLBACK');
      return false;
    }

    $query = "DELETE FROM categoria_produto WHERE id = ?";
    $post[] = $i;
    $result = $db->execute($query, $post);

    if (!$result) {
      $db->setLastError("Não foi possível deletar este cadastro. (2)");
      $db->execute('ROLLBACK');
      return false;
    }

    if (file_exists(PATH_IMG_CATEGORIAS_PRODUTO . $i . '/' .  $img_categoria)) {
      unlink(PATH_IMG_CATEGORIAS_PRODUTO . $i . '/' .  $img_categoria);
      rmdir(PATH_IMG_CATEGORIAS_PRODUTO . $i);
    }

    $db->execute('COMMIT');

    return $result;
  }

  function ordem($arrayPost)
  {
    extract($arrayPost);
    $db     = $this->db;

    // ordem anterior
    $query = "UPDATE categoria_produto SET ordem = ? WHERE ordem = ?";
    $db->execute($query, array($ordemAnt, $ordem));

    // nova ordem
    $query = "UPDATE categoria_produto SET ordem = ? WHERE id = ?";
    return $db->execute($query, array($ordem, $i));
  }

  /**
   *  Essa funcao pega o arquivo que foi postado e move para a pasta do material
   *  Ela é chamada após ser checado se o arquivo é válido.
   */
  function mover_arquivo_para_pasta_do_registro($id_imagem, $nome_campo_arquivo, $campo_tabela, $remover = false)
  {
    #
    $db     = $this->db;

    $nome_campo             = $nome_campo_arquivo;
    $nome_arquivo           = @$_FILES[$nome_campo]["name"];
    $campo_postado          = @$_FILES[$nome_campo]["tmp_name"];

    $pasta_deste_registro     = PATH_IMG_CATEGORIAS_PRODUTO;

    if ($remover) {

      $dadosAntigos   = $this->procurar(array("i" => $id_imagem));
      $imagem_antiga  = $dadosAntigos[$campo_tabela];

      if ($imagem_antiga != "") {
        @unlink($pasta_deste_registro . $id_imagem . "/" . $imagem_antiga);
      }

      $query = "UPDATE categoria_produto SET $campo_tabela = ? WHERE id = ?";
      $db->execute($query, array("", $id_imagem));


      // Se marcou pra remover, só remove e não continua
      return true;
    }

    if (empty($campo_postado)) {
      return true;
    }

    if (chmod($pasta_deste_registro, 0777)) {
      @mkdir($pasta_deste_registro, 0777);
      @mkdir($pasta_deste_registro . $id_imagem, 0777);

      # Mover arquivo e apagar apenas se mover.

      $pega     = explode(".", $nome_arquivo);
      $extensao = $pega[count($pega) - 1];

      $imagem = rand(1, 99) . time() . "." . $extensao;

      $novo_nome = $pasta_deste_registro . $id_imagem . "/" . $imagem;

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

      $query = "UPDATE categoria_produto SET $campo_tabela = ? WHERE id = ?";
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
