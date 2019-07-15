<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* themes/travel_theme/templates/layout/page.html.twig */
class __TwigTemplate_3b0d402a7d4a8121c667de8191622fae7eb9951e2f3ecdaf3755d406d5a2fd9d extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["if" => 75];
        $filters = ["escape" => 76, "date" => 412];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['if'],
                ['escape', 'date'],
                []
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->getSourceContext());

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 60
        echo "

<!-- Header and Navbar -->
<div class=\"container\">
  <header class=\"main-header\">
    <nav class=\"navbar topnav navbar-default\" role=\"navigation\">
    <div class=\"row\">
      <div class=\"navbar-header col-md-2\">
        <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\"#main-navigation\">
          <span></span>
          <!-- <span class=\"sr-only\">Toggle navigation</span>
          <span class=\"icon-bar\"></span>
          <span class=\"icon-bar\"></span>
          <span class=\"icon-bar\"></span> -->
        </button>
        ";
        // line 75
        if ($this->getAttribute(($context["page"] ?? null), "header", [])) {
            // line 76
            echo "          ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "header", [])), "html", null, true);
            echo "
        ";
        }
        // line 78
        echo "      </div>

      <!-- Navigation -->
      <div class=\"col-md-7 text-right\">
        ";
        // line 82
        if ($this->getAttribute(($context["page"] ?? null), "primary_menu", [])) {
            // line 83
            echo "          ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "primary_menu", [])), "html", null, true);
            echo "
        ";
        }
        // line 85
        echo "      </div>
      <!--End Navigation -->

      <!-- Navigation -->
      <div class=\"col-md-3\">
        ";
        // line 90
        if ($this->getAttribute(($context["page"] ?? null), "search", [])) {
            // line 91
            echo "          ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "search", [])), "html", null, true);
            echo "
        ";
        }
        // line 93
        echo "      </div>
      <!--End Navigation -->

    </div>
  </nav>

  <!-- Banner -->
  ";
        // line 100
        if ((($context["is_front"] ?? null) && $this->getAttribute(($context["page"] ?? null), "slideshow", []))) {
            echo "  
    <div class=\"slideshow\">
      ";
            // line 102
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "slideshow", [])), "html", null, true);
            echo "
    </div>
  ";
        }
        // line 105
        echo "  <!-- End Banner -->

  <!-- Secondary Menu -->
  ";
        // line 108
        if ((($context["is_front"] ?? null) && $this->getAttribute(($context["page"] ?? null), "secondary_menu", []))) {
            echo "  
    <div class=\"secondary-menu\">
      ";
            // line 110
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "secondary_menu", [])), "html", null, true);
            echo "
    </div>
  ";
        }
        // line 113
        echo "  <!-- End Secondary Menu -->  

  </header>
</div>

<!--End Header & Navbar -->


<!--Home page message-->
  ";
        // line 122
        if ((($context["is_front"] ?? null) && $this->getAttribute(($context["page"] ?? null), "homepagemessage", []))) {
            // line 123
            echo "    <div class=\"container\">
      <div class=\"row\">
        <div class=\"col-md-12\">
          ";
            // line 126
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "homepagemessage", [])), "html", null, true);
            echo "
        </div>
      </div>
    </div>
  ";
        }
        // line 131
        echo "<!--End Highlighted-->


<!--Highlighted-->
  ";
        // line 135
        if ($this->getAttribute(($context["page"] ?? null), "highlighted", [])) {
            // line 136
            echo "    <div class=\"container\">
      <div class=\"row\">
        <div class=\"col-md-12\">
          ";
            // line 139
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "highlighted", [])), "html", null, true);
            echo "
        </div>
      </div>
    </div>
  ";
        }
        // line 144
        echo "<!--End Highlighted-->


