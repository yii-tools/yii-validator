<?php

declare(strict_types=1);

namespace Yii\Validator;

use ReflectionAttribute;
use ReflectionObject;
use Yii\Html\Helper\Utils;
use Yiisoft\Validator\Rule\Composite;
use Yiisoft\Validator\Rule\Length;
use Yiisoft\Validator\Rule\Number;
use Yiisoft\Validator\Rule\Regex;
use Yiisoft\Validator\Rule\Required;
use Yiisoft\Validator\Rule\StopOnError;
use Yiisoft\Validator\Rule\Url;
use Yiisoft\Validator\RuleInterface;

use function array_key_exists;
use function method_exists;

final class RulesHtmlParser
{
    public function getRuleHtmlAttributes(object $formModel, string $attribute): array
    {
        $htmlRuleAttributes = [];
        $rulesByAttribute = [];

        if (method_exists($formModel, 'getRules') === false) {
            return $htmlRuleAttributes;
        }

        /** @psalm-var array<array-key, RuleInterface> $formModelRules */
        $formModelRules = $formModel->getRules();

        if (array_key_exists($attribute, $formModelRules)) {
            /** @psalm-var array<array-key, RuleInterface> $rulesByAttribute */
            $rulesByAttribute = $formModelRules[$attribute];
        }

        $rules = $this->normalizeRules($rulesByAttribute);

        foreach ($rules as $rule) {
            $htmlRuleAttributes = $this->getLengthHtmlAttributes($rule, $htmlRuleAttributes);
            $htmlRuleAttributes = $this->getNumberHtmlAttributes($rule, $htmlRuleAttributes);
            $htmlRuleAttributes = $this->getRegexHtmlAttributes($rule, $htmlRuleAttributes);
            $htmlRuleAttributes = $this->getRequiredHtmlAttributes($rule, $htmlRuleAttributes);
            $htmlRuleAttributes = $this->getUrlHtmlAttributes($rule, $htmlRuleAttributes);
        }

        return $htmlRuleAttributes;
    }

    private function getLengthHtmlAttributes(RuleInterface $rule, array $attributes): array
    {
        if ($rule instanceof Length) {
            $attributes['maxlength'] = $rule->getMax();
            $attributes['minlength'] = $rule->getMin();
        }

        return $attributes;
    }

    private function getNumberHtmlAttributes(RuleInterface $rule, array $attributes): array
    {
        if ($rule instanceof Number) {
            $attributes['max'] = $rule->getMax();
            $attributes['min'] = $rule->getMin();
        }

        return $attributes;
    }

    private function getRegexHtmlAttributes(RuleInterface $rule, array $attributes): array
    {
        if ($rule instanceof Regex && $rule->isNot() === false) {
            $attributes['pattern'] = Utils::normalizeRegexpPattern($rule->getPattern());
        }

        return $attributes;
    }

    private function getRequiredHtmlAttributes(RuleInterface $rule, array $attributes): array
    {
        if ($rule instanceof Required) {
            $attributes['required'] = true;
        }

        return $attributes;
    }

    private function getUrlHtmlAttributes(RuleInterface $rule, array $attributes): array
    {
        if ($rule instanceof Url) {
            $attributes['pattern'] = Utils::normalizeRegexpPattern($rule->getPattern());
        }

        return $attributes;
    }

    /**
     * @psalm-param array<array-key, RuleInterface> $rules
     *
     * @psalm-return list<\Yiisoft\Validator\RuleInterface>
     */
    private function normalizeRules(array $rules): array
    {
        $normalizeRules = [];

        foreach ($rules as $rule) {
            if (($rule instanceof Composite || $rule instanceof StopOnError)) {
                foreach ($rule->getRules() as $rule) {
                    $normalizeRules[] = $rule;
                }
            } else {
                $normalizeRules[] = $rule;
            }
        }

        return $normalizeRules;
    }
}
