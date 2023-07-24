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

/* @home/destaques.html.twig */
class __TwigTemplate_596fbc34654be6d727bc1d6c6d3593ed52ffa9d7dba493f958033c96bc7d7861 extends Template
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
        echo "<div class=\"swiper swiper-destaques\">
  <div class=\"swiper-wrapper\">
    ";
        // line 3
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["Destaques"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["Produto"]) {
            // line 4
            echo "    <div class=\"swiper-slide\">
      <div class=\"cards-destaque\">
        <div
          class=\"card-bg-destaque\"
          style=\"background-image: url('/src/images/categorias/";
            // line 8
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["Produto"], "id_categoria", [], "any", false, false, false, 8), "html", null, true);
            echo "/";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["Produto"], "id_tipo_produto", [], "any", false, false, false, 8), "html", null, true);
            echo "/";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["Produto"], "id", [], "any", false, false, false, 8), "html", null, true);
            echo "/";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["Produto"], "img_produto", [], "any", false, false, false, 8), "html", null, true);
            echo "'); background-size: contain; background-position: center\"
        >
      </div>
        <div
          class=\"div-card-destaque\"
          data-before=\"R\$ \"
          style=\"background-image: url('/src/images/categorias/";
            // line 14
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["Produto"], "id_categoria", [], "any", false, false, false, 14), "html", null, true);
            echo "/";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["Produto"], "id_tipo_produto", [], "any", false, false, false, 14), "html", null, true);
            echo "/";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["Produto"], "id", [], "any", false, false, false, 14), "html", null, true);
            echo "/";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["Produto"], "img_produto", [], "any", false, false, false, 14), "html", null, true);
            echo "'); background-position: center; background-repeat: no-repeat; background-size: contain\"
        >
          <div class=\"card-destaque\">
            <div class=\"nome-destaque\">TESTE</div>
            <div class=\"div-btn-destaque\">
              <a class=\"button-comprar\" title=\"Botão Comprar\" onclick=\"modalAdicionar.abrir('<?= \$dataProduto ?>', pageHash)\">Comprar</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['Produto'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 26
        echo "  </div>
  <div class=\"swiper-button-next color-primary\" id=\"swiper-button-next\"></div>
  <div class=\"swiper-button-prev color-primary\" id=\"swiper-button-prev\"></div>
</div>
";
    }

    public function getTemplateName()
    {
        return "@home/destaques.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  90 => 26,  66 => 14,  51 => 8,  45 => 4,  41 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "@home/destaques.html.twig", "D:\\xampp\\htdocs\\developer1\\views\\home\\destaques.html.twig");
    }
}