<!-- Start Top Widget -->
";
        // line 148
        if (($context["is_front"] ?? null)) {
            echo "  
  ";
            // line 149
            if ((($this->getAttribute(($context["page"] ?? null), "topwidget_first", []) || $this->getAttribute(($context["page"] ?? null), "topwidget_second", [])) || $this->getAttribute(($context["page"] ?? null), "topwidget_third", []))) {
                // line 150
                echo "    <div class=\"topwidget\">
      <div class=\"container\">
        <div class=\"row\">

        <!-- Top widget first region -->          
          ";
                // line 155
                if ($this->getAttribute(($context["page"] ?? null), "topwidget_first", [])) {
                    // line 156
                    echo "            <div class = ";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["topwidget_class"] ?? null)), "html", null, true);
                    echo ">
              ";
                    // line 157
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "topwidget_first", [])), "html", null, true);
                    echo "
            </div>
          ";
                }
                // line 159
                echo "          
          <!-- End top widget third region -->

          <!-- Top widget second region -->          
          ";
                // line 163
                if ($this->getAttribute(($context["page"] ?? null), "topwidget_second", [])) {
                    // line 164
                    echo "            <div class = ";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["topwidget_class"] ?? null)), "html", null, true);
                    echo ">
              ";
                    // line 165
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "topwidget_second", [])), "html", null, true);
                    echo "
            </div>
          ";
                }
                // line 167
                echo "          
          <!-- End top widget third region -->
          
          <!-- Top widget third region -->          
          ";
                // line 171
                if ($this->getAttribute(($context["page"] ?? null), "topwidget_third", [])) {
                    // line 172
                    echo "            <div class = ";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["topwidget_class"] ?? null)), "html", null, true);
                    echo ">
              ";
                    // line 173
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "topwidget_third", [])), "html", null, true);
                    echo "
            </div>
          ";
                }
                // line 175
                echo "          
          <!-- End top widget third region -->

          <!-- Top widget third region -->          
          ";
                // line 179
                if ($this->getAttribute(($context["page"] ?? null), "topwidget_forth", [])) {
                    // line 180
                    echo "            <div class = ";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["topwidget_class"] ?? null)), "html", null, true);
                    echo ">
              ";
                    // line 181
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "topwidget_forth", [])), "html", null, true);
                    echo "
            </div>
          ";
                }
                // line 183
                echo "          
          <!-- End top widget third region -->

        </div>
      </div>
    </div>
  ";
            }
        }
        // line 191
        echo "<!--End Top Widget -->


<!-- Page Title -->
";
        // line 195
        if (($this->getAttribute(($context["page"] ?? null), "page_title", []) &&  !($context["is_front"] ?? null))) {
            // line 196
            echo "  <div id=\"page-title\">
    <div id=\"page-title-inner\">
      <div class=\"container\">
        ";
            // line 199
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "page_title", [])), "html", null, true);
            echo "
      </div>
    </div>
  </div>
";
        }
        // line 204
        echo "<!-- End Page Title -->


<!-- layout -->
<div id=\"wrapper\">
  <!-- start: Container -->
  <div class=\"container\">
    
    <!--Content top-->
      ";
        // line 213
        if ($this->getAttribute(($context["page"] ?? null), "content_top", [])) {
            // line 214
            echo "        <div class=\"row\">
          ";
            // line 215
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "content_top", [])), "html", null, true);
            echo "
        </div>
      ";
        }
        // line 218
        echo "    <!--End Content top-->
    
    <!--start:content -->
    <div class=\"row\">
      <div class=\"col-md-12\">";
        // line 222
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "breadcrumb", [])), "html", null, true);
        echo "</div>
    </div>

    <div class=\"row layout\">
      <!--- Start Left SideBar -->
      ";
        // line 227
        if ($this->getAttribute(($context["page"] ?? null), "sidebar_first", [])) {
            // line 228
            echo "        <div class=\"sidebar\" >
          <div class = ";
            // line 229
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["sidebarfirst"] ?? null)), "html", null, true);
            echo " >
            ";
            // line 230
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "sidebar_first", [])), "html", null, true);
            echo "
          </div>
        </div>
      ";
        }
        // line 234
        echo "      <!---End Right SideBar -->

      <!--- Start content -->
      ";
        // line 237
        if ($this->getAttribute(($context["page"] ?? null), "content", [])) {
            // line 238
            echo "        <div class=\"content_layout\">
          <div class=";
            // line 239
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["contentlayout"] ?? null)), "html", null, true);
            echo ">
            ";
            // line 240
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "content", [])), "html", null, true);
            echo "
          </div>
        </div>
      ";
        }
        // line 244
        echo "      <!---End content -->

      <!--- Start Right SideBar -->
      ";
        // line 247
        if ($this->getAttribute(($context["page"] ?? null), "sidebar_second", [])) {
            // line 248
            echo "        <div class=\"sidebar\">
          <div class=";
            // line 249
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["sidebarsecond"] ?? null)), "html", null, true);
            echo ">
            ";
            // line 250
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "sidebar_second", [])), "html", null, true);
            echo "
          </div>
        </div>
      ";
        }
        // line 254
        echo "      <!---End Right SideBar -->
      
    </div>
    <!--End Content -->

    <!--Start Content Bottom-->
    ";
        // line 260
        if ($this->getAttribute(($context["page"] ?? null), "content_bottom", [])) {
            // line 261
            echo "      <div class=\"row\">
        ";
            // line 262
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "content_bottom", [])), "html", null, true);
            echo "
      </div>
    ";
        }
        // line 265
        echo "    <!--End Content Bottom-->

  </div>
