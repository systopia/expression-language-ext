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
        self::assertNotEmpty($this->expressionLanguage->compile('map(array, "value.a")', ['array']));
    }

    public function testCeilIsRegistered(): void
    {
        self::assertNotEmpty($this->expressionLanguage->compile('ceil(2.3)'));
    }

    public function testDateCreateIsRegistered(): void
    {
        self::assertNotEmpty($this->expressionLanguage->compile('date_create("2000")'));
    }
}
