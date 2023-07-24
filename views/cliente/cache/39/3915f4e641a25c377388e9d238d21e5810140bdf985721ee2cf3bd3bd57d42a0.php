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

/* @contato/index.html.twig */
class __TwigTemplate_cbe1ebf99466f37c01912c40280a2bd51e805536e10143c8b05b34e39669424f extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'header' => [$this, 'block_header'],
            'content' => [$this, 'block_content'],
            'script' => [$this, 'block_script'],
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
        $this->parent = $this->loadTemplate("@base/main.html.twig", "@contato/index.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "Contato";
    }

    // line 5
    public function block_header($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 6
        $this->displayParentBlock("header", $context, $blocks);
        echo "

<link rel=\"stylesheet\" href=\"/src/css/contato.css\" />
";
    }

    // line 9
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 10
        echo "<section class=\"section-contato\">
  <div class=\"page-title\">
    <span class=\"head-titulo\">Contato</span>
  </div>
  <div class=\"container-contato\">
    <div class=\"body-contato\">
      <div class=\"div-funcionamento\">
        <div class=\"subtitulo-categoria\">Contato</div>
        <div class=\"body-funcionamento\">
          <div class=\"funcionamento\">
            <div class=\"subtitulo-funcionamento\">subtitulo1_contato</div>
            <div class=\"txt-functionamento\">descricao1_contato</div>
          </div>

          <div class=\"funcionamento\">
            <div class=\"subtitulo-funcionamento\">
              ";
        // line 26
        echo twig_escape_filter($this->env, ($context["subtitulo2_contato"] ?? null), "html", null, true);
        echo "
            </div>
            <div class=\"txt-functionamento\">
              ";
        // line 29
        echo twig_escape_filter($this->env, ($context["descricao2_contato"] ?? null), "html", null, true);
        echo "
            </div>
          </div>
        </div>
      </div>
      <div class=\"div-funcionamento\">
        <div class=\"subtitulo-categoria\">Delivery</div>
        <div class=\"body-funcionamento\">
          <div class=\"funcionamento\">
            <div class=\"subtitulo-funcionamento\">Faça seu pedido pelo nosso whatsapp:</div>
            <div class=\"div-txt-functionamento\">
              <a class=\"txt-functionamento contato-whatsapp\" href=\"";
        // line 40
        echo twig_escape_filter($this->env, ($context["linkWhatsapp"] ?? null), "html", null, true);
        echo "\" target=\"_blank\">";
        echo twig_escape_filter($this->env, ($context["whatsapp"] ?? null), "html", null, true);
        echo "</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class=\"como-chegar-contato\">
    <div class=\"localizacao\">
      <div class=\"titulo-endereco\" onclick=\"ChamarFormularioContato()\">Nos envie uma mensagem!</div>
    </div>
    <div class=\"form-contato\">
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

        ";
        // line 76
        echo "
        <button type=\"button\" onclick=\"SalvarContato()\">Enviar</button>
      </form>
    </div>
  </div>

  <div class=\"como-chegar-contato\">
    <div class=\"localizacao\">
      <div class=\"titulo-endereco\">Localização</div>
      <div class=\"body-endereco\">
        <div class=\"info-endereco\"><?= \$enderecoCompleto ?></div>
      </div>
    </div>

    <iframe
      src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3661.359423659917!2d-46.03870398255615!3d-23.411380100000006!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94cdce4a1af911b3%3A0xea2a6b746253ab8a!2sR.%20Vinte%20e%20Tr%C3%AAs%20de%20Maio%2C%2020%20-%20Centro%2C%20Guararema%20-%20SP%2C%2008900-000!5e0!3m2!1spt-BR!2sbr!4v1648576923892!5m2!1spt-BR!2sbr\"
      width=\"600\"
      height=\"450\"
      style=\"border: 0\"
      allowfullscreen=\"\"
      loading=\"lazy\"
      referrerpolicy=\"no-referrer-when-downgrade\"
    ></iframe>
  </div>
</section>
";
    }

    // line 101
    public function block_script($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 102
        $this->displayParentBlock("script", $context, $blocks);
        echo "

<script>
  function SalvarContato() {
    if (validarForm(\"frm\")) {
      var frm = document.getElementById(\"frm\");
      var data = new FormData(frm);

      \$.ajax({
        url: \"/contato/salvar/\",
        type: \"POST\",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        method: \"POST\",
        type: \"POST\", // For jQuery < 1.9
        beforeSend: (data) => {
          inserirLoading(\"frm\");
        },
        success: (data) => {
          console.log(data);
          removerLoading();
        },
      }).done((e) => {});
    }
  }
</script>

";
    }

    public function getTemplateName()
    {
        return "@contato/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  181 => 102,  177 => 101,  148 => 76,  110 => 40,  96 => 29,  90 => 26,  72 => 10,  68 => 9,  60 => 6,  56 => 5,  49 => 3,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "@contato/index.html.twig", "/var/www/vhosts/developer.brastream.io/httpdocs/views/contato/index.html.twig");
    }
}
