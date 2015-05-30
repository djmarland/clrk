<?php

namespace App\Query\Email;

use PHPMailer;

/**
 * Default Email setup
 * Class Query
 * @package App\Query\Email
 */
class MailQuery
{

    private $mailer;

    public function __construct(
        PHPMailer $mailer
    ) {
        $this->mailer = $mailer;
    }

    /**
     * @param $to
     * @param $fromName
     * @param $subject
     * @param $body
     * @return bool
     */
    public function send(
        $to,
        $fromName,
        $subject,
        $body
    ) {

        $this->mailer->FromName = $fromName;
        $this->mailer->addAddress($to);
        $this->mailer->isHTML(true);

        $this->mailer->Subject = $subject;
        $this->mailer->Body    = $body;

        if(!$this->mailer->send()) {
            // @todo - log the error better
            error_log('Mailer Error: ' . $this->mailer->ErrorInfo);
            return false;
        }
        return true;
    }
}
