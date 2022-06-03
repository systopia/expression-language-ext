<?php

declare(strict_types=1);

namespace Systopia\ExpressionLanguage\Test;

use PHPUnit\Framework\TestCase;
use Systopia\ExpressionLanguage\SystopiaExpressionLanguage;

/**
 * @covers \Systopia\ExpressionLanguage\SystopiaExpressionLanguage
 */
final class SystopiaExpressionLanguageTest extends TestCase
{
    private SystopiaExpressionLanguage $expressionLanguage;

    protected function setUp(): void
    {
        parent::setUp();
        $this->expressionLanguage = new SystopiaExpressionLanguage();
    }

    public function testMapIsRegistered(): void
    {
        static::assertNotEmpty($this->expressionLanguage->compile('map(array, "value.a")', ['array']));
    }

    public function testCeilIsRegistered(): void
    {
        static::assertNotEmpty($this->expressionLanguage->compile('ceil(2.3)', []));
    }
}
