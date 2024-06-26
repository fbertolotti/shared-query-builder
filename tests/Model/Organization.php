<?php

declare(strict_types=1);

namespace Andante\Doctrine\ORM\Tests\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Organization
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(Types::INTEGER)]
    private ?int $id = null;

    #[ORM\ManyToOne(Address::class)]
    private ?Address $address = null;

    /** @var Collection<int, Person> */
    #[ORM\ManyToMany(Person::class)]
    private Collection $persons;

    #[ORM\Column(Types::STRING, nullable: true)]
    private ?string $name = null;

    public function __construct()
    {
        $this->persons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(?Address $address): self
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return Collection<int, Person>
     */
    public function getPersons(): Collection
    {
        return $this->persons;
    }

    public function addPerson(Person $person): self
    {
        $this->persons->add($person);
        return $this;
    }

    public function removePerson(Person $person): self
    {
        $this->persons->removeElement($person);
        return $this;
    }
}
