<?php

/**
 * VideoProviderInterface.php
 *
 * @copyright Copyright (c) Mathias Schilling <m@matchilling>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */
namespace Application\Service;

/**
 *
 * VideoProviderInterface
 *
 * @package Application
 *
 */
interface VideoProviderInterface
{

    /**
     *
     * @return string
     */
    public function getProviderName();

    /**
     * Get video details by its id
     *
     * @param  string $id
     * @return \Application\Entity\Video
     */
    public function findById($id);

    /**
     * Find videos by a search term
     *
     * $options['page']  integer Page number
     * $options['limit'] integer Max number of items per page
     *
     * @param  string  $query
     * @param  options $options
     *
     * @return \Application\Entity\VideoCollection
     */
    public function search($query, array $options);
}
