<?php

/**
 * VideoController.php
 *
 * @copyright Copyright (c) Mathias Schilling <m@matchilling>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */
namespace Application\Controller;

use \Application\Service;

/**
 *
 * VideoController
 *
 * @package Application
 *
 */
class VideoController extends \Zend\Mvc\Controller\AbstractActionController
{

    /**
     *
     * @var Service\VideoProviderInterface
     */
    private $videoProvider;

    /**
     *
     * @param Service\VideoProviderInterface $videoProvider
     */
    public function __construct(Service\VideoProviderInterface $videoProvider)
    {
        $this->videoProvider = $videoProvider;
    }

    /**
     *
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        if (! $id = $this->params('id')) {
            $this->notFoundAction();
        }

        if (! ($video = $this->videoProvider->findById($id)) instanceof \Application\Entity\Video) {
            $this->notFoundAction();
        }

        return new \Zend\View\Model\ViewModel([
            'video' => $video
        ]);
    }
}