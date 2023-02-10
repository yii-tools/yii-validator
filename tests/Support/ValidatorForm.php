<?php

declare(strict_types=1);

namespace Yii\Validator\Tests\Support;

use Yii\FormModel\AbstractFormModel;
use Yii\Validator\HasValidate;
use Yiisoft\Validator\Rule\Email;
use Yiisoft\Validator\Rule\Length;
use Yiisoft\Validator\Rule\Number;
use Yiisoft\Validator\Rule\Regex;
use Yiisoft\Validator\Rule\Required;
use Yiisoft\Validator\Rule\StopOnError;
use Yiisoft\Validator\Rule\Url;

final class ValidatorForm extends AbstractFormModel
{
    use HasValidate;

    private string $amount = '';
    private string $email = '';
    private string $url = '';
    private string $username = '';
    private string $server = '';
    private string $textArea = '';
    private int $integer = 0;

    public function getRules(): array
    {
        return [
            'amount' => [new Required(), new Length(min: 1, max: 10), new Regex('/^[0-9]+$/')],
            'email' => [new Required(), new Email()],
            'integer' => [new Required(), new Number(min: 1, max: 10)],
            'server' => [new StopOnError([new Required(), new Regex('/^[a-z]+$/')])],
            'url' => [new Required(), new Url()],
        ];
    }
}
