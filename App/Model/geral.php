<?

namespace App\Model;

class geral
{

	static function SubirImagemValida($nome_campo, $pasta)
	{
		$nome_arquivo           = @$_FILES[$nome_campo]["name"];
		$campo_postado          = @$_FILES[$nome_campo]["tmp_name"];

		if (empty($campo_postado)) {
			return false;
		}

		@mkdir($pasta, 0777);
		@chmod($pasta, 0777);

		if (exif_imagetype($campo_postado)) {

			$pega     = explode(".", $nome_arquivo);
			$extensao = $pega[count($pega) - 1];

			$imagem = time() . "." . $extensao;

			$novo_nome = $pasta . "/" . $imagem;

			if (!move_uploaded_file($campo_postado, $novo_nome)) {
				if (!copy($campo_postado, $novo_nome)) {
					return false;
				}
			}
			return true;
		}
		return false;
	}
	static function webUrlValida($url)
	{
		return substr($url, 0, 7) ==  "http://" || substr($url, 0, 8) ==  "https://";
	}

	// link: https://www.php.net/manual/pt_BR/function.fmod.php
	// link: https://stackoverflow.com/questions/3216482/round-down-to-nearest-half-integer-in-php
	static function roundPrimeiroDecimal($number)
	{
		return round($number - 0.01, 1);
	}
	static function showPrimeiroDecimal($number, $decimal = 1)
	{
		return number_format($number, $decimal, ',', '');
	}
	static function roundDownHalfInteger($number, $nearest)
	{
		return number_format($number - fmod($number, $nearest), 1);
	}
	static function roundUpHalfInteger($number, $nearest)
	{
		return number_format($number + ($nearest - fmod($number, $nearest)), 1);
	}
	static function round($number)
	{
		$floor      = floor($number);
		$fraction   = $number - $floor;

		if ($fraction < 0.5) {
			return floor($number);
		} else if ($fraction > 0.59) {
			return ceil($number);
		}

		return substr($number, 0, 3);
	}

	static function IsNullOrEmptyString($str)
	{
		return (!isset($str) || trim($str) === '');
	}

	/**
	 * Retorna o conteúdo de um xml em um array
	 */
	static function getArrayFromXmlFile($arquivo)
	{
		$conteudo = self::loadFile($arquivo);
		if (!is_object($conteudo)) {
			return false;
		}
		return self::simpleXMLToArray($conteudo);
	}
	/**
	 * Retorna o conteúdo de um xml em um array
	 */
	static function getArrayFromXmlString($file_get_contents)
	{
		$conteudo = self::loadString($file_get_contents);
		return self::simpleXMLToArray($conteudo);
	}


	static function loadFile($arquivo)
	{
		return @simplexml_load_file($arquivo);
	}
	static function loadString($string)
	{
		return @simplexml_load_string($string);
	}



	static function Maiusculo($texto)
	{
		$minusculo = array('ã', 'õ', 'á', 'é', 'í', 'ó', 'ú', 'à', 'è', 'ì', 'ò', 'ù', 'â', 'ê', 'î', 'ô', 'û', 'ç', 'ü');
		$maiusculo = array('Ã', 'Õ', 'Á', 'É', 'Í', 'Ó', 'Ú', 'À', 'È', 'Ì', 'Ò', 'Ù', 'Â', 'Ê', 'Î', 'Ô', 'Û', 'Ç', 'Ü');

		$texto = strtoupper($texto);
		for ($i = 0; $i < 19; $i++) {
			$texto = str_replace($minusculo[$i], $maiusculo[$i], $texto);
		}

		return $texto;
	}
	static function Minusculo($texto)
	{
		$minusculo = array('ã', 'õ', 'á', 'é', 'í', 'ó', 'ú', 'à', 'è', 'ì', 'ò', 'ù', 'â', 'ê', 'î', 'ô', 'û', 'ç', 'ü');
		$maiusculo = array('Ã', 'Õ', 'Á', 'É', 'Í', 'Ó', 'Ú', 'À', 'È', 'Ì', 'Ò', 'Ù', 'Â', 'Ê', 'Î', 'Ô', 'Û', 'Ç', 'Ü');

		$texto = strtolower($texto);
		for ($i = 0; $i < 19; $i++) {
			$texto = str_replace($maiusculo[$i], $minusculo[$i], $texto);
		}
		return $texto;
	}

	static function LetraDoNumero($a)
	{
		$alfabeto = range('a', 'z');
		return $alfabeto[$a];
	}

	static function pegar_mes_atual_por_extenso()
	{
		$array["01"] = "Janeiro";
		$array["02"] = "Fevereiro";
		$array["03"] = "Março";
		$array["04"] = "Abril";
		$array["05"] = "Maio";
		$array["06"] = "Junho";
		$array["07"] = "Julho";
		$array["08"] = "Agosto";
		$array["09"] = "Setembro";
		$array["10"] = "Outubro";
		$array["11"] = "Novembro";
		$array["12"] = "Dezembro";

		return $array[date("m")];
	}

	static function traduzir_mes_por_extenso($m)
	{
		$array["01"] = "Janeiro";
		$array["02"] = "Fevereiro";
		$array["03"] = "Março";
		$array["04"] = "Abril";
		$array["05"] = "Maio";
		$array["06"] = "Junho";
		$array["07"] = "Julho";
		$array["08"] = "Agosto";
		$array["09"] = "Setembro";
		$array["10"] = "Outubro";
		$array["11"] = "Novembro";
		$array["12"] = "Dezembro";

		return $array[$m];
	}

	static function pegar_data_e_hora_atual()
	{
		return date("d/m/Y H:i:s");
	}
	static function pegar_data_completa()
	{
		$mes = geral::pegar_mes_atual_por_extenso();
		return date("d") . " de $mes de " . date("Y");
	}
	static function redirecionarParaPaginaInicial()
	{
		echo "<script>window.location.href='" . $GLOBALS["URL_SITE"] . "/" . SISTEMA . "';</script>";
		die();
	}

