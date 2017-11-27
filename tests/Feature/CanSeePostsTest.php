<?php

namespace Tests\Feature;

use App\Post;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CanSeePostsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function can_see_most_recent_posts()
    {
        foreach(range(1,5) as $i){
            $date = Carbon::now()->subDays($i);
            factory(Post::class)->create(['published_at'=>$date,'title'=>$date->format('Y-m-d')]);
        }
        $response = $this->get('/');
        $string = $response->getContent();


        $response->assertStatus(200);
        $yesterday = Carbon::yesterday()->format('Y-m-d');
        $twoDaysAgo = Carbon::yesterday()->subDay()->format('Y-m-d');

        $this->assertRegExp('/'.$yesterday.'.*'.$twoDaysAgo.'/usm',$string);
    }

    /**
     * @test
     */
    public function cannot_see_an_unpublished_post()
    {
        //create post
        $post = Post::create(['title'=>'title','body'=>'# body']);
        //go to post page
        $response = $this->get(route('posts.show',[$post]));

        $response->assertStatus(404);
    }
    /**
     * @test
     */
   public function can_see_a_published_post()
   {
       //create post
       $post = Post::create(['title'=>'title','body'=>'# body','published_at'=>Carbon::parse('-1 week')]);
       //go to post page
       $response = $this->get(route('posts.show',[$post]));

       $response->assertStatus(200);
       $response->assertSee('title');
       $response->assertSee('>body');
   }

    /**
     * @test
     */
   public function cannot_see_non_existant_post()
   {
       $response = $this->get(route('posts.show',[0]));
       $response->assertStatus(404);
   }
}
