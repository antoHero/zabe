<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class GravatarTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_generate_gravatar_default_image_url_when_no_email_is_found_first_character_a()
    {
        $user = User::factory()->create([
            'name' => 'Akay',
            'email' => 'afakeemailaddress@zabe.com'
        ]);

        $gravatarUrl = $user->getAvatar();

        $this->assertEquals(
            'https://www.gravatar.com/avatar/'.md5($user->email).'?s=200&d=s3.amazonaws.com/laracasts/images/forum/avatars/default-avatar-1.png',
             $gravatarUrl
        );

        $response = Http::get($user->getAvatar());

        $this->assertTrue($response->successful());
    }

    public function test_user_can_generate_gravatar_default_image_url_when_no_email_is_found_first_character_z()
    {
        $user = User::factory()->create([
            'name' => 'Akay',
            'email' => 'zfakeemailaddress@zabe.com'
        ]);

        $gravatarUrl = $user->getAvatar();

        $this->assertEquals(
            'https://www.gravatar.com/avatar/'.md5($user->email).'?s=200&d=s3.amazonaws.com/laracasts/images/forum/avatars/default-avatar-26.png',
             $gravatarUrl
        );

        $response = Http::get($user->getAvatar());

        $this->assertTrue($response->successful());
    }

    public function test_user_can_generate_gravatar_default_image_url_when_no_email_is_found_first_character_0()
    {
        $user = User::factory()->create([
            'name' => 'Akay',
            'email' => '0fakeemailaddress@zabe.com'
        ]);

        $gravatarUrl = $user->getAvatar();

        $this->assertEquals(
            'https://www.gravatar.com/avatar/'.md5($user->email).'?s=200&d=s3.amazonaws.com/laracasts/images/forum/avatars/default-avatar-27.png',
             $gravatarUrl
        );

        $response = Http::get($user->getAvatar());

        $this->assertTrue($response->successful());
    }

    public function test_user_can_generate_gravatar_default_image_url_when_no_email_is_found_first_character_9()
    {
        $user = User::factory()->create([
            'name' => 'Akay',
            'email' => '9fakeemailaddress@zabe.com'
        ]);

        $gravatarUrl = $user->getAvatar();

        $this->assertEquals(
            'https://www.gravatar.com/avatar/'.md5($user->email).'?s=200&d=s3.amazonaws.com/laracasts/images/forum/avatars/default-avatar-36.png',
             $gravatarUrl
        );

        $response = Http::get($user->getAvatar());

        $this->assertTrue($response->successful());
    }
}