	static function tratarDataParaBusca($data)
	{
		$pega = explode("/", $data);

		$total_separacoes = count($pega);

		if ($total_separacoes == 2 && strlen($data) == 5) {
			# TENTAR DATA DD/MM

			# Tentando dia/mes
			# data_temp = mes-dia. Ex: 11-06
			$data_temp 	 = substr($data, 3, 2) . "-" . substr($data, 0, 2);

			if (strtotime(date("Y-$data_temp")) > 0) {
				# SE CONSEGUIR TRANSFORMAR EM DATA A BUSCA, retornar CAMPO CONVERTIDO
				return $data_temp;
			}
		} else if ($total_separacoes == 2 && strlen($data) == 7) {
			# TENTAR DATA MM/AAAA
			# convertendo para Ex: 2017-11

			$data_temp = substr($data, -4) . "-" . substr($data, 0, 2);

			if (strtotime(date($data_temp)) > 0) {
				# SE CONSEGUIR TRANSFORMAR EM DATA A BUSCA, retornar CAMPO CONVERTIDO
				return $data_temp;
			}
		} else if ($total_separacoes == 3 && strlen($data) == 10) {
			# TENTAR ANO
			$data_temp = geral::Convert_Data_Brasileira_Para_Americana($data);

			if (strtotime($data_temp) > 0) {
				# SE CONSEGUIR TRANSFORMAR EM DATA A BUSCA, retornar CAMPO CONVERTIDO
				return $data_temp;
			}
		}

		return $data;
	}


	static function Convert_Data_Americana_Para_Brasileira($date)
	{
		if (strlen($date) == 10) {
			return substr($date, -2) . "/" . substr($date, 5, 2) . "/" . substr($date, 0, 4);
		}
		return date("d/m/Y");
	}
	static function Convert_Data_Brasileira_Para_Americana($date)
	{
		if (strlen($date) == 10) {
			return substr($date, -4) . "-" . substr($date, 3, 2) . "-" . substr($date, 0, 2);
		}
		return date("Y-m-d");
	}
	static function Convert_Data_Brasileira_Para_Timestamp($date, $fim_do_dia = false)
	{
		if (strlen($date) == 10) {
			$data_americana = substr($date, -4) . "-" . substr($date, 3, 2) . "-" . substr($date, 0, 2);

			if ($fim_do_dia) {
				return strtotime($data_americana) + 86340;
			}
			return strtotime($data_americana);
		}
		return time();
	}

	static public $array_emails_invalidos = array(
		'gmail.com.br', 'hotamail.com', 'homail.com', 'homail.c', 'yaho.com.br', 'yahooo.com.br', 'yaho.com', 'yahooo.com', 'iahoo.com', 'iaho.com.br',
		'ig.coom', 'iahu.com', 'iahu.com.br', 'rotmail.com', 'tjapa.jus.br',
		'gmail.com.b', 'hotmail.com.b'
	);
	static function EscapeQuotes($field)
	{
		return htmlspecialchars($field);
	}
	static function removerAcentos($str)
	{

		$string = 'ÁÍÓÚÉÄÏÖÜËÀÌÒÙÈÃÕÂÎÔÛÊáíóúéäïöüëàìòùèãõâîôûêÇç';

		return preg_replace('/[`^~\'"]/', null, iconv('UTF-8', 'ASCII//TRANSLIT', $str));
	}
	/**
	 * $tipo_retorno = "data_1" =  dia de Mes de ano
	 * $tipo_retorno = "full" =  d/m/Y H:i:s
	 * $tipo_retorno = "d/m/Y"
	 * $tipo_retorno = "H:i:s"
	 * $tipo_retorno = "H:i"
	 * @param ($valor, $tipo_retorno)
	 * @param Retorna formato de Data (dd/mm/aaaa) para o valor timestamp passado
	 *
	 */
	static function ConvertTimeTo($valor, $tipo_retorno)
	{
		if ($tipo_retorno == 'data_1') {
			$data = date("d") . " de " . self::getMes() . " de " . date("Y");
			//return $valor;
			return $data;
		}
		if ($tipo_retorno == 'full') {
			$data = date("d/m/Y H:i:s", $valor);
			//return $valor;
			return $data;
		}
		if ($tipo_retorno == 'd/m/Y') {

			$data = date("d/m/Y", $valor);
			//return $valor;
			if ($data == "31/12/1969") {
				return date("d/m/Y");
			}
			return $data;
		}
		if ($tipo_retorno == "H:i:s") {
			$data = gmdate("H:i:s", $valor);
			return $data;
		}
		if ($tipo_retorno == "H:i") {
			$data = date("H:i", $valor);
			return $data;
		}
	}


	static function TratarArrayParaTextArea($linha)
	{
		if (empty($linha)) {
			return $linha;
		}
		if (!is_array($linha)) {
			return Geral::TratarValorParaTextArea($linha);
		}

		foreach ($linha as $key => $value) {
			$row[$key] =  Geral::TratarValorParaTextArea($value);
		}
		return $row;
	}

	static function TratarArrayDeTextAreaParaExibir($linha)
	{
		if (empty($linha)) {
			return $linha;
		}
		if (!is_array($linha)) {
			return Geral::TratarValorDeTextAreaParaExibir($linha);
		}

		foreach ($linha as $key => $value) {
			$row[$key] =  Geral::TratarValorDeTextAreaParaExibir($value);
		}
		return $row;
	}

	static function TratarValorParaTextArea($valor)
	{

		$val = str_replace("\r\n",		"&#13;&#10;", $valor);
		$val = str_replace("\n", 		"&#13;&#10;", $val);
		$val = str_replace("<br>", 	 	"&#13;&#10;", $val);
		$val = str_replace("<br />", 	"&#13;&#10;", $val);
		$val = str_replace("<br >", 	"&#13;&#10;", $val);

		$val = str_replace('\r\n',		'&#13;&#10;', $val);
		$val = str_replace('\n', 		'&#13;&#10;', $val);
		$val = str_replace('<br>', 	 	'&#13;&#10;', $val);
		$val = str_replace('<br />', 	'&#13;&#10;', $val);
		$val = str_replace('<br >', 	'&#13;&#10;', $val);
		$val = stripslashes($val);
		$val = str_replace("'", '&#39;', $val);
		$val = str_replace('"', '&#34;', $val);

		return $val;
	}
	/**
	 * retorna o resultado de uma consulta SQL
	 * @param resultado da consulta
	 * @param instancia da classe dbConnect (OPCIONAL)
	 */
	static function fetchMysqlResultInOneSimpleArray($result, $db = null)
	{
		$arr = array();
		$db1 = ($db == null) ? new dbConnect() : $db;
		while ($linha = $db1->fetch_assoc($result))
			$arr[] = $linha;

		return $arr;
	}

