<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\RoadRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoadRepository::class)]
#[ApiResource]
class Road
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\Column(type: 'string', length: 1000, nullable: true)]
    private $description;

    #[ORM\OneToMany(mappedBy: 'road', targetEntity: Duration::class, orphanRemoval: true)]
    private $durations;

    public function __construct()
    {
        $this->durations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Duration>
     */
    public function getDurations(): Collection
    {
        return $this->durations;
    }

    public function addDuration(Duration $duration): self
    {
        if (!$this->durations->contains($duration)) {
            $this->durations[] = $duration;
            $duration->setRoad($this);
        }

        return $this;
    }

    public function removeDuration(Duration $duration): self
    {
        if ($this->durations->removeElement($duration)) {
            // set the owning side to null (unless already changed)
            if ($duration->getRoad() === $this) {
                $duration->setRoad(null);
            }
        }

        return $this;
    }

}
