<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase; // これは使いたいTestCaseでないのでError : Call to a member function connection() on null
use Tests\TestCase;
use App\Http\Controllers\HomeController;

use App\Models\Phone;
use Closure;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Support\Collection;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public function test_phone_number_success()
    {
        $phone_numbers = Phone::get();
        $home = new HomeController();
        foreach ($phone_numbers as $p_number){
            echo $p_number."\n";
            // 正しい形で電話番号を加工する
            $tel = $home->get_phone_number($p_number["sample1"],$p_number["sample2"],$p_number["sample3"]);
            echo $tel."\n";
            $this->assertMatchesRegularExpression("/^0[0-9]{1,4}-[0-9]{1,4}-[0-9]{3,4}$/", $tel);
        }
    }

    public function test_phone_number_fail()
    {
        $phone_numbers = Phone::get();
        $home = new HomeController();
        foreach ($phone_numbers as $p_number){
            echo $p_number."\n";
            // 間違った形で電話番号を加工する
            $tel = $home->get_phone_number_fail($p_number["sample1"],$p_number["sample2"],$p_number["sample3"]);
            echo $tel."\n";
            $this->assertMatchesRegularExpression("/^0[0-9]{1,4}-[0-9]{1,4}-[0-9]{3,4}$/", $tel);
        }
    }
}
