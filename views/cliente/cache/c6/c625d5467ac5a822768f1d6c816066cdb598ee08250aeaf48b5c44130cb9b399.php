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

/* @base/footer.html.twig */
class __TwigTemplate_06d48569b379f8a35f505970456e8949a42830f11de8e7102fd533fbdddc6e27 extends Template
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
        echo "<footer>
  <div><a href=\"./home\">Home</a></div>
  <div><a href=\"./contato\">Contato</a></div>
  <div><a href=\"./quem-somos\">Quem somos</a></div>
  <div><a href=\"./sobre\">Sobre</a></div>
</footer>
";
    }

    public function getTemplateName()
    {
        return "@base/footer.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "@base/footer.html.twig", "/var/www/vhosts/developer.brastream.io/httpdocs/views/base/footer.html.twig");
    }
}
