<?php

declare(strict_types = 1);

namespace NycuRO;

use NycuRO\api\{
    MechanicAPI, MessageAPI, SlotsAPI
};
use NycuRO\query\{
    PMQueryException
};
use pocketmine\Player;
use pocketmine\command\{
    Command, CommandSender, ConsoleCommandSender
};
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

/**
 * author: NycuRO
 * LobbyUtils Project
 */
class LobbyUtils extends PluginBase {

    public $ip = "";
    public $port = 19132;
    public $enableTransfer = true;
    public $enableMessage = true;
    public $enableTitle = true;
    public $enableSubTitle = true;
    public $enableGlobalList = true;
    public $messageTransfer = "";
    public $titleOnTransfer = "";
    public $subtitleOnTransfer = "";
    public $messageGlobalList = "";
    public $servers = [];

    public function onLoad() {
        if (!(API::getAPI() instanceof $this)) {
            API::$mainAPI = $this;
        } else if (!(API::$mechanicAPI instanceof MechanicAPI)) {
            API::$mechanicAPI = new MechanicAPI(new API());
        } else if (!(API::getMessageAPI() instanceof MessageAPI)) {
            API::$messageAPI = new MessageAPI(new API());
        } else if (!(API::getSlotsAPI() instanceof SlotsAPI)) {
            API::$slotsAPI = new SlotsAPI(new API());
        }
    }

	public function onEnable() {
        $files = array("config.yml");
        foreach($files as $file){
            if(!file_exists($this->getDataFolder() . $file)) {
                @mkdir($this->getDataFolder());
                file_put_contents($this->getDataFolder() . $file, $this->getResource($file));
            }
        }
        $this->cfg = new Config($this->getDataFolder() . "config.yml", Config::YAML);
        $this->ip = $this->cfg->get("ip");
        $this->port = $this->cfg->get("port");
        $this->enableTransfer = $this->cfg->get("enableTransfer");
        $this->enableMessage = $this->cfg->get("enableMessage");
        $this->enableTitle = $this->cfg->get("enableTitle");
        $this->enableSubTitle = $this->cfg->get("enableSubTitle");
        $this->enableGlobalList = $this->cfg->get("enableGlobalList");
        $this->messageTransfer = $this->cfg->get("messageTransfer");
        $this->titleOnTransfer = $this->cfg->get("titleOnTranfer");
        $this->subtitleOnTransfer = $this->cfg->get("subtitleOnTransfer");
        $this->messageGlobalList = $this->cfg->get("messageGlobalList");
        $this->servers = $this->cfg->get("servers");
		$this->saveDefaultConfig();
		$this->reloadConfig();
	}

    /**
     * @param CommandSender $sender
     * @param Command $command
     * @param string $label
     * @param array $args
     * @return bool
     * @throws PMQueryException
     */
    public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
        if (!$sender instanceof Player) return false;
        switch ($command->getName()) {
            case "hub":
                API::getMessageAPI()->sendMessageTransfer($sender);
                API::getMessageAPI()->sendTitleTransfer($sender);
                if (API::getMechanicAPI()->isTransferEnabled() == true) {
                    $sender->transfer($this->ip, $this->port);
                }
                break;
            case "glist":
                if (API::getMechanicAPI()->isGlobalListEnabled() == true) {
                    API::getMessageAPI()->sendGlobalListMessage($sender);
                }
                break;
        }
        return true;
    }
}