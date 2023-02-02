<?php

namespace App\Entity;

use App\Repository\DayRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DayRepository::class)]
class Day
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'days')]
    private Collection $users;

    #[ORM\ManyToMany(targetEntity: Slot::class, inversedBy: 'days')]
    private Collection $slots;

    #[ORM\ManyToMany(targetEntity: Task::class, inversedBy: 'days')]
    private Collection $tasks;

    #[ORM\OneToMany(mappedBy: 'day', targetEntity: DailyTask::class)]
    private Collection $dailyTasks;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->slots = new ArrayCollection();
        $this->tasks = new ArrayCollection();
        $this->dailyTasks = new ArrayCollection();
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

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
        }

        return $this;
    }

    public function removeTask(Task $task): self
    {
        $this->tasks->removeElement($task);

        return $this;
    }

    /**
     * @return Collection<int, DailyTask>
     */
    public function getDailyTasks(): Collection
    {
        return $this->dailyTasks;
    }

    public function addDailyTask(DailyTask $dailyTask): self
    {
        if (!$this->dailyTasks->contains($dailyTask)) {
            $this->dailyTasks->add($dailyTask);
            $dailyTask->setDay($this);
        }

        return $this;
    }

    public function removeDailyTask(DailyTask $dailyTask): self
    {
        if ($this->dailyTasks->removeElement($dailyTask)) {
            // set the owning side to null (unless already changed)
            if ($dailyTask->getDay() === $this) {
                $dailyTask->setDay(null);
            }
        }

        return $this;
    }
}
