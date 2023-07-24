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
class __TwigTemplate_db1302d6d945c893ae7179addd8eb076ea2a6c3675292db66cc2f629e8bc6cc6 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
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
        $this->parent = $this->loadTemplate("@base/main.html.twig", "@home/index.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo " here is the index page content
<h1>Home page</h1>

";
        // line 4
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["rotas"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["navigation"]) {
            // line 5
            echo "<section>
  <a href=\"";
            // line 6
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["navigation"], "href", [], "any", false, false, false, 6), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["navigation"], "item", [], "any", false, false, false, 6), "html", null, true);
            echo "</a>
</section>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['navigation'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 8
        echo " 

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
        return array (  71 => 8,  60 => 6,  57 => 5,  53 => 4,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "@home/index.html.twig", "C:\\xampp7_2\\htdocs\\dev\\coffe\\views\\home\\index.html.twig");
    }
}
