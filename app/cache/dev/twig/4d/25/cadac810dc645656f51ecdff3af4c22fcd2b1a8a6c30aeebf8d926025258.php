<?php

/* AcmeDemoBundle::layout.html.twig */
class __TwigTemplate_4d25cadac810dc645656f51ecdff3af4c22fcd2b1a8a6c30aeebf8d926025258 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        try {
            $this->parent = $this->env->loadTemplate("TwigBundle::layout.html.twig");
        } catch (Twig_Error_Loader $e) {
            $e->setTemplateFile($this->getTemplateName());
            $e->setTemplateLine(1);

            throw $e;
        }

        $this->blocks = array(
            'head' => array($this, 'block_head'),
            'title' => array($this, 'block_title'),
            'body' => array($this, 'block_body'),
            'content_header' => array($this, 'block_content_header'),
            'content_header_more' => array($this, 'block_content_header_more'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "TwigBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_head($context, array $blocks = array())
    {
        // line 4
        echo "    <link rel=\"icon\" sizes=\"16x16\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" />
    <link rel=\"stylesheet\" href=\"";
        // line 5
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/acmedemo/css/demo.css"), "html", null, true);
        echo "\" />
    
    ";
        // line 7
        if ($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array())) {
            // line 8
            echo "    \t<a href=\"";
            echo $this->env->getExtension('routing')->getPath("logout");
            echo "\">Logout</a>
\t";
        } else {
            // line 10
            echo "\t   <a href=\"";
            echo $this->env->getExtension('routing')->getPath("_ac_login");
            echo "\">Login</a>
\t    <a href=\"";
            // line 11
            echo $this->env->getExtension('routing')->getPath("account_register");
            echo "\">Register</a> 
\t";
        }
    }

    // line 15
    public function block_title($context, array $blocks = array())
    {
        echo "Demo Bundle";
    }

    // line 17
    public function block_body($context, array $blocks = array())
    {
        // line 18
        echo "    ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session", array()), "flashbag", array()), "get", array(0 => "notice"), "method"));
        foreach ($context['_seq'] as $context["_key"] => $context["flashMessage"]) {
            // line 19
            echo "        <div class=\"flash-message\">
            <em>Notice</em>: ";
            // line 20
            echo twig_escape_filter($this->env, $context["flashMessage"], "html", null, true);
            echo "
        </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['flashMessage'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 23
        echo "
    ";
        // line 24
        $this->displayBlock('content_header', $context, $blocks);
        // line 33
        echo "
    <div class=\"block\">
        ";
        // line 35
        $this->displayBlock('content', $context, $blocks);
        // line 36
        echo "    </div>

    ";
        // line 38
        if (array_key_exists("code", $context)) {
            // line 39
            echo "        <h2>Code behind this page</h2>
        <div class=\"block\">
            <div class=\"symfony-content\">";
            // line 41
            echo (isset($context["code"]) ? $context["code"] : $this->getContext($context, "code"));
            echo "</div>
        </div>
    ";
        }
    }

    // line 24
    public function block_content_header($context, array $blocks = array())
    {
        // line 25
        echo "        <ul id=\"menu\">
            ";
        // line 26
        $this->displayBlock('content_header_more', $context, $blocks);
        // line 29
        echo "        </ul>

        <div style=\"clear: both\"></div>
    ";
    }

    // line 26
    public function block_content_header_more($context, array $blocks = array())
    {
        // line 27
        echo "                <li><a href=\"";
        echo $this->env->getExtension('routing')->getPath("_demo");
        echo "\">Demo Home</a></li>
            ";
    }

    // line 35
    public function block_content($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "AcmeDemoBundle::layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  154 => 35,  147 => 27,  144 => 26,  137 => 29,  135 => 26,  132 => 25,  129 => 24,  121 => 41,  117 => 39,  115 => 38,  111 => 36,  109 => 35,  105 => 33,  103 => 24,  100 => 23,  91 => 20,  88 => 19,  83 => 18,  80 => 17,  74 => 15,  67 => 11,  62 => 10,  56 => 8,  54 => 7,  49 => 5,  44 => 4,  41 => 3,  11 => 1,);
    }
}
