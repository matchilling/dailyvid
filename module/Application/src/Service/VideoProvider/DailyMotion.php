<?php

/**
 * DailyMotion.php
 *
 * @copyright Copyright (c) Mathias Schilling <m@matchilling>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */
namespace Application\Service\VideoProvider;

/**
 *
 * DailyMotion
 *
 * @package Application
 *
 */
class DailyMotion implements \Application\Service\VideoProviderInterface
{

    /**
     *
     * @var \Dailymotion
     */
    private static $api;

    /**
     *
     * @var \Application\Service\VideoProvider\DailyMotion\Mapper
     */
    private static $mapper;

    /**
     * Default fields for api calls
     *
     * @var array
     */
    private static $fields = [
        'available_formats',
        'channel',
        'comments_total',
        'description',
        'duration',
        'genre',
        'id',
        'owner',
        'title',
        'updated_time',
        'url',
        'views_total',
        'thumbnail_large_url',
        'thumbnail_medium_url',
        'thumbnail_small_url'
    ];

    /**
     *
     * @var string
     */
    const PROVIDER_NAME = 'dailymotion';

    /**
     *
     * @param \Dailymotion $api
     */
    public function __construct(\Dailymotion $api, \Application\Service\VideoProvider\DailyMotion\Mapper $mapper)
    {
        self::$api    = $api;
        self::$mapper = $mapper;
    }

    /**
     *
     * {@inheritDoc}
     * @see \Application\Service\VideoInterface::getProviderName()
     */
    public function getProviderName()
    {
        return self::PROVIDER_NAME;
    }

    /**
     *
     * {@inheritDoc}
     * @see \Application\Service\VideoInterface::findById()
     */
    public function findById($id)
    {
        $response = self::$api->get(sprintf('/video/%s', $id), [
            'fields' => self::$fields
        ]);

        return $response
            ? self::$mapper->convertVideo($response)
            : null;
    }

    /**
     *
     * {@inheritDoc}
     * @see \Application\Service\VideoInterface::search()
     */
    public function search($query, array $options = [])
    {
        $response = self::$api->get('/videos', [
            'fields' => self::$fields,
            'search' => $query,
            'page'   => isset($options['page']) ? $options['page'] : 1,
            'limit'  => isset($options['limit']) ? $options['limit'] : 25
        ]);

        return $response
            ? self::$mapper->convertVideoCollection($response)
            : null;
    }
}
