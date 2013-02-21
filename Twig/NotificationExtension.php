<?php

namespace LRotherfield\Bundle\NotificationBundle\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface;

class NotificationExtension extends \Twig_Extension
{
    protected $container,
        $js = true,
        $css = true;

    public function __construct(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function getFunctions()
    {
        return array(
            'notify_all' => new \Twig_Function_Method($this, 'renderAll', array('is_safe' => array('html'))),
            'notify_one' => new \Twig_Function_Method($this, 'renderOne', array('is_safe' => array('html'))),
            'notify_resources' => new \Twig_Function_Method($this, 'renderResources', array('is_safe' => array('html')))
        );
    }

    public function renderAll($container = false)
    {
        $notifications_array = $this->container->get("lrotherfield.notify")->all();

        if (count($notifications_array) > 0) {
            return $this->container
                ->get('templating')
                ->render(
                    "LRotherfieldNotificationBundle:Notification:multiple.html.twig",
                    compact("notifications_array", "container")
                );
        }

        return null;
    }

    public function renderOne($name, $container = false)
    {
        if (!$this->container->get("lrotherfield.notify")->has($name)) {
            return false;
        }
        $notifications = $this->container->get("lrotherfield.notify")->get($name);

        if (count($notifications) > 0) {
            return $this->container
                ->get('templating')
                ->render(
                    "LRotherfieldNotificationBundle:Notification:single.html.twig",
                    compact("notifications", "container")
                );
        }

        return null;
    }

    public function renderResources()
    {
        return $this->container
            ->get('templating')
            ->render("LRotherfieldNotificationBundle:Notification:resources.html.twig");
    }

    public function getName()
    {
        return 'lrotherfield_notification_extension';
    }

}