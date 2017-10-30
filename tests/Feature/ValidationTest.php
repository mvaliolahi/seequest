<?php
/**
 * Created by PhpStorm.
 * User: m.valiolahi
 * Date: 10/29/2017
 * Time: 6:17 PM
 */

namespace Tests\Feature;


use Tests\TestCase;
use Tests\Validators\BetweenSample;
use Mvaliolahi\SeeQuest\SeeQuest;

/**
 * Class ValidationTest
 * @package Tests\Feature
 */
class ValidationTest extends TestCase
{
    /**
     * @var SeeQuest
     */
    protected $validator;

    /** @test */
    public function it_should_validate_required_as_single_rule()
    {
        $rule = [
            'name' => 'required',
        ];

        $request = [
            'name' => 'Meysam',
        ];

        $this->validator->check($request, $rule);
        $err = $this->validator->getErrors();

        $this->assertEmpty($err);
    }

    /** @test */
    public function it_should_have_error_if_required_fail()
    {
        $rule = [
            'name' => 'required',
        ];

        $request = [];

        $this->validator->check($request, $rule);
        $err = $this->validator->getErrors();

        $this->assertEquals('name', $err[0]['attribute']);
    }

    /** @test */
    public function it_should_validate_required_as_multiple_rule()
    {
        $rule = [
            'name' => 'required',
            'age' => 'required|min:10|max:25',
        ];

        $request = [
            'name' => 'Meysam Valiolahi',
            'age' => 12,
        ];

        $this->validator->check($request, $rule);

        $this->assertEmpty($this->validator->getErrors());
    }

    /** @test */
    public function it_should_use_from_custom_validator()
    {
        $validator = new SeeQuest('en', [
            BetweenSample::class
        ]);

        $rule = [
            'name' => 'required',
            'age' => 'required|between_sample:1,10',
        ];

        $request = [
            'name' => 'Meysam Valiolahi',
            'age' => 12,
        ];

        $validator->check($request, $rule);

        $this->assertEquals('age', $validator->getErrors()[0]['attribute']);
    }

    /** @test */
    public function it_should_fail_for_all_validations()
    {
        $rule = [
            'name' => 'required',
            'email' => 'required|email',
            'age' => 'required|between:1,25|integer',
            'score' => 'min:10',
            'high_core' => 'max:600',
            'number' => 'regex:[^0-9]'
        ];

        $request = [
            'high_core' => 601,
            'number' => 'it should be number'
        ];

        $this->validator->check($request, $rule);

        $this->assertEquals(9, count($this->validator->getErrors()));
    }

    protected function setUp()
    {
        parent::setUp();

        $this->validator = new SeeQuest('en');
    }
}