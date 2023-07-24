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
class __TwigTemplate_a78c587e22150e4a03a4c1a4765133d2aa94581b3426b903d48c4c831605b4fc extends Template
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
    <link rel=\"stylesheet\" href=\"./src/css/menu_lateral.css\" />
    <link rel=\"stylesheet\" href=\"./src/css/main.css\" />
    <link rel=\"stylesheet\" href=\"./src/css/footer.css\" />
    <title>Teste</title>
  </head>
  <body>

    <body>
      <div class=\"dashboard\">
        ";
        // line 18
        $this->loadTemplate("@base/header.html.twig", "@base/main.html.twig", 18)->display($context);
        // line 19
        echo "        ";
        $this->loadTemplate("@base/sidenav.html.twig", "@base/main.html.twig", 19)->display($context);
        echo "      
  
        <main id=\"content\">";
        // line 21
        $this->displayBlock('content', $context, $blocks);
        echo "</main>

        ";
        // line 23
        $this->loadTemplate("@base/footer.html.twig", "@base/main.html.twig", 23)->display($context);
        // line 24
        echo "      </div>  
  </body>
</html>
";
    }

    // line 21
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
        return array (  79 => 21,  72 => 24,  70 => 23,  65 => 21,  59 => 19,  57 => 18,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "@base/main.html.twig", "/var/www/vhosts/developer.brastream.io/httpdocs/views/base/main.html.twig");
    }
}
