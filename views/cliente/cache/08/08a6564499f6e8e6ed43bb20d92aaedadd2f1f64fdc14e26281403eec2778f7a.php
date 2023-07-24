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

/* @base/main.html.twig */
class __TwigTemplate_b1944f9d8f73f07ce250c04fdbc3b6c4c0cd6a41c1c40dab80f3f00350f34ddb extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"pt-br\">
  <head>
    <meta charset=\"UTF-8\" />
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" />
    <link rel=\"stylesheet\" href=\"./src/css/normalize.css\" />
    <link rel=\"stylesheet\" href=\"./src/css/padroes.css\" />
    <link rel=\"stylesheet\" href=\"./src/css/dashboard.css\" />
    <link rel=\"stylesheet\" href=\"./src/css/header.css\" />
    <link rel=\"stylesheet\" href=\"./src/css/menu_lateral.css\" />
    <link rel=\"stylesheet\" href=\"./src/css/main.css\" />
    <link rel=\"stylesheet\" href=\"./src/css/footer.css\" />
    <title>Teste</title>
  </head>
  <body>

    <body>
      <div class=\"dashboard\">
        ";
        // line 19
        $this->loadTemplate("@base/header.html.twig", "@base/main.html.twig", 19)->display($context);
        // line 20
        echo "        ";
        $this->loadTemplate("@base/sidenav.html.twig", "@base/main.html.twig", 20)->display($context);
        echo "      
  
        <main id=\"content\">";
        // line 22
        $this->displayBlock('content', $context, $blocks);
        echo "</main>

        ";
        // line 24
        $this->loadTemplate("@base/footer.html.twig", "@base/main.html.twig", 24)->display($context);
        // line 25
        echo "      </div>  
  </body>
</html>
";
    }

    // line 22
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo " ";
    }

    public function getTemplateName()
    {
        return "@base/main.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  80 => 22,  73 => 25,  71 => 24,  66 => 22,  60 => 20,  58 => 19,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "@base/main.html.twig", "C:\\xampp7_2\\htdocs\\dev\\coffe\\views\\base\\main.html.twig");
    }
}
