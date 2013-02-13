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
            'render_messages' => new \Twig_Function_Method($this, 'renderMessages', array('is_safe' => array('html'))),
            'render_message' => new \Twig_Function_Method($this, 'renderMessage', array('is_safe' => array('html')))
        );
    }

    public function renderMessages()
    {
        $messages = $this->container->get("lrotherfield.message")->all();

        return $this->container
            ->get('templating')
            ->render("LRotherfieldNotificationBundle:Message:multiple.html.twig", compact("messages"));
    }

    public function renderMessage($name)
    {
        if (!$this->container->get("lrotherfield.message")->has($name)) {
            return false;
        }
        $messages = $this->container->get("lrotherfield.message")->get($name);

        return $this->container
            ->get('templating')
            ->render("LRotherfieldNotificationBundle:Message:single.html.twig", compact("messages"));
    }


    public function getName()
    {
        return 'lrotherfield_notification_extension';
    }


}