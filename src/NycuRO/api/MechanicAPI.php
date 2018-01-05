<?php

declare(strict_types = 1);

namespace NycuRO\api;

use NycuRO\API;

/**
 * author: NycuRO
 * LobbyUtils Project
 */
class MechanicAPI {

    /** @var API $API */
    public $API;

    /**
     * MechanicAPI constructor.
     * @param API $API
     */
    public function __construct(API $API) {
        $this->API = $API;
    }

    /**
     * @param bool $isEnabled
     * @return bool
     */
    public function isTransferEnabled(bool $isEnabled = true): bool{
        $config = API::getAPI()->enableTransfer;
        if ($config == true) {
            return $isEnabled;
        } else {
            return ($isEnabled = false);
        }
    }

    /**
     * @param bool $isEnabled
     * @return bool
     */
    public function isMessageEnabled(bool $isEnabled = true) : bool{
        $config = API::getAPI()->messageTransfer;
        if ($config == true) {
            return $isEnabled;
        } else {
            return ($isEnabled = false);
        }
    }

    /**
     * @param bool $isEnabled
     * @return bool
     */
    public function isTitleEnabled(bool $isEnabled = true) : bool{
        $config = API::getAPI()->enableTitle;
        if ($config == true) {
            return $isEnabled;
        } else {
            return ($isEnabled = false);
        }
    }

    /**
     * @param bool $isEnabled
     * @return bool
     */
    public function isSubTitleEnabled(bool $isEnabled = true) : bool{
        $config = API::getAPI()->enableSubTitle;
        if ($config == true) {
            return $isEnabled;
        } else {
            return ($isEnabled = false);
        }
    }

    /**
     * @param bool $isEnabled
     * @return bool
     */
    public function isGlobalListEnabled(bool $isEnabled = true) : bool{
        $config = API::getAPI()->enableGlobalList;
        if ($config == true) {
            return $isEnabled;
        } else {
            return ($isEnabled = false);
        }
    }

    /**
     * @param array $servers
     * @return array
     */
    public function getServers(array $servers = []) : array{
        $config = explode(" ", API::getAPI()->servers);
        if ($config) {
            $servers = $config;
        }
        return $servers;
    }
}