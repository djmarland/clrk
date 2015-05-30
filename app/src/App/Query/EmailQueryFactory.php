<?php

namespace App\Query;

use App\Query\Email\MailQuery;
use PHPMailer;

/**
 * Default factory setup
 * Class DatabaseQueryFactory
 * @package App\Infrastructure
 */
class EmailQueryFactory
{

    protected $baseMailer;

    /**
     * @param $host
     * @param $username
     * @param $password
     * @param $from
     */
    public function __construct(
        $host,
        $username,
        $password,
        $from
    ) {

        $this->baseMailer = new PHPMailer();

        $this->baseMailer->isSMTP();
        $this->baseMailer->SMTPSecure = 'tls';
        $this->baseMailer->Port = 587;
        $this->baseMailer->SMTPAuth = true;

        $this->baseMailer->Host = $host;
        $this->baseMailer->Username = $username;
        $this->baseMailer->Password = $password;
        $this->baseMailer->From = $from;
    }

    /**
     * @return MailQuery
     */
    public function createMail()
    {
        return new MailQuery(clone $this->baseMailer);
    }
}
