<?php

use Yosymfony\Spress\Core\Plugin\PluginInterface;
use Yosymfony\Spress\Core\Plugin\EventSubscriber;
use Yosymfony\Spress\Core\Plugin\Event\EnvironmentEvent;
use Michelf\MarkdownExtra;

class FlowControlSpressTwigMarkdown implements PluginInterface
{
    private $io;

    public function initialize(EventSubscriber $subscriber)
    {
        $subscriber->addEventListener('spress.start', 'onStart');
    }

    public function getMetas()
    {
        return [
            'name' => 'flow-control/spress-twig-markdown',
            'description' => 'Spress plugin to add `markdown` filter function to Twig templates',
            'author' => 'Florian Engelhardt',
            'license' => 'GPL-v3',
        ];
    }

    public function onStart(EnvironmentEvent $event)
    {
        $renderizer = $event->getRenderizer();
        $renderizer->addTwigFilter('markdown', function ($string) {
            return MarkdownExtra::defaultTransform($string);
        });
    }

}
