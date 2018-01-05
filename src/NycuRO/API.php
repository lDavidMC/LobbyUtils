<?php

declare(strict_types = 1);

namespace NycuRO;

use NycuRO\api\{
    MechanicAPI, MessageAPI, SlotsAPI
};

/**
 * author: NycuRO
 * LobbyUtils Project
 */
class API {

    /** @var LobbyUtils $mainAPI */
    public static $mainAPI;

    /** @var MechanicAPI $mechanicAPI */
    public static $mechanicAPI;

    /** @var MessageAPI $messageAPI */
    public static $messageAPI;

    /** @var SlotsAPI $slotsAPI */
    public static $slotsAPI;

    /**
     * @return LobbyUtils
     */
    public static function getAPI() {
        return self::$mainAPI;
    }

    /**
     * @return MechanicAPI
     */
    public static function getMechanicAPI() {
        return self::$mechanicAPI;
    }

    /**
     * @return MessageAPI
     */
    public static function getMessageAPI() {
        return self::$messageAPI;
    }

    /**
     * @return SlotsAPI
     */
    public static function getSlotsAPI() {
        return self::$slotsAPI;
    }
}