</div>
<!-- End: layout -->



<!-- Start: Footer -->
";
        // line 274
        if ((($context["is_front"] ?? null) && (($this->getAttribute(($context["page"] ?? null), "footer_first", []) || $this->getAttribute(($context["page"] ?? null), "footer_second", [])) || $this->getAttribute(($context["page"] ?? null), "footer_third", [])))) {
            // line 275
            echo "  <div class=\"footerwidget\">
    <div class=\"container\">      
      <div class=\"row\">

        <!-- Start Footer First Region -->        
        ";
            // line 280
            if ($this->getAttribute(($context["page"] ?? null), "footer_first", [])) {
                // line 281
                echo "          <div class = ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["footer_first_class"] ?? null)), "html", null, true);
                echo ">
            ";
                // line 282
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "footer_first", [])), "html", null, true);
                echo "
          </div>
        ";
            }
            // line 284
            echo "        
        <!-- End Footer First Region -->

        <!-- Start Footer Second Region -->        
        ";
            // line 288
            if ($this->getAttribute(($context["page"] ?? null), "footer_second", [])) {
                // line 289
                echo "          <div class = ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["footer_class"] ?? null)), "html", null, true);
                echo ">
            ";
                // line 290
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "footer_second", [])), "html", null, true);
                echo "
          </div>
        ";
            }
            // line 292
            echo "        
        <!-- End Footer Second Region -->

        <!-- Start Footer third Region -->        
        ";
            // line 296
            if ($this->getAttribute(($context["page"] ?? null), "footer_third", [])) {
                // line 297
                echo "          <div class = ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["footer_class"] ?? null)), "html", null, true);
                echo ">
            ";
                // line 298
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "footer_third", [])), "html", null, true);
                echo "
          </div>
        ";
            }
            // line 300
            echo "        
        <!-- End Footer Third Region -->

      </div>
    </div>
  </div>
";
        }
        // line 307
        echo "<!--End Footer -->


<!-- Page Title -->
";
        // line 311
        if ((($context["is_front"] ?? null) && $this->getAttribute(($context["page"] ?? null), "features", []))) {
            // line 312
            echo "  <div class=\"container\">
    ";
            // line 313
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "features", [])), "html", null, true);
            echo "
  </div>
";
        }
        // line 316
        echo "<!-- End Page Title -->


