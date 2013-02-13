<?php 

namespace LRotherfield\Bundle\FlashMessageBundle\Service;

class Flash
{
    private $session, $flashes = array();
    
    public function __construct(\Symfony\Component\HttpFoundation\Session\Session $session)
    {
        $this->session = $session;
    }
    
    public function setFlash(array $arguments = array())
    {
        $arguments += array(
            "message" => "",
            "style" => "notice",
            "type" => "flash",
            "lifetime" => "5000",
            "sticky" => false
        );
        if($arguments["type"] === "flash"){
            $this->session->setFlash($arguments["style"], $arguments);
        }
        print_r($arguments);
    }
}
