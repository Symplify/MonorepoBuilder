<?php

// scoper-autoload.php @generated by PhpScoper

$loader = require_once __DIR__.'/autoload.php';

// Aliases for the whitelisted classes. For more information see:
// https://github.com/humbug/php-scoper/blob/master/README.md#class-whitelisting
if (!class_exists('ComposerAutoloaderInit003048a6754a71b70d33dfd940fd998c', false) && !interface_exists('ComposerAutoloaderInit003048a6754a71b70d33dfd940fd998c', false) && !trait_exists('ComposerAutoloaderInit003048a6754a71b70d33dfd940fd998c', false)) {
    spl_autoload_call('MonorepoBuilder20210710\ComposerAutoloaderInit003048a6754a71b70d33dfd940fd998c');
}
if (!class_exists('Normalizer', false) && !interface_exists('Normalizer', false) && !trait_exists('Normalizer', false)) {
    spl_autoload_call('MonorepoBuilder20210710\Normalizer');
}
if (!class_exists('JsonException', false) && !interface_exists('JsonException', false) && !trait_exists('JsonException', false)) {
    spl_autoload_call('MonorepoBuilder20210710\JsonException');
}
if (!class_exists('Attribute', false) && !interface_exists('Attribute', false) && !trait_exists('Attribute', false)) {
    spl_autoload_call('MonorepoBuilder20210710\Attribute');
}
if (!class_exists('Stringable', false) && !interface_exists('Stringable', false) && !trait_exists('Stringable', false)) {
    spl_autoload_call('MonorepoBuilder20210710\Stringable');
}
if (!class_exists('UnhandledMatchError', false) && !interface_exists('UnhandledMatchError', false) && !trait_exists('UnhandledMatchError', false)) {
    spl_autoload_call('MonorepoBuilder20210710\UnhandledMatchError');
}
if (!class_exists('ValueError', false) && !interface_exists('ValueError', false) && !trait_exists('ValueError', false)) {
    spl_autoload_call('MonorepoBuilder20210710\ValueError');
}
if (!class_exists('ReturnTypeWillChange', false) && !interface_exists('ReturnTypeWillChange', false) && !trait_exists('ReturnTypeWillChange', false)) {
    spl_autoload_call('MonorepoBuilder20210710\ReturnTypeWillChange');
}

// Functions whitelisting. For more information see:
// https://github.com/humbug/php-scoper/blob/master/README.md#functions-whitelisting
if (!function_exists('resolveConfigFileInfo')) {
    function resolveConfigFileInfo() {
        return \MonorepoBuilder20210710\resolveConfigFileInfo(...func_get_args());
    }
}
if (!function_exists('composerRequire003048a6754a71b70d33dfd940fd998c')) {
    function composerRequire003048a6754a71b70d33dfd940fd998c() {
        return \MonorepoBuilder20210710\composerRequire003048a6754a71b70d33dfd940fd998c(...func_get_args());
    }
}
if (!function_exists('setproctitle')) {
    function setproctitle() {
        return \MonorepoBuilder20210710\setproctitle(...func_get_args());
    }
}
if (!function_exists('array_is_list')) {
    function array_is_list() {
        return \MonorepoBuilder20210710\array_is_list(...func_get_args());
    }
}
if (!function_exists('enum_exists')) {
    function enum_exists() {
        return \MonorepoBuilder20210710\enum_exists(...func_get_args());
    }
}
if (!function_exists('includeIfExists')) {
    function includeIfExists() {
        return \MonorepoBuilder20210710\includeIfExists(...func_get_args());
    }
}
if (!function_exists('dump')) {
    function dump() {
        return \MonorepoBuilder20210710\dump(...func_get_args());
    }
}
if (!function_exists('dd')) {
    function dd() {
        return \MonorepoBuilder20210710\dd(...func_get_args());
    }
}

return $loader;