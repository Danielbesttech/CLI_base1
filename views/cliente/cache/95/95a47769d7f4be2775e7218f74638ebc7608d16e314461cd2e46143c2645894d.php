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
class __TwigTemplate_b74dc84ffac0d5186fae7f31fb28e785ff6a5d84742e9a89395e6755cd48ee98 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'header' => [$this, 'block_header'],
            'title' => [$this, 'block_title'],
            'content' => [$this, 'block_content'],
            'script' => [$this, 'block_script'],
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
    ";
        // line 6
        $this->displayBlock('header', $context, $blocks);
        // line 25
        echo "
    <title>";
        // line 26
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
  </head>
  <body id=\"body\">
    ";
        // line 29
        $this->loadTemplate("@base/header.html.twig", "@base/main.html.twig", 29)->display($context);
        // line 30
        echo "
    <div class=\"conteudo\">
      <div id=\"loading\" name=\"loading\" class=\"loader\"></div>
      <div id=\"conteudo\">";
        // line 33
        $this->displayBlock('content', $context, $blocks);
        echo "</div>
    </div>

    ";
        // line 36
        $this->loadTemplate("@base/footer.html.twig", "@base/main.html.twig", 36)->display($context);
        // line 37
        echo "  </body>
  ";
        // line 38
        $this->displayBlock('script', $context, $blocks);
        // line 50
        echo "</html>
";
    }

    // line 6
    public function block_header($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 7
        echo "    <link rel=\"stylesheet\" href=\"/src/css/normalize.css\" />
    <link rel=\"stylesheet\" href=\"/src/css/fontawesome-all.css\" />
    <link rel=\"stylesheet\" href=\"/src/css/swiper-bundle.css\" />
    <link rel=\"stylesheet\" href=\"/src/css/root.css\" />
    <link rel=\"stylesheet\" href=\"/src/css/aos.min.css\" />
    <link rel=\"stylesheet\" href=\"/src/css/jquery-confirm.css\" />
    <link rel=\"stylesheet\" href=\"/src/css/site.css\" />
    <link rel=\"stylesheet\" href=\"/src/css/font.css\" />
    <link rel=\"stylesheet\" href=\"/src/css/home.css\" />
    <link rel=\"stylesheet\" href=\"/src/css/navbar.css\" />
    <link rel=\"stylesheet\" href=\"/src/css/marmitex.css\" />
    <link rel=\"stylesheet\" href=\"/src/css/cardapio.css\" />
    <link rel=\"stylesheet\" href=\"/src/css/galeria.css\" />
    <link rel=\"stylesheet\" href=\"/src/css/carrinho.css\" />
    <link rel=\"stylesheet\" href=\"/src/css/restaurante.css\" />
    <link rel=\"stylesheet\" href=\"/src/css/modal.css\" />
    <link rel=\"stylesheet\" href=\"/vendor/enyo/dropzone/dist/dropzone.css\" />
    ";
    }

    // line 26
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "Página Inicial";
    }

    // line 33
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo " ";
    }

    // line 38
    public function block_script($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 39
        echo "  <script src=\"https://code.jquery.com/jquery-3.7.0.min.js\" integrity=\"sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=\" crossorigin=\"anonymous\"></script>
  <script
    src=\"https://cdnjs.cloudflare.com/ajax/libs/Swiper/10.0.4/swiper-bundle.min.js\"
    integrity=\"sha512-0N/5ZOjfsh3niel+5dRD40HQkFOWaxoVzqMVAHnmAO2DC3nY/TFB7OYTaPRAFJ571IRS/XRsXGb2XyiFLFeu1g==\"
    crossorigin=\"anonymous\"
    referrerpolicy=\"no-referrer\"
  ></script>
  <script language=\"JavaScript\" src=\"/src/js/fontawesome.min.js\"></script>
  <script language=\"JavaScript\" src=\"/src/js/funcoes.js\"></script>
  <script language=\"JavaScript\" src=\"/vendor/enyo/dropzone/dist/dropzone-min.js\"></script>
  ";
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
        return array (  127 => 39,  123 => 38,  116 => 33,  109 => 26,  88 => 7,  84 => 6,  79 => 50,  77 => 38,  74 => 37,  72 => 36,  66 => 33,  61 => 30,  59 => 29,  53 => 26,  50 => 25,  48 => 6,  41 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "@base/main.html.twig", "/var/www/vhosts/developer.brastream.io/httpdocs/views/base/main.html.twig");
    }
}
