<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* @home/index.html.twig */
class __TwigTemplate_e4d18c84fec347750f7e8cd966ab46bb31b2b4b2cc31c9c2aefa0e4ba3719341 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'header' => [$this, 'block_header'],
            'content' => [$this, 'block_content'],
            'script' => [$this, 'block_script'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "@base/main.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("@base/main.html.twig", "@home/index.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    public function block_header($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 2
        $this->displayParentBlock("header", $context, $blocks);
        echo "

<link
  rel=\"stylesheet\"
  href=\"https://cdnjs.cloudflare.com/ajax/libs/Swiper/10.0.4/swiper-bundle.css\"
  integrity=\"sha512-3OuH/9eh0Sx9s/c23ZFG5SJb3GvBluF9cdGgQXhZyMyId4GP87W9QBgkHmocx+8kZaCZmXQUUuLOD4Q4f5PaWQ==\"
  crossorigin=\"anonymous\"
  referrerpolicy=\"no-referrer\"
/>
";
    }

    // line 11
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 12
        echo "
<section class=\"section-header-home\">
  <div class=\"div-bg-home\">
    <div
      style=\"background: url('/src/images/";
        // line 16
        echo twig_escape_filter($this->env, ($context["banner_principal"] ?? null), "html", null, true);
        echo "'); background-size: contain; background-repeat: no-repeat; background-position: 0 60px; background-attachment: fixed; aspect-ratio: 4/1;\"
    ></div>
  </div>
  <div class=\"div-bg-home-mobile\">
    <div class=\"\"></div>
  </div>
</section>

<section class=\"section-header-info\">
  <div class=\"container-header-info\">
    <div class=\"info-titulo\">
      <h1 class=\"home-sub-title\">EMPÓRIO<span class=\"home-destaque\">TREMBÃO</span></h1>
      <span class=\"home-sub-detalhes\"
        >É uma loja de produtos típicos de <span class=\"home-destaque\">Minas Gerais</span>, onde prezamos a qualidade e o sabor para melhor atender nossos
        clientes.</span
      >
    </div>
  </div>
</section>

<section class=\"section-lancamento-home\">
  <div class=\"container-lancamento\">
    <div class=\"lancamento-title\">
      <h1 class=\"subtitulo-categoria\">Produtos em Destaque</h1>
    </div>
    <div class=\"cards-produtos\">";
        // line 41
        $this->loadTemplate("@home/destaques.html.twig", "@home/index.html.twig", 41)->display(twig_array_merge($context, ($context["Destaques"] ?? null)));
        echo "</div>
  </div>
</section>

<!-- Categorias -->
<section class=\"section-categorias-home\">
  <div class=\"container\">
    <div class=\"categorias-title\">
      <h1 class=\"subtitulo-categoria\">Categorias</h1>
    </div>
    <div class=\"cards-categorias\">
      <div class=\"categoria-base-size\">
        <a onclick=\"redirecionarPagina('produtos/index.php', 'iProduto=1')\" class=\"div-card-categoria\">
          <div
            class=\"body-card-categoria\"
            style=\"
              background: url(\$URL_IMG_CATEGORIAS_PRODUTO/\$id/\$img_categoria);
              background-size: cover;
              background-repeat: no-repeat;
              -webkit-transition: all 0.5s;
              -moz-transition: all 0.5s;
              -o-transition: all 0.5s;
              transition: all 0.5s;
            \"
          >
            <span class=\"btn-categoria\"> TESTE </span>
          </div>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- Restaurante -->
<section class=\"section-restaurante-home\">";
        // line 75
        $this->loadTemplate("@home/restaurante.html.twig", "@home/index.html.twig", 75)->display(twig_array_merge($context, ($context["Restaurante"] ?? null)));
        echo "</section>

<section class=\"section-formas-pagamentos\">
  <div class=\"container-formas-pagamentos\">
    <div class=\"titulo-formas-pagamentos\">Formas de Pagamentos</div>
    <div class=\"subtitulo-formas-pagamentos\">Aceitamos pagamentos via cartão de crédito, débito, boleto e pix.</div>
    <div class=\"body-formas-pagamentos\">
      <div class=\"formas-pagamentos\">
        <img src=\"/src/images/pagamentos/elo.png\" width=\"52px\" alt=\"Cartão bandeira Elo\" />
      </div>
      <div class=\"formas-pagamentos\">
        <img src=\"/src/images/pagamentos/elo.png\" width=\"52px\" alt=\"Cartão bandeira MasterCard\" />
      </div>
      <div class=\"formas-pagamentos\">
        <img src=\"/src/images/pagamentos/elo.png\" width=\"52px\" alt=\"Cartão bandeira MasterCard Maestro\" />
      </div>
      <div class=\"formas-pagamentos\">
        <img src=\"/src/images/pagamentos/visa.png\" width=\"52px\" alt=\"Cartão bandeira Visa\" />
      </div>
      <div class=\"formas-pagamentos\">
        <img src=\"/src/images/pagamentos/hipercard.png\" width=\"52px\" alt=\"Cartão bandeira Hipercard\" />
      </div>
      <div class=\"formas-pagamentos\">
        <img src=\"/src/images/pagamentos/pix.png\" width=\"52px\" alt=\"Cartão via Pix\" />
      </div>
      <div class=\"formas-pagamentos\">
        <img src=\"/src/images/pagamentos/alelo.png\" width=\"52px\" alt=\"Vale refeição Alelo\" />
      </div>
    </div>
  </div>
</section>

<div class=\"espaco-bottom\"></div>

";
    }

    // line 109
    public function block_script($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 110
        $this->displayParentBlock("script", $context, $blocks);
        echo "
<script language=\"JavaScript\" src=\"/src/js/home/destaques.js\"></script>
<script language=\"JavaScript\" src=\"/src/js/home/restaurante.js\"></script>

";
    }

    public function getTemplateName()
    {
        return "@home/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  183 => 110,  179 => 109,  140 => 75,  103 => 41,  75 => 16,  69 => 12,  65 => 11,  51 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "@home/index.html.twig", "D:\\xampp\\htdocs\\developer1\\views\\home\\index.html.twig");
    }
}
