<?php

declare(strict_types=1);

namespace Yii\Validator;

use Yii\FormModel\FormModelInterface;
use Yiisoft\Validator\RuleInterface;

use function array_key_exists;

trait HasRulesHtmlAttributes
{
    use CanBeLength;
    use CanBeNumber;
    use CanBeRegex;
    use CanBeRequired;
    use CanBeUrl;
    use HasRules;

    public function getRuleHtmlAttributes(FormModelInterface $formModel, string $attribute): array
    {
        $rulesAttribute = [];

        /** @psalm-var array<array-key, RuleInterface> $rules */
        $rules = $formModel->getRules();

        if (array_key_exists($attribute, $rules)) {
            $rulesAttribute = $rules[$attribute];
        }

        $htmlRuleAttributes = [];

        /** @psalm-var array<array-key, RuleInterface> $rulesAttribute */
        foreach ($rulesAttribute as $rule) {
            $htmlRuleAttributes = $this->getLengthHtmlAttributes($rule, $htmlRuleAttributes);
            $htmlRuleAttributes = $this->getNumberHtmlAttributes($rule, $htmlRuleAttributes);
            $htmlRuleAttributes = $this->getRegexHtmlAttributes($rule, $htmlRuleAttributes);
            $htmlRuleAttributes = $this->getRequiredHtmlAttributes($rule, $htmlRuleAttributes);
            $htmlRuleAttributes = $this->getUrlHtmlAttributes($rule, $htmlRuleAttributes);
        }

        return $htmlRuleAttributes;
    }
}
