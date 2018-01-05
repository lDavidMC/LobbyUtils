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
        $message = API::getAPI()->messageTransfer;
        if (API::getMechanicAPI()->isMessageEnabled() == true) {
            $player->sendMessage($message);
        }
    }

    /**
     * @param Player $player
     */
    public function sendTitleTransfer(Player $player) : void{
        $messageTitle = API::getAPI()->titleOnTransfer;
        $messageSubTitle = API::getAPI()->subtitleOnTransfer;
        if (API::getMechanicAPI()->isTitleEnabled() == true && API::getMechanicAPI()->isSubTitleEnabled() == true) {
            $player->addTitle($messageTitle, $messageSubTitle);
        } else if (API::getMechanicAPI()->isTitleEnabled() == true && API::getMechanicAPI()->isSubTitleEnabled() == false) {
            $player->addTitle($messageTitle);
        }
    }

    /**
     * @param Player $player
     * @throws PMQueryException
     */
    public function sendGlobalListMessage(Player $player) : void{
        $config = API::getAPI()->getConfig()->getAll();
        $messageGlobalList = API::getAPI()->messageGlobalList;
        if ($config["messageGlobalList"]) {
            $messageGlobalList = str_replace("[players]", API::getSlotsAPI()->getSlots(), $messageGlobalList);
            $messageGlobalList = str_replace("[maxplayers]", API::getSlotsAPI()->getMaxSlots(), $messageGlobalList);
        }
        $player->sendMessage($messageGlobalList);
    }
}