<?php

namespace ACS\ACSPanelBundle\Event\Subscribers;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class KernelSubscriber implements EventSubscriberInterface
{
    static public function getSubscribedEvents()
    {
        return array(
            // must be registered before the default Locale listener
            KernelEvents::REQUEST => array(array('switchUserLanguage', 0)),
        );
    }

    /**
     * Sets user language from database configuration
     */
    public function switchUserLanguage(GetResponseEvent $event)
    {
        $request = $event->getRequest();

        global $kernel;

        if ('AppCache' == get_class($kernel)) {
            $kernel = $kernel->getKernel();
        }

        $settings_manager = $kernel->getContainer()->get('acs.setting_manager');
        $security = $kernel->getContainer()->get('security.context');

        $user = null;
        if($security->getToken()){
            $user = $security->getToken()->getUser();
        }

        if($user && 'anon.' != $user){
            $language = $settings_manager->getUserSetting('user_language',$user);

            if($language){
                $request->setLocale($language);
            }

        }

    }
}
