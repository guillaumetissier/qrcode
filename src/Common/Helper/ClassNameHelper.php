<?php

namespace Guillaumetissier\QrCode\Common\Helper;

final class ClassNameHelper
{
    private function __construct()
    {
    }

    private function __clone()
    {
    }

    /**
     * Get class name without namespace from FQCN
     */
    public static function getClassName(string $fqcn): string
    {
        $parts = explode('\\', $fqcn);
        return end($parts);
    }

    /**
     * Get namespace from FQCN
     */
    public static function getNamespace(string $fqcn): string
    {
        $lastBackslash = strrpos($fqcn, '\\');

        if ($lastBackslash === false) {
            return ''; // No namespace
        }

        return substr($fqcn, 0, $lastBackslash);
    }

    /**
     * Get both class name and namespace
     *
     * @return array{namespace: string, className: string}
     */
    public static function parse(string $fqcn): array
    {
        return [
            'namespace' => self::getNamespace($fqcn),
            'className' => self::getClassName($fqcn),
        ];
    }
}
