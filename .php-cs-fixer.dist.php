<?php

require_once __DIR__ . '/vendor/tareq1988/wp-php-cs-fixer/loader.php';

$finder = PhpCsFixer\Finder::create()
    ->exclude( 'node_modules' )
    ->exclude( 'vendors' )
    ->in( __DIR__ )
;

$config = new PhpCsFixer\Config();
$config
    ->registerCustomFixers( array(
        new WeDevs\Fixer\SpaceInsideParenthesisFixer(),
        new WeDevs\Fixer\BlankLineAfterClassOpeningFixer(),
    ) )
    ->setRiskyAllowed( true )
    ->setUsingCache( false )
    ->setRules(
        array(
            '@PSR2'                   => true,
            'align_multiline_comment' => true,
            'array_syntax'            => array( 'syntax' => 'long' ),
            'binary_operator_spaces'  => array(
                'operators' => array( '=' => 'align', '=>' => 'align' ),
            ),
            'blank_line_after_opening_tag' => true,
            'blank_line_before_statement'  => array(
                'statements' => array( 'return', 'try', 'if', 'while', 'for', 'foreach', 'do', 'case' ),
            ),
            'braces' => array(
                'position_after_functions_and_oop_constructs' => 'same',
                'allow_single_line_closure'                   => false,
            ),
            'cast_spaces' => array( 'space' => 'single' ),
            //'class_attributes_separation' => ['elements' => ['method', 'const', 'property']],
            'class_definition'                        => array( 'single_line' => true ),
            'concat_space'                            => array( 'spacing' => 'one' ),
            'constant_case'                           => array( 'case' => 'lower' ),
            'dir_constant'                            => true,
            'elseif'                                  => true,
            'full_opening_tag'                        => true,
            'fully_qualified_strict_types'            => true,
            'function_declaration'                    => true,
            'WeDevs/space_inside_parenthesis'         => true,
            'WeDevs/blank_line_after_class_opening'   => true,
            'function_typehint_space'                 => true,
            'global_namespace_import'                 => array( 'import_classes' => true ),
            'include'                                 => true,
            'line_ending'                             => true,
            'list_syntax'                             => array( 'syntax' => 'long' ),
            'lowercase_cast'                          => true,
            'lowercase_keywords'                      => true,
            'lowercase_static_reference'              => true,
            'magic_constant_casing'                   => true,
            'magic_method_casing'                     => true,
            'method_argument_space'                   => true,
            'native_function_casing'                  => true,
            'method_chaining_indentation'             => true,
            'native_function_type_declaration_casing' => true,
            'new_with_braces'                         => true,
            'no_alternative_syntax'                   => false,
            'no_blank_lines_after_class_opening'      => false,
            'no_blank_lines_after_phpdoc'             => true,
            'no_empty_comment'                        => true,
            'no_empty_phpdoc'                         => true,
            'no_empty_statement'                      => true,
            'no_extra_blank_lines'                    => array( 'tokens' => array(
                'extra',
                'parenthesis_brace_block',
                'square_brace_block',
                'throw',
                'use',
            ) ),
            'no_leading_import_slash'                     => true,
            'no_leading_namespace_whitespace'             => true,
            'no_mixed_echo_print'                         => true,
            'no_multiline_whitespace_around_double_arrow' => true,
            'no_short_bool_cast'                          => true,
            'echo_tag_syntax'                             => array( 'format' => 'long' ),
            'no_singleline_whitespace_before_semicolons'  => true,
            'no_spaces_around_offset'                     => array( 'positions' => array( 'outside' ) ),
            'no_spaces_inside_parenthesis'                => false,
            'no_superfluous_phpdoc_tags'                  => array( 'allow_mixed' => true, 'allow_unused_params' => true ),
            'no_trailing_comma_in_list_call'              => true,
            'no_trailing_comma_in_singleline_array'       => true,
            'no_trailing_whitespace'                      => true,
            'no_unneeded_control_parentheses'             => true,
            'no_unneeded_curly_braces'                    => true,
            'no_unneeded_final_method'                    => true,
            'no_unused_imports'                           => true,
            'no_whitespace_before_comma_in_array'         => true,
            'no_whitespace_in_blank_line'                 => true,
            'normalize_index_brace'                       => true,
            'object_operator_without_whitespace'          => true,
            'ordered_imports'                             => true,
            'php_unit_fqcn_annotation'                    => true,
            'phpdoc_align'                                => array(
                'align' => 'vertical',
                'tags'  => array(
                    'method',
                    'param',
                    'property',
                    'return',
                    'throws',
                    'type',
                    'var',
                ),
            ),
            'phpdoc_annotation_without_dot' => true,
            'phpdoc_indent'                 => true,
            'general_phpdoc_tag_rename'     => array(
                'fix_annotation' => true,
                'fix_inline'     => true,
            ),
            'phpdoc_no_access'                              => true,
            'phpdoc_no_alias_tag'                           => true,
            'phpdoc_no_package'                             => true,
            'phpdoc_no_useless_inheritdoc'                  => true,
            'phpdoc_return_self_reference'                  => true,
            'phpdoc_scalar'                                 => true,
            'phpdoc_separation'                             => true,
            'phpdoc_single_line_var_spacing'                => true,
            'phpdoc_to_comment'                             => true,
            'phpdoc_trim'                                   => true,
            'phpdoc_trim_consecutive_blank_line_separation' => true,
            'phpdoc_types'                                  => true,
            'phpdoc_types_order'                            => array(
                'null_adjustment' => 'always_last',
                'sort_algorithm'  => 'none',
            ),
            'phpdoc_var_without_name'            => true,
            'return_type_declaration'            => true,
            'semicolon_after_instruction'        => true,
            'short_scalar_cast'                  => true,
            'single_blank_line_before_namespace' => true,
            'single_class_element_per_statement' => true,
            'single_line_comment_style'          => array(
                'comment_types' => array( 'hash' ),
            ),
            'single_line_throw'                 => true,
            'single_quote'                      => true,
            'single_trait_insert_per_statement' => true,
            'space_after_semicolon'             => array(
                'remove_in_empty_for_expressions' => true,
            ),
            'standardize_increment'       => true,
            'standardize_not_equals'      => true,
            'ternary_operator_spaces'     => true,
            'trailing_comma_in_multiline' => array(
                'elements' => array( 'arrays' ),
            ),
            'trim_array_spaces'               => false,
            'whitespace_after_comma_in_array' => true,
        )
    )
    ->setFinder( $finder )
;

return $config;
