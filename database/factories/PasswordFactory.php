<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Password>
 */
class PasswordFactory extends Factory
{
    public function definition(): array
    {
        $services = [
            'GitHub', 'GitLab', 'Bitbucket',
            'Gmail', 'Outlook', 'Proton Mail',
            'Netflix', 'Amazon Prime', 'Disney+', 'Hulu',
            'Twitter', 'LinkedIn', 'Instagram', 'Facebook',
            'Stripe', 'PayPal', 'Square',
            'AWS', 'DigitalOcean', 'Heroku', 'Vercel',
            'Slack', 'Discord', 'Zoom', 'Teams',
            'Notion', 'Trello', 'Asana', 'Jira',
            'Spotify', 'Apple Music', 'YouTube Premium',
            'Dropbox', 'Google Drive', 'OneDrive',
            '1Password', 'LastPass', 'Bitwarden',
            'Shopify', 'WooCommerce', 'Magento',
            'Salesforce', 'HubSpot', 'Pipedrive',
        ];

        return [
            'name' => fake()->randomElement($services),
            'username' => fake()->userName(),
            'password' => fake()->password(),
            'website' => fake()->url(),
            'team_id' => Team::factory(),
        ];
    }
}
