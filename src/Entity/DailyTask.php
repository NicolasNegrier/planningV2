<?php

namespace App\Entity;

use App\Repository\DailyTaskRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DailyTaskRepository::class)]
class DailyTask
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'dailyTasks')]
    private ?Day $day = null;

    #[ORM\ManyToOne(inversedBy: 'dailyTasks')]
    private ?Task $task = null;

    #[ORM\ManyToMany(targetEntity: Slot::class, inversedBy: 'dailyTasks')]
    private Collection $slots;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'dailyTasks')]
    private Collection $users;

    public function __construct()
    {
        $this->slots = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDay(): ?Day
    {
        return $this->day;
    }

    public function setDay(?Day $day): self
    {
        $this->day = $day;

        return $this;
    }

    public function getTask(): ?Task
    {
        return $this->task;
    }

    public function setTask(?Task $task): self
    {
        $this->task = $task;

        return $this;
    }

    /**
     * @return Collection<int, Slot>
     */
    public function getSlots(): Collection
    {
        return $this->slots;
    }

    public function addSlot(Slot $slot): self
    {
        if (!$this->slots->contains($slot)) {
            $this->slots->add($slot);
        }

        return $this;
    }

    public function removeSlot(Slot $slot): self
    {
        $this->slots->removeElement($slot);

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        $this->users->removeElement($user);

        return $this;
    }
}
