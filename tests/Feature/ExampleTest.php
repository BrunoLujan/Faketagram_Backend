<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testPushAndPop()
    {
        $stack = [];
        $this->assertSame(0, count($stack));
        array_push($stack, 'foo');
        $this->assertSame('foo', $stack[count($stack)-1]);
        $this->assertSame(1, count($stack));
        $this->assertSame('foo', array_pop($stack));
        $this->assertSame(0, count($stack));
    }

    public function testEmpty()
    {
        $stack = [];
        $this->assertEmpty($stack);
        return $stack;
    }

    public function testBasicRoutePhotosTest()
    {
        $response = $this->get('/photos');

        $response->assertStatus(200);
        $response->assertSee('Photos');
    }

    public function testBasicRoutePhotosIdTest()
    {
        $response = $this->get('/photos/10');

        $response->assertStatus(200);
        $response->assertSee('Mostrando detalle de la foto: 10');
    }

}
