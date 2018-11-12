<?php

namespace Owner\Model\Entity;

trait OwnerTrait
{
    public function isOwnedBy($user)
    {
        return $this->get('user_id') === $user->id;
    }
}