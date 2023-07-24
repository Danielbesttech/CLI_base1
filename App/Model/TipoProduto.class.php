<?
namespace App\Model;

class TipoProduto extends Cadastro
{
  private $db;

  function __construct($db = null)
  {
    if ($db != null) {
      $this->db = $db;
    } else {
      $this->db = new dbConnect();
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

    $post[]           = $i;

    $db     = $this->db;

    $query  = "SELECT *, id_categoria as idTipoProduto FROM tipo_produto WHERE id = ?";
    $res    = $db->select($query, $post);
    return $db->retornarArray($res, false);
  }


  function listarTipoProdutoPorCategoria($arrayPost, $status = 0)
  {

    extract($arrayPost);

    $post[] = $i;
    $db     = $this->db;

    if ($status > 0)
      $add_pesquisa = " AND status = 1";

    $query  = "SELECT * from tipo_produto WHERE id_categoria = ? $add_pesquisa ORDER BY ordem ASC";
    $res    = $db->select($query, $post);
    return $db->retornarArray($res, true);
  }

  function listarTipoProduto()
  {
    $db     = $this->db;

    $query  = "SELECT * from tipo_produto";
    $res    = $db->select($query, array());
    return $db->retornarArray($res, true);
  }

  function inserir($arrayPost)
  {
    extract($arrayPost);

    $db     = $this->db;

    $query = "INSERT INTO tipo_produto
                  (
                    titulo,
                    id_categoria,
                    ordem
                  )
                  SELECT
                    ?,
                    ?,
                    MAX(ordem) + 1 from tipo_produto
                  ";

    $post[] = $titulo;
    $post[] = $id_categoria;

    $result = $db->execute($query, $post);

    if (!$result) {
      $db->setLastError("Não foi possível inserir este cadastro.");
      return false;
    }

    return true;
  }

  function alterar($arrayPost)
  {
    extract($arrayPost);

    $db     = $this->db;

    $query = "UPDATE tipo_produto
                  SET
                    titulo        = ?,
                    id_categoria  = ?
                  WHERE
                    id = ?
                  ";

    $post[] = $titulo;
    $post[] = $id_categoria;
    $post[] = $i;

    $result = $db->execute($query, $post);

    if (!$result) {
      $db->setLastError("Não foi possível alterar este cadastro.");
      return false;
    }

    return true;
  }

  function status($arrayPost)
  {
    extract($arrayPost);

    $db     = $this->db;

    $query = "UPDATE tipo_produto SET status = !status WHERE id = ?";
    return $db->execute($query, array($i));
  }

  function ordem($arrayPost)
  {

    extract($arrayPost);
    $db     = $this->db;

    // ordem anterior
    $query = "UPDATE tipo_produto SET ordem = ? WHERE ordem = ?";
    $db->execute($query, array($ordemAnt, $ordem));

    // nova ordem
    $query = "UPDATE tipo_produto SET ordem = ? WHERE id = ?";
    return $db->execute($query, array($ordem, $i));
  }

  function deletar($arrayPost)
  {
    extract($arrayPost);

    $db     = $this->db;
    $db->execute('BEGIN');

    $Produtos = new Produtos();
    $listaProdutoPorTipo = $Produtos->listarProdutosPorTipo(array('i' => $i));

    foreach ($listaProdutoPorTipo as $key => $value) {

      $result = $Produtos->deletar(array('i' => $value['id']));

      if (!$result) {
        $db->setLastError("Não foi possível deletar este cadastro. (1)");
        $db->execute('ROLLBACK');
        return false;
      }
    }

    extract($this->procurar(array('i' => $i)));

    $query = "DELETE FROM tipo_produto WHERE id = ? ";
    $post[] = $i;
    $result = $db->execute($query, $post);

    if (!$result) {
      $db->setLastError("Não foi possível deletar este cadastro. (2)");
      $db->execute('ROLLBACK');
      return false;
    }

    if (file_exists(PATH_IMG_CATEGORIAS_PRODUTO . $id_categoria . '/' . $id)) {
      rmdir(PATH_IMG_CATEGORIAS_PRODUTO . $id_categoria . '/' . $id);
    }

    $db->execute('COMMIT');

    return $result;
  }

  function getLastError()
  {
    return $this->db->getLastError();
  }
}
