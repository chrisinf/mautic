<?php
namespace Mautic\CustomBundle\EventListener;

use Psr\Log\LoggerInterface;
use Swift_Events_SendEvent;
use Swift_Events_SendListener;

class GlobalEmailListener implements Swift_Events_SendListener
{
    protected $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Invoked immediately before the Message is sent.
     *
     * @param Swift_Events_SendEvent $evt
     */
    public function beforeSendPerformed(Swift_Events_SendEvent $evt)
    {
        $this->logger->info("beforeSendPerformed triggered", [ 'event' => $evt ]);
    }

    /**
     * Invoked immediately after the Message is sent.
     *
     * @param Swift_Events_SendEvent $evt
     */
    public function sendPerformed(Swift_Events_SendEvent $evt)
    {
        $this->logger->info("sendPerformed triggered", [ 'event' => $evt ]);
    }
}