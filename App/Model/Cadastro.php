<?

namespace App\Model;

abstract class Cadastro
{
	abstract protected function getLastError();
	abstract protected function inserir($arrayPost);
	abstract protected function alterar($arrayPost);
	abstract protected function deletar($arrayPost);
	abstract protected function procurar($arrayPost);
}
