<?php

declare(strict_types = 1);

namespace NycuRO\api;

use NycuRO\API;
use NycuRO\query\{
    PMQuery, PMQueryException
};

/**
 * author: NycuRO
 * LobbyUtils Project
 */
class SlotsAPI {

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
     * @return int
     * @throws PmQueryException
     */
    public function getSlots(): int{
        $servers = API::getMechanicAPI()->getServers();

        $slots = 0;
        $slotsServer = count(API::getAPI()->getServer()->getOnlinePlayers());
        foreach ($servers as $server) {
            $parts = explode(":", $server);
            $query = PMQuery::query($parts[0], $parts[1] ?? 19132);
            $slots += $query["num"];
        }

        return ($slotsFinal = $slots + $slotsServer);
    }

    /**
     * @return int
     * @throws PmQueryException
     */
    public function getMaxSlots(): int{
        $servers = (array) API::getMechanicAPI()->getServers();

        $maxSlots = 0;
        $slotsServer = API::getAPI()->getServer()->getMaxPlayers();
        foreach($servers as $server) {
            $parts = explode(":", $server);
            $query = PMQuery::query($parts[0], $parts[1] ?? 19132);
            $maxSlots += $query["max"];
        }

        return ($maxSlotsFinal = $maxSlots + $slotsServer);
    }

}