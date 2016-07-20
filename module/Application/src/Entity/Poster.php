<?php

/**
 * Poster.php
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
 * Poster
 *
 * @package Application
 *
 * @method string  getSize
 * @method integer getSourceUrl
 */
class Poster extends AbstractEntity
{

    /**
     *
     * @SerializeType("string") @SerializeName("size")
     * @var string
     */
    protected $size;

    /**
     *
     * @SerializeType("string") @SerializeName("source_url")
     * @var string
     */
    protected $sourceUrl;

    // Size constants
    const SIZE_LARGE  = 'large';
    const SIZE_MEDIUM = 'medium';
    const SIZE_SMALL  = 'small';
}
