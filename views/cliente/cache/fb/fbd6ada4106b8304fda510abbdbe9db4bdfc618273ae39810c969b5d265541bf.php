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

/* @produto/card.html.twig */
class __TwigTemplate_6bff61824b85fcab887b3a5c230be3fb1d9509887705414e9a30ef2945fc0002 extends Template
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
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["Produtos"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["Produto"]) {
            // line 2
            echo "<div class=\"div-card-produto\">
  <div class=\"card-produto <?= \$promo ?>\">
    <div class=\"card-imagem\" data-title=\"Clique aqui para visualizar o produto\" onclick=\"modalVerProduto.abrir('<?= \$dataProduto ?>', pageHash)\">
      <img class=\"imagem-produto\" src=\"/src/images/categorias/";
            // line 5
            echo twig_escape_filter($this->env, ($context["id_categoria"] ?? null), "html", null, true);
            echo "/";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["Produto"], "id_tipo_produto", [], "any", false, false, false, 5), "html", null, true);
            echo "/";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["Produto"], "id", [], "any", false, false, false, 5), "html", null, true);
            echo "/";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["Produto"], "img_produto", [], "any", false, false, false, 5), "html", null, true);
            echo "\" alt=\"\" />
      <figcaption class=\"legenda-figure-produto\"><i class=\"fas fa-expand\"></i>&nbsp;Expandir</figcaption>
    </div>
    <div class=\"card-produto-body\">
      <div class=\"nome-produto\">
        ";
            // line 10
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["Produto"], "titulo", [], "any", false, false, false, 10), "html", null, true);
            echo "
      </div>
      <div class=\"descricao-produto\"><?= \$descricao ?></div>
      <div class=\"valor-produto\">
        R\$
        <?= \$preco ?>
      </div>
      <div class=\"comprar-produto\">
        <button class=\"button-comprar\" value=\"Comprar\" onclick=\"modalAdicionar.abrir('<?= \$dataProduto ?>', pageHash)\">Comprar</button>
      </div>
    </div>
  </div>
</div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['Produto'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "@produto/card.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  60 => 10,  46 => 5,  41 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "@produto/card.html.twig", "/var/www/vhosts/developer.brastream.io/httpdocs/views/produto/card.html.twig");
    }
}
