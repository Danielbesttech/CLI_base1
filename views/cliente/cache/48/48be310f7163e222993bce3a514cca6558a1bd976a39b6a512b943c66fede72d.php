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

/* @base/header.html.twig */
class __TwigTemplate_f1505383071538ee59a12eccd226cc027e59eb5bf7e45da5a2547a63a41e288a extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<section class=\"navigation\">
  <div class=\"nav-container\">
    <div class=\"brand\">
      <a href=\"./#home/\">
        <img src=\"/src/images/logo-rodape180x180.png\" class=\"nav-logo\" alt=\"Logo\" />
      </a>
    </div>
    <nav>
      <span class=\"open-nav-mobile\" onclick=\"openNavMobile()\">&#9776;</span>
      <ul class=\"nav-list large-response-menu\">
        <div class=\"divide-navbar\">
          <li>
            <a id=\"menu-inicio\" class=\"item-nav\" href=\"/\">Início</a>
          </li>
          <li>
            <a id=\"menu-galeria\" class=\"item-nav\" href=\"/quem-somos/\">Quem Somos</a>
          </li>
          <li>
            <a class=\"item-nav\" id=\"id-nav-produto\" href=\"/categoria/12/\">Produtos</a>
            <ul class=\"nav-dropdown\">
              <li>
                <a class=\"item-nav\" href=\"produtos/1\" id=\"menu-produto\">A</a>
              </li>
            </ul>
          </li>

          <li>
            <a id=\"menu-cardapio\" class=\"item-nav\" href=\"/cardapio\">Cardápio</a>
          </li>
        </div>
        <div class=\"divide-navbar\">
          <li>
            <a id=\"menu-restaurante\" class=\"item-nav\">Nosso Restaurante</a>
          </li>
          <li>
            <a id=\"menu-contato\" class=\"item-nav\" href=\"/contato/\">Contato</a>
          </li>
        </div>
      </ul>
    </nav>
    <div class=\"nav-side-icones\">
      <div class=\"icon-nav-carrinho\">
        <a id=\"menu-carrinho\" class=\"item-nav contador-carrinho\" data-after=\"0\"><i class=\"fas fa-shopping-cart\"></i></a>
        <div class=\"descricao-itens-carrinho\" id=\"contador-carrinho\" data-after=\"0\">Seu carrinho tem</div>
      </div>

      <div class=\"navbar-redes-sociais\">
        ";
        // line 48
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["RedesSociais"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["redes"]) {
            // line 49
            echo "        <div class=\"icon-footer-redes\"><a class=\"fab ";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["redes"], "icone", [], "any", false, false, false, 49), "html", null, true);
            echo " fa-2x\" href=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["redes"], "href", [], "any", false, false, false, 49), "html", null, true);
            echo "\" target='_blank'></a></div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['redes'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 51
        echo "      </div>
    </div>
  </div>

  <div id=\"nav-mobile\" class=\"nav-mobile\">
    <a href=\"javascript:void(0)\" class=\"close-nav-mobile\" onclick=\"closeNavMobile()\">Fechar</a>
    <a onclick=\"redirecionarMobile('carrinho/index.php')\">Carrinho <i class=\"fas fa-shopping-cart\"></i> </a>
    <a onclick=\"redirecionarMobile('home/index.php')\">Início</a>
    <a onclick=\"redirecionarMobile('galeria/index.php')\">Quem Somos</a>
    <button class=\"dropdown-btn\">
      Produtos
      <i class=\"fas fa-caret-down\"></i>
    </button>
    <div class=\"dropdown-container\">
      <a href=\"produtos/1\">AAAAAAAAAAAAAAAAAA</a>
    </div>
    <a onclick=\"redirecionarMobile('cardapio/index.php')\">Cardápio</a>
    <a onclick=\"redirecionarMobile('restaurante/index.php')\">Nosso Restaurante</a>
    <a onclick=\"redirecionarMobile('contato/index.php')\">Contato</a>
  </div>
</section>

<script>
  var dropdown = document.getElementsByClassName(\"dropdown-btn\");
  var i;

  for (i = 0; i < dropdown.length; i++) {
    dropdown[i].addEventListener(\"click\", function() {
      this.classList.toggle(\"drop-show\");
      var dropdownContent = this.nextElementSibling;
      if (dropdownContent.style.display === \"block\") {
        dropdownContent.style.display = \"none\";
      } else {
        dropdownContent.style.display = \"block\";
      }
    });
  }
</script>";
    }

    public function getTemplateName()
    {
        return "@base/header.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  101 => 51,  90 => 49,  86 => 48,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "@base/header.html.twig", "/var/www/vhosts/developer.brastream.io/httpdocs/views/base/header.html.twig");
    }
}
