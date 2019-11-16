<?php

namespace Thomisticus\MappableModels\Mapping;

use Illuminate\Support\Arr;

class ModelMapping
{
    /**
     * Database mapping file content. i.e.: config/example.php
     * @var array
     */
    private $content = [];

    /**
     * ModelMapping constructor.
     * @param string $key
     */
    public function __construct(string $key)
    {
        $file = new ModelMappingFile();
        $this->content = $file->getContent($key);
    }

    /**
     * Check if model_mapping is enabled according to config file
     * @return mixed
     */
    public static function isEnabled()
    {
        return config('mappable-models.model_mapping.enabled');
    }

    /**
     * Retrieves table name from database mappings file content
     *
     * @return string
     */
    public function getTable(): string
    {
        return Arr::get($this->content, 'table');
    }

    /**
     * Retrieves primary key name from database mappings file content
     *
     * @return string
     */
    public function getPrimaryKey(): string
    {
        return Arr::get($this->content, 'primary');
    }

    /**
     * Retrieves column mappings according to mappings file content
     * @return array
     */
    public function getMappings(): array
    {
        $mapping = Arr::get($this->content, 'columns');
        if (config('mappable-models.model_mapping.uppercase')) {
            return array_map(function ($item) {
                return strtoupper($item);
            }, $mapping);
        }

        return $mapping;
    }

    /**
     * Retrieves the sequences from database mappings file content
     * @return string
     */
    public function getSequence(): string
    {
        return Arr::get($this->content, 'sequence');
    }
}
