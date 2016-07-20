<?php

/**
 * SearchController.php
 *
 * @copyright Copyright (c) Mathias Schilling <m@matchilling>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */
namespace Application\Controller;

use \Application\Service;
use \Application\Entity\VideoCollection;

/**
 *
 * SearchController
 *
 * @package Application
 *
 */
class SearchController extends \Zend\Mvc\Controller\AbstractActionController
{

    /**
     *
     * @var integer
     */
    private $maxItems;

    /**
     *
     * @var Service\VideoProviderInterface
     */
    private $videoProvider;

    /**
     *
     * @param Service\VideoProviderInterface $videoProvider
     * @param integer $maxItems
     */
    public function __construct(Service\VideoProviderInterface $videoProvider, $maxItems = 50)
    {
        $this->videoProvider = $maxItems;
        $this->videoProvider = $videoProvider;
    }

    /**
     *
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $response = null;
        $page     = (int) $this->getRequest()->getQuery('page', 1);

        if ($query = $this->getRequest()->getQuery('q', null)) {
            $response = $this->videoProvider->search($query,
                [
                    'page'  => $page,
                    'limit' => $this->maxItems
                ]
            );
        }

        return new \Zend\View\Model\ViewModel(
            [
                'providerName' => $this->videoProvider->getProviderName(),
                'videos'       => $response instanceof VideoCollection ? $response : new VideoCollection(),
                'query'        => $query,
                'page'         => $page
            ]);
    }
}