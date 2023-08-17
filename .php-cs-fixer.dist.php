<?php

declare(strict_types=1);

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__.'/src')
    ->in(__DIR__.'/tests')
;

$config = new PhpCsFixer\Config();

return $config->setRules([
    '@PhpCsFixer' => true,
    '@PhpCsFixer:risky' => true,
    'phpdoc_align' => ['align' => 'left'],
    'comment_to_phpdoc' => ['ignored_tags' => ['phpstan-ignore-next-line']],
    'php_unit_internal_class' => false,
    'no_superfluous_phpdoc_tags' => [
        'allow_mixed' => true,
        'remove_inheritdoc' => false,
    ],
])
    ->setRiskyAllowed(true)
    ->setFinder($finder)
;
