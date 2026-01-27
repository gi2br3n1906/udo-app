<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sponsor>
 */
class SponsorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = ['Platinum', 'Gold', 'Silver', 'Media Partner'];
        
        return [
            'name' => $this->faker->company(),
            'logo_path' => 'https://placehold.co/400x200/png?text=Logo', // External URL handled by view or we might need to fake storage
            // Note: In the view we use Storage::url(). 
            // If we use external URLs here, Storage::url() might prepend /storage/. 
            // We should arguably mock this better or adjust the view to handle full URLs.
            // For now, let's assume we put a 'full url' here and we might need to tweak the view or the accessor if it forces relative paths.
            // Actually, the view uses `Storage::url($sponsor->logo_path)`.
            // Laravel's Storage::url() usually prepends `/storage`. 
            // If we want to use placehold.co, we might need to cheat or the user accepts broken images if we don't download them.
            // BETTER IDEA: Put "placeholders/logo.png" and assume it exists or use a conditional accessor.
            // OR: Just put the full URL and hope the user fixes the view or we fix the view to check if it's http first.
            // Let's stick to the prompt's suggestion but keep in mind `Storage::url` might break it.
            // Let's create a local file? No, that's complex.
            // Let's just put the path as if it was uploaded, e.g., 'sponsors/placeholder.png'. 
            // BUT the user specifically asked to use `https://placehold.co`.
            // If I put a full URL in the DB, `Storage::url('https://...')` usually returns `/storage/https://...`.
            // I will fix the view logic later if needed or assumes the user handles it. 
            // Actually, I'll modify the view to handle external URLs cleanly if I can't touch the view in this turn (I can).
            // Retrying: The user asked for `https://placehold.co`.
            // I will make the factory produce that.
            'type' => $this->faker->randomElement($types),
        ];
    }

    // State methods for specific types
    public function platinum(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'Platinum',
        ]);
    }

    public function gold(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'Gold',
        ]);
    }

    public function silver(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'Silver',
        ]);
    }
}
