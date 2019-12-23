<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
    public function testBasicExample()
    {
        // 測試呼叫json api
        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json('get','/api/users');
        $response->assertStatus(200);

        // dump 和 dumpHeaders 方法可用于检查和调试响应内容
        // $response = $this->get('/');
        // $response->dumpHeaders();
        // $response->dump();
    }

    public function testDatabase()
    {
        // 數據庫測試
        $this->assertDatabaseHas('users', [
            'email' => 'admin@abc.com'
        ]);
    }

    public function testApplication()
    {
        // 生成已認證user
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)
                         ->withSession(['foo' => 'bar'])
                         ->get('/api/users');
        $this->assertAuthenticatedAs($user, $guard = null);
    }
}
