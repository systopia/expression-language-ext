<?php

/*
 * Copyright (c) 2022 SYSTOPIA GmbH
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
        self::assertSame('\ceil(3.5)', $this->expressionLanguage->compile('ceil(3.5)'));
        self::assertSame(4.0, $this->expressionLanguage->evaluate('ceil(3.5)'));
    }

    public function testCount(): void
    {
        self::assertSame('\count([0 => 1, 1 => 2])', $this->expressionLanguage->compile('count([1, 2])'));
        self::assertSame(2, $this->expressionLanguage->evaluate('count([1, 2])'));
    }

    public function testFloor(): void
    {
        self::assertSame('\floor(3.5)', $this->expressionLanguage->compile('floor(3.5)'));
        self::assertSame(3.0, $this->expressionLanguage->evaluate('floor(3.5)'));
    }

    public function testMax(): void
    {
        self::assertSame('\max(2, 1, 3)', $this->expressionLanguage->compile('max(2, 1, 3)'));
        self::assertSame(3, $this->expressionLanguage->evaluate('max(2, 1, 3)'));

        self::assertSame('\max($array)', $this->expressionLanguage->compile('max(array)', ['array']));
        self::assertSame(3, $this->expressionLanguage->evaluate('max(array)', ['array' => [2, 1, 3]]));
    }

    public function testMin(): void
    {
        self::assertSame('\min(2, 1, 3)', $this->expressionLanguage->compile('min(2, 1, 3)'));
        self::assertSame(1, $this->expressionLanguage->evaluate('min(2, 1, 3)'));

        self::assertSame('\min($array)', $this->expressionLanguage->compile('min(array)', ['array']));
        self::assertSame(1, $this->expressionLanguage->evaluate('min(array)', ['array' => [2, 1, 3]]));
    }

    public function testRound(): void
    {
        self::assertSame('\round(1.35, 1)', $this->expressionLanguage->compile('round(1.35, 1)'));
        self::assertSame(1.4, $this->expressionLanguage->evaluate('round(1.35, 1)'));
    }

    public function testSum(): void
    {
        self::assertSame('\array_sum([0 => 1, 1 => 2])', $this->expressionLanguage->compile('sum([1, 2])'));
        self::assertSame(3, $this->expressionLanguage->evaluate('sum([1, 2])'));
    }
}
