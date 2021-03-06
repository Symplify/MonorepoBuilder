<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace MonorepoBuilder20210715\Symfony\Component\HttpKernel\EventListener;

use MonorepoBuilder20210715\Symfony\Component\EventDispatcher\EventSubscriberInterface;
use MonorepoBuilder20210715\Symfony\Component\HttpKernel\Event\RequestEvent;
use MonorepoBuilder20210715\Symfony\Component\HttpKernel\KernelEvents;
/**
 * Validates Requests.
 *
 * @author Magnus Nordlander <magnus@fervo.se>
 *
 * @final
 */
class ValidateRequestListener implements \MonorepoBuilder20210715\Symfony\Component\EventDispatcher\EventSubscriberInterface
{
    /**
     * Performs the validation.
     * @param \Symfony\Component\HttpKernel\Event\RequestEvent $event
     */
    public function onKernelRequest($event)
    {
        if (!$event->isMainRequest()) {
            return;
        }
        $request = $event->getRequest();
        if ($request::getTrustedProxies()) {
            $request->getClientIps();
        }
        $request->getHost();
    }
    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents() : array
    {
        return [\MonorepoBuilder20210715\Symfony\Component\HttpKernel\KernelEvents::REQUEST => [['onKernelRequest', 256]]];
    }
}
