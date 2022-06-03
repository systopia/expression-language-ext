<?php

declare(strict_types=1);

namespace Systopia\ExpressionLanguage\FunctionProvider;

use Symfony\Component\ExpressionLanguage\ExpressionFunction;
use Symfony\Component\ExpressionLanguage\ExpressionFunctionProviderInterface;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

final class MapExpressionFunctionProvider implements ExpressionFunctionProviderInterface
{
    private ExpressionLanguage $expressionLanguage;

    public function __construct(ExpressionLanguage $expressionLanguage)
    {
        $this->expressionLanguage = $expressionLanguage;
    }

    /**
     * {@inheritDoc}
     */
    public function getFunctions(): array
    {
        return [
            new ExpressionFunction('map', function (string $arrayName, string $expression): string {
                return sprintf('map(%s, %s)', $arrayName, $expression);
            }, function ($arguments, iterable $iterable, string $expression): array {
                $mapped = [];
                foreach ($iterable as $key => $value) {
                    $mapped[] = $this->expressionLanguage->evaluate($expression, ['key' => $key, 'value' => $value]);
                }

                return $mapped;
            }),
        ];
    }
}
