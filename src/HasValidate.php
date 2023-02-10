<?php

declare(strict_types=1);

namespace Yii\Validator;

use Yii\FormModel\FormModelError;
use Yiisoft\Validator\Helper\ObjectParser;
use Yiisoft\Validator\Result;
use Yiisoft\Validator\RuleInterface;
use Yiisoft\Validator\ValidatorInterface;

trait HasValidate
{
    abstract public function error(): FormModelError;

    /**
     * @psalm-return array<int|string, RuleInterface|list<RuleInterface>>
     */
    public function getRules(): array
    {
        return (new ObjectParser($this))->getRules();
    }

    public function getRuleHtmlAttributes(object $formModel, string $attribute): array
    {
        return (new RulesHtmlParser())->getRuleHtmlAttributes($formModel, $attribute);
    }

    public function validate(ValidatorInterface $validator): bool
    {
        $result = $validator->validate($this, $this->getRules());

        if (!$result->isValid()) {
            $this->addError($result);
        }

        return $result->isValid();
    }

    private function addError(Result $result): void
    {
        foreach ($result->getErrorMessagesIndexedByAttribute() as $attribute => $errors) {
            foreach ($errors as $error) {
                $this->error()->add($attribute, $error);
            }
        }
    }
}
