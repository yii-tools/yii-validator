<?php

declare(strict_types=1);

namespace Yii\Validator\Test;

use PHPUnit\Framework\TestCase;
use Yii\Validator\Tests\Support\ValidatorForm;
use Yii\Validator\Tests\Support\ValidatorFormAttributes;

final class RuleHtmlAttributesTest extends TestCase
{
    public function testGetRuleHtmlAttributes(): void
    {
        $formModel = new ValidatorForm();

        // property amount
        $this->assertSame(
            [
                'required' => true,
                'maxlength' => 10,
                'minlength' => 1,
                'pattern' => '^[0-9]+$',
            ],
            $formModel->getRuleHtmlAttributes($formModel, 'amount'),
        );

        // property email
        $this->assertSame(
            ['required' => true],
            $formModel->getRuleHtmlAttributes($formModel, 'email'),
        );

        // property integer
        $this->assertSame(
            [
                'required' => true,
                'max' => 10,
                'min' => 1,
            ],
            $formModel->getRuleHtmlAttributes($formModel, 'integer'),
        );

        // property url
        $this->assertSame(
            [
                'required' => true,
                'pattern' => '^((?i)http|https):\/\/(([a-zA-Z0-9][a-zA-Z0-9_-]*)(\.[a-zA-Z0-9][a-zA-Z0-9_-]*)+)(?::\d{1,5})?([?\/#].*$|$)',
            ],
            $formModel->getRuleHtmlAttributes($formModel, 'url'),
        );
    }

    public function testGetRuleHtmlAttributesWithAttributes(): void
    {
        $formModel = new ValidatorFormAttributes();

        // property amount
        $this->assertSame(
            [
                'required' => true,
                'maxlength' => 10,
                'minlength' => 1,
                'pattern' => '^[0-9]+$',
            ],
            $formModel->getRuleHtmlAttributes($formModel, 'amount'),
        );

        // property email
        $this->assertSame(
            ['required' => true],
            $formModel->getRuleHtmlAttributes($formModel, 'email'),
        );

        // property integer
        $this->assertSame(
            [
                'required' => true,
                'max' => 10,
                'min' => 1,
            ],
            $formModel->getRuleHtmlAttributes($formModel, 'integer'),
        );

        // property url
        $this->assertSame(
            [
                'required' => true,
                'pattern' => '^((?i)http|https):\/\/(([a-zA-Z0-9][a-zA-Z0-9_-]*)(\.[a-zA-Z0-9][a-zA-Z0-9_-]*)+)(?::\d{1,5})?([?\/#].*$|$)',
            ],
            $formModel->getRuleHtmlAttributes($formModel, 'url'),
        );
    }
}
