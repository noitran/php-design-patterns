<?php

declare(strict_types=1);

namespace Noitran\Patterns\Creational\Prototype\Tests;

use DateTime;
use Noitran\Patterns\Creational\Prototype\Expense;
use Noitran\Patterns\Creational\Prototype\Income;
use Noitran\Patterns\Creational\Prototype\User;
use PHPUnit\Framework\TestCase;

class PrototypeTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_successfully_clone_object(): void
    {
        $income = new Income();
        $income->setCurrency('EUR');
        $income->setAmount(11.55);
        $income->setCreatedAt(new DateTime());
        $income->setUpdatedAt(new DateTime());
        $income->setUser(new User($income));

        $secondIncome = clone $income;
        self::assertNotSame($secondIncome, $income);

        // CreatedAt DateTime object was cloned
        self::assertNotSame($secondIncome->createdAt(), $income->createdAt());
        // UpdatedAt DateTime object was cloned
        self::assertNotSame($secondIncome->updatedAt(), $income->updatedAt());
        // User object was cloned
        self::assertNotSame($secondIncome->user(), $income->user());
        // User object's invoice was also cloned
        self::assertNotSame($secondIncome->user()->getIncome(), $income->user()->getIncome());

        // Primitives have been cloned
        self::assertSame($secondIncome->currency(), $income->currency());
        self::assertSame($secondIncome->amount(), $income->amount());

        $expense = new Expense();
        $expense->setCurrency('USD');
        $secondExpense = clone $expense;
        self::assertNotSame($secondExpense, $expense);
    }
}
