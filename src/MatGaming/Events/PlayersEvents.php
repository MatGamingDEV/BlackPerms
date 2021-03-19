<?php


namespace MatGaming\Events;


use MatGaming\BlackPerms;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerPreLoginEvent;

class PlayersEvents implements Listener
{
    /**
     * @var BlackPerms
     */
    private BlackPerms $plugin;

    public function __construct(BlackPerms $plugin)
    {
        $this->plugin = $plugin;
    }

    public function loginPlayer(PlayerPreLoginEvent $ev)
    {
        $permsManager = $this->plugin->getPermsManager();
        $pl = $ev->getPlayer();
        if (!$permsManager->checkPlayerFileExist($pl)){
            $permsManager->createPlayerFile($pl);
        }
    }
}