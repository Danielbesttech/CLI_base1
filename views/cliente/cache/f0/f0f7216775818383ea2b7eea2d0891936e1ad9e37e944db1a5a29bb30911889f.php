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

/* @home/restaurante.html.twig */
class __TwigTemplate_d72ef49cfc2bc134f660f7b436406fc27136758c9ce446d066ea885f388e58e9 extends Template
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
        echo "<div class=\"swiper swiper-restaurante\">
  <div class=\"swiper-wrapper\">
    ";
        // line 3
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["Restaurante"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["Item"]) {
            // line 4
            echo "    <div class=\"swiper-slide\">
      <div class=\"banner-restaurante-cardapio\">
        <img src=\"/src/images/restaurante/";
            // line 6
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["Item"], "imagem", [], "any", false, false, false, 6), "html", null, true);
            echo "\" class=\"img-banner-restaurante\" alt=\"\" />
      </div>
    </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['Item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 10
        echo "  </div>
  <div class=\"swiper-button-next color-primary\"></div>
  <div class=\"swiper-button-prev color-primary\"></div>
</div>
";
    }

    public function getTemplateName()
    {
        return "@home/restaurante.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  59 => 10,  49 => 6,  45 => 4,  41 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "@home/restaurante.html.twig", "D:\\xampp\\htdocs\\developer1\\views\\home\\restaurante.html.twig");
    }
}
