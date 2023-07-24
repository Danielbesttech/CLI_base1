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

/* @categoria/index.html.twig */
class __TwigTemplate_b9d7ab89c787e61fddba1ac8bc9ba0c0e399581791ea94a20b1f97dde32da4b7 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'header' => [$this, 'block_header'],
            'content' => [$this, 'block_content'],
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
        $this->parent = $this->loadTemplate("@base/main.html.twig", "@categoria/index.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "Produtos";
    }

    public function block_header($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 2
        $this->displayParentBlock("header", $context, $blocks);
        echo "

<link rel=\"stylesheet\" href=\"/src/css/produtos.css\" />
";
    }

    // line 5
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 6
        echo "<section class=\"section-produtos\">
  <div class=\"page-title\">
    <h1 class=\"head-titulo\">";
        // line 8
        echo twig_escape_filter($this->env, ($context["categoria"] ?? null), "html", null, true);
        echo "</h1>
  </div>
  <div class=\"container-produtos\">
    <div class=\"cards-produtos\">
      ";
        // line 12
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["TiposCategoriasProdutos"] ?? null));
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["SubCategoria"] => $context["Produtos"]) {
            // line 13
            echo "      <div class=\"div-subcategoria\">
        <div class=\"subtitulo-title\">
          <span class=\"subtitulo-categoria\">";
            // line 15
            echo twig_escape_filter($this->env, $context["SubCategoria"], "html", null, true);
            echo "</span>
        </div>
        <div class=\"body-categoria\">";
            // line 17
            $this->loadTemplate("@produto/card.html.twig", "@categoria/index.html.twig", 17)->display(twig_array_merge($context, $context["Produtos"]));
            echo "</div>
      </div>
      ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['SubCategoria'], $context['Produtos'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 20
        echo "    </div>
  </div>
</section>

";
    }

    public function getTemplateName()
    {
        return "@categoria/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  123 => 20,  106 => 17,  101 => 15,  97 => 13,  80 => 12,  73 => 8,  69 => 6,  65 => 5,  57 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "@categoria/index.html.twig", "/var/www/vhosts/developer.brastream.io/httpdocs/views/categoria/index.html.twig");
    }
}
