<?php


namespace App\Service\Listener;


use App\Entity\Company\Company;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use SymfonyBundles\RedisBundle\Redis\ClientInterface;

class CompanyChangeListener implements AutoLoadedEventListener
{

    public const COMPANY_NAME_CHANGE_QUEUE_ID = 'company.name.change';

    protected ClientInterface $redis;

    public function __construct(ClientInterface $redis)
    {
        $this->redis = $redis;
    }

    public function getSubscribedEvents()
    {
        return [Events::postUpdate];
    }

    public final function postUpdate(LifecycleEventArgs $eventArgs)
    {
        $entity = $eventArgs->getEntity();
        if ($entity instanceof Company) {
            // MAP OF KEY => 0 => OLD VALUE, 1 => NEW VALUE of ENTITY ATTRIBUTE
            $changeSet = $eventArgs->getEntityManager()->getUnitOfWork()->getEntityChangeSet($entity);
            var_dump($changeSet);
            if (isset($changeSet['name'])) {
                $this->redis->push(self::COMPANY_NAME_CHANGE_QUEUE_ID, $entity->getId());
            }
        }
    }
}
