<?php

namespace Tests\Unit\Models;

use App\Models\User;
use App\Models\Users\UserAddress;
use App\Models\Users\UserAttribute;
use App\Models\Users\UserAttributeSelection;
use App\Models\Users\UserContact;
use App\Models\Users\UserDocument;
use App\Models\Users\UserSocialProfile;
use Illuminate\Database\UniqueConstraintViolationException;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_has_user_contacts(): void
    {
        $this->assertHasHasManyRelationships('userContacts', UserContact::class);
    }

    public function test_has_user_documents(): void
    {
        $this->assertHasHasManyRelationships('userDocuments', UserDocument::class);
    }

    public function test_has_user_addresses(): void
    {
        $this->assertHasHasManyRelationships('userAddresses', UserAddress::class);
    }

    public function test_has_user_social_profiles(): void
    {
        $this->assertHasHasManyRelationships('userSocialProfiles', UserSocialProfile::class);
    }

    public function test_has_user_attributes(): void
    {
        $user = User::factory()
            ->has(UserAttribute::factory()->count(3))
            ->has(
                UserAttribute::factory()->has(UserAttributeSelection::factory()->count(3))
            )
            ->create();

        $user = User::with([
            'userAttributes.userAttributeSelections',
        ])->find($user->id);

        $this->assertCount(4, $user->userAttributes);
        $this->assertInstanceOf(UserAttribute::class, $user->userAttributes->first());

        $someAttributeHasSelections = $user->userAttributes->some(fn ($userAttribute) => $userAttribute->userAttributeSelections->isNotEmpty());

        $this->assertTrue($someAttributeHasSelections);
    }

    public function test_email_hash_is_deterministic_and_unique(): void
    {
        $email = 'test@example.com';

        $user = User::factory()->create([
            'email' => $email,
        ]);

        $this->assertNotNull($user->email_hash);

        $found = User::where('email_hash', secure_deterministic_hash($email))->first();

        $this->assertNotNull($found);
        $this->assertTrue($found->is($user));

        $this->assertNotEquals($email, $user->email_hash);
        $this->assertStringNotContainsString($email, $user->email_hash);

        $this->expectException(UniqueConstraintViolationException::class);

        User::factory()->create([
            'email' => $email,
        ]);
    }

    protected function assertHasHasManyRelationships(string $relationshipName, string $relatedClass): void
    {
        $user = User::factory()
            ->has($relatedClass::factory()->count(3))
            ->create();

        $user = User::with($relationshipName)->find($user->id);

        $this->assertCount(3, $user->{$relationshipName});
        $this->assertInstanceOf($relatedClass, $user->{$relationshipName}->first());
    }
}
