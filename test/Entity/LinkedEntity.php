<?php

namespace Kayladnls\DoctrineAdditions\Test\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @Entity
 * @Table
 */
class LinkedEntity
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    public $id;

    /**
     * @Column(type="url")
     */
    public $link;
}