<?php

namespace Thomisticus\MappableModels\Mapping;

class ModelMappingFile
{
    private $content;

    /**
     * ModelMappingFile constructor.
     */
    public function __construct()
    {
        $this->loadFile();
    }

    /**
     * @return mixed
     */
    private function getFilePath()
    {
        $fileName = config('mappable-models.model_mapping.file');
        return base_path("database/mappings/{$fileName}.php");
    }


    private function loadFile()
    {
        $file = $this->getFilePath();
        if (is_null($file)) {
            throw new \RuntimeException("Mapping file {$file} is not defined");
        }

        $this->content = include($file);
    }

    /**
     * @param $key
     * @return array
     */
    public function getContent($key): array
    {
        return array_get($this->content, $key);
    }
}
