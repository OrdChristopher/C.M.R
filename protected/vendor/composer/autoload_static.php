<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7c5b7e230044a2558e3c7497a6f75fa7
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'Application\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Application\\' => 
        array (
            0 => __DIR__ . '/../..' . '/application',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7c5b7e230044a2558e3c7497a6f75fa7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7c5b7e230044a2558e3c7497a6f75fa7::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}