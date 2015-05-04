<?php
namespace UnitTest\App\Domain\Entity;

use App\Domain\Entity\Entity as AbstractEntity;

class MockEntity extends AbstractEntity
{
    const KEY_PREFIX = 'X';
}
