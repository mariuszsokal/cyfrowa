<?php
declare(strict_types=1);

namespace App\DomainModel\User;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
final class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=16)
     */
    private $userName;

    /**
     * @ORM\Column(type="string", length=16)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $companyName;

    /**
     * @ORM\Column(type="string", length=16)
     */
    private $vatId;
}