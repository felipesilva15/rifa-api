<?php

namespace App\Libs;

class ResourceManager {
    private string $resourceClass;
    private mixed $data;

    public function __construct(string $resourceClass, mixed $data) {
        $this->resourceClass = $resourceClass;
        $this->data = $data;
    }

    public function convertDataToResource(): mixed {
        $resource = $this->data;

        if (class_exists($this->resourceClass)) {
            $resource = new $this->resourceClass($this->data);
        }

        return $resource;
    }

    public function convertDataToResourceCollection(): mixed {
        $resource = $this->data;

        if (class_exists($this->resourceClass)) {
            $resource = $this->resourceClass::collection($this->data);
        }

        return $resource;
    }
}