	static function TratarValorDeTextAreaParaExibir($valor)
	{

		$val = str_replace("\r\n",	 "<br>", $valor);
		$val = str_replace("\n", 	"<br>", $val);
		$val = str_replace('\r\n', 	'<br>', $val);
		$val = str_replace('\n', 	'<br>', $val);
		$val = str_replace("&#13;&#10;", "<br>", $val);
		$val = str_replace('&#13;&#10;', '<br>', $val);
		$val = stripslashes($val);
		return $val;
	}

	static function TratarValorDeTextAreaParaExibirNoTextArea($valor)
	{

		$val = str_replace("<br>",          "\r\n",          $valor);
		$val = str_replace("<br>",          "\n",            $val);
		$val = str_replace('<br>',          '\r\n',          $val);
		$val = str_replace('<br>',          '\n',            $val);
		$val = str_replace("&lt;br&gt;",    "\r\n",          $val);
		$val = str_replace("&lt;br&gt;",    "\n",            $val);
		$val = str_replace('&lt;br&gt;',    '\r\n',          $val);
		$val = str_replace('&lt;br&gt;',    '\n',            $val);
		$val = stripslashes($val);
		return $val;
	}
	static function TratarValorParaAlertConfirm($valor)
	{

		$val = str_replace('\r\n', 		'<br>', $valor);
		$val = str_replace('\n', 		'<br>', $val);
		$val = str_replace("\r\n",	 	"<br>", $val);
		$val = str_replace("\n", 		"<br>", $val);
		$val = stripslashes($val);

		$val = str_replace("'", '', $val);
		$val = str_replace('"', '', $val);
		return $val;
	}

	static function removeEspacosInicioFim($str)
	{
		if ($str != '') {
			$string = ltrim($str);
			$string = rtrim($string);
			return $string;
		}

		return $str;
	}

	/**
	 * @param converte um array para o formato json
	 */
	static function array2json($array)
	{
		if (!function_exists('json_encode')) {

			function json_encode($value)
			{

				if ($value === null) {
					return 'null';
				};  // gettype fails on null?

				$out = '';
				$esc = "\"\\/\n\r\t" . chr(8) . chr(12);  // escaped chars
				$l   = '.';  // decimal point

				switch (gettype($value)) {
					case 'boolean':
						$out .= $value ? 'true' : 'false';
						break;

					case 'float':
					case 'double':
						// PHP uses the decimal point of the current locale but JSON expects %x2E
						$l = localeconv();
						$l = $l['decimal_point'];
						// fallthrough...

					case 'integer':
						$out .= str_replace($l, '.', $value);  // what, no getlocale?
						break;

					case 'array':
						// if array only has numeric keys, and is sequential... ?
						for ($i = 0; ($i < count($value) && isset($value[$i])); $i++);
						if ($i === count($value)) {
							// it's a "true" array... or close enough
							$out .= '[' . implode(',', array_map('json_encode', $value)) . ']';
							break;
						}
						// fallthrough to object for associative arrays...

					case 'object':
						$arr = is_object($value) ? get_object_vars($value) : $value;
						$b = array();
						foreach ($arr as $k => $v) {
							$b[] = '"' . addcslashes($k, $esc) . '":' . json_encode($v);
						}
						$out .= '{' . implode(',', $b) . '}';
						break;

					default:  // anything else is treated as a string
						return '"' . addcslashes($value, $esc) . '"';
						break;
				}

				return $out;


				/*
                    switch ($type = gettype($data)) {
                        case 'NULL':
                            return 'null';
                        case 'boolean':
                            return ($data ? 'true' : 'false');
                        case 'integer':
                            return '"' . addcslashes($data,'"') . '"';
                        case 'double':
                        case 'float':
                            return $data;
                        case 'string':
                            return '"' . addcslashes($data,'"') . '"';
                        case 'object':
                            $data = get_object_vars($data);
                        case 'array':

                            $output_index_count = 0;
                            $output_indexed = array();
                            $output_associative = array();
                            foreach ($data as $key => $value) {
                                $output_indexed[] = json_encode($value);
                                $output_associative[] = json_encode($key) . ':' . json_encode($value);
                                if ($output_index_count !== NULL && $output_index_count++ !== $key) {
                                    $output_index_count = NULL;
                                }
                            }
                            if ($output_index_count !== NULL) {
                                return '[' . implode(',', $output_indexed) . ']';
                            } else {
                                return '{' . implode(',', $output_associative) . '}';
                            }
                        default:

                            return ''; // Not supported
                            }*/
			}
		}

		return json_encode($array);
	}
	/**
	 * @param converte formato json para um array
	 */
	static function json2array($json)
	{
		if (!function_exists('json_decode')) {
			function json_decode($json)
			{

				/* by default we don't tolerate ' as string delimiters
                         if you need this, then simply change the comments on
                         the following lines: */
				$assoc = true;
				// $matchString = '/(".*?(?<!\\\\)"|\'.*?(?<!\\\\)\')/';
				$matchString = '/".*?(?<!\\\\)"/';

				// safety / validity test
				$t = preg_replace($matchString, '', $json);
				$t = preg_replace('/[,:{}\[\]0-9.\-+Eaeflnr-u \n\r\t]/', '', $t);
				if ($t != '') {
					return null;
				}

				// build to/from hashes for all strings in the structure
				$s2m = array();
				$m2s = array();
				preg_match_all($matchString, $json, $m);
				foreach ($m[0] as $s) {
					$hash       = '"' . md5($s) . '"';
					$s2m[$s]    = $hash;
					$m2s[$hash] = str_replace('$', '\$', $s);  // prevent $ magic
				}

				// hide the strings
				$json = strtr($json, $s2m);

				// convert JS notation to PHP notation
				$a = ($assoc) ? '' : '(object) ';
				$json = strtr(
					$json,
					array(
						':' => '=>',
						'[' => 'array(',
						'{' => "{$a}array(",
						']' => ')',
						'}' => ')'
					)
				);

				// remove leading zeros to prevent incorrect type casting
				$json = preg_replace('~([\s\(,>])(-?)0~', '$1$2', $json);

				// return the strings
				$json = strtr($json, $m2s);

				/* "eval" string and return results.
                         As there is no try statement in PHP4, the trick here
                         is to suppress any parser errors while a function is
                         built and then run the function if it got made. */
				$f = @create_function('', "return {$json};");
				$r = ($f) ? $f() : null;

				// free mem (shouldn't really be needed, but it's polite)
				unset($s2m);
				unset($m2s);
				unset($f);

				return $r;


				/*
                   var_dump($json);
                   $comment = false;
                    $out = '$x=';

                    for ($i=0; $i<strlen($json); $i++)
                    {
                        if (!$comment)
                        {
                            if (($json[$i] == '{') || ($json[$i] == '['))       $out .= ' array(';
                            else if (($json[$i] == '}') || ($json[$i] == ']'))   $out .= ')';
                            else if ($json[$i] == ':')    $out .= '=>';
                            else                         $out .= $json[$i];
                        }
                        else $out .= $json[$i];
                        if ($json[$i] == '"' && $json[($i-1)]!="\\")    $comment = !$comment;
                    }

                    eval($out.";");
                    return $x;*/
			}
		}

		//echo $json."<br><br>";
		if (is_array($json)) {
			return $json;
		}
		return json_decode($json, true);
	}

