<?php

declare(strict_types=1);

namespace Yii\Validator\Test;

use PHPUnit\Framework\TestCase;
use Yii\Validator\Tests\Support\ValidatorForm;
use Yii\Validator\Tests\Support\ValidatorFormAttributes;
use Yiisoft\Validator\Rule\Email;
use Yiisoft\Validator\Rule\Length;
use Yiisoft\Validator\Rule\Number;
use Yiisoft\Validator\Rule\Regex;
use Yiisoft\Validator\Rule\Required;
use Yiisoft\Validator\Rule\Url;

final class RulesTest extends TestCase
{
    public function testRule(): void
    {
        $formModel = new ValidatorForm();

        $rules = $formModel->getRules();

        // property amount
        $this->assertArrayHasKey('amount', $rules);
        $this->assertCount(3, $rules['amount']);
        $this->assertInstanceof(Required::class, $rules['amount'][0]);
        $this->assertInstanceof(Length::class, $rules['amount'][1]);
        $this->assertInstanceof(Regex::class, $rules['amount'][2]);

        // property email
        $this->assertArrayHasKey('email', $rules);
        $this->assertCount(2, $rules['email']);
        $this->assertInstanceof(Required::class, $rules['email'][0]);
        $this->assertInstanceof(Email::class, $rules['email'][1]);

        // property integer
        $this->assertArrayHasKey('integer', $rules);
        $this->assertCount(2, $rules['integer']);
        $this->assertInstanceof(Required::class, $rules['integer'][0]);
        $this->assertInstanceof(Number::class, $rules['integer'][1]);

        // property url
        $this->assertArrayHasKey('url', $rules);
        $this->assertCount(2, $rules['url']);
        $this->assertInstanceof(Required::class, $rules['url'][0]);
        $this->assertInstanceof(Url::class, $rules['url'][1]);
    }

    public function testRuleWithAttributes(): void
    {
        $formModel = new ValidatorFormAttributes();

        $rules = $formModel->getRules();

        // property amount
        $this->assertArrayHasKey('amount', $rules);
        $this->assertCount(3, $rules['amount']);
        $this->assertInstanceof(Required::class, $rules['amount'][0]);
        $this->assertInstanceof(Length::class, $rules['amount'][1]);
        $this->assertInstanceof(Regex::class, $rules['amount'][2]);

        // property email
        $this->assertArrayHasKey('email', $rules);
        $this->assertCount(2, $rules['email']);
        $this->assertInstanceof(Required::class, $rules['email'][0]);
        $this->assertInstanceof(Email::class, $rules['email'][1]);

        // property integer
        $this->assertArrayHasKey('integer', $rules);
        $this->assertCount(2, $rules['integer']);
        $this->assertInstanceof(Required::class, $rules['integer'][0]);
        $this->assertInstanceof(Number::class, $rules['integer'][1]);

        // property url
        $this->assertArrayHasKey('url', $rules);
        $this->assertCount(2, $rules['url']);
        $this->assertInstanceof(Required::class, $rules['url'][0]);
        $this->assertInstanceof(Url::class, $rules['url'][1]);
    }
}
