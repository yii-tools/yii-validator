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

final class ValidatorFormAttributes extends AbstractFormModel
{
    use HasValidate;

    #[Required, Length(min: 1, max: 10), Regex('/^[0-9]+$/')]
    private string $amount = '';
    #[Required, Email]
    private string $email = '';
    #[Required, Number(min: 1, max: 10)]
    private int $integer = 0;
    #[Required, Url]
    private string $url = '';
    private string $username = '';
    #[StopOnError([new Required(), new Regex('/^[a-z]+$/')])]
    private string $server = '';
    private string $textArea = '';
}
