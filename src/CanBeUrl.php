<?php

declare(strict_types=1);

namespace Yii\Validator;

use Yii\Html\Helper\Utils;
use Yiisoft\Validator\Rule\Url;
use Yiisoft\Validator\RuleInterface;

trait CanBeUrl
{
    public function getUrlHtmlAttributes(RuleInterface $rule, array $attributes): array
    {
        if ($rule instanceof Url) {
            $attributes['pattern'] = Utils::normalizeRegexpPattern($rule->getPattern());
        }

        return $attributes;
    }
}
