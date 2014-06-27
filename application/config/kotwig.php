<?php

return array
(
    'environment' => array
    (
        'debug' => FALSE,
        'trim_blocks' => FALSE,
        'charset' => 'utf-8',
        'base_template_class' => 'Twig_Template',
        'cache' => APPPATH . 'cache/twig',
        'auto_reload' => TRUE,
        'strict_variables' => FALSE,
        'autoescape' => TRUE,
        'optimizations' => -1,
    ),
    'extensions' => array
    (// List extension class names
    ),
  /*  'globals' => array
    (
        'Captcha' => Captcha::instance(),
        'CorrectDeclension' => new CorrectDeclension,
        'token' => Security::token(),
        'Info' => new Info(),
        'Helper' => new Helper()
    ),*/
    'filters' => array
    (
        'i18n' => new Twig_Filter_Function('__')
    ),

    'templates' => 'views',
    'suffix' => 'twig',
);