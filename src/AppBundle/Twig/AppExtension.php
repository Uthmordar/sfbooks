<?php

namespace AppBundle\Twig;

class AppExtension extends \Twig_Extension implements \Symfony\Component\DependencyInjection\ContainerAwareInterface
{
    
    private $container;
    
    public function setContainer(\Symfony\Component\DependencyInjection\ContainerInterface $container=null){
        $this->container=$container;
    }
    
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('ellipsis', array($this, 'ellipsisFilter')),
        );
    }
    
    public function ellipsisFilter($content, $words){
        $array=explode(' ', $content);
        $text='';
        if(count($array)>$words){
            for($i=0; $i<$words; $i++){
                $text.=array_shift($array). ' ';
            }
            $text.= '[...]';
            return $text;
        }
        return $content;
    }

    public function getName()
    {
        return 'app_extension';
    }
}