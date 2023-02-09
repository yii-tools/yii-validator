<?php

declare(strict_types=1);

namespace Yii\Validator;

use ReflectionObject;
use ReflectionAttribute;
use Yiisoft\Validator\RuleInterface;

trait HasRules
{
    public function getRules(): array
    {
        return $this->collectorRulesAttributes();
    }

    /**
     * Returns the list of rules indexed by attribute names.
     *
     * @return array List of attribute types and rules indexed by attribute names.
     */
    private function collectorRulesAttributes(): array
    {
        $reflection = new ReflectionObject($this);
        $rules = [];

        foreach ($reflection->getProperties() as $property) {
            $attributeRules = [];

            if ($property->isStatic() === false) {
                $attributeRules = $property->getAttributes(RuleInterface::class, ReflectionAttribute::IS_INSTANCEOF);
            }

            foreach ($attributeRules as $attributeRule) {
                $rules[$property->getName()][] = $attributeRule->newInstance();
            }
        }

        return $rules;
    }
}
