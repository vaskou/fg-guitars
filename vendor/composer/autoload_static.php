<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0bf561d5b3ed4660f4608c66f66a7c33
{
    public static $files = array (
        'ce86993b4eb8a50284a32cea0e176dc4' => __DIR__ . '/..' . '/vaskou/wordpress-custom-settings/WordpressCustomSettings/bootstrap_2_0_4.php',
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit0bf561d5b3ed4660f4608c66f66a7c33::$classMap;

        }, null, ClassLoader::class);
    }
}