	/**
	 * RETORNA FALSO SE N�O VALIDAR O E-MAIL PASSADO
	 */
	static function ValidarEmail($email)
	{
		$email = strtolower($email);

		$array_Invalidos = array(
			"'", "~",  "=",
			"!", "#",  "$",
			"%", "�",  "&",
			"*", "(",  ")",
			"+", "�",
			"\\", "/", "�",
		);


		if (filter_var($email, FILTER_VALIDATE_EMAIL) != false) {
			// FILTRAR CARACTERES QUE A FILTRAGEM PADR�O N�O VERIFICA
			foreach ($array_Invalidos as $key => $string) {
				if (strstr($email, $string) != false) {
					return false;
				}
			}
			// FILTRAR ERROS DE DIGITA��O DE DOMINIOS CONHECIDOS
			foreach (self::$array_emails_invalidos as $key => $string) {
				if (strstr($email, $string) != false) {
					return false;
				}
			}

			return $email;
		}

		return false;
	}

	static function addslashes_recursive($var)
	{
		if (is_object($var)) {
			$new_var = new object();
			$properties = get_object_vars($var);
			foreach ($properties as $property => $value) {
				$new_var->$property = geral::addslashes_recursive($value);
			}
		} else if (is_array($var)) {
			$new_var = array();
			foreach ($var as $property => $value) {
				$new_var[$property] = geral::addslashes_recursive($value);
			}
		} else if (is_string($var)) {
			$new_var = addslashes($var);
		} else { // nulls, integers, etc.
			$new_var = $var;
		}

		return $new_var;
	}

	/**
	 * Retorna TRUE se a p�gina anterior � do mesmo dominio
	 * Usa como base a variavel $_SERVER["HTTP_REFERER"];
	 *
	 */
	static function Pagina_Anterior_Eh_Local()
	{
		return (@strstr($_SERVER["HTTP_REFERER"], $GLOBALS["PATH_SITE"]) != false);
	}

	static function EnviarEmail($para, $assunto, $mensagem, $cabecalho = '')
	{
		#return true;
		if ($cabecalho == '') {
			$cabecalho = $GLOBALS["cabecalho"];
		}

		$para = str_replace(";", ",", $para);
		if ($para != "" && $assunto != '' && $mensagem != '' && $cabecalho != '') {
			return mail($para, $assunto, $mensagem, $cabecalho);
		}
		return false;
	}

	static function Enviar_Notificacao_Programador($ASSUNTO, $MENSAGEM)
	{
		$programador   = "matheus@overseebrasil.com.br";
		$NAVEGADOR     = $_SERVER["HTTP_USER_AGENT"];
		$HTTP_REFERER  = $_SERVER["HTTP_REFERER"];
		$IP            = $_SERVER["REMOTE_ADDR"];
		$REMOTE_HOST   = gethostbyaddr($IP);
		$DATA          = date("d/m/Y H:i:s");

		$MENSAGEM .= "<br><br><strong>Dados conexão do usuário:</strong>";
		$MENSAGEM .= "<br><br><strong>IP:</strong> $IP - $DATA";
		$MENSAGEM .= "<br><br><strong>Navegador:</strong> $NAVEGADOR";
		$MENSAGEM .= "<br><br><strong>Página anterior:</strong> $HTTP_REFERER";
		if ($REMOTE_HOST != '') {
			$MENSAGEM .= "<br><br><strong>Conexão:</strong> $REMOTE_HOST";
		}
		$MENSAGEM .= "<br><br>";

		if (!empty($_POST)) {
			$MENSAGEM .= "<strong>Dados postados (considere conteúdo sem as aspas): </strong> <bR><br>
                 <table>
                 ";
			foreach ($_POST as $key => $value) {
				$MENSAGEM .= "<tr><td>$key</td><td>'$value'</td></tr>";
			}
			$MENSAGEM .= "</table>";
		}

		@Geral::EnviarEmail($programador, SISTEMA . " - " . $ASSUNTO, $MENSAGEM, $GLOBALS["cabecalho"]);
	}

	/**
	 *
	 */
	static function Remover_Barra_R_Barra_N($string, $replace = "")
	{
		$contador = 1;
		$MAXIMO   = 10;

		$string_final = $string;
		$R            = '\r';
		$N            = '\n';

		for ($a = 1; $a <= $MAXIMO; $a++) {
			$procurar     = $R . $N;
			$string_final = str_replace($procurar, $replace, $string_final);
			$R            = "\\" . $R;
			$N            = "\\" . $N;
		}
		return $string_final;
	}

