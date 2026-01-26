<?php

return [
    'encoding'      => 'UTF-8',
    'finalize'      => true,
    'cachePath'     => storage_path('app/purifier'),
    'cacheFileMode' => 0755,
    'settings'      => [
        'default' => [
            'HTML.Doctype'             => 'HTML 4.01 Transitional',
            'HTML.Allowed'             => 'h1,h2,h3,h4,h5,h6,div,b,strong,i,em,u,a[href|title],ul,ol,li,p[style],br,span,img[width|height|alt|src|style]',
            'CSS.AllowedProperties'    => 'font,font-size,font-weight,font-style,font-family,text-decoration,padding-left,color,background-color,text-align',
            'AutoFormat.AutoParagraph' => false, // Quill adds p tags
            'AutoFormat.RemoveEmpty'   => false,
            'URI.AllowedSchemes'       => ['http' => true, 'https' => true, 'data' => true, 'mailto' => true, 'tel' => true],
        ],
    ],
];
