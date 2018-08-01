<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WithLogin extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        //homepage
        $this->get("/")->assertStatus(200);
        //login
        $this->get("/login")->assertStatus(200);
        //register
        $this->get("/register")->assertStatus(200);
    }

    //test login if uname and password wrong
    function testLoginWrong(){
        $cred = [
          "uname" => "aaccacaca",
          "pass" => "asdasdasdasd"
        ];

        $this->post("/login",$cred)->assertStatus(200)->assertJson(["code" => 402]);
    }

    //test login if uname and password correct
    function testLoginCorrect(){
        $cred = [
          "uname" => "test",
          "pass" => "test"
        ];

        $this->post("/login",$cred)->assertStatus(200)->assertJson(["code" => 200]);
    }
}
