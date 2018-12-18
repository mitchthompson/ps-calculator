<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8b14466745098bd383aee7c95695b6b3
{
    public static $prefixLengthsPsr4 = array (
        'I' => 
        array (
            'Inc\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Inc\\' => 
        array (
            0 => __DIR__ . '/../..' . '/inc',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8b14466745098bd383aee7c95695b6b3::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8b14466745098bd383aee7c95695b6b3::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
