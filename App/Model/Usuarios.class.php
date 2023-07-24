<?
  namespace App\Model;

  class Usuarios extends Cadastro
  {
    private $db;

    function __construct($db = null)
    {
      if ($db != null)
      {
        $this->db = $db;
      }
      else {
        $this->db                       = new dbConnect();
      }
    }

    function login($arrayPost)
    {
      extract($arrayPost);

      $db     = $this->db;

      $post[] = $ovrusr;
      $post[] = md5($ovrpwd);
      $post[] = Constantes::ATIVO;

      $query  = "SELECT * FROM usuarios WHERE ovrusr = ? AND ovrpwd = ? AND status = ?";

      $res    = $db->select($query, $post);
      $linha  = $db->retornarArray($res, false);

      if (!empty($linha))
      {
        $_SESSION["ADM"] = $linha;
        return true;
      }

      return false;
    }
    function procurar($arrayPost, $limite = 0)
    {
      /**
       * 1) Criar query de selecao
       * 2) Retornar lista
       */

      if (!empty($arrayPost))
        extract($arrayPost);

      $post           = array();

      $retornar_varios  = true;

      if (isset($i))
      {
        $add_busca        = " WHERE id = ? ";
        $post[]           = $i;
        $retornar_varios  = false;
      }
      else
      {
        $add_busca        = " WHERE id != ? ";
        $post[]           = $GLOBALS["USER"]["id"];
      }

      $limite = $limite > 0 ? " LIMIT $limite " : "";

      $db     = $this->db;
      $query  = "SELECT * FROM usuarios $add_busca ORDER BY nome ASC $limite";
      $res    = $db->select($query, $post);
      return $db->retornarArray($res, $retornar_varios);
    }

    function inserir($arrayPost)
    {
      extract($arrayPost);

      $db     = $this->db;

      $ovrusr = $this->tratarUsuario($ovrusr);

      if ($this->existe($ovrusr))
      {
        return false;
      }

      $query = "INSERT INTO usuarios
                  SET
                    roleid          = ?,
                    nome            = ?,
                    ovrusr          = ?,
                    ovrpwd          = ?,
                    status          = ?
                  ";

      $post[] = $roleid;
      $post[] = $nome;
      $post[] = $ovrusr;
      $post[] = md5($ovrpwd);
      $post[] = Constantes::ATIVO;
      $result = $db->execute($query, $post);


      if (!$result)
      {
        $db->setLastError("Não foi possível inserir este cadastro.");
        return false;
      }
      $id_usuario = mysqli_insert_id($db->db);

      return $id_usuario;

    }


    function tratarUsuario($usr)
    {
      $usr = str_replace(" ", "", $usr);
      $usr = geral::removerAcentos($usr);
      return strtolower($usr);
    }

    function alterar($arrayPost)
    {
      extract($arrayPost);

      $db     = $this->db;

      $ovrusr = $this->tratarUsuario($ovrusr);

      if ($this->existe($ovrusr, $i))
      {
        return false;
      }

      $add_senha = "";
      if ($ovrpwd != "")
        $add_senha = "ovrpwd          = ?,";

      $query = "UPDATE usuarios
                  SET
                    $add_senha
                    roleid          = ?,
                    nome            = ?,
                    ovrusr          = ?
                  WHERE
                    id = ?
                  ";

      if ($ovrpwd != "")
      {
        $post[] = md5($ovrpwd);
      }
      $post[] = $roleid;
      $post[] = $nome;
      $post[] = $ovrusr;


      $post[] = $i;

      $result = $db->execute($query, $post);

      if (!$result)
      {
        $db->setLastError("Não foi possível alterar este cadastro.");
        return false;
      }

      return true;

    }

    function deletar($arrayPost)
    {
      extract($arrayPost);

      $db     = $this->db;

      $db->execute("BEGIN");

      $query  = "DELETE FROM usuarios WHERE id = ?";
      $result = $db->execute($query, array($i));

      if (!$result)
        return false;

      if ($result)
        $db->execute("COMMIT");

      return $result;
    }

    function status($arrayPost)
    {
      extract($arrayPost);

      $db     = $this->db;

      $query = "UPDATE usuarios SET status = !status WHERE id = ?";
      return $db->execute($query, array($i));

    }

    /**
     *
     * Checa se já existe registro com os dados passados.
     * Se passar o ID, verifica registros diferentes deste ID.
     * @param  mixed $id_owner
     * @param  mixed $ovrusr
     * @return boolean
     */
    function existe($ovrusr, $id = 0)
    {
      $db     = $this->db;

      $query  = "SELECT id FROM usuarios WHERE ovrusr = ?";
      $post[] = $ovrusr;

      if ($id > 0)
      {
        $query .= " AND id != ?";
        $post[] = $id;
      }

      $res    = $db->select($query, $post);
      $existe =  !empty($res);

      if ($existe)
      {
        $db->setLastError("Esta usuário já está reservado.");
      }
      return $existe;
    }

    function getLastError()
    {
      return $this->db->getLastError();
    }




  }
?>
