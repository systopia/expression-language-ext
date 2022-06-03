<?php

declare(strict_types=1);

namespace Systopia\ExpressionLanguage\Test\FunctionProvider;

use PHPUnit\Framework\TestCase;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use Systopia\ExpressionLanguage\FunctionProvider\PhpFunctionsFunctionProvider;

/**
 * @covers \Systopia\ExpressionLanguage\FunctionProvider\PhpFunctionsFunctionProvider
 */
class PhpFunctionsFunctionProviderTest extends TestCase
{
    private ExpressionLanguage $expressionLanguage;

    protected function setUp(): void
    {
        parent::setUp();
        $this->expressionLanguage = new ExpressionLanguage();
        $this->expressionLanguage->registerProvider(new PhpFunctionsFunctionProvider());
    }

    public function testCeil(): void
    {
        static::assertSame('\ceil(3.5)', $this->expressionLanguage->compile('ceil(3.5)'));
        static::assertSame(4.0, $this->expressionLanguage->evaluate('ceil(3.5)'));
    }

    public function testCount(): void
    {
        static::assertSame('\count([0 => 1, 1 => 2])', $this->expressionLanguage->compile('count([1, 2])'));
        static::assertSame(2, $this->expressionLanguage->evaluate('count([1, 2])'));
    }

    public function testFloor(): void
    {
        static::assertSame('\floor(3.5)', $this->expressionLanguage->compile('floor(3.5)'));
        static::assertSame(3.0, $this->expressionLanguage->evaluate('floor(3.5)'));
    }

    public function testMax(): void
    {
        static::assertSame('\max(2, 1, 3)', $this->expressionLanguage->compile('max(2, 1, 3)'));
        static::assertSame(3, $this->expressionLanguage->evaluate('max(2, 1, 3)'));

        static::assertSame('\max($array)', $this->expressionLanguage->compile('max(array)', ['array']));
        static::assertSame(3, $this->expressionLanguage->evaluate('max(array)', ['array' => [2, 1, 3]]));
    }

    public function testMin(): void
    {
        static::assertSame('\min(2, 1, 3)', $this->expressionLanguage->compile('min(2, 1, 3)'));
        static::assertSame(1, $this->expressionLanguage->evaluate('min(2, 1, 3)'));

        static::assertSame('\min($array)', $this->expressionLanguage->compile('min(array)', ['array']));
        static::assertSame(1, $this->expressionLanguage->evaluate('min(array)', ['array' => [2, 1, 3]]));
    }

    public function testRound(): void
    {
        static::assertSame('\round(1.35, 1)', $this->expressionLanguage->compile('round(1.35, 1)'));
        static::assertSame(1.4, $this->expressionLanguage->evaluate('round(1.35, 1)'));
    }

    public function testSum(): void
    {
        static::assertSame('\array_sum([0 => 1, 1 => 2])', $this->expressionLanguage->compile('sum([1, 2])'));
        static::assertSame(3, $this->expressionLanguage->evaluate('sum([1, 2])'));
    }
}
