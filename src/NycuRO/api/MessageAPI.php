<?php

declare(strict_types = 1);

namespace NycuRO\api;

use NycuRO\API;
use NycuRO\query\{
    PMQueryException
};
use pocketmine\Player;

/**
 * author: NycuRO
 * LobbyUtils Project
 */
class MessageAPI {

    /** @var API */
    public $API;

    /**
     * MessageAPI constructor.
     * @param API $API
     */
    public function __construct(API $API) {
        $this->API = $API;
    }

    /**
     * @param Player $player
     */
    public function sendMessageTransfer(Player $player) : void{
        $config = $this->API::getAPI()->getConfig()->getAll();
        $message = "";
        if ($config["messageTransfer"]) {
            $message = $config["messageTransfer"];
        }
        if ($this->API::getMechanicAPI()->isMessageEnabled() == true) {
            $player->sendMessage($message);
        }
    }

    /**
     * @param Player $player
     */
    public function sendTitleTransfer(Player $player) : void{
        $config = $this->API::getAPI()->getConfig()->getAll();
        $messageTitle = "";
        $messageSubTitle = "";
        if ($config["titleOnTranfer"]) {
            $messageTitle = $config["titleOnTranfer"];
        }
        if ($config["subtitleOnTransfer"]) {
            $messageSubTitle = $config["subtitleOnTransfer"];
        }
        if ($this->API::getMechanicAPI()->isTitleEnabled() == true && $this->API::getMechanicAPI()->isSubTitleEnabled() == true) {
            $player->addTitle($messageTitle, $messageSubTitle);
        } else if ($this->API::getMechanicAPI()->isTitleEnabled() == true && $this->API::getMechanicAPI()->isSubTitleEnabled() == false) {
            $player->addTitle($messageTitle);
        }
    }

    /**
     * @param Player $player
     * @throws PMQueryException
     */
    public function sendGlobalListMessage(Player $player) : void{
        $config = $this->API::getAPI()->getConfig()->getAll();
        $messageGlobalList = "";
        $messageGlobalListFinal = "";
        if ($config["messageGlobalList"]) {
            $messageGlobalList = $config["messageGlobalList"];
            $messageGlobalListFinal = str_replace("[players]", $this->API::getSlotsAPI()->getSlots(), $messageGlobalList);
            $messageGlobalListFinal = str_replace("[maxplayers]", $this->API::getSlotsAPI()->getMaxSlots(), $messageGlobalList);
        }
        $player->sendMessage($messageGlobalListFinal);
    }
}