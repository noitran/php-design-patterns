<?php

declare(strict_types=1);

namespace Noitran\Patterns\Creational\Prototype;

class Income extends ItemPrototype
{
    protected string $type = 'income';

    /**
     * Class that has circular reference (References back to Invoice class)
     * https://medium.com/@johann.pardanaud/about-circular-references-in-php-10f71f811e9
     * https://johann.pardanaud.com/blog/about-circular-references-in-php
     */
    protected User $user;

    public function __clone()
    {
        $this->createdAt = clone $this->createdAt;
        $this->updatedAt = clone $this->updatedAt;

        // Cloning an object that has a nested object with backreference requires special treatment.
        // After the cloning is completed, the nested object should point to the cloned object, instead of the
        // original object.
        $this->user = clone $this->user;
        // One of the Prototype drawbacks is that __constructor method isn't executed during cloning, so, it has
        // to be manually called.
        $this->user->setIncome($this);
    }

    public function user(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }
}
