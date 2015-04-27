<?php

/* AcmeDemoBundle:Form:login.html.twig */
class __TwigTemplate_96fcbeb5c2f7573c30cde9d35cf2673d3284c7de8ab26aa09a474f0dc4d169b4 extends Twig_Template
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
        if ((array_key_exists("loginError", $context) && (isset($context["loginError"]) ? $context["loginError"] : $this->getContext($context, "loginError")))) {
            // line 2
            echo "    <div class=\"alert alert-error\"><strong>Sorry</strong>, those details didn't match. Try again or <a href=\"";
            echo $this->env->getExtension('routing')->getUrl("reset_password");
            echo "\">reset password</a></div>
";
        }
        // line 4
        echo "
<form id=\"form_login\" class=\"form-horizontal\" action=\"";
        // line 5
        echo $this->env->getExtension('routing')->getUrl("login_check");
        echo "\" method=\"post\" enctype=\"application/x-www-form-urlencoded\">

<div class=\"control-group row \">
    <div class=\"sd-12\">
        <label for=\"login-email\" class=\"form-label\">Email</label>
        <input id=\"login-email\" name=\"email\" type=\"text\" class=\"form-control\" placeholder=\"Email\" value=\"";
        // line 10
        echo twig_escape_filter($this->env, ((array_key_exists("loginUsername", $context)) ? ((isset($context["loginUsername"]) ? $context["loginUsername"] : $this->getContext($context, "loginUsername"))) : ("")), "html", null, true);
        echo "\">
    </div>
</div>


<div class=\"control-group row \">
    <div class=\"sd-12\">
        <label for=\"login-password\" class=\"form-label\">Password</label>
        <input id=\"login-password\" name=\"password\" type=\"password\" class=\"form-control\" placeholder=\"Password\">
    </div>
</div>

    <div class=\"control-group row \" style=\"margin-top: 22px;margin-bottom: 15px;\">
        <div class=\"sd-12\">
        <span id=\"rememberMeSpan\" class=\"checkbox\">
            <input type=\"checkbox\" id=\"remember_me\" name=\"_remember_me\" checked />
            <label for=\"remember_me\"></label>
        </span>
        <label for=\"remember_me\" class=\"form-label\">Remember me</label>
        </div>
    </div>

    <button type=\"submit\" id=\"login-submit\" class=\"btn btn-warning  yellow-btn\" data-original-title=\"\">Login</button>
    ";
        // line 33
        if (array_key_exists("_targetPath", $context)) {
            echo "<input type=\"hidden\" name=\"_target_path\" value=\"";
            echo twig_escape_filter($this->env, (isset($context["_targetPath"]) ? $context["_targetPath"] : $this->getContext($context, "_targetPath")), "html", null, true);
            echo "\" />";
        }
        // line 34
        echo "


</form>

    <div class=\"cf\">
    <a class=\"signup-link\" href=\"/register\">SIGN UP</a>
    <a class=\"fogot-pass-link\" href=\"";
        // line 41
        echo $this->env->getExtension('routing')->getUrl("reset_password");
        echo "\" id=\"reset_password_button\">Forgot your password?</a>
    </div>






";
    }

    public function getTemplateName()
    {
        return "AcmeDemoBundle:Form:login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  79 => 41,  70 => 34,  64 => 33,  38 => 10,  30 => 5,  27 => 4,  21 => 2,  19 => 1,);
    }
}
