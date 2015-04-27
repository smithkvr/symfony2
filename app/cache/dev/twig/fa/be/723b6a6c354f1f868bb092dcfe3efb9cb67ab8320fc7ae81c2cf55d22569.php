<?php

/* AcmeDemoBundle:Form:newPassword.html.twig */
class __TwigTemplate_fabe723b6a6c354f1f868bb092dcfe3efb9cb67ab8320fc7ae81c2cf55d22569 extends Twig_Template
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
        echo "<form id=\"form_new_password\" class=\"well form-inline\" method=\"post\" enctype=\"application/x-www-form-urlencoded\">

    <div class=\"control-group row\">
        <div class=\"sd-12\">
            <label for=\"password-email\" class=\"form-label\">New password</label>
            <input id=\"password\" name=\"password\" type=\"password\" class=\"form-control\">
        </div>
    </div>

    <div class=\"control-group row\">
        <div class=\"sd-12\">
            <label for=\"password-email\" class=\"form-label\">Confirm password</label>
            <input id=\"password2\" name=\"password2\" type=\"password\" class=\"form-control\">
            ";
        // line 14
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "password", array()), "errors", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["msg"]) {
            // line 15
            echo "                <p class=\"help-block\">";
            echo twig_escape_filter($this->env, $context["msg"], "html", null, true);
            echo "</p>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['msg'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 17
        echo "        </div>
    </div>

    <div class=\"control-group row\">
        <div class=\"sd-12\">
            <button id=\"newpassword-submit\" name=\"newpassword-submit\" type=\"submit\" class=\"btn yellow-btn mtx\">Update password</button>
        </div>
    </div>
</form>


";
    }

    public function getTemplateName()
    {
        return "AcmeDemoBundle:Form:newPassword.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  47 => 17,  38 => 15,  34 => 14,  19 => 1,);
    }
}
