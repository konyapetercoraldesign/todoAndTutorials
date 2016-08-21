<?php

/* :layouts:todo.html.twig */
class __TwigTemplate_2322bd35d183b029b13e283d1de0fdc806d7ff3e38af62f5b3d6a5ab873f7e2a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("base.html.twig", ":layouts:todo.html.twig", 1);
        $this->blocks = array(
            'body' => array($this, 'block_body'),
            'stylesheets' => array($this, 'block_stylesheets'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        // line 4
        echo "    <div id=\"wrapper\">
        <div id=\"container\">

            <div id=\"welcome\">
                <h1><span>Todo List</span></h1>
            </div>

            <div id=\"status\">

                <span>New Todo</span>

                <form action=\"/todo";
        // line 15
        if (array_key_exists("todo_id", $context)) {
            echo "/";
            echo twig_escape_filter($this->env, (isset($context["todo_id"]) ? $context["todo_id"] : null), "html", null, true);
        }
        echo "\" method=\"post\">
                    ";
        // line 16
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'widget');
        echo "
                    <input type=\"submit\" />
                </form>

                <ul>
                    ";
        // line 21
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["allTodo"]) ? $context["allTodo"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["todo"]) {
            // line 22
            echo "                    <li>
                        <span>
                            ";
            // line 24
            echo twig_escape_filter($this->env, $this->getAttribute($context["todo"], "title", array()), "html", null, true);
            echo " (
                            <a href=\"";
            // line 25
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("todo", array("todo_id" => $this->getAttribute($context["todo"], "id", array()))), "html", null, true);
            echo "\">Edit</a> |
                            <a href=\"";
            // line 26
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("deleteTodo", array("todo_id" => $this->getAttribute($context["todo"], "id", array()))), "html", null, true);
            echo "\">Delete</a>
                            )<br/>
                            ";
            // line 28
            echo twig_escape_filter($this->env, $this->getAttribute($context["todo"], "description", array()), "html", null, true);
            echo "
                        </span>
                    </li>
                    <hr>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['todo'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 33
        echo "                </ul>
            </div>

            <div id=\"next\">
                <a href=\"/\">Back to Home</a>
            </div>

        </div>
    </div>
";
    }

    // line 44
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 45
        echo "<style>
    body { background: #F5F5F5; font: 18px/1.5 sans-serif; }
    h1, h2 { line-height: 1.2; margin: 0 0 .5em; }
    h1 { font-size: 36px; }
    h2 { font-size: 21px; margin-bottom: 1em; }
    p { margin: 0 0 1em 0; }
    a { color: #0000F0; }
    a:hover { text-decoration: none; }
    code { background: #F5F5F5; max-width: 100px; padding: 2px 6px; word-wrap: break-word; }
    #wrapper { background: #FFF; margin: 1em auto; max-width: 800px; width: 95%; }
    #container { padding: 2em; }
    #welcome, #status { margin-bottom: 2em; }
    #welcome h1 span { display: block; font-size: 75%; }
    #icon-status, #icon-book { float: left; height: 64px; margin-right: 1em; margin-top: -4px; width: 64px; }
    #icon-book { display: none; }

    .todoContent { float: left; }
    .buttonTodo { float: left; }

    @media (min-width: 768px) {
        #wrapper { width: 80%; margin: 2em auto; }
        #icon-book { display: inline-block; }
        /*#status a, #next a { display: block; }*/

        @-webkit-keyframes fade-in { 0% { opacity: 0; } 100% { opacity: 1; } }
        @keyframes fade-in { 0% { opacity: 0; } 100% { opacity: 1; } }
        .sf-toolbar { opacity: 0; -webkit-animation: fade-in 1s .2s forwards; animation: fade-in 1s .2s forwards;}
    }
</style>
";
    }

    public function getTemplateName()
    {
        return ":layouts:todo.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  108 => 45,  105 => 44,  92 => 33,  81 => 28,  76 => 26,  72 => 25,  68 => 24,  64 => 22,  60 => 21,  52 => 16,  45 => 15,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends 'base.html.twig' %}*/
/* */
/* {% block body %}*/
/*     <div id="wrapper">*/
/*         <div id="container">*/
/* */
/*             <div id="welcome">*/
/*                 <h1><span>Todo List</span></h1>*/
/*             </div>*/
/* */
/*             <div id="status">*/
/* */
/*                 <span>New Todo</span>*/
/* */
/*                 <form action="/todo{% if todo_id is defined  %}/{{ todo_id }}{% endif %}" method="post">*/
/*                     {{ form_widget(form) }}*/
/*                     <input type="submit" />*/
/*                 </form>*/
/* */
/*                 <ul>*/
/*                     {% for todo in allTodo %}*/
/*                     <li>*/
/*                         <span>*/
/*                             {{ todo.title }} (*/
/*                             <a href="{{ path('todo',{'todo_id': todo.id}) }}">Edit</a> |*/
/*                             <a href="{{ path('deleteTodo',{'todo_id': todo.id}) }}">Delete</a>*/
/*                             )<br/>*/
/*                             {{ todo.description }}*/
/*                         </span>*/
/*                     </li>*/
/*                     <hr>*/
/*                     {% endfor %}*/
/*                 </ul>*/
/*             </div>*/
/* */
/*             <div id="next">*/
/*                 <a href="/">Back to Home</a>*/
/*             </div>*/
/* */
/*         </div>*/
/*     </div>*/
/* {% endblock %}*/
/* */
/* {% block stylesheets %}*/
/* <style>*/
/*     body { background: #F5F5F5; font: 18px/1.5 sans-serif; }*/
/*     h1, h2 { line-height: 1.2; margin: 0 0 .5em; }*/
/*     h1 { font-size: 36px; }*/
/*     h2 { font-size: 21px; margin-bottom: 1em; }*/
/*     p { margin: 0 0 1em 0; }*/
/*     a { color: #0000F0; }*/
/*     a:hover { text-decoration: none; }*/
/*     code { background: #F5F5F5; max-width: 100px; padding: 2px 6px; word-wrap: break-word; }*/
/*     #wrapper { background: #FFF; margin: 1em auto; max-width: 800px; width: 95%; }*/
/*     #container { padding: 2em; }*/
/*     #welcome, #status { margin-bottom: 2em; }*/
/*     #welcome h1 span { display: block; font-size: 75%; }*/
/*     #icon-status, #icon-book { float: left; height: 64px; margin-right: 1em; margin-top: -4px; width: 64px; }*/
/*     #icon-book { display: none; }*/
/* */
/*     .todoContent { float: left; }*/
/*     .buttonTodo { float: left; }*/
/* */
/*     @media (min-width: 768px) {*/
/*         #wrapper { width: 80%; margin: 2em auto; }*/
/*         #icon-book { display: inline-block; }*/
/*         /*#status a, #next a { display: block; }*//* */
/* */
/*         @-webkit-keyframes fade-in { 0% { opacity: 0; } 100% { opacity: 1; } }*/
/*         @keyframes fade-in { 0% { opacity: 0; } 100% { opacity: 1; } }*/
/*         .sf-toolbar { opacity: 0; -webkit-animation: fade-in 1s .2s forwards; animation: fade-in 1s .2s forwards;}*/
/*     }*/
/* </style>*/
/* {% endblock %}*/
/* */
