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
        $config = $this->API::getAPI()->getConfig()->getAll();
        if ($config["enableTransfer"] == true) {
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
        $config = $this->API::getAPI()->getConfig()->getAll();
        if ($config["enableMessage"] == true) {
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
        $config = $this->API::getAPI()->getConfig()->getAll();
        if ($config["enableTitle"] == true) {
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
        $config = $this->API::getAPI()->getConfig()->getAll();
        if ($config["enableSubTitle"] == true) {
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
        $config = $this->API::getAPI()->getConfig()->getAll();
        if ($config["enableGlobalList"] == true) {
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
        $config = $this->API::getAPI()->getConfig()->getAll();
        if ($config["servers"] == true) {
            $servers = $config["servers"];
        }
        return $servers;
    }
}