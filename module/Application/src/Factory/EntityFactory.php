<?php

/**
 * EntityFactory.php
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
 * EntityFactory
 *
 * @package Application
 *
 */
class EntityFactory implements EntityFactoryInterface
{

    /**
     *
     * @var \JMS\Serializer\Serializer
     */
    private static $serializer;

    /**
     *
     * @internal Need to trim leading slashes from the namespace, because JMS
     *           serializer can't handle them.
     *
     * @param  string $entityClassName
     * @return string
     */
    private static function getCollectionClassName($entityClassName)
    {
        return sprintf('array<%s>', ltrim($entityClassName, '\\'));
    }

    /**
     *
     * {@inheritDoc}
     * @see \Application\Factory\EntityFactoryInterface::collectionFromArray()
     */
    public static function collectionFromArray($entityClassName, array $array)
    {
        return ! (empty($array))
            ? self::getSerializer()->fromArray($array, self::getCollectionClassName($entityClassName))
            : null;
    }

    /**
     *
     * {@inheritDoc}
     * @see \Application\Factory\EntityFactoryInterface::collectionFromJson()
     */
    public static function collectionFromJson($entityClassName, $json)
    {
        return ! empty($json)
            ? self::getSerializer()->deserialize(
                $json,
                self::getCollectionClassName($entityClassName),
                'json',
                \JMS\Serializer\DeserializationContext::create()->setSerializeNull(true)
              )
            : null;
    }

    /**
     *
     * {@inheritDoc}
     * @see \Application\Factory\EntityFactoryInterface::fromArray()
     */
    public static function fromArray($entityClassName, array $array)
    {
        return ! empty($array) ? self::getSerializer()->fromArray($array, $entityClassName) : null;
    }

    /**
     *
     * {@inheritDoc}
     * @see \Application\Factory\EntityFactoryInterface::fromJson()
     */
    public static function fromJson($entityClassName, $json)
    {
        return ! empty($json)
            ? self::getSerializer()->deserialize(
                $json,
                $entityClassName,
                'json',
                \JMS\Serializer\DeserializationContext::create()->setSerializeNull(true)
              )
            : null;
    }

    /**
     *
     * @return \JMS\Serializer\Serializer
     */
    private static function getSerializer()
    {
        if (null == self::$serializer) {
            self::setSerializer();
        }

        return self::$serializer;
    }

    /**
     *
     * @return void
     */
    private static function setSerializer()
    {
        \Doctrine\Common\Annotations\AnnotationRegistry::registerLoader('class_exists');

        $builder = \JMS\Serializer\SerializerBuilder::create();
        $builder->addDefaultHandlers();

        self::$serializer = $builder->build();
    }

    /**
     *
     * {@inheritDoc}
     * @see \Application\Factory\EntityFactoryInterface::toArray()
     */
    public static function toArray($object)
    {
        return self::getSerializer()->toArray($object);
    }

    /**
     *
     * {@inheritDoc}
     * @see \Application\Factory\EntityFactoryInterface::toJson()
     */
    public static function toJson($object)
    {
        return self::getSerializer()->serialize(
            $object,
            'json',
            \JMS\Serializer\SerializationContext::create()->setSerializeNull(true)
        );
    }
}
