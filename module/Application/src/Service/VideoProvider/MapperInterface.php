<?php

/**
 * MapperInterface.php
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
 * MapperInterface
 *
 * @package Application
 *
 */
interface MapperInterface
{

    /**
     *
     * @param  mixed   $data
     * @param  boolean $denormalize
     * @return \Application\Entity\Video
     */
    public function convertVideo($data, $denormalize = true);

    /**
     *
     * @param  mixed $data
     * @return \Application\Entity\VideoCollection
     */
    public function convertVideoCollection($data);
}
