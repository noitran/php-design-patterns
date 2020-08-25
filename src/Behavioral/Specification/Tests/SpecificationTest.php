<?php

declare(strict_types=1);

namespace Noitran\Patterns\Behavioral\Specification\Tests;

use Noitran\Patterns\Behavioral\Specification\Order;
use Noitran\Patterns\Behavioral\Specification\OrderIsDelivered;
use Noitran\Patterns\Behavioral\Specification\OrderIsPending;
use Noitran\Patterns\Behavioral\Specification\OrderRepository;
use PHPUnit\Framework\TestCase;

class SpecificationTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_init_specification(): void
    {
        $specification = new OrderIsDelivered();
        $order = new Order('delivered');

        self::assertTrue($specification->isSatisfiedBy($order));
    }

    /**
     * @test
     */
    public function it_should_fetch_orders_using_specification_and_repository(): void
    {
        $orders = new OrderRepository([
            new Order('delivered'),
            new Order('delivered'),
            new Order('delivered'),
            new Order('pending'),
            new Order('pending'),
        ]);

        $deliveredOrders = $orders->bySpecification(new OrderIsDelivered());
        $pendingOrders = $orders->bySpecification(new OrderIsPending());

        self::assertCount(3, $deliveredOrders);
        self::assertCount(2, $pendingOrders);
    }
}
