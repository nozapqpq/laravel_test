<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Phone;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PhoneFactory extends Factory
{
    protected $model = Phone::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $str1 = "0".rand(10,99);
        return [
            //
            'sample1' => $str1,
            'sample2' => strval(rand(100,999)),
            'sample3' => strval(rand(1000,9999)),
        ];
    }
}
