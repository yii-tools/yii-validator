<?php

declare(strict_types=1);

namespace Yii\Validator\Test;

use PHPUnit\Framework\TestCase;
use Yii\Validator\Tests\Support\ValidatorForm;
use Yii\Validator\Tests\Support\ValidatorFormAttributes;
use Yiisoft\Validator\Validator;

final class ValidatorTest extends TestCase
{
    public function testValidate(): void
    {
        $formModel = new ValidatorForm();
        $validator = new Validator();

        $this->assertFalse($formModel->validate($validator));
        $this->assertTrue($formModel->error()->has());
        $this->assertSame(
            [
                'amount' => [
                    'Value cannot be blank.',
                    'This value must contain at least 1 character.',
                    'Value is invalid.',
                ],
                'email' => [
                    'Value cannot be blank.',
                    'This value is not a valid email address.',
                ],
                'integer' => [
                    'Value must be no less than 1.',
                ],
                'server' => [
                    0 => 'Value cannot be blank.',
                ],
                'url' => [
                    'Value cannot be blank.',
                    'This value is not a valid URL.',
                ],
            ],
            $formModel->error()->getAll()
        );
    }

    public function testValidateWithAttributes(): void
    {
        $formModel = new ValidatorFormAttributes();
        $validator = new Validator();

        $this->assertFalse($formModel->validate($validator));
        $this->assertTrue($formModel->error()->has());
        $this->assertSame(
            [
                'amount' => [
                    'Value cannot be blank.',
                    'This value must contain at least 1 character.',
                    'Value is invalid.',
                ],
                'email' => [
                    'Value cannot be blank.',
                    'This value is not a valid email address.',
                ],
                'integer' => [
                    'Value must be no less than 1.',
                ],
                'url' => [
                    'Value cannot be blank.',
                    'This value is not a valid URL.',
                ],
                'server' => [
                    0 => 'Value cannot be blank.',
                ],
            ],
            $formModel->error()->getAll()
        );
    }
}
