<?php

namespace Tests\Feature;

use App\Mail\Invitation;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class InvitationTest extends TestCase
{
    /** @test */
    public function it_should_be_able_to_invite_someone_to_the_platform()
    {
        // Arrange
        Mail::fake();

        /** @var User $user */
        $user = User::factory()->create();

        $this->actingAs($user);

        // Act
        $this->post('invite', ['email' => 'novo@email.com']);

        // Assert
        Mail::assertSent(Invitation::class, function ($mail) {
            return $mail->hasTo('novo@email.com');
        });

        // Criou um convite no banco de dados
        $this->assertDatabaseHas('invites', ['email' => 'novo@email.com']);
    }
}
