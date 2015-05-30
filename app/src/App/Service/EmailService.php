<?php

namespace App\Service;

/**
 * Default factory setup
 * Class ServiceFactory
 * @package App\Infrastructure
 */
class EmailService extends Service
{

    /**
     * @param $to
     * @param $fromName
     * @param $subject
     * @param $body
     * @return bool
     * @throws \App\Domain\Exception\DataNotSetException
     */
    public function send(
        $to,
        $fromName,
        $subject,
        $body
    ) {
        $mail = $this->getEmailQueryFactory()->createMail();
        return $mail->send(
            $to,
            $fromName,
            $subject,
            $body
        );
    }

}
