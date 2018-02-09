<?php

declare(strict_types=1);

namespace App\Event;

use Doctrine\ORM\Event\LifecycleEventArgs;

class TimestampableModel
{
    /**
     * Add createdAt timestamp
     * 
     * @param LifeCycleEventArgs $args
     */
    public function prePersist(LifeCycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if ($this->hasTimestampableModelCreateTrait($entity) === true) {
            $entity->setCreatedAt(new \DateTime());
        }
    }

    private function hasTimestampableModelCreateTrait($entity)
    {
        if (array_key_exists('App\Component\Core\Model\TimestampableTrait', class_uses($entity))) {
            return true;
        }

        return false;
    }
    
    /**
     * Add updatedAt timestamp
     * 
     * @param LifecycleEventArgs $args
     */
    public function preUpdate(LifeCycleEventArgs $args)
    {
        $entity = $args->getEntity();
        
        if ($this->hasTimestampableModelUpdateTrait($entity) === true) {
            $entity->setUpdatedAt(new \DateTime());
        }
    }

    private function hasTimestampableModelUpdateTrait($entity)
    {
        if (array_key_exists('App\Component\Core\Model\TimestampableTrait', class_uses($entity))) {
            return true;
        }

        return false;
    }
}