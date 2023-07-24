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
class __TwigTemplate_5cdbd535968e6be4537b716eb68d6c4df06d34f7b0dba164d1bc994b5495f40d extends Template
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
        echo "<footer class=\"footer\">
  <div class=\"container-footer\">
    <div class=\"imagem-footer\">
      <img class=\"logo-footer\" src=\"assets/images/logo-rodape180x180.png\" alt=\"Logo Rodapé\" />
    </div>

    <div class=\"footer-informacoes\">
      <div class=\"p1\">Nosso Endereço</div>
      <div class=\"p2\">enderecoCompleto</div>
      <div class=\"p3\">
        <Span>Whatsapp: whatsapp - </Span>
        <Span>Telefone: telefone </Span>
      </div>
      <div class=\"p3\">Siga nas redes sociais</div>
      <div class=\"footer-redes-sociais\"></div>
      <div class=\"p4\">Copyright ©Empório Trembão 2023</div>
    </div>

    <div class=\"footer-oversee\">
      <a class=\"footer-logo-over\" href=\"https://overseebrasil.com.br\" target=\"_blank\" rel=\"noreferrer\">
        <img src=\"./assets/images/logo-oversee.png\" width=\"46px\" alt=\"\" />
        <div class=\"textoOversee\">
          Desenvolvido por
          <b> Oversee Tecnologia </b>
        </div>
      </a>
    </div>
  </div>
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
        return new Source("", "@base/footer.html.twig", "D:\\xampp\\htdocs\\developer1\\views\\base\\footer.html.twig");
    }
}
