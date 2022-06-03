<?php

declare(strict_types=1);

namespace Systopia\ExpressionLanguage;

use Psr\Cache\CacheItemPoolInterface;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use Systopia\ExpressionLanguage\FunctionProvider\MapExpressionFunctionProvider;
use Systopia\ExpressionLanguage\FunctionProvider\PhpFunctionsFunctionProvider;

class SystopiaExpressionLanguage extends ExpressionLanguage
{
    public function __construct(CacheItemPoolInterface $cache = null, array $providers = [])
    {
        $providers = array_merge([
            new MapExpressionFunctionProvider($this),
            new PhpFunctionsFunctionProvider(),
        ], $providers);

        parent::__construct($cache, $providers);
    }
}
