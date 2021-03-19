<?php


namespace MatGaming\Entities;


use MatGaming\BlackPerms;
use pocketmine\Player;

class BlackPlayer extends Player
{
    public function addPermissions(array $permissions): void
    {
        foreach ($permissions as $permission){
            $this->addAttachment(BlackPerms::getInstance())->setPermission($permission, true);
            $this->addAttachment(BlackPerms::getInstance(), $permission);
        }
    }

    public function removePermissions(array $permissions): void
    {
        foreach ($permissions as $permission){
            $this->addAttachment(BlackPerms::getInstance())->unsetPermission($permission);
            $this->addAttachment(BlackPerms::getInstance(), $permission);
        }
    }

}