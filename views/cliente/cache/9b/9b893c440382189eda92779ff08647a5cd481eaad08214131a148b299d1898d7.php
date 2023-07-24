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

/* @contato/formulario.html.twig */
class __TwigTemplate_c5e189756ddf28d4452d31732ca8bb101a05f51debc248407ec93bea105e46ea extends Template
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
        echo "<div class=\"form-contato\">
  <form id=\"frm\" onsubmit=\"return false\">
    <h2>Entrar na lista</h2>

    <div class=\"input\">
      <input required type=\"text\" id=\"nome\" name=\"nome\" />
      <label>Nome</label>
      <span class=\"error\"></span>
    </div>

    <div class=\"input\">
      <input required type=\"email\" id=\"email\" name=\"email\" />
      <label>Email</label>
      <span class=\"error\"></span>
    </div>
    <div class=\"input\">
      <input required type=\"date\" id=\"data\" name=\"data\" />
      <label>Data</label>
      <span class=\"error\"></span>
    </div>

    <div id=\"dropzone\" class=\"dropzone\"></div>

    <button type=\"submit\">Enviar</button>
  </form>
</div>

<script>
</script>
<script language=\"JavaScript\" src=\"/src/js/contato/formulario.js\"></script>
";
    }

    public function getTemplateName()
    {
        return "@contato/formulario.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "@contato/formulario.html.twig", "/var/www/vhosts/developer.brastream.io/httpdocs/views/contato/formulario.html.twig");
    }
}