<!-- Start bottom -->
";
        // line 320
        if (($context["is_front"] ?? null)) {
            echo "  
  ";
            // line 321
            if ((($this->getAttribute(($context["page"] ?? null), "bottom_first", []) || $this->getAttribute(($context["page"] ?? null), "bottom_second", [])) || $this->getAttribute(($context["page"] ?? null), "bottom_third", []))) {
                // line 322
                echo "    <div class=\"bottom-widgets\">
      <div class=\"container\">        
        <div class=\"row\">

          <!-- Start Bottom First Region -->          
          ";
                // line 327
                if ($this->getAttribute(($context["page"] ?? null), "bottom_first", [])) {
                    // line 328
                    echo "            <div class = ";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["bottom_class"] ?? null)), "html", null, true);
                    echo ">
              ";
                    // line 329
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "bottom_first", [])), "html", null, true);
                    echo "
            </div>
          ";
                }
                // line 331
                echo "          
          <!-- End Bottom First Region -->

          <!-- Start Bottom Second Region -->
          ";
                // line 335
                if ($this->getAttribute(($context["page"] ?? null), "bottom_second", [])) {
                    // line 336
                    echo "            <div class = ";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["bottom_class"] ?? null)), "html", null, true);
                    echo ">
              ";
                    // line 337
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "bottom_second", [])), "html", null, true);
                    echo "
            </div>
          ";
                }
                // line 339
                echo "          
          <!-- End Bottom Second Region -->

          <!-- Start Bottom third Region -->          
          ";
                // line 343
                if ($this->getAttribute(($context["page"] ?? null), "bottom_third", [])) {
                    // line 344
                    echo "            <div class = ";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["bottom_class"] ?? null)), "html", null, true);
                    echo ">
              ";
                    // line 345
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "bottom_third", [])), "html", null, true);
                    echo "
            </div>
          ";
                }
                // line 347
                echo "          
          <!-- End Bottom Third Region -->

          <!-- Start Bottom Forth Region -->
          ";
                // line 351
                if ($this->getAttribute(($context["page"] ?? null), "bottom_forth", [])) {
                    // line 352
                    echo "          <div class = ";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["bottom_class"] ?? null)), "html", null, true);
                    echo ">
            ";
                    // line 353
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "bottom_forth", [])), "html", null, true);
                    echo "
          </div>
          ";
                }
                // line 356
                echo "          <!-- End Bottom Forth Region -->

        </div>
      </div>
    </div>
  ";
            }
        }
        // line 363
        echo "<!--End Bottom -->


<!-- Start Footer Menu -->
";
        // line 367
        if ($this->getAttribute(($context["page"] ?? null), "footer_menu", [])) {
            // line 368
            echo "  <div class=\"footer-menu\">
    <div class=\"container\">
      <div class=\"row\">
        <div class=\"col-sm-6\">
          ";
            // line 372
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "footer_menu", [])), "html", null, true);
            echo "
        </div>
        ";
            // line 374
            if (($context["show_social_icon"] ?? null)) {
                // line 375
                echo "        <div class=\"col-sm-6\">
          <div class=\"social-media-wrap\">
            <div class=\"social-media\">
              ";
                // line 378
                if (($context["facebook_url"] ?? null)) {
                    // line 379
                    echo "                <a href=\"";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["facebook_url"] ?? null)), "html", null, true);
                    echo "\"  class=\"facebook\" target=\"_blank\" ><i class=\"fa fa-facebook\"></i></a>
              ";
                }
                // line 381
                echo "              ";
                if (($context["google_plus_url"] ?? null)) {
                    // line 382
                    echo "                <a href=\"";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["google_plus_url"] ?? null)), "html", null, true);
                    echo "\"  class=\"google-plus\" target=\"_blank\" ><i class=\"fa fa-google-plus\"></i></a>
              ";
                }
                // line 384
                echo "              ";
                if (($context["twitter_url"] ?? null)) {
                    // line 385
                    echo "                <a href=\"";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["twitter_url"] ?? null)), "html", null, true);
                    echo "\" class=\"twitter\" target=\"_blank\" ><i class=\"fa fa-twitter\"></i></a>
              ";
                }
                // line 387
                echo "              ";
                if (($context["linkedin_url"] ?? null)) {
                    // line 388
                    echo "                <a href=\"";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["linkedin_url"] ?? null)), "html", null, true);
                    echo "\" class=\"linkedin\" target=\"_blank\"><i class=\"fa fa-linkedin\"></i></a>
              ";
                }
                // line 390
                echo "              ";
                if (($context["pinterest_url"] ?? null)) {
                    // line 391
                    echo "                <a href=\"";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["pinterest_url"] ?? null)), "html", null, true);
                    echo "\" class=\"pinterest\" target=\"_blank\" ><i class=\"fa fa-pinterest\"></i></a>
              ";
                }
                // line 393
                echo "              ";
                if (($context["rss_url"] ?? null)) {
                    // line 394
                    echo "                <a href=\"";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["rss_url"] ?? null)), "html", null, true);
                    echo "\" class=\"rss\" target=\"_blank\" ><i class=\"fa fa-rss\"></i></a>
              ";
                }
                // line 396
                echo "            </div>
          </div>          
        </div>
        ";
            }
            // line 400
            echo "      </div>
    </div>
  </div>
