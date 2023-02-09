<?php

declare(strict_types=1);

namespace Yii\Validator;

use Yii\FormModel\FormModelError;
use Yiisoft\Validator\Result;
use Yiisoft\Validator\ValidatorInterface;

trait HasValidate
{
    use HasRules;
    use HasRulesHtmlAttributes;

    abstract public function error(): FormModelError;

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
