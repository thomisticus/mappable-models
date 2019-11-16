<?php

namespace Thomisticus\MappableModels\Traits;

trait HasArrayMappableFormat
{
    /**
     * Convert the model instance to an array.
     *
     * @return array
     */
    public function toArray()
    {
        if (method_exists($this, 'getMaps')) {

            if (count($this->getMaps()) === 0) {
                return parent::toArray();
            }

            return $this->getRemappedColumns();
        }

        return parent::toArray();
    }

    /**
     * Retrieves the array of remapped columns
     * @return array
     */
    private function getRemappedColumns()
    {
        $mapped = [];
        $flippedMaps = array_flip($this->getMaps());
        foreach (parent::toArray() as $index => $data) {
            // TODO put here the option to check if the index value is in upper case according to the config
            $index = strtoupper($index);
            if (array_key_exists($index, $flippedMaps)) {
                $mapped[$flippedMaps[$index]] = $data;
            }
        }
        return $mapped;
    }
}
