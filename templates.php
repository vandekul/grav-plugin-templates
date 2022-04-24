<?php
namespace Grav\Plugin;

use Composer\Autoload\ClassLoader;
use Grav\Common\Plugin;
use RocketTheme\Toolbox\Event\Event;
use Grav\Common\Page\Pages;
use Grav\Common\User\Interfaces\UserInterface;
/**
 * Class TemplatesPlugin
 * @package Grav\Plugin
 */
class TemplatesPlugin extends Plugin
{
    /**
     * @return array
     *
     * The getSubscribedEvents() gives the core a list of events
     *     that the plugin wants to listen to. The key of each
     *     array section is the event that the plugin listens to
     *     and the value (in the form of an array) contains the
     *     callable (or function) as well as the priority. The
     *     higher the number the higher the priority.
     */
    public static function getSubscribedEvents(): array
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0]
        ];
    }

    /**
     * Composer autoload
     *
     * @return ClassLoader
     */
    /**public function autoload(): ClassLoader
    {
        return require __DIR__ . '/vendor/autoload.php';
    }

    /**
     * Initialize the plugin
     */
    public function onPluginsInitialized(): void
    {
        // Don't proceed if we are in the admin plugin
        if ($this->isAdmin()) {
            return;
        }

        // Enable the main events we are interested in
        $this->enable([
            // Put your main events here
            'onAdminPageTypes' => ['onAdminPageTypes', 0],
        ]);
    }


    public function onAdminPageTypes(Event $event)
    {
       /** @var User */
      
       $user = $this->grav['user'];

       if (!$user->get('username')) {
           return;
       }

       $allTypes = $event['types'];

       $templates = $user->get('templates', null);

       if (!$templates) {
           // Show user list of all available templates
           return;
        }


       $types = [];

       foreach (array_values($templates) as $template) {
           $types[$template] = $allTypes[$template];
       }

       $event['types'] = $types;
    }
}