	/**
	 * Verifica o dispositivo que o usu�rio est� acessando
	 */
	static function is_mobile()
	{

		// Get the user agent

		$user_agent = $_SERVER['HTTP_USER_AGENT'];

		// Create an array of known mobile user agents
		// This list is from the 21 October 2010 WURFL File.
		// Most mobile devices send a pretty standard string that can be covered by
		// one of these.  I believe I have found all the agents (as of the date above)
		// that do not and have included them below.  If you use this function, you
		// should periodically check your list against the WURFL file, available at:
		// http://wurfl.sourceforge.net/


		$mobile_agents = array(


			"240x320",
			"acer",
			"acoon",
			"acs-",
			"abacho",
			"ahong",
			"airness",
			"alcatel",
			"amoi",
			"android",
			"anywhereyougo.com",
			"applewebkit/525",
			"applewebkit/532",
			"asus",
			"audio",
			"au-mic",
			"avantogo",
			"becker",
			"benq",
			"bilbo",
			"bird",
			"blackberry",
			"blazer",
			"bleu",
			"cdm-",
			"compal",
			"coolpad",
			"danger",
			"dbtel",
			"dopod",
			"elaine",
			"eric",
			"etouch",
			"fly ",
			"fly_",
			"fly-",
			"go.web",
			"goodaccess",
			"gradiente",
			"grundig",
			"haier",
			"hedy",
			"hitachi",
			"htc",
			"huawei",
			"hutchison",
			"inno",
			"jbrowser",
			"kddi",
			"kgt",
			"kwc",
			"lenovo",
			"lg ",
			"lg2",
			"lg3",
			"lg4",
			"lg5",
			"lg7",
			"lg8",
			"lg9",
			"lg-",
			"lge-",
			"lge9",
			"longcos",
			"maemo",
			"mercator",
			"meridian",
			"micromax",
			"midp",
			"mini",
			"mitsu",
			"mmm",
			"mmp",
			"mobi",
			"mot-",
			"moto",
			"nec-",
			"netfront",
			"newgen",
			"nexian",
			"nf-browser",
			"nintendo",
			"nitro",
			"nokia",
			"nook",
			"novarra",
			"obigo",
			"palm",
			"panasonic",
			"pantech",
			"philips",
			"phone",
			"pg-",
			"playstation",
			"pocket",
			"pt-",
			"qc-",
			"qtek",
			"rover",
			"sagem",
			"sama",
			"samu",
			"sanyo",
			"samsung",
			"sch-",
			"scooter",
			"sec-",
			"sendo",
			"sgh-",
			"sharp",
			"siemens",
			"sie-",
			"softbank",
			"sony",
			"spice",
			"sprint",
			"spv",
			"symbian",
			"tablet",
			"talkabout",
			"tcl-",
			"teleca",
			"telit",
			"tianyu",
			"tim-",
			"toshiba",
			"tsm",
			"up.browser",
			"utec",
			"utstar",
			"verykool",
			"virgin",
			"vk-",
			"voda",
			"voxtel",
			"vx",
			"wap",
			"wellco",
			"wig browser",
			"wii",
			"windows ce",
			"wireless",
			"xda",
			"xde",
			"zte"
		);

		// Pre-set $is_mobile to false.

		$is_mobile = false;

		// Cycle through the list in $mobile_agents to see if any of them
		// appear in $user_agent.

		foreach ($mobile_agents as $device) {

			// Check each element in $mobile_agents to see if it appears in
			// $user_agent.  If it does, set $is_mobile to true.

			if (stristr($user_agent, $device)) {

				$is_mobile = true;

				// break out of the foreach, we don't need to test
				// any more once we get a true value.

				break;
			}
		}

		$Apple = array();
		$Apple['UA'] = $_SERVER['HTTP_USER_AGENT'];
		$Apple['Device'] = false;
		$Apple['Types'] = array('iPhone', 'iPod', 'iPad');

		foreach ($Apple['Types'] as $d => $t) {
			$Apple[$t] = (strpos($Apple['UA'], $t) !== false);
			$Apple['Device'] |= $Apple[$t];
		}
		// is this an Apple device?
		/*echo
			    "<p>Apple device? ", ($Apple['Device'] ? 'true' : 'false'),
			    "</p>\n<p>iPhone? ", ($Apple['iPhone'] ? 'true' : 'false'),
			    "</p>\n<p>iPod? ", ($Apple['iPod'] ? 'true' : 'false'),
			    "</p>\n<p>iPad? ", ($Apple['iPad'] ? 'true' : 'false'),
			    '</p>'; */
		if (($Apple['iPhone'] == true) or ($Apple['Device'] == true) or ($Apple['iPod'] == true) or ($Apple['iPad'] == true)) {

			//	APPLE RETORNA 2
			$is_mobile = 2;

			//echo "<script>	ALERT('APPLE'); window.document.location.href='$URL_APPLE';</script>";

		} else {
			if ($is_mobile == true) {
				//	MOBILE RTSP RETORNA 1

				$is_mobile = 1;
				//echo "$URL_MOBILE";
				//echo "<meta http-equiv='Refresh' content='0;url=$URL_MOBILE' />";
			} else {

				//	DESKTOP RETORNA 0

				$is_mobile = 0;
				//echo "flash $is_mobile";
			}

			if (stristr($user_agent, "android")) {

				$is_mobile = 3;
			}
		}

		return $is_mobile;
	}

	/**
	 * Retorna true se a data passada em TIMESTAMP estiver entre a data inicial e a final
	 * Retorna a string "anterior" se estiver menor que a data inicial
	 * Retorna a string "expirou" se estiver maior que a data inicial
	 */
	static function IsDataDentroPeriodo($data, $data_ini, $data_fim)
	{
		if ($data == '') {
			$data = time();
		}

		if (($data >= $data_ini) and ($data <= $data_fim)) {
			return true;
		} else if (($data < $data_ini) and ($data < $data_fim)) {
			return "anterior";
		} else if (($data > $data_ini) and ($data > $data_fim)) {
			return "expirado";
		} else {
			return "data invalida";
		}
	}

	/**
	 * Retorna o bloco HTML passado com os dados substituidos
	 *
	 * @param $bloco	 - Bloco html para substituicao de valores
	 * @param $value	  - Array de valores para substituir em $bloco
	 */
	static function Replace_HTML_Block($bloco, $value)
	{
		foreach ($value as $nome_campo => $valor) {
			//echo "$bloco  - $nome_campo => $valor <br>";

			$campo = $nome_campo;

			if (strstr($bloco, $campo)) {
				//echo "$nome_campo => $valor <br>";
				$bloco  = str_replace($campo, $valor, $bloco);
			}
		}
		//echo $bloco;
		return $bloco;
	}

