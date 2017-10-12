<?php
namespace Mautic\CustomBundle\EventListener;

use Doctrine\ORM\EntityManager;
use Mautic\CoreBundle\Helper\CoreParametersHelper;
use Mautic\CustomBundle\Model\EmailLogModel;
use Psr\Log\LoggerInterface;
use Swift_Events_SendEvent;
use Swift_Events_SendListener;
use Swift_Events_TransportChangeEvent;
use Swift_Events_TransportChangeListener;

class GlobalEmailListener implements Swift_Events_SendListener, Swift_Events_TransportChangeListener
{
    /*
     * @var LoggerInterface
     */
    protected $logger;

    private $localDomain;

    public function __construct(LoggerInterface $logger, CoreParametersHelper $coreParametersHelper)
    {
        $this->logger = $logger;
        $this->localDomain = $coreParametersHelper->getParameter("mailer_helo_hostname");
    }

    /**
     * Invoked immediately before the Message is sent.
     *
     * @param Swift_Events_SendEvent $evt
     */
    public function beforeSendPerformed(Swift_Events_SendEvent $evt)
    {
    }

    /**
     * Invoked immediately after the Message is sent.
     *
     * @param Swift_Events_SendEvent $evt
     */
    public function sendPerformed(Swift_Events_SendEvent $evt)
    {
        /*
         * todo fix this
         * $this->em is null in the EmailLogModel, probably needs EmailLog to be known to ORM..
         * look at other bundle models for examples
         *
        $msg = $evt->getMessage();

        $log = new EmailLogModel();
        $log->writeLog(['sender' => $msg->getFrom(), 'recipient' => implode(',', $msg->getTo())]);
        */
    }

    /**
     * Invoked just before a Transport is started.
     *
     * @param Swift_Events_TransportChangeEvent $evt
     */
    public function beforeTransportStarted(Swift_Events_TransportChangeEvent $evt)
    {
        $transport = $evt->getTransport();

        if ($transport instanceof \Swift_Transport_EsmtpTransport  && !empty($this->localDomain)) {
            $transport->setLocalDomain($this->localDomain);
            $this->logger->info("set LocalDomain to custom value", [ 'localDomain' => $this->localDomain ]);
        }
    }

    /**
     * Invoked immediately after the Transport is started.
     *
     * @param Swift_Events_TransportChangeEvent $evt
     */
    public function transportStarted(Swift_Events_TransportChangeEvent $evt)
    {
    }

    /**
     * Invoked just before a Transport is stopped.
     *
     * @param Swift_Events_TransportChangeEvent $evt
     */
    public function beforeTransportStopped(Swift_Events_TransportChangeEvent $evt)
    {
    }

    /**
     * Invoked immediately after the Transport is stopped.
     *
     * @param Swift_Events_TransportChangeEvent $evt
     */
    public function transportStopped(Swift_Events_TransportChangeEvent $evt)
    {
    }
}