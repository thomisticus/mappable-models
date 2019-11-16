<?php

namespace Thomisticus\MappableModels\Mapping;

use Illuminate\Support\Arr;

class ModelMappingFile
{
    /**
     * Mapping file content (database/mappings/foo.php")
     * @var array
     */
    private $content;

    /**
     * ModelMappingFile constructor.
     */
    public function __construct()
    {
        $this->loadFileContent();
    }

    /**
     * Retrieves the mapping file path according to it's name on config file.
     * Usually this file is stored at: "database/mappings/" folder.
     *
     * @return string
     */
    private function getFilePath()
    {
        $fileName = config('mappable-models.model_mapping.file');
        return base_path("database/mappings/{$fileName}.php");
    }

    /**
     * Loads $content class' property. According to the mapping file.
     */
    private function loadFileContent()
    {
        $file = $this->getFilePath();

        if (is_null($file)) {
            throw new \RuntimeException("Mapping file {$file} is not defined");
        }

        $this->content = include($file);
    }

    /**
     * Retrieves the content of a specific key inside $content array property
     *
     * @param string $key
     * @return array
     */
    public function getContent($key): array
    {
        return Arr::get($this->content, $key);
    }
}
