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

/* @base/sidenav.html.twig */
class __TwigTemplate_6172ccf9c5bb472b255d70ec403dec17ec06682d873b239f9cec74dcbbd9251d extends Template
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
        echo "<div id=\"div_select_unidades\">
  <div class=\"container-unidades\">
    <div class=\"unidades-icone\">
      <i class=\"fa-solid fa-house-medical-flag\"></i>
    </div>
    <select name=\"id_unidade\" id=\"id_unidade\">

      <option [SELECTED] value=\"[ID_UNIDADE]\">[UNIDADE 1]</option>

    </select>
  </div>
</div>

<div class=\"menu_lateral\">
  <ul>
    ";
        // line 16
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["rotas"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["navigation"]) {
            // line 17
            echo "    <a id=\"[ID_MENU_PRINCIPAL]\" href=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["navigation"], "href", [], "any", false, false, false, 17), "html", null, true);
            echo "\">
      <i class=\"";
            // line 18
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["navigation"], "icone", [], "any", false, false, false, 18), "html", null, true);
            echo "\"></i>
      <span>";
            // line 19
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["navigation"], "item", [], "any", false, false, false, 19), "html", null, true);
            echo "</span>
    </a>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['navigation'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 22
        echo "
    <li onclick=\"window.location.href='logout.php'\">
      <i class=\"fas fa-sign-out-alt\"></i>
      <span>Sair</span>
    </li>
  </ul>

  <label>[USER_LOGADO]</label>
</div>
";
    }

    public function getTemplateName()
    {
        return "@base/sidenav.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  76 => 22,  67 => 19,  63 => 18,  58 => 17,  54 => 16,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "@base/sidenav.html.twig", "/var/www/vhosts/developer.brastream.io/httpdocs/views/base/sidenav.html.twig");
    }
}
