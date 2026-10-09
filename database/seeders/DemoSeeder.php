<?php

namespace Database\Seeders;

use App\Models\Outfit;
use App\Models\Pricing;
use App\Models\Purchase;
use App\Models\Room;
use App\Models\Subscription;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

/**
 * Données de démonstration : salles, équipements, un abonnement et un achat.
 * À lancer après DatabaseSeeder (comptes admin / gérant / utilisateur et formules).
 */
class DemoSeeder extends Seeder
{
    public function run(): void
    {
        $manager = User::where('role', 'manager')->firstOrFail();
        $user = User::where('role', 'user')->firstOrFail();

        $this->copyImages();

        $outfits = collect([
            ['Haltères 2 × 5 kg', 'Paire d\'haltères en fonte avec revêtement caoutchouc.', 15000, 'outfit_1'],
            ['Tapis de yoga', 'Tapis antidérapant de 6 mm, idéal pour le yoga et les étirements.', 8000, 'outfit_2'],
            ['Corde à sauter', 'Corde réglable avec poignées ergonomiques.', 3500, 'outfit_3'],
            ['Gants de musculation', 'Gants respirants avec protection des paumes.', 6000, 'outfit_4'],
        ])->map(fn ($o) => Outfit::forceCreate([
            'name' => $o[0],
            'description' => $o[1],
            'sale_price' => $o[2],
            'cover_image' => "media/outfits/{$o[3]}.jpg",
            'status' => true,
            'user_id' => $manager->id,
        ]));

        $rooms = collect([
            ['Iron Club', 'Salle de musculation et de cardio ouverte 7j/7, coachs sur place.', 6.3654, 2.4183, 'room_1'],
            ['Fit Akpakpa', 'Cours collectifs (zumba, cross-training) et espace bien-être.', 6.3550, 2.4650, 'room_2'],
            ['Power Gym', 'Salle spacieuse orientée force athlétique et haltérophilie.', 6.4485, 2.3550, 'room_3'],
        ])->map(fn ($r) => Room::forceCreate([
            'name' => $r[0],
            'description' => $r[1],
            'site_url' => 'https://example.com',
            'latitude' => $r[2],
            'longitude' => $r[3],
            'cover_image' => "media/rooms/{$r[4]}_cover.jpg",
            'overview_image' => "media/rooms/{$r[4]}_overview.jpg",
            'status' => true,
            'user_id' => $manager->id,
        ]));

        $pricingIds = Pricing::pluck('id');
        foreach ($rooms as $room) {
            $room->pricings()->sync($pricingIds);
            $room->outfits()->sync($outfits->pluck('id'));
        }

        // Un abonnement et un achat pour remplir le tableau de bord de l'utilisateur
        $pricing = Pricing::orderBy('duration')->first();
        $subscriptionTransaction = Transaction::forceCreate([
            'reference' => 'DEMO-SUB-1',
            'amount' => $pricing->price,
            'amount_ttc' => $pricing->price,
            'option' => 'subscription',
            'status' => 'approved',
            'pricing_id' => $pricing->id,
            'room_id' => $rooms[0]->id,
            'user_id' => $user->id,
        ]);
        Subscription::forceCreate([
            'amount' => $pricing->price,
            'expiration_date' => now()->addDays($pricing->duration),
            'status' => true,
            'transaction_id' => $subscriptionTransaction->id,
            'pricing_id' => $pricing->id,
            'room_id' => $rooms[0]->id,
            'user_id' => $user->id,
        ]);
        $user->forceFill(['is_subscribed' => true])->save();

        $purchaseTransaction = Transaction::forceCreate([
            'reference' => 'DEMO-PUR-1',
            'amount' => $outfits[0]->sale_price,
            'amount_ttc' => $outfits[0]->sale_price,
            'option' => 'purchase',
            'status' => 'approved',
            'outfit_id' => $outfits[0]->id,
            'user_id' => $user->id,
        ]);
        Purchase::forceCreate([
            'amount' => $outfits[0]->sale_price,
            'status' => 'pending', // état de livraison : en attente
            'transaction_id' => $purchaseTransaction->id,
            'outfit_id' => $outfits[0]->id,
            'user_id' => $user->id,
        ]);
    }

    /**
     * Copie les images de démonstration dans storage/app/public/media.
     */
    private function copyImages(): void
    {
        $source = database_path('seeders/demo-images');

        foreach (File::files($source) as $file) {
            $folder = str_starts_with($file->getFilename(), 'room_') ? 'rooms' : 'outfits';
            Storage::disk('public')->put("media/{$folder}/{$file->getFilename()}", File::get($file->getPathname()));
        }
    }
}