	/**
	 * Ordena qualquer array passando como parametros:
	 * @param ($array_geral, $campo_ordenacao, $tipo_ordenacao_1 = SORT_ASC, $tipo_ordenacao_2 = SORT_STRING)
	 * @param Array a ser ordenado, Campo do array de referencia, Ascendente ou descendente, SORT_STRING
	 */
	static function Ordenar($array_geral, $campo_ordenacao, $tipo_ordenacao_1 = SORT_ASC, $tipo_ordenacao_2 = SORT_STRING)
	{
		if (is_array($array_geral) && !empty($array_geral)) {
			foreach ($array_geral as $key => $value) {
				$array_ordem[$key] 				= $value[$campo_ordenacao];
			}

			$array_reorder = array_map('strtolower', $array_ordem);

			// ALFABETICA
			array_multisort(
				$array_reorder,
				$tipo_ordenacao_1,
				$tipo_ordenacao_2,
				$array_geral
			);
		}

		return $array_geral;
	}


	/**
	 * Passe uma data no formato dd/mm/yyyy ou yyyy-mm-dd
	 * @param $data
	 * @param $FORMATO - DIA ( retorna dd/mm/yyyy) ANO ( retorna yyyy-mm-dd)
	 */
	static function Trata_Data($data, $FORMATO)
	{

		if ($FORMATO == "ANO") {
			//PEGA DD/MM/YYYY E RETORNA YYYY/MM/DD
			return substr($data, -4) . "-" . substr($data, 3, 2) . "-" . substr($data, 0, 2);
		}
		if ($FORMATO == "DIA") {

			return substr($data, -2) . "/" . substr($data, 5, 2) . "/" . substr($data, 0, 4);
		}
	}

	static function VerificaSoma($soma, $limite)
	{
		//COMPARA A VARIAVEL SOMA COM A LIMITE, SE FOREM  IGUAIS ENTAO RETORNA 0

		if ($soma == $limite) {
			$soma = 0;
		}
		return $soma;
	}


	static function EntraForm($dt_ini, $dt_fim, $hr_ini, $hr_fim)
	{

		//RETORNA V_OK PARA VERIFICAR INICIO E FIM DE INSCRICOES

		$V_OK = 0;

		$hoje = strtotime(date("Y-m-d"));
		$hora_agora = date("H:i");

		if ($hoje >= $dt_ini && $hoje <= $dt_fim) {
			$diferenca_ini = ((substr($hora_agora, 0, 2) * 60) + substr($hora_agora, 3, 2)) - ((substr($hr_ini, 0, 2) * 60) + substr($hr_ini, 3, 2));
			$diferenca_fim = ((substr($hr_fim, 0, 2) * 60) + substr($hr_fim, 3, 2)) - ((substr($hora_agora, 0, 2) * 60) + substr($hora_agora, 3, 2));

			if ($hoje == $dt_ini) {
				if ($diferenca_ini >= 0) {
					// SE TIVER OK A HORA INI

					if ((substr($diferenca_fim, 0, 1) == '-') and ($hoje == $dt_fim)) {
						//SE HORA FIM J� PASSOU E HOJE FOR = A DATA FIM
						//ECHO "SE HORA FIM J� PASSOU E HOJE FOR = A DATA FIM";
						$V_OK = 0;
					} else {
						// SE TIVER OK A HORA FIM
						//echo "SE TIVER OK A HORA FIM";
						$V_OK = 1;
					}
				}
			} else {
				if ($hoje == $dt_fim) {
					if ((substr($diferenca_fim, 0, 1) == '-') and ($hoje == $dt_fim)) {
						//SE HORA FIM J� PASSOU E HOJE FOR = A DATA FIM
						//echo "SE HORA FIM J� PASSOU E HOJE FOR = A DATA FIM";
						$V_OK = 0;
					} else {
						// SE TIVER OK A HORA FIM
						//echo "ESTAMOS ENTRE AS HORAS DE INICIO E FIM";
						$V_OK = 1;
					}
				} else {
					// 	ESTAMOS ENTRE AS DATAS DE INICIO E FIM
					//echo "ESTAMOS ENTRE AS DATAS DE INICIO E FIM";
					$V_OK = 1;
				}
			}
		}
		return $V_OK;
	}
	static function CriarSenha($x)
	{
		$chars = "ab1c2d3e4f5g6h7i8j9k0mno1p3q4r6s2t7u9v0w1x5y6z023456789AB2V4C65D6EF8G900HI3J56KLMNOPQRSTUV023456789";
		srand((float)microtime() * 1000000);
		$i = 1;
		$pass = '';
		while ($i <= $x) {
			$num = rand() % 33;
			$tmp = substr($chars, $num, 1);
			$pass = $pass . $tmp;
			$i++;
		}
		return $pass;
	}
	static function calcula_hora_diferenca($hora_ini, $hora_fim)
	{

		if (strlen($hora_ini) > 5) {

			$hora1 = substr($hora_ini, 0, 2);
			$min1 = substr($hora_ini, 3, 2);
			$seg1 = substr($hora_ini, -2, 2);

			$hora2 = substr($hora_fim, 0, 2);
			$min2 = substr($hora_fim, 3, 2);
			$seg2 = substr($hora_fim, -2, 2);

			for ($a = 1; $a <= $hora1; $a++) {
				$min = $min + 60;
			}

			$total_ini = $min + $min1;
			for ($a = 1; $a <= $hora2; $a++) {
				$min3 = $min3 + 60;
			}
			$total_fim = $min3 + $min2;

			if ($total_ini > $total_fim) {

				$total = $total_ini - $total_fim;
			} else {

				$total = $total_fim - $total_ini;
			}

			if ($seg1 > $seg2) {
				$seg1 = 60 - $seg1; // 60 - 50 = 10
				$add_seg = $seg2 + $seg1; //=20 seg
				$total = $total - 1;
			} else {
				//SUBTRACAO AKI
				// + ou -

				$add_seg = $seg2 - $seg1;
				//echo $add_seg."<br>";
			}
			$total_geral = $total_geral + $total;
			$x = $total;

			//echo "X = $x<br>";
			if ($total >= 60) {

				//echo "<br>AQUI  <br>";
				if ($x >= 60) {
					while ($x >= 60) {
						$add_hora = $add_hora + 1;
						$x = $x - 60;
					}
				}

				if ($add_seg >= 60) {
					while ($add_seg >= 60) {
						$add_seg = $add_seg - 60;
						$x = $x + 1;
					}
				}

				if ($add_hora <= 9) {
					$add_hora = "0" . $add_hora;
				}
				if ($x <= 9) {
					$x = "0" . $x;
				}
				if ($add_seg <= 9) {
					$add_seg = "0" . $add_seg;
				}
			} else {
				//echo "<br>AQUI 1 <br>";
				$add_hora = '0';

				//TRANSFORMA SEGUNDOS EM MINUTOS
				if ($add_seg >= 60) {
					while ($add_seg >= 60) {
						$add_seg = $add_seg - 60;
						$x = $x + 1;
					}
				}

				// SE MINUTOS > 60 ADD UMA HORA
				if ($x >= 60) {
					while ($x >= 60) {
						$add_hora = $add_hora + 1;
						$x = $x - 60;
					}
				}
				if ($add_hora <= 9) {
					$add_hora = "0" . $add_hora;
				}
				if ($x <= 9) {
					$x = "0" . $x;
				}
				if ($add_seg <= 9) {
					$add_seg = "0" . $add_seg;
				}
			}
		}

		$y = $add_seg;

		//$result = "$add_hora:$x:$y";
		//RETORNA OS MINUTOS
		$x = $x + ($add_hora * 60);
		$result = "$x";
		if (strlen($result) > 8) {

			$result = false;
		}
		return $result;
	}

