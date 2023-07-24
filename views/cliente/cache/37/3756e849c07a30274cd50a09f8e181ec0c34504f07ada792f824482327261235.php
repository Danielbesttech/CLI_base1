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

/* @base/index.html.twig */
class __TwigTemplate_1e4b744596b08e75bb40f915d5545f6f492d534b584573335d304abd79eefa74 extends Template
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
    <link rel=\"stylesheet\" href=\"./src/css/header.css\" />
    <title>Teste</title>
  </head>
  <body>

    <body>
      <div class=\"dashboard\">
        ";
        // line 17
        $this->loadTemplate("@base/header.html.twig", "@base/index.html.twig", 17)->display($context);
        // line 18
        echo "        ";
        $this->loadTemplate("@base/sidenav.html.twig", "@base/index.html.twig", 18)->display($context);
        echo "      
  
        <main id=\"content\">";
        // line 20
        $this->displayBlock('content', $context, $blocks);
        echo "</main>

        ";
        // line 22
        $this->loadTemplate("@base/footer.html.twig", "@base/index.html.twig", 22)->display($context);
        // line 23
        echo "      </div>  
  </body>
</html>
";
    }

    // line 20
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo " ";
    }

    public function getTemplateName()
    {
        return "@base/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  78 => 20,  71 => 23,  69 => 22,  64 => 20,  58 => 18,  56 => 17,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "@base/index.html.twig", "C:\\xampp7_2\\htdocs\\dev\\coffe\\views\\base\\index.html.twig");
    }
}
