<?php


namespace Mautic\CustomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Mautic\CoreBundle\Doctrine\Mapping\ClassMetadataBuilder;

class EmailLog
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var \DateTime
     */
    protected $sentAt;

    /**
     * @var string
     */
    protected $sender;

    /**
     * @var string
     */
    protected $recipient;

    /**
     * @param ORM\ClassMetadata $metadata
     */
    public static function loadMetadata(ORM\ClassMetadata $metadata)
    {
        $builder = new ClassMetadataBuilder($metadata);

        $builder->setTable('email_log')
            ->setCustomRepositoryClass('Mautic\CustomBundle\Entity\EmailLogRepository')
            ->addIndex(['sent_at'], 'sent_at');

        $builder->addId();

        $dateAdded = $builder->createField('sentAt', 'datetime')
            ->columnName('sent_at')
            ->columnDefinition('TIMESTAMP DEFAULT CURRENT_TIMESTAMP')
            ->nullable();

        $dateAdded->build();

        $builder->createField('sender', 'string')
            ->columnName('sender')
            ->build();

        $builder->createField('recipient', 'string')
            ->columnName('recipient')
            ->build();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getSentAt()
    {
        return $this->sentAt;
    }

    /**
     * @param \DateTime $sentAt
     */
    public function setSentAt($sentAt)
    {
        $this->sentAt = $sentAt;
    }

    /**
     * @return string
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @param string $sender
     */
    public function setSender($sender)
    {
        $this->sender = $sender;
    }

    /**
     * @return string
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * @param string $recipient
     */
    public function setRecipient($recipient)
    {
        $this->recipient = $recipient;
    }

}