	static function calcula_hora_soma($hora_ini, $hora_fim)
	{

		if (strlen($hora_ini) > 5) {

			$pega_ini  = explode(":", $hora_ini);
			$pega_fim = explode(":", $hora_fim);

			$hora1  = $pega_ini[0];
			$min1    = $pega_ini[1];
			$seg1     = $pega_ini[2];

			$hora2  = $pega_fim[0];
			$min2    = $pega_fim[1];
			$seg2    = $pega_fim[2];

			for ($a = 1; $a <= $hora1; $a++) {
				$min = $min + 60;
			}

			$total_ini = $min + $min1;
			for ($a = 1; $a <= $hora2; $a++) {
				$min3 = $min3 + 60;
			}
			$total_fim = $min3 + $min2;

			$total = $total_fim + $total_ini;

			/*if($seg1>$seg2)
				{
					$seg1=60-$seg1; // 60 - 50 = 10
					$add_seg=$seg2+$seg1; //=20 seg
					$total=$total-1;
				}
				else
				{*/
			$add_seg = $seg2 + $seg1;
			//echo $add_seg."<br>";
			//}
			$total_geral = $total_geral + $total;
			$x = $total;

			//echo "X = $x<br>";
			if ($total >= 60) {

				//echo "<br>AQUI  <br>";
				if ($x >= 60) {
					while ($x >= 60) {
						$add_hora = $add_hora + 1;
						$x = $x - 60;
					}
				}

				if ($add_seg >= 60) {
					while ($add_seg >= 60) {
						$add_seg = $add_seg - 60;
						$x = $x + 1;
					}
				}

				if ($add_hora <= 9) {
					$add_hora = "0" . $add_hora;
				}
				if ($x <= 9) {
					$x = "0" . $x;
				}
				if ($add_seg <= 9) {
					$add_seg = "0" . $add_seg;
				}
			} else {
				//echo "<br>AQUI 1 <br>";
				$add_hora = '0';

				//TRANSFORMA SEGUNDOS EM MINUTOS
				if ($add_seg >= 60) {
					while ($add_seg >= 60) {
						$add_seg = $add_seg - 60;
						$x = $x + 1;
					}
				}

				// SE MINUTOS > 60 ADD UMA HORA
				if ($x >= 60) {
					while ($x >= 60) {
						$add_hora = $add_hora + 1;
						$x = $x - 60;
					}
				}
				if ($add_hora <= 9) {
					$add_hora = "0" . $add_hora;
				}
				if ($x <= 9) {
					$x = "0" . $x;
				}
				if ($add_seg <= 9) {
					$add_seg = "0" . $add_seg;
				}
			}
		}

		$y = $add_seg;
		$result = "$add_hora:$x:$y";

		return $result;
	}

	static function removerAcento($str)
	{
		$var = strtolower($str);

		$var = @ereg_replace("[����]", "a", $var);
		$var = @ereg_replace("[���]", "e", $var);
		$var = @ereg_replace("[�����]", "o", $var);
		$var = @ereg_replace("[���]", "u", $var);
		$var = @str_replace("�", "c", $var);

		$from = '��������������������������';
		$to   = 'AAAAEEIOOOUUCaaaaeeiooouuc';

		return strtr($var, $from, $to);
	}

	static function removerSimbolos($str)
	{
		$var = strtolower($str);

		$from = '!@#$%�&*()-_+=[]{}���;,<>|\\~^`:/?�����������������';
		$to   = '__________________oa_____________________aeiouAEIOU';

		return strtr($var, $from, $to);
	}

	static function Remover_Espaco_Em_Branco($str)
	{
		return str_replace(" ", "", $str);
	}
	static function Trocar_Espaco_por_Underline($str)
	{
		return str_replace(" ", "_", $str);
	}

	/**
	 * @param ($bytes, $multiplicador, $tipo_retorno, $precision = 2)
	 * @param $multiplicador. Parra 1000 ou 1024
	 * @param $tipo_retorno = 'nome' retorna em KB, MB etc
	 */
	static function bytesToSize_OK($bytes, $multiplicador, $tipo_retorno, $precision = 2)
	{
		$kilobyte = $multiplicador;
		$megabyte = $kilobyte * 1000;
		$gigabyte = $megabyte * 1000;
		$terabyte = $gigabyte * 1000;


		if ($bytes == "") {
			$bytes = '0';
		}

		if (($bytes >= 0) && ($bytes < $kilobyte)) {
			$retorno        =  $bytes;
			$nomenclatura   = ' B';
		} elseif (($bytes >= $kilobyte) && ($bytes < $megabyte)) {
			$retorno = round($bytes / $kilobyte, $precision);
			$nomenclatura   = ' KB';
		} elseif (($bytes >= $megabyte) && ($bytes < $gigabyte)) {
			$retorno =  round($bytes / $megabyte, $precision);
			$nomenclatura   = ' MB';
		} elseif (($bytes >= $gigabyte) && ($bytes < $terabyte)) {
			$retorno = round($bytes / $gigabyte, $precision);
			$nomenclatura   = ' GB';
		} elseif ($bytes >= $terabyte) {
			$retorno        = round($bytes / $terabyte, $precision);
			$nomenclatura   = ' TB';
		} else {
			$retorno        = $bytes;
			$nomenclatura   = ' B';
		}

		if ($tipo_retorno == "nome") {
			return $retorno . $nomenclatura;
		} else {
			return $retorno;
		}
	}

