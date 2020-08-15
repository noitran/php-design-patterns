<?php

declare(strict_types=1);

namespace Noitran\Patterns\Creational\Builder\Tests;

use Noitran\Patterns\Creational\Builder\Director;
use Noitran\Patterns\Creational\Builder\MySqlBuilder;
use Noitran\Patterns\Creational\Builder\PostgresBuilder;
use PHPUnit\Framework\TestCase;

class BuilderTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_successfully_output_mysql_query(): void
    {
        $queryBuilder = new MySqlBuilder();
        $sql = (new Director($queryBuilder))->build();

        self::assertInstanceOf(MySqlBuilder::class, $queryBuilder);
        self::assertEquals(
            'select email, name, surname from users where name = John and surname = Doe limit 5 , 0',
            $sql
        );
    }

    /**
     * @test
     */
    public function it_should_successfully_output_postgres_query(): void
    {
        $queryBuilder = new PostgresBuilder();
        $sql = (new Director($queryBuilder))->build();

        self::assertInstanceOf(PostgresBuilder::class, $queryBuilder);
        self::assertEquals(
            'select email, name, surname from users where name = John and surname = Doe limit 5 start 0',
            $sql
        );
    }
}
