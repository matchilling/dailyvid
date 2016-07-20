<?php

/**
 * VideoCollection.php
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
 * VideoCollection
 *
 * @package Application
 *
 * @method boolean hasMorePages
 * @method Video[] getItems
 * @method integer getLimit
 * @method integer getPaget
 * @method integer getTotal
 *
 */
class VideoCollection extends AbstractEntity
{

    /**
     *
     * @SerializeType("boolean") @SerializeName("has_more_pages")
     * @var boolean
     */
    protected $hasMorePages;

    /**
     *
     * @SerializeType("array<Application\Entity\Video>") @SerializeName("items")
     * @var Application\Entity\Video[]
     */
    protected $items;

    /**
     *
     * @SerializeType("integer") @SerializeName("limit")
     * @var int
     */
    protected $limit;

    /**
     *
     * @SerializeType("integer") @SerializeName("page")
     * @var int
     */
    protected $page;

    /**
     *
     * @SerializeType("integer") @SerializeName("total")
     * @var integer
     */
    protected $total;

    /**
     *
     * @return integer
     */
    public function getNumberOfPages()
    {
        return abs($total / $limit);
    }
}