	/**
	 * Passe o tempo em timestamp e o separador � opcional.
	 * @param $tempo
	 * @param $separador = ":"
	 */
	static function Transformar_Segundos_Para_Formato_Hora($tempo, $separador = ":")
	{
		$tempo = !is_numeric($tempo) ? 0 : $tempo;

		if ($tempo >= 0) {
			return sprintf("%02d%s%02d%s%02d", floor($tempo / 3600), $separador, ($tempo / 60) % 60, $separador, $tempo % 60);
		}
	}

	/**
	 * Passe no formato HH:MM:SS. Exemplo: Passe "00:01:00". Retornar� 60
	 */
	static function Transformar_Hora_Para_Segundos($tempo)
	{
		if (strlen($tempo) == 8) {
			$pega = explode(":", $tempo);
			$hora       = ($pega[0] * 3600);
			$min         = ($pega[1] * 60);
			$seg          = $pega[2];

			return ($hora + $min + $seg);
		} else if (strlen($tempo) == 5) {
			$pega = explode(":", $tempo);
			$hora       = ($pega[0] * 3600);
			$min         = ($pega[1] * 60);

			return ($hora + $min);
		}
		return 0;
	}
	static function porcentagem($carga, $tempo)
	{
		$pega_carga   = explode(":", $carga);
		$pega_tempo = explode(":", $tempo);

		$hora_carga    = ($pega_carga[0] * 3600);
		$min_carga      = ($pega_carga[1] * 60);
		$seg_carga       = $pega_carga[2];

		$hora_tempo     = ($pega_tempo[0] * 3600);
		$min_tempo 	 = ($pega_tempo[1] * 60);
		$seg_tempo	       = $pega_tempo[2];

		$total_carga = $hora_carga + $min_carga + $seg_carga;
		$total_tempo = $hora_tempo + $min_tempo + $seg_tempo;
		$conta = 0;
		if ($total_tempo > 0 && $total_carga > 0) {
			$conta = substr((($total_tempo / $total_carga) * 100), 0, 5);
		}

		$conta = str_replace('.', ',', $conta);

		return  "$conta%";
	}

	static function porcentagem_nota($nota, $soma_pesos)
	{

		$conta = substr((($nota / $soma_pesos) * 100), 0, 5);

		return  "$conta%";
	}

	static function addDayIntoDate($date, $days)
	{
		$thisyear = substr($date, 0, 4);
		$thismonth = substr($date, 4, 2);
		$thisday =  substr($date, 6, 2);
		$nextdate = mktime(0, 0, 0, $thismonth, $thisday + $days, $thisyear);
		return strftime("%Y%m%d", $nextdate);
	}

	static function subDayIntoDate($date, $days)
	{
		$thisyear = substr($date, 0, 4);
		$thismonth = substr($date, 4, 2);
		$thisday =  substr($date, 6, 2);
		$nextdate = mktime(0, 0, 0, $thismonth, $thisday - $days, $thisyear);
		return strftime("%Y%m%d", $nextdate);
	}
	static function retira_acentos($texto)
	{
		$array1 = array(
			"?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?"
		);
		$array2 = array(
			"a", "a", "a", "a", "a", "e", "e", "e", "e", "i", "i", "i", "i", "o", "o", "o", "o", "o", "u", "u", "u", "u", "c", "A", "A", "A", "A", "A", "E", "E", "E", "E", "I", "I", "I", "I", "O", "O", "O", "O", "O", "U", "U", "U", "U", "C"
		);
		return str_replace($array1, $array2, $texto);
	}


	/**
	 * Passe o array que deseja imprimir
	 */
	static function pre($array)
	{
		echo "<pre>" . print_r($array, true) . "</pre>";
	}

	/**
	 * Passe o array que deseja imprimir com o var_dump
	 */
	static function dump($array)
	{
		echo "<pre>" . var_dump($array) . "</pre>";
	}



	static function simpleXMLToArray(SimpleXMLElement $xml, $attributesKey = null, $childrenKey = null, $valueKey = null)
	{

		if ($childrenKey && !is_string($childrenKey)) {
			$childrenKey = '@children';
		}
		if ($attributesKey && !is_string($attributesKey)) {
			$attributesKey = '@attributes';
		}
		if ($valueKey && !is_string($valueKey)) {
			$valueKey = '@values';
		}

		$return = array();
		$name = $xml->getName();
		$_value = trim((string)$xml);
		if (!strlen($_value)) {
			$_value = null;
		};

		if ($_value !== null) {
			if ($valueKey) {
				$return[$valueKey] = $_value;
			} else {
				$return = $_value;
			}
		}

		$children = array();
		$first = true;
		foreach ($xml->children() as $elementName => $child) {
			$value = self::simpleXMLToArray($child, $attributesKey, $childrenKey, $valueKey);
			if (isset($children[$elementName])) {
				if (is_array($children[$elementName])) {
					if ($first) {
						$temp = $children[$elementName];
						unset($children[$elementName]);
						$children[$elementName][] = $temp;
						$first = false;
					}
					$children[$elementName][] = $value;
				} else {
					$children[$elementName] = array($children[$elementName], $value);
				}
			} else {
				$children[$elementName] = $value;
			}
		}
		if ($children) {
			if ($childrenKey) {
				$return[$childrenKey] = $children;
			} else {
				$return = array_merge($return, $children);
			}
		}

		$attributes = array();
		foreach ($xml->attributes() as $name => $value) {
			$attributes[$name] = trim($value);
		}
		if ($attributes) {
			if ($attributesKey) {
				$return[$attributesKey] = $attributes;
			} else {
				$return = array_merge($return, $attributes);
			}
		}

		return $return;
	}

	static function intenetExplorer()
	{
		$info_navegador = $_SERVER['HTTP_USER_AGENT'];

		if (preg_match('/Firefox/i', $info_navegador)) {
			$nome_navegador = 'Mozilla Firefox';
		} else if (preg_match('/Chrome/i', $info_navegador)) {
			$nome_navegador = 'Google Chrome';
		} else {
			$nome_navegador = 'Internet Explorer';
		}

		$Browser = array(
			'userAgent' => $info_navegador,
			'navegador'	=> $nome_navegador,
		);

		extract($Browser);
		return ($navegador == 'Internet Explorer');
	}
}
