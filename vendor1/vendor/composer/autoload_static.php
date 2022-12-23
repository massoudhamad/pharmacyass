<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit50fae01e901e1057a6f3d8a2810ca686
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit50fae01e901e1057a6f3d8a2810ca686::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit50fae01e901e1057a6f3d8a2810ca686::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}