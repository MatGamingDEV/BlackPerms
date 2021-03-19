<?php


namespace MatGaming\Utils;


use MatGaming\BlackPerms;
use pocketmine\Player;
use pocketmine\utils\Config;

class PermsManager
{
    /**
     * @var BlackPerms
     */
    private BlackPerms $plugin;

    public function __construct(BlackPerms $plugin)
    {
        $this->plugin = $plugin;
    }

    public function checkPlayerFileExist(Player $player): bool
    {
        $DataFolder = $this->plugin->getDataFolder();
        $name = strtolower($player->getName());
        return file_exists($DataFolder."data/players/$name.json");
    }

    public function createPlayerFile(Player $player): void
    {
        $DataFolder = $this->plugin->getDataFolder();
        $name = strtolower($player->getName());
        $data = new Config($DataFolder."data/players/$name.json", Config::JSON, [
            "name" => $player->getName(),
            "group" => $this->getDefaultGroup(),
        ]);
    }

    private function getDefaultGroup(): string
    {
        return $this->plugin->getSettingsFile()->get("default-group");
    }

}