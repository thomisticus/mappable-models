<?php

namespace Thomisticus\MappableModels\Mapping;

class ModelMapping
{
    /**
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
     * @return mixed
     */
    public static function isEnabled()
    {
        return config('mappable-models.model_mapping.enabled');
    }

    /**
     * @return string
     */
    public function getTable(): string
    {
        return array_get($this->content, 'table');
    }

    /**
     * @return string
     */
    public function getPrimaryKey(): string
    {
        return array_get($this->content, 'primary');
    }

    /**
     * @return array
     */
    public function getMappings(): array
    {
        $mapping = array_get($this->content, 'columns');
        if (config('mappable-models.model_mapping.uppercase')) {
            return array_map(function ($item) {
                return strtoupper($item);
            }, $mapping);
        }

        return $mapping;
    }

    /**
     * @return string
     */
    public function getSequence(): string
    {
        return array_get($this->content, 'sequence');
    }
}
