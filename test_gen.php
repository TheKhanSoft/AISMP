<?php

$basePath = 'd:/xampp/htdocs/ai-society';

$modules = [
    [
        'namespace' => 'Admin\\Pages',
        'list_class' => 'PageList',
        'form_class' => 'PageForm',
        'model' => 'App\\Models\\Page',
        'title' => 'Pages',
        'singular' => 'Page',
        'fields' => ['title', 'slug', 'is_published'],
        'has_form' => true,
        'specifics' => 'pages'
    ],
    // I will flesh out the modules.
];

// ... I will write the full generator here.
