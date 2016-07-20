<?php

/**
 * Mapper.php
 *
 * @copyright Copyright (c) Mathias Schilling <m@matchilling>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */
namespace Application\Service\VideoProvider\DailyMotion;

use \Application\Entity\Poster;

/**
 *
 * DailyMotion
 *
 * @package Application
 *
 */
class Mapper implements \Application\Service\VideoProvider\MapperInterface
{

    /**
     *
     * @var \Application\Factory\EntityFactoryInterface
     */
    private static $entityFactory;

    /**
     *
     * @param  \Application\Factory\EntityFactoryInterface $entityFactory
     * @return void
     */
    public function __construct(\Application\Factory\EntityFactoryInterface $entityFactory)
    {
        self::$entityFactory = $entityFactory;
    }

    /**
     *
     * {@inheritDoc}
     * @see \Application\Service\VideoProvider\MapperInterface::convertVideo()
     */
    public function convertVideo($data, $denormalize = true)
    {

        $map = [
            'channel'        => $data['channel'],
            'comments_count' => $data['comments_total'],
            'description'    => $data['description'],
            'duration'       => $data['duration'],
            'source_id'      => $data['id'],
            'source_url'     => $data['url'],
            'title'          => $data['title'],
            'view_count'     => $data['views_total']
        ];

        $sizes = [
            'thumbnail_large_url'  => Poster::SIZE_LARGE,
            'thumbnail_medium_url' => Poster::SIZE_MEDIUM,
            'thumbnail_small_url'  => Poster::SIZE_SMALL
        ];

        foreach ($sizes as $sourceSize => $targetSize) {
            if ($data[$sourceSize]) {
                $map['posters'][] = [
                    'size'       => $targetSize,
                    'source_url' => $data[$sourceSize]
                ];
            }
        }

        return $denormalize
            ? self::$entityFactory->fromArray(\Application\Entity\Video::class, $map)
            : $map;
    }

    /**
     *
     * {@inheritDoc}
     * @see \Application\Service\VideoProvider\MapperInterface::convertVideoCollection()
     */
    public function convertVideoCollection($data)
    {
        $map = [
            'has_more_pages' => $data['has_more'],
            'items'          => [],
            'limit'          => $data['limit'],
            'page'           => $data['page'],
            'total'          => $data['total']
        ];

        foreach ($data['list'] as $video) {
            array_push($map['items'], $this->convertVideo($video, false));
        }

        return self::$entityFactory->fromArray(\Application\Entity\VideoCollection::class, $map);
    }
}
