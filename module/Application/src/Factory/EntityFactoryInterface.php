<?php

/**
 * EntityFactoryInterface.php
 *
 * @copyright Copyright (c) Mathias Schilling <m@matchilling>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */
namespace Application\Factory;

/**
 *
 * EntityFactoryInterface
 *
 * @package Application
 *
 */
interface EntityFactoryInterface
{

    /**
     *
     * @param  string  $entityClassName
     * @param  array[] $array
     * @return null|object[]
     */
    public static function collectionFromArray($entityClassName, array $array);

    /**
     *
     * @param  string $entityClassName
     * @param  string $json
     * @return null|object[]
     */
    public static function collectionFromJson($entityClassName, $json);

    /**
     *
     * @param  string $entityClassName
     * @param  array  $array
     * @return null|object
     */
    public static function fromArray($entityClassName, array $array);

    /**
     *
     * @param  string $entityClassName
     * @param  string $json
     * @return null|object
     */
    public static function fromJson($entityClassName, $json);

    /**
     *
     * @param  object|object[] $object
     * @return array|array[]
     */
    public static function toArray($object);

    /**
     *
     * @param  object|object[] $object
     * @return string
     */
    public static function toJson($object);
}
