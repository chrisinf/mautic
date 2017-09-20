<?php
namespace Mautic\CustomBundle\EventListener;

use Doctrine\ORM\EntityManager;
use Mautic\CustomBundle\Model\EmailLogModel;
use Psr\Log\LoggerInterface;
use Swift_Events_SendEvent;
use Swift_Events_SendListener;

class GlobalEmailListener implements Swift_Events_SendListener
{
    protected $logger;

    protected $em;

    public function __construct(LoggerInterface $logger, EntityManager $em)
    {
        $this->logger = $logger;
        $this->em = $em;
    }

    /**
     * Invoked immediately before the Message is sent.
     *
     * @param Swift_Events_SendEvent $evt
     */
    public function beforeSendPerformed(Swift_Events_SendEvent $evt)
    {
        $this->logger->info('beforeSendPerformed triggered', [ 'event' => $evt ]);
        // check for limits
    }

    /**
     * Invoked immediately after the Message is sent.
     *
     * @param Swift_Events_SendEvent $evt
     */
    public function sendPerformed(Swift_Events_SendEvent $evt)
    {
        $this->logger->info('sendPerformed triggered', [ 'event' => $evt ]);

        $msg = $evt->getMessage();

        $log = new EmailLogModel();
        $log->writeLog(['sender' => $msg->getFrom(), 'recipient' => implode(',', $msg->getTo())]);
    }
}