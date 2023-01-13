<?php

namespace App\Entity;

use App\Repository\SlotRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SlotRepository::class)]
class Slot
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $value = null;

    #[ORM\ManyToMany(targetEntity: Day::class, mappedBy: 'slots')]
    private Collection $days;

    #[ORM\ManyToMany(targetEntity: Task::class, mappedBy: 'slots')]
    private Collection $tasks;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'slots')]
    private Collection $users;

    public function __construct()
    {
        $this->days = new ArrayCollection();
        $this->tasks = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue(int $value): self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return Collection<int, Day>
     */
    public function getDays(): Collection
    {
        return $this->days;
    }

    public function addDay(Day $day): self
    {
        if (!$this->days->contains($day)) {
            $this->days->add($day);
            $day->addSlot($this);
        }

        return $this;
    }

    public function removeDay(Day $day): self
    {
        if ($this->days->removeElement($day)) {
            $day->removeSlot($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Task>
     */
    public function getTasks(): Collection
    {
        return $this->tasks;
    }

    public function addTask(Task $task): self
    {
        if (!$this->tasks->contains($task)) {
            $this->tasks->add($task);
            $task->addSlot($this);
        }

        return $this;
    }

    public function removeTask(Task $task): self
    {
        if ($this->tasks->removeElement($task)) {
            $task->removeSlot($this);
        }

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
            $user->addSlot($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeSlot($this);
        }

        return $this;
    }
}
