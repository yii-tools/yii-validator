<?php

declare(strict_types=1);

namespace Yii\Validator;

use Yiisoft\Validator\Rule\Length;
use Yiisoft\Validator\RuleInterface;

trait CanBeLength
{
    public function getLengthHtmlAttributes(RuleInterface $rule, array $attributes): array
    {
        if ($rule instanceof Length) {
            $attributes['maxlength'] = $rule->getMax();
            $attributes['minlength'] = $rule->getMin();
        }

        return $attributes;
    }
}
