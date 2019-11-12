<?php

namespace Thomisticus\MappableModels;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;
use Thomisticus\MappableModels\Mapping\ModelMapping;
use Thomisticus\MappableModels\Traits\HasArrayMappableFormat;
use Thomisticus\MappableModels\Traits\HasAutomaticMapping;

class MappableModel extends Model
{
    use Eloquence, Mappable, HasAutomaticMapping, HasArrayMappableFormat {
        HasArrayMappableFormat::toArray insteadof Eloquence;
    }

    protected $sequence;

    /**
     * MappableModel constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        // Map columns if mapping is enabled
        $this->mapModel();

        // After map columns construct parent
        parent::__construct($attributes);
    }

    private function mapModel()
    {
        if (ModelMapping::isEnabled()) {
            $mm = new ModelMapping($this->getTable());

            $this->table = $mm->getTable();
            $this->primaryKey = $mm->getPrimaryKey();
            $this->maps = $mm->getMappings();
            $this->sequence = $mm->getSequence();
        }
    }
}
