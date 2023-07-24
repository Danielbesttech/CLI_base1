<?

namespace App\Controller;

use App\Model\CategoriaProduto;
use App\Model\ConhecaNossoRestaurante;
use App\Model\Constantes;
use App\Model\dbConnect;
use App\Model\geral;
use App\Model\InfoGeral;
use App\Model\Produtos;
use App\Model\TipoProduto;
use App\Utils\TwigUtils;

class Inicio
{
  public $router, $base_template, $params_global, $templates, $loader, $twig;

  public function __construct($router)
  {
    $this->router = $router;

    $arrViews = [
      "base"       => "base",
      "home"       => "home",
      "contato"    => "contato",
      "quem_somos" => "quem_somos",
      "cardapio"   => "cardapio",
      "categoria"  => "categoria",
      "produto"    => "produto",
    ];
    $this->twig = TwigUtils::carregaTwig("views/cliente", $arrViews);

    self::loadHeader();
  }







  public function loadHeader()
  {
    $InfoGeral = new InfoGeral(new dbConnect());
    $Dados = $InfoGeral->procurar();

    $Redes = ["twitter", "youtube", "instagram", "facebook"];
    $icones = ["twitter" => "fa-twitter", "youtube" => "fa-youtube", "instagram" => "fa-instagram", "facebook" => "fa-facebook"];
    foreach ($Redes as $key => $value) {
      if (geral::webUrlValida($Dados[$value])) {
        $arr[] = ["icone" => $icones[$value], "url" => $Dados[$value]];
      }
    }

    $this->params_global = ["RedesSociais" => $arr];
  }

  public function Home()
  {

    $InfoGeral = new InfoGeral();

    $Dados = $InfoGeral->procurar();

    $Produtos = new Produtos();
    $listaDestaques = $Produtos->listarDestaques();
    $ConhecaNossoRestaurante = new ConhecaNossoRestaurante();
    $arrRestaurante = $ConhecaNossoRestaurante->listar(array('tipo_imagem' => Constantes::ID_RESTAURANTE_HOME), true);

    $this->params_global += ['banner_principal' => $Dados['banner_principal']];
    $this->params_global += ['Destaques' => $listaDestaques];
    $this->params_global += ['Restaurante' => $arrRestaurante];
    $this->params_global += ['ArrayCSS' => 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/10.0.4/swiper-bundle.css'];
    $this->params_global += ['ArrayGeral' => 'teste de css'];

    $arr = $this->params_global;

    echo $this->twig->render('@home/index.html.twig', $arr);
  }

  public function Contato($data)
  {
    $InfoGeral = new InfoGeral();

    $Dados = $InfoGeral->procurar();
    extract($Dados);

    $whatsappSemFormatacao = str_replace(['(', ')', '-', ' '], '', $whatsapp);
    $linkWhatsapp = "https://wa.me/55$whatsappSemFormatacao";

    $enderecoCompleto = "$endereco - $bairro, $cidade - $estado - CEP $cep";

    $this->params_global += ["endereco" => $enderecoCompleto];
    $this->params_global += ["whatsapp" => $whatsapp];
    $this->params_global += ["linkWhatsapp" => $linkWhatsapp];


    $arr = $this->params_global;


    echo $this->twig->render('@contato/index.html.twig', $arr);
  }

  public function ContatoFormulario()
  {
    echo $this->twig->render('@contato/formulario.html.twig');
  }

  public function QuemSomos($data)
  {
    $arr = $this->params_global;

    echo $this->twig->render('@quem_somos/index.html.twig', $arr);
  }

  public function Cardapio($data)
  {
    $arr = $this->params_global;

    echo $this->twig->render('@cardapio/index.html.twig', $arr);
  }

  public function Categoria($data)
  {
    $CategoriaProduto = new CategoriaProduto();
    $dadosCategoriaProduto = $CategoriaProduto->procurar(array('i' => $data['id']));

    if (empty($dadosCategoriaProduto))
      $this->router->redirect($this->router->route("rotas.home"));



    $this->params_global += ["categoria" => $dadosCategoriaProduto['titulo'], "id_categoria" => $data['id']];

    $TipoProduto = new TipoProduto();
    $listaTipoProduto = $TipoProduto->listarTipoProdutoPorCategoria(array('i' => $data['id']), Constantes::ATIVO);

    $Produtos = new Produtos();

    foreach ($listaTipoProduto as $key => $value) {
      extract($value);

      $listaProdutos = $Produtos->listarProdutosPorTipo(array('i' => $id), Constantes::ATIVO);
      if (!empty($listaProdutos))
        $arrProdutos[$titulo] = $listaProdutos;
    }

    $this->params_global += ["TiposCategoriasProdutos" => $arrProdutos];

    $arr = $this->params_global;

    echo $this->twig->render('@categoria/index.html.twig', $arr);
  }


  public function SalvarForm($data)
  {
    geral::pre($data);
  }
}
