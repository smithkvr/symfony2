<?php

/* AcmeDemoBundle:Form:resetPassword.html.twig */
class __TwigTemplate_72eb129f553aa1325dee58cec7617009c5e0a300fa0d9780c3e0fadbc0153499 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<h3 class=\"form-heading\">Enter your email address to get reset password</h3>

<form id=\"form_reset_password\" class=\"well form-inline\" method=\"post\" enctype=\"application/x-www-form-urlencoded\">

    <div class=\"control-group row\">
        <div class=\"sd-12\">
            <label for=\"resetpassword-email\" class=\"form-label\">Email</label>
            <input id=\"resetpassword-email\" name=\"email\" type=\"text\" placeholder=\"Email\" class=\"form-control\">
            ";
        // line 9
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "email", array()), "errors", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["msg"]) {
            // line 10
            echo "                <p class=\"help-block\">";
            echo twig_escape_filter($this->env, $context["msg"], "html", null, true);
            echo "</p>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['msg'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 12
        echo "        </div>
    </div>

    <div class=\"control-group row\">
        <div class=\"sd-12\">
            <button id=\"fresetpassword-submit\" name=\"resetpassword-submit\" type=\"submit\" class=\"btn yellow-btn mtx\">Reset password</button>
        </div>
    </div>
</form>";
    }

    public function getTemplateName()
    {
        return "AcmeDemoBundle:Form:resetPassword.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  42 => 12,  33 => 10,  29 => 9,  19 => 1,);
    }
}
