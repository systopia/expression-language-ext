<?php

declare(strict_types=1);

namespace Systopia\ExpressionLanguage\FunctionProvider;

use Symfony\Component\ExpressionLanguage\ExpressionFunction;
use Symfony\Component\ExpressionLanguage\ExpressionFunctionProviderInterface;

class PhpFunctionsFunctionProvider implements ExpressionFunctionProviderInterface
{
    /**
     * {@inheritDoc}
     *
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function getFunctions(): array
    {
        return [
            ExpressionFunction::fromPhp('ceil'),
            ExpressionFunction::fromPhp('count'),
            ExpressionFunction::fromPhp('floor'),
            ExpressionFunction::fromPhp('round'),
            ExpressionFunction::fromPhp('max'),
            ExpressionFunction::fromPhp('min'),
            ExpressionFunction::fromPhp('array_sum', 'sum'),
        ];
    }
}
