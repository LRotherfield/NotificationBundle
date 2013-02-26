<?php 

namespace LRotherfield\Bundle\NotificationBundle\Notification;

class Notifications
{
    private $session, $flashes = array(), $defaults = array();
    
    public function __construct(\Symfony\Component\HttpFoundation\Session\Session $session, array $defaults)
    {
        $this->session = $session;
        $this->defaults = $defaults;
    }
    
    public function add($name, array $arguments = array())
    {
        $arguments += $this->defaults;
        if($arguments["type"] === "flash"){
            $this->session->getFlashBag()->add($name, $arguments);
        } elseif($arguments["type"] == "instant") {
            if(!isset($this->flashes[$name])){
                $this->flashes[$name] = array();
            }
            $this->flashes[$name][] = $arguments;
        }
    }

    public function has($name)
    {
        if($this->session->getFlashBag()->has($name)){
            return true;
        } else {
            return isset($this->flashes[$name]);
        }
    }

    public function get($name)
    {
        if($this->session->getFlashBag()->has($name) && isset($this->flashes[$name])){
            return array_merge_recursive($this->session->getFlashBag()->get($name), $this->flashes[$name]);
        } elseif($this->session->getFlashBag()->has($name)) {
            return $this->session->getFlashBag()->get($name);
        } else {
            return $this->flashes[$name];
        }
    }

    public function all()
    {
        return array_merge_recursive($this->session->getFlashBag()->all(), $this->flashes);
    }
}
