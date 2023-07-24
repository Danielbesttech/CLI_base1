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

/* @quem_somos/index.html.twig */
class __TwigTemplate_320adedbe54617c538a1301317fa3f53d50014da3dcb0ec11e6bd25d98ae0c76 extends Template
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
        return "base/index.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("base/index.html.twig", "@quem_somos/index.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 4
        echo "  <h2>
    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Fugiat autem error, soluta, ut culpa veritatis aperiam cumque quas eius sint harum reprehenderit
    magni unde dolorem quos a quo ipsam quae!
  </h2>
  <h1>Será</h1>
";
    }

    public function getTemplateName()
    {
        return "@quem_somos/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  50 => 4,  46 => 3,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "@quem_somos/index.html.twig", "C:\\xampp7_2\\htdocs\\dev\\coffe\\views\\quem_somos\\index.html.twig");
    }
}