";
        }
        // line 404
        echo "<!-- End Footer Menu -->


<div class=\"copyright\">
  <div class=\"container\">
    <div class=\"row\">

      <!-- Copyright -->
      <div class=\"col-sm-6\"><p>Copyright © ";
        // line 412
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, twig_date_format_filter($this->env, "now", "Y"), "html", null, true);
        echo ". All rights reserved</p></div>
      <!-- End Copyright -->

      <!-- Credit link -->
      ";
        // line 416
        if (($context["show_credit_link"] ?? null)) {
            // line 417
            echo "        <div class=\"col-sm-6\">
          <p class=\"credit-link\">Designed By <a href=\"http://www.zymphonies.com\" target=\"_blank\">Zymphonies</a></p>
        </div>
      ";
        }
        // line 421
        echo "      <!-- End Credit link -->
      
    </div>
  </div>
</div>


<!-- Google map -->
";
        // line 429
        if ((($context["is_front"] ?? null) && $this->getAttribute(($context["page"] ?? null), "google_map", []))) {
            // line 430
            echo "  <div class=\"google_map\">";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "google_map", [])), "html", null, true);
            echo "</div>
";
        }
        // line 432
        echo "<!-- End Google map -->";
    }

    public function getTemplateName()
    {
        return "themes/travel_theme/templates/layout/page.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  754 => 432,  748 => 430,  746 => 429,  736 => 421,  730 => 417,  728 => 416,  721 => 412,  711 => 404,  705 => 400,  699 => 396,  693 => 394,  690 => 393,  684 => 391,  681 => 390,  675 => 388,  672 => 387,  666 => 385,  663 => 384,  657 => 382,  654 => 381,  648 => 379,  646 => 378,  641 => 375,  639 => 374,  634 => 372,  628 => 368,  626 => 367,  620 => 363,  611 => 356,  605 => 353,  600 => 352,  598 => 351,  592 => 347,  586 => 345,  581 => 344,  579 => 343,  573 => 339,  567 => 337,  562 => 336,  560 => 335,  554 => 331,  548 => 329,  543 => 328,  541 => 327,  534 => 322,  532 => 321,  528 => 320,  522 => 316,  516 => 313,  513 => 312,  511 => 311,  505 => 307,  496 => 300,  490 => 298,  485 => 297,  483 => 296,  477 => 292,  471 => 290,  466 => 289,  464 => 288,  458 => 284,  452 => 282,  447 => 281,  445 => 280,  438 => 275,  436 => 274,  425 => 265,  419 => 262,  416 => 261,  414 => 260,  406 => 254,  399 => 250,  395 => 249,  392 => 248,  390 => 247,  385 => 244,  378 => 240,  374 => 239,  371 => 238,  369 => 237,  364 => 234,  357 => 230,  353 => 229,  350 => 228,  348 => 227,  340 => 222,  334 => 218,  328 => 215,  325 => 214,  323 => 213,  312 => 204,  304 => 199,  299 => 196,  297 => 195,  291 => 191,  281 => 183,  275 => 181,  270 => 180,  268 => 179,  262 => 175,  256 => 173,  251 => 172,  249 => 171,  243 => 167,  237 => 165,  232 => 164,  230 => 163,  224 => 159,  218 => 157,  213 => 156,  211 => 155,  204 => 150,  202 => 149,  198 => 148,  192 => 144,  184 => 139,  179 => 136,  177 => 135,  171 => 131,  163 => 126,  158 => 123,  156 => 122,  145 => 113,  139 => 110,  134 => 108,  129 => 105,  123 => 102,  118 => 100,  109 => 93,  103 => 91,  101 => 90,  94 => 85,  88 => 83,  86 => 82,  80 => 78,  74 => 76,  72 => 75,  55 => 60,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/travel_theme/templates/layout/page.html.twig", "/var/www/html/themes/travel_theme/templates/layout/page.html.twig");
    }
}
