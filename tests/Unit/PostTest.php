<?php

namespace Tests\Unit;

use App\Post;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function can_see_title()
    {
        $post = factory(Post::class)->make(['title'=>'title']);
        $this->assertTrue($post->title == 'title');
    }

    /**
     * @test
     */
    public function can_see_body()
    {
        $post = factory(Post::class)->make(['body'=>'body']);
        $this->assertEquals('body',$post->body);
    }

    /**
     * @test
     */
    public function can_see_formatted_body()
    {
        $post = factory(Post::class)->make(['body'=>'# body']);
        $this->assertRegExp('/<h1\s?.*?>body<\/h1>/',$post->formatted_body);
    }
}
