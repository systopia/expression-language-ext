<?php

declare(strict_types=1);

namespace Systopia\ExpressionLanguage\Test\FunctionProvider;

use PHPUnit\Framework\TestCase;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use Systopia\ExpressionLanguage\FunctionProvider\MapExpressionFunctionProvider;

/**
 * @covers \Systopia\ExpressionLanguage\FunctionProvider\MapExpressionFunctionProvider
 */
final class MapExpressionFunctionProviderTest extends TestCase
{
    private ExpressionLanguage $expressionLanguage;

    protected function setUp(): void
    {
        parent::setUp();
        $this->expressionLanguage = new ExpressionLanguage();
        $this->expressionLanguage->registerProvider(new MapExpressionFunctionProvider($this->expressionLanguage));
    }

    public function testCompile(): void
    {
        $this->expressionLanguage->parse('map(array, "value.b")', ['array']);

        $compiled = $this->expressionLanguage->compile('map(array, "value.b")', ['array']);
        static::assertSame('map($array, "value.b")', $compiled);
    }

    public function testEvaluate(): void
    {
        $array = [
            (object) ['a' => 'fooA', 'b' => 'fooB'],
            (object) ['a' => 'barA', 'b' => 'barB'],
        ];

        $mapped = $this->expressionLanguage->evaluate('map(array, "value.b")', ['array' => $array]);
        static::assertSame(['fooB', 'barB'], $mapped);
    }

    public function testEvaluateWithAddition(): void
    {
        $arrayObject = new \ArrayObject([
            (object) ['a' => 1, 'b' => 2],
            (object) ['a' => 3, 'b' => 4],
        ]);

        $mapped = $this->expressionLanguage->evaluate('map(array, "value.a + value.b")', ['array' => $arrayObject]);
        static::assertSame([3, 7], $mapped);
    }

    public function testEvaluateWithKey(): void
    {
        $array = [
            'a' => 1,
            'b' => 2,
        ];

        $mapped = $this->expressionLanguage->evaluate('map(array, "key ~ \" => \" ~ value")', ['array' => $array]);
        static::assertSame(['a => 1', 'b => 2'], $mapped);
    }
}
