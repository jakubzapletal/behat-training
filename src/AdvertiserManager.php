<?php

namespace Training;

use Training\Storage\Storage;

class AdvertiserManager
{
    /** @var Storage */
    private $storage;

    public function __construct(Storage $storage)
    {
        $this->storage = $storage;
    }

    /**
     * @param int $id
     *
     * @return null|Advertiser
     */
    public function findById($id)
    {
        $advertiser = $this->storage->findAdvertiserById($id);

        return $advertiser;
    }

    /**
     * @param int $id
     * @param string $name
     */
    public function create($id, $name)
    {
        $this->storage->createAdvertiser($id, $name);
    }
}
