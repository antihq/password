<?php

namespace Database\Seeders;

use App\Models\CreditCard;
use App\Models\Password;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public mixed $users;

    public mixed $sharedTeams;

    public function run(): void
    {
        $this->seedUsers();
        $this->seedSharedTeams();
        $this->seedTeamMemberships();
        $this->seedPasswords();
        $this->seedCreditCards();
    }

    private function seedUsers(): void
    {
        $users = collect();

        $existingUser = User::where('email', 'test@example.com')->first();

        if ($existingUser) {
            $users->push($existingUser);
        } else {
            $users->push(User::factory()->withoutTwoFactor()->withPersonalTeam()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]));
        }

        $users->push(...User::factory()->withoutTwoFactor()->withPersonalTeam()->count(19)->create());

        $users->push(...User::factory()->withPersonalTeam()->count(5)->create());

        $users->push(...User::factory()->withoutTwoFactor()->unverified()->withPersonalTeam()->count(5)->create());

        $this->users = $users;
    }

    private function seedSharedTeams(): void
    {
        $this->sharedTeams = Team::factory()->count(12)->create([
            'personal_team' => false,
            'user_id' => $this->users->random()->id,
        ]);
    }

    private function seedTeamMemberships(): void
    {
        foreach ($this->sharedTeams as $team) {
            $memberCount = fake()->numberBetween(3, 8);
            $members = $this->users
                ->where('id', '!=', $team->user_id)
                ->random($memberCount);

            $members->each(function (User $member) use ($team) {
                $role = fake()->randomElement(['admin', 'editor', 'member']);
                $team->users()->attach($member->id, ['role' => $role]);
            });
        }
    }

    private function seedPasswords(): void
    {
        $personalTeams = $this->users->pluck('ownedTeams')->flatten();

        foreach ($personalTeams as $team) {
            if (! $team->personal_team) {
                continue;
            }

            $count = fake()->numberBetween(2, 4);
            Password::factory()->count($count)->create(['team_id' => $team->id]);
        }

        foreach ($this->sharedTeams as $team) {
            $count = fake()->numberBetween(8, 12);
            Password::factory()->count($count)->create(['team_id' => $team->id]);
        }
    }

    private function seedCreditCards(): void
    {
        $personalTeams = $this->users->pluck('ownedTeams')
            ->flatten()
            ->where('personal_team', true);

        foreach ($personalTeams as $team) {
            CreditCard::factory()
                ->count(fake()->numberBetween(3, 5))
                ->create(['team_id' => $team->id]);
        }

        foreach ($this->sharedTeams as $team) {
            CreditCard::factory()
                ->count(fake()->numberBetween(5, 8))
                ->create(['team_id' => $team->id]);
        }
    }
}
