<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->exclude('vendor')
    ->exclude('node_modules')
    ->exclude('bootstrap')
    ->exclude('.git')
    ->name('*.php');

$config = new PhpCsFixer\Config();
return $config
    ->setRiskyAllowed(true)
    ->setRules([
        '@PSR12' => true,
        'array_syntax' => ['syntax' => 'short'],
        'no_unused_imports' => true,
        'no_superfluous_phpdoc_tags' => false,
        'ordered_imports' => true,
    ])
    ->setFinder($finder);
