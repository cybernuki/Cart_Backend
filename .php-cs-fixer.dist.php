<?php

return (new PhpCsFixer\Config())
    ->setRiskyAllowed(true)
    ->setRules([
        '@PhpCsFixer' => true,
        '@DoctrineAnnotation' => true,
        'php_unit_test_class_requires_covers' => false,
        'php_unit_internal_class' => false,
        'blank_line_before_statement' => [
            'statements' => [
                'if',
                'while',
                'switch',
                'do',
                'for',
                'foreach',
                'break',
                'continue',
                'declare',
                'return',
                'throw',
                'try',
            ],
        ],
    ])
    ->setCacheFile(__DIR__.'/.php_cs.cache')
    ->setFinder(PhpCsFixer\Finder::create()
        ->in(__DIR__.'/app')
        ->in(__DIR__.'/database')
        ->in(__DIR__.'/config')
        ->in(__DIR__.'/routes')
        ->in(__DIR__.'/tests')
    );
