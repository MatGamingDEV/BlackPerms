<?php


namespace MatGaming\Entities;


use MatGaming\BlackPerms;
use MatGaming\Utils\PermsManager;
use pocketmine\Player;

class BlackGroups
{
    /**
     * @var PermsManager
     */
    private PermsManager $manager;

    private string $name;

    private array $players;

    private array $permissions;

    public function __construct(PermsManager $manager, string $name, array $players = [], array $permissions = [])
    {
        $this->manager = $manager;
        $this->name = $name;
        $this->players = $players;
        $this->permissions = $permissions;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return array
     */
    public function getPermissions(): array
    {
        return $this->permissions;
    }


    /**
     * @param array $permissions
     */
    public function setPermissions(array $permissions): void
    {
        $this->permissions = $permissions;
    }

    /**
     * @return array
     */
    public function getPlayers(): array
    {
        return $this->players;
    }

    /**
     * @param array $players
     */
    public function setPlayers(array $players): void
    {
        $this->players = $players;
    }

    public function addPlayer(Player $player): void
    {
        $this->players[$player->getName()] = $player;
    }

    public function addPermission(string $permission): void
    {
        $this->permissions[$permission] = $permission;
    }

}