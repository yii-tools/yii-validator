<?php

declare(strict_types=1);

namespace Yii\Validator;

use Yii\Html\Helper\Utils;
use Yiisoft\Validator\Rule\Regex;
use Yiisoft\Validator\RuleInterface;

trait CanBeRegex
{
    public function getRegexHtmlAttributes(RuleInterface $rule, array $attributes): array
    {
        if ($rule instanceof Regex && $rule->isNot() === false) {
            $attributes['pattern'] = Utils::normalizeRegexpPattern($rule->getPattern());
        }

        return $attributes;
    }
}
