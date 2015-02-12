<?php

// autoload_real.php @generated by Composer

<<<<<<< HEAD
class ComposerAutoloaderInita6bc3543c35ecaf8fa5767fc93391b83
=======
class ComposerAutoloaderInit6cf9001217b78bd9250623196cab973c
>>>>>>> FETCH_HEAD
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

<<<<<<< HEAD
        spl_autoload_register(array('ComposerAutoloaderInita6bc3543c35ecaf8fa5767fc93391b83', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader();
        spl_autoload_unregister(array('ComposerAutoloaderInita6bc3543c35ecaf8fa5767fc93391b83', 'loadClassLoader'));
=======
        spl_autoload_register(array('ComposerAutoloaderInit6cf9001217b78bd9250623196cab973c', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader();
        spl_autoload_unregister(array('ComposerAutoloaderInit6cf9001217b78bd9250623196cab973c', 'loadClassLoader'));
>>>>>>> FETCH_HEAD

        $includePaths = require __DIR__ . '/include_paths.php';
        array_push($includePaths, get_include_path());
        set_include_path(join(PATH_SEPARATOR, $includePaths));

        $map = require __DIR__ . '/autoload_namespaces.php';
        foreach ($map as $namespace => $path) {
            $loader->set($namespace, $path);
        }

        $map = require __DIR__ . '/autoload_psr4.php';
        foreach ($map as $namespace => $path) {
            $loader->setPsr4($namespace, $path);
        }

        $classMap = require __DIR__ . '/autoload_classmap.php';
        if ($classMap) {
            $loader->addClassMap($classMap);
        }

        $loader->register(true);

        $includeFiles = require __DIR__ . '/autoload_files.php';
        foreach ($includeFiles as $file) {
<<<<<<< HEAD
            composerRequirea6bc3543c35ecaf8fa5767fc93391b83($file);
=======
            composerRequire6cf9001217b78bd9250623196cab973c($file);
>>>>>>> FETCH_HEAD
        }

        return $loader;
    }
}

<<<<<<< HEAD
function composerRequirea6bc3543c35ecaf8fa5767fc93391b83($file)
=======
function composerRequire6cf9001217b78bd9250623196cab973c($file)
>>>>>>> FETCH_HEAD
{
    require $file;
}
