<?php

namespace Mautic\CustomBundle\Model;

use Mautic\CoreBundle\Model\AbstractCommonModel;
use Mautic\CustomBundle\Entity\EmailLog;

class EmailLogModel extends AbstractCommonModel
{
    /**
     * {@inheritdoc}
     *
     * @return \Mautic\CustomBundle\Entity\EmailLogRepository
     */
    public function getRepository()
    {
        return $this->em->getRepository('EmailLog');
    }

    /**
     * Writes an entry to the email log.
     *
     * @param array $args [sender, recepient]
     */
    public function writeLog($args)
    {
        $sender = (isset($args['sender'])) ? $args['sender'] : '';
        $recipient = (isset($args['recipient'])) ? $args['recipient'] : '';

        $log = new EmailLog();
        $log->setSender($sender);
        $log->setRecipient($recipient);
        //$log->setSentAt(new \DateTime());

        $this->getRepository()->saveEntity($log);
    }
}