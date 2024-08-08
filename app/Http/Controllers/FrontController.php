<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Article;
use App\Models\Comment;
use Laravolt\Avatar\Avatar;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Image as ImageModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Algolia\AlgoliaSearch\Http\Psr7\Response;


class FrontController extends Controller
{
    public function index()
    {
        // Se il contenuto non è in cache, calcolalo
        $hoursListened = 0;

        // Verifica se l'utente è autenticato
        if (Auth::check()) {
            $userId = Auth::id();

            $hoursListened = UserActivity::where('user_id', $userId)->sum('hours_played');
        }

        // Top Listener
        $usersTopListener = UserActivity::with(['user.image'])->orderBy('hours_played', 'desc')->take(4)->get();

        // Calcoliamo le ore, i minuti e i secondi
        $formattedTime = null;
        if ($hoursListened != 0) {
            $hours = floor($hoursListened / 3600); // Calcola le ore
            $minutes = floor(($hoursListened % 3600) / 60); // Calcola i minuti
            $seconds = $hoursListened % 60; // Calcola i secondi residui

            // Formattiamo il risultato per renderlo leggibile
            $formattedTime = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
        }

        // Prepara i dati per la vista
        $viewData = [
            'usersTopListener' => $usersTopListener,
            'hoursListened' => $hoursListened,
            'formattedTime' => $formattedTime,
        ];

        return view('welcome', $viewData);
    }


    public function Members()
    {
        $usersWithActivities = UserActivity::with('user') // Carica anche le informazioni dell'utente associato all'attività
            ->orderBy('hours_online', 'desc') // Ordina le attività in base al numero di ore online in ordine decrescente
            ->take(3) // Limita il risultato alle prime 4 attività
            ->get();


        $users = User::all();

        return view('members', compact('users', 'usersWithActivities'));
    }

    public function About()
    {
        $users = User::where('is_online', true)->get();
        $defaultPath = Storage::url('Avatars');


        $topListener = UserActivity::where('hours_online', '>', 0)
            ->orderBy('hours_online', 'desc')
            ->first();


        return view('about', compact('users', 'defaultPath', 'topListener'));
    }



    public function logout(Request $request)
    {
        // Ottieni l'utente autenticato
        $user = Auth::user();

        // Verifica se l'utente è autenticato
        if ($user) {
            $lastOnlineDateTime = new Carbon($user->last_online_at);

            // Calcola la durata della sessione online
            $durationOnline = $lastOnlineDateTime->diffInSeconds(now());

            $request->session()->put('duration_online', $durationOnline);

            UserActivity::updateOrCreate(
                ['user_id' => $user->id],
                ['duration_online' => $durationOnline]
            );

            // Imposta lo stato online dell'utente su false
            $user->is_online = false;
            $user->online_duration = $durationOnline;
            $user->save();
        } else {
            $request->session()->put('duration_online', 0);
        }
        // Effettua il logout dell'utente
        Auth::logout();

        // Invalida la sessione e rigenera il token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Reindirizza l'utente alla home
        return redirect('/');
    }

    public function createStaff()
    {
        return view('create-staff');
    }


    public function userProfile($id)
    {
        $authenticatedUserId = Auth::id();

        // Check if the provided ID matches the authenticated user's ID
        if ($id == $authenticatedUserId) {
            // Redirect to another page, e.g., the dashboard or home page
            return redirect()->route('user', ['id' => Auth::user()->id]); // You can change 'home' to the desired route
        }
        $user = User::with('comments.commenter')->findOrFail($id);
        return view('user-profile', compact('user'));
    }




    public function updateComment(Request $request, $commentId)
    {
        $request->validate([
            'body' => 'required|string',
        ]);

        $comment = Comment::findOrFail($commentId);

        if ($comment->commenter_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $comment->update([
            'body' => $request->body,
        ]);

        return redirect()->back()->with('success', 'Comment updated successfully.');
    }




    public function bannerUserUpload(Request $request)
    {
        try {
            $user = Auth::user();

            // Aggiungi logging per il debug
            \Log::info('Request received', $request->all());

            $request->validate([
                'banner' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $image = $request->file('banner');

            // Aggiungi logging per il debug
            \Log::info('File uploaded', ['file' => $image]);

            // Naming the image
            $imageName = 'user-' . $user->username . '-banner.' . $image->getClientOriginalExtension();

            // Define the path
            $destinationPath = public_path('storage/images/profile-user-banners');

            // Ensure directory exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Save the image
            $image->move($destinationPath, $imageName);

            // Full image path
            $imagePath = 'storage/images/profile-user-banners/' . $imageName;

            // Create or update the user's image path
            $user->image()->updateOrCreate(
                ['user_id' => $user->id], // Assuming 'user_id' is the foreign key in images table
                ['banner_picture_path' => $imagePath]
            );

            return redirect()->back()->with('success', 'Banner updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Error uploading banner', ['error' => $e->getMessage()]);

            return redirect()->back()->with('error', 'An error occurred while uploading the banner.');
        }
    }


    public function ProfilePage($id)
    {
        $user = User::find($id);
        return view('user-info', compact('user'));
    }
}
