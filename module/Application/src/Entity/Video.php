<?php

/**
 * Video.php
 *
 * @copyright Copyright (c) Mathias Schilling <m@matchilling>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */
namespace Application\Entity;

use \JMS\Serializer\Annotation\SerializedName as SerializeName;
use \JMS\Serializer\Annotation\Type as SerializeType;

/**
 *
 * Video
 *
 * @package Application
 *
 * @method string   getChannel
 * @method integer  getCommentsCount
 * @method string   getDescription
 * @method string   getChannel
 * @method integer  getDuration
 * @method Poster[] getPosters
 * @method string   getSourceId
 * @method string   getSourceUrl
 * @method string   getTitle
 * @method integer  getViewCount
 *
 */
class Video extends AbstractEntity
{

    /**
     *
     * @SerializeType("string") @SerializeName("channel")
     * @var string
     */
    protected $channel;

    /**
     *
     * @SerializeType("integer") @SerializeName("comments_count")
     * @var int
     */
    protected $commentsCount;

    /**
     *
     * @SerializeType("string") @SerializeName("description")
     * @var string
     */
    protected $description;

    /**
     * Duration in seconds
     *
     * @SerializeType("integer") @SerializeName("duration")
     * @var int
     */
    protected $duration;

    /**
     *
     * @SerializeType("array<Application\Entity\Poster>") @SerializeName("posters")
     * @var Application\Entity\Poster[]
     */
    protected $posters;

    /**
     *
     * @SerializeType("string") @SerializeName("source_id")
     * @var string
     */
    protected $sourceId;

    /**
     *
     * @SerializeType("string") @SerializeName("source_url")
     * @var string
     */
    protected $sourceUrl;

    /**
     *
     * @SerializeType("string") @SerializeName("title")
     * @var string
     */
    protected $title;

    /**
     *
     * @SerializeType("string") @SerializeName("view_count")
     * @var int
     */
    protected $viewCount;

    /**
     *
     * @param  string $size
     * @param  string $default
     * @return NULL|string|\Application\Entity\Poster
     */
    public function getPosterOrDefault($size = Poster::SIZE_180x240, $default = null)
    {
        if (! is_array($this->posters)) {
            return $default ? $default : null;
        }

        foreach ($this->getPosters() as $poster) {
            if ($size === $poster->getSize()) {
                return $poster->getSourceUrl();
            }
        }

        return $default ? $default : null;
    }
}
