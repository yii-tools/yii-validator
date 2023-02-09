<?php

declare(strict_types=1);

namespace Yii\Validator;

use Yiisoft\Validator\Rule\Number;
use Yiisoft\Validator\RuleInterface;

trait CanBeNumber
{
    public function getNumberHtmlAttributes(RuleInterface $rule, array $attributes): array
    {
        if ($rule instanceof Number) {
            $attributes['max'] = $rule->getMax();
            $attributes['min'] = $rule->getMin();
        }

        return $attributes;
    }
}
