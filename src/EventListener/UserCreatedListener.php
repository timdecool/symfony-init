<?php
namespace App\EventListener;

use App\Entity\User;
use Doctrine\ORM\Event\PostPersistEventArgs;

class UserCreatedListener
{
    // Le listener a besoin de deux arguments : l'instance de l'entité et le lifecycle event
    public function postPersist(
        User $user,
        PostPersistEventArgs $event
    ) : void
    {
        dd('stop');               
    }
}