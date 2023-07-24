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
class __TwigTemplate_7d9e7541bf32408a1578b7034873d543c2875a585ea21a1c1fa02278192e7afa extends Template
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
        $this->parent = $this->loadTemplate("@base/main.html.twig", "@quem_somos/index.html.twig", 1);
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
        return new Source("", "@quem_somos/index.html.twig", "/var/www/vhosts/developer.brastream.io/httpdocs/views/quem_somos/index.html.twig");
    }
}
