<?php

namespace G4\Version;

class Version
{

    const DEFAULT_VERSION = '0.0.0';

    /**
     * @var string
     */
    private $versionNumber;

    /**
     * @var string
     */
    private $path;

    public function __construct($path)
    {
        $this->path = realpath($path);
    }

    public function getVersionNumber()
    {
        if(!isset($this->versionNumber)) {
            $this->loadVersion();
        }
        return $this->versionNumber;
    }

    private function loadVersion()
    {
        if ($this->path) {
            $rawData = file_get_contents($this->path);
            if (!empty($rawData)) {
                $data = json_decode($rawData, true);
            }
        }
        $this->versionNumber = empty($data['version']) ? self::DEFAULT_VERSION : $data['version'];
    }
}