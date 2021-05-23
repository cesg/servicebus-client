<?php

$finder = PhpCsFixer\Finder::create()
    ->exclude(['resources', 'storage', 'bootstrap', 'public', 'node_modules', 'deployer'])
    ->ignoreDotFiles(true)
    ->ignoreVCS(true)
    ->in(__DIR__)
;

$config = new PhpCsFixer\Config();

return $config
    ->setRiskyAllowed(true)
    ->setRules([
        '@PSR12' => true,
        '@PHP80Migration' => true,
        'php_unit_test_annotation' => ['style' => 'annotation'],
        'php_unit_method_casing' => ['case' => 'snake_case'],
    ])
    ->setFinder($finder)
;
