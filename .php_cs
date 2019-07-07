<?php

$fixer = [
    'finder' => [
        'exclude' => [
            'bootstrap',
            'public',
            'storage',
            'node_modules',
            'var'
        ]
    ],

    'rules' => [
        // set the "level"
        '@Symfony' => true,
        //exclude psr rule
        'psr0' => false,
        //override some of the symfony default rules
        'concat_space' => [
            'spacing' => 'one'
        ],
        'trailing_comma_in_multiline_array' => false,
        'phpdoc_no_empty_return' => false,
        'new_with_braces' => false,
        'phpdoc_align' => false,
        'phpdoc_summary' => false,
        'no_multiline_whitespace_around_double_arrow' => false,
        'pre_increment' => false,
        'no_multiline_whitespace_before_semicolons' => true,
        'array_syntax' => [
            'syntax' => 'short'
        ],
        'binary_operator_spaces' =>  [
            'align_equals' => true,
            'align_double_arrow' => true
        ],
        'return_type_declaration' => [
            'space_before' => 'one'
        ],
        'php_unit_fqcn_annotation' => false,
        'whitespace_after_comma_in_array' => true,
        'blank_line_after_namespace'   => true,
        'blank_line_after_opening_tag' => true,
        'blank_line_before_statement'  => [
            'statements' => [
                'return',
                'throw',
                'try',
                'if'
            ],
        ],
        'blank_line_before_statement' => [
            'statements' => [
                'if',
                'return',
                'throw',
                'try',
            ]
        ],
        'braces' => true,
        'cast_spaces' => true,
        'class_definition' => true,
        'elseif' => true,
        'full_opening_tag' => true,
        'function_declaration' => true,
        'function_typehint_space' => true,
        'single_blank_line_at_eof'           => true,
        'single_blank_line_before_namespace' => true,
        'single_class_element_per_statement' => true,
        'single_import_per_statement' => true,
        'single_line_after_imports' => true,
        'single_quote' => true,
        'space_after_semicolon' => true,
        'standardize_not_equals' => true,
        'switch_case_semicolon_to_colon' => true,
        'switch_case_space' => true,
        'ternary_operator_spaces' => true,
        'trailing_comma_in_multiline_array' => true,
        'trim_array_spaces' => true,
        'unary_operator_spaces' => true,
        'phpdoc_no_useless_inheritdoc' => true,
        'phpdoc_order' => true,
        'phpdoc_scalar' => true,
        'phpdoc_separation' => true,
        'phpdoc_single_line_var_spacing' => true,
        'phpdoc_summary' => true,
        'phpdoc_to_comment' => true,
        'phpdoc_trim' => true,
        'phpdoc_types' => true,
        'phpdoc_var_without_name' => true,
        'phpdoc_align' => true,
        'phpdoc_indent' => true,
        'phpdoc_inline_tag' => true,
        'phpdoc_no_alias_tag' => [
            'type' => 'var',
        ],
        'no_spaces_inside_parenthesis' => true,
        'no_trailing_comma_in_list_call' => true,
        'no_trailing_comma_in_singleline_array' => true,
        'no_trailing_whitespace' => true,
        'no_trailing_whitespace_in_comment' => true,
        'no_useless_return' => true,
        'no_whitespace_before_comma_in_array' => true,
        'no_whitespace_in_blank_line' => true,
        'normalize_index_brace' => true,
        'object_operator_without_whitespace' => true,
        'no_multiline_whitespace_around_double_arrow' => true,
        'no_multiline_whitespace_before_semicolons'   => true,
        'no_short_bool_cast' => true,
        'no_singleline_whitespace_before_semicolons'  => true,
        'no_spaces_after_function_name'               => true,
        'no_spaces_around_offset'                     => [
            'inside',
            'outside',
        ],
        'hash_to_slash_comment' => true,
        'heredoc_to_nowdoc' => true,
        'include' => true,
        'indentation_type' => true,
        'line_ending'=> true
    ]
];

return PhpCsFixer\Config::create()
    ->setUsingCache(true)
    ->setCacheFile('.php_cs.cache')
    ->setRules($fixer['rules'])
    ->setFinder($fixer['finder']);