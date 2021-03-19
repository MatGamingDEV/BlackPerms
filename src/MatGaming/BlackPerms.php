<?php


namespace MatGaming;


use MatGaming\Events\PlayersEvents;
use MatGaming\Utils\MessagesManager;
use MatGaming\Utils\PermsManager;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class BlackPerms extends PluginBase
{
    /**
     * @var BlackPerms
     */
    private static BlackPerms $instance;

    /**
     * @var Config
     */
    private Config $settings;

    /**
     * @var Config
     */
    private Config $lang;

    /**
     * @var Config
     */
    private Config $groupsData;

    /**
     * @var MessagesManager
     */
    private MessagesManager $messagesManager;

    /**
     * @var PermsManager
     */
    private PermsManager $permsManager;

    public function onEnable()
    {
        self::$instance = $this;
        $this->messagesManager = new MessagesManager($this);
        $this->permsManager = new PermsManager($this);
        $this->initConfig();
        $this->registerCommands();
        $this->registerEvents();
    }

    public static function getInstance(): BlackPerms
    {
        return self::$instance;
    }

    public function getMessageManager(): MessagesManager
    {
        return $this->messagesManager;
    }

    public function getPermsManager(): PermsManager
    {
        return $this->permsManager;
    }

    private function registerCommands(): void
    {
        $commandMap = $this->getServer()->getCommandMap();
        $commandMap->registerAll("BlackPerms", [

        ]);
    }

    private function initConfig(): void
    {
        $DataFolder = $this->getDataFolder();
        @mkdir($DataFolder."data");
        @mkdir($DataFolder."data/players");
        @mkdir($DataFolder."lang");
        $this->saveResource("settings.yml");
        $this->saveResource("data/groups.json");
        $this->settings = new Config($DataFolder."settings.yml", Config::YAML);
        $this->lang = new Config($DataFolder."lang/lang-".$this->settings->get("lang").".json", Config::JSON);
        $this->groupsData = new Config($DataFolder."data/groups.json", Config::JSON);
    }

    public function getLangFile(): Config
    {
        return $this->lang;
    }

    public function getDataFile(): Config
    {
        return $this->groupsData;
    }

    public function getSettingsFile(): Config
    {
        return $this->settings;
    }

    private function registerEvents(): void
    {
        $this->getServer()->getPluginManager()->registerEvents(new PlayersEvents($this), $this);
    }

}