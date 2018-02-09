<?php

declare(strict_types=1);

namespace App\Event;

use Doctrine\ORM\Event\OnFlushEventArgs;
use Symfony\Component\VarDumper\VarDumper;

class DumpChanges
{
    public function onFlush(OnFlushEventArgs $args): void
    {
        $em = $args->getEntityManager();
        $uow = $em->getUnitOfWork();

        VarDumper::dump('insertions');
        foreach ($uow->getScheduledEntityInsertions() as $entity) {
            VarDumper::dump($entity);
        }

        VarDumper::dump('updates');
        foreach ($uow->getScheduledEntityUpdates() as $entity) {
            VarDumper::dump($entity);
        }

        VarDumper::dump('deletions');
        foreach ($uow->getScheduledEntityDeletions() as $entity) {
            VarDumper::dump($entity);
        }

        VarDumper::dump('collectionDeletions');
        foreach ($uow->getScheduledCollectionDeletions() as $col) {
            VarDumper::dump($col);
        }

        VarDumper::dump('collectionUpdates');
        foreach ($uow->getScheduledCollectionUpdates() as $col) {
            VarDumper::dump($col);
        }

        //exit;

    }
}