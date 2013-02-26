<?php

namespace LRotherfield\Bundle\NotificationBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('l_rotherfield_notification');

        $rootNode->children()
            ->scalarNode("message")->defaultValue("")->end()
            ->scalarNode("title")->defaultValue("")->end()
            ->scalarNode("class")->defaultValue("notice")->end()
            ->scalarNode("type")->defaultValue("flash")->end()
            ->scalarNode("lifetime")->defaultValue(6000)->end()
            ->booleanNode("click_to_close")->defaultFalse()->end()
            ->end();

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        return $treeBuilder;
    }
}
