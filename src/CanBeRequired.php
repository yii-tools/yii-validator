<?php

declare(strict_types=1);

namespace Yii\Validator;

use Yiisoft\Validator\Rule\Required;
use Yiisoft\Validator\RuleInterface;

trait CanBeRequired
{
    public function getRequiredHtmlAttributes(RuleInterface $rule, array $attributes): array
    {
        if ($rule instanceof Required) {
            $attributes['required'] = true;
        }

        return $attributes;
    }
}
