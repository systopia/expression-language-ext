<?php
/*
 * Copyright (c) $year.today SYSTOPIA GmbH
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM,
 * DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR
 * OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE
 * OR OTHER DEALINGS IN THE SOFTWARE.
 */

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
        self::assertSame('map($array, "value.b")', $compiled);
    }

    public function testEvaluate(): void
    {
        $array = [
            (object) ['a' => 'fooA', 'b' => 'fooB'],
            (object) ['a' => 'barA', 'b' => 'barB'],
        ];

        $mapped = $this->expressionLanguage->evaluate('map(array, "value.b")', ['array' => $array]);
        self::assertSame(['fooB', 'barB'], $mapped);
    }

    public function testEvaluateWithAddition(): void
    {
        $arrayObject = new \ArrayObject([
            (object) ['a' => 1, 'b' => 2],
            (object) ['a' => 3, 'b' => 4],
        ]);

        $mapped = $this->expressionLanguage->evaluate('map(array, "value.a + value.b")', ['array' => $arrayObject]);
        self::assertSame([3, 7], $mapped);
    }

    public function testEvaluateWithKey(): void
    {
        $array = [
            'a' => 1,
            'b' => 2,
        ];

        $mapped = $this->expressionLanguage->evaluate('map(array, "key ~ \" => \" ~ value")', ['array' => $array]);
        self::assertSame(['a => 1', 'b => 2'], $mapped);
    }
}
