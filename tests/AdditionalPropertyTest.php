<?php
declare(strict_types=1);


namespace Mmal\OpenapiValidator\Tests;

use Mmal\OpenapiValidator\Validator;
use PHPUnit\Framework\TestCase;

class AdditionalPropertyTest extends BaseTestCase
{
    public function testShoudlNotAllowAdditionalProperty()
    {
        $validator = $this->getTestedClass();

        $error = $validator->validate('getBooksWithReference', 200, [
            'status' => 'a',
            'result' => 'b',
            'c' => 'd'
        ]);

        //var_dump($error); exit;
        $this->assertTrue($error->hasErrors());
        $this->assertContains('the definition does not allow additional properties', (string)$error);
    }

    protected function getTestedClass(): Validator
    {
        $schema = file_get_contents(__DIR__.'/specs/additional-properties-spec.yaml');
        return $this->getInstance($schema);
    }
}