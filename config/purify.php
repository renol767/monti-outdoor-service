<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Config
    |--------------------------------------------------------------------------
    |
    | This option defines the default config that is provided to HTMLPurifier.
    |
    */

    'default' => 'default',

    /*
    |--------------------------------------------------------------------------
    | Configs
    |--------------------------------------------------------------------------
    |
    | Here you may define the settings for HTMLPurifier.
    |
    */

    'configs' => [

        'default' => [
            'Core.Encoding' => 'utf-8',
            'HTML.Doctype' => 'HTML 4.01 Transitional',
            'HTML.Allowed' => 'h1,h2,h3,h4,h5,h6,b,strong,i,em,u,a[href|title],ul,ol,li,p[style],br,span,img[width|height|alt|src]',
            'HTML.ForbiddenElements' => '',
            'CSS.AllowedProperties' => 'font,font-size,font-weight,font-style,font-family,text-decoration,padding-left,color,background-color,text-align',
            'AutoFormat.AutoParagraph' => false, // Quill adds p tags, don't double up
            'AutoFormat.RemoveEmpty' => false,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | HTMLPurifier definition cache
    |--------------------------------------------------------------------------
    |
    | Here you may specify the cache path for HTMLPurifier.
    |
    */

    'cachePath' => storage_path('app/purifier'),

];
