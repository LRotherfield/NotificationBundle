<?php

namespace LRotherfield\Bundle\NotificationBundle\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface;

class NotificationExtension extends \Twig_Extension
{
    protected $container;

    public function __construct(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function getFunctions()
    {
        return array(
            'notify_all' => new \Twig_Function_Method($this, 'renderAll', array('is_safe' => array('html'))),
            'notify_one' => new \Twig_Function_Method($this, 'renderOne', array('is_safe' => array('html')))
        );
    }

    public function renderAll()
    {
        $notifications_array = $this->container->get("lrotherfield.notify")->all();

        return $this->container
            ->get('templating')
            ->render("LRotherfieldNotificationBundle:Notification:multiple.html.twig", compact("notifications_array"));
    }

    public function renderOne($name)
    {
        if (!$this->container->get("lrotherfield.notify")->has($name)) {
            return false;
        }
        $notifications = $this->container->get("lrotherfield.notify")->get($name);

        return $this->container
            ->get('templating')
            ->render("LRotherfieldNotificationBundle:Notification:single.html.twig", compact("notifications"));
    }


    public function getName()
    {
        return 'lrotherfield_notification_extension';
    }


}