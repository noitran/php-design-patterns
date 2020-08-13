<?php


declare(strict_types=1);

namespace Noitran\Patterns\Creational\Prototype\Tests;

use DateTime;
use Noitran\Patterns\Creational\Prototype\Invoice;
use Noitran\Patterns\Creational\Prototype\User;
use PHPUnit\Framework\TestCase;

class PrototypeTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldSuccessfullyCloneObject(): void
    {
        $invoice = new Invoice();

        $invoice->setCurrency('EUR');
        $invoice->setCreatedAt(new DateTime());
        $invoice->setUpdatedAt(new DateTime());
        $invoice->setItems([
            'key' => 'value',
        ]);
        $invoice->setUser(new User($invoice));

        $secondInvoice = clone $invoice;

        self::assertNotSame($secondInvoice, $invoice);

        // CreatedAt DateTime object was cloned
        self::assertNotSame($secondInvoice->createdAt(), $invoice->createdAt());
        // UpdatedAt DateTime object was cloned
        self::assertNotSame($secondInvoice->updatedAt(), $invoice->updatedAt());
        // User object was cloned
        self::assertNotSame($secondInvoice->user(), $invoice->user());
        // User object's invoice was also cloned
        self::assertNotSame($secondInvoice->user()->getInvoice(), $invoice->user()->getInvoice());

        // Primitives have been cloned
        self::assertSame($secondInvoice->currency(), $invoice->currency());
        self::assertSame($secondInvoice->items(), $invoice->items());
    }
}
