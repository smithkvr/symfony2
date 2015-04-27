<?php
namespace Acme\DemoBundle\Twig;
use Acme\DemoBundle\Utility\Util;
use Symfony\Component\Filesystem\Filesystem;

use \Twig_Extension;
use \Twig_Filter_Method;
use \Twig_Function_Method;
use \Twig_SimpleFunction;

use Symfony\Component\DependencyInjection\ContainerInterface;

class UtilExtension extends Twig_Extension
{
    protected $util;

    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }


}
