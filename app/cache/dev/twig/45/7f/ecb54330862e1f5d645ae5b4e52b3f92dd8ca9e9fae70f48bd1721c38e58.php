<?php

/* AcmeDemoBundle:Login:login.html.twig */
class __TwigTemplate_457fecb54330862e1f5d645ae5b4e52b3f92dd8ca9e9fae70f48bd1721c38e58 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        try {
            $this->parent = $this->env->loadTemplate("AcmeDemoBundle::layout.html.twig");
        } catch (Twig_Error_Loader $e) {
            $e->setTemplateFile($this->getTemplateName());
            $e->setTemplateLine(1);

            throw $e;
        }

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "AcmeDemoBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_title($context, array $blocks = array())
    {
        echo " Log in & Get on";
    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        // line 4
        echo "
    <div id=\"content\" class=\"container\">

    <section class=\"pc-login bx-shadow mtmexl\">
        <h1>WELCOME BACK</h1>
        ";
        // line 9
        echo twig_include($this->env, $context, "AcmeDemoBundle:Form:login.html.twig");
        echo "
        <!-- Post Click Tracking Location: puntclub.com.au Log In -->
        <script type=\"text/javascript\">
            <!--
            var dd = new Date();
            var ord = Math.round(Math.abs(Math.sin(dd.getTime()))*1000000000)%10000000;
            var fd_pct_src = new String(\"<scr\"+\"ipt src=\\\"//adsfac.net/pct_mx.asp?L=224143&source=js&ord=\"+ord+\"\\\" type=\\\"text/javascript\\\"></scr\"+\"ipt>\");
            document.write(fd_pct_src);
            -->
        </script>
        <noscript>
            <iframe frameborder=\"0\" width=\"0\" height=\"0\" src=\"//adsfac.net/pct_mx.asp?L=224143&source=if\"></iframe>
        </noscript>
    </section>
    </div>

";
    }

    public function getTemplateName()
    {
        return "AcmeDemoBundle:Login:login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  53 => 9,  46 => 4,  43 => 3,  37 => 2,  11 => 1,);
    }
}
