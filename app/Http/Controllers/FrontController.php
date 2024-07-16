<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\User;
use App\Models\Article;
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
        // Cache per 2 minuti
        $cacheKey = 'welcome_html';
        $cachedContent = Cache::get($cacheKey);

        if ($cachedContent) {
            return new \Illuminate\Http\Response($cachedContent);
        }

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

        // Renderizza la vista con i dati
        $viewContent = view('welcome', $viewData)->render();

        // Metti in cache il contenuto renderizzato
        Cache::put($cacheKey, $viewContent, now()->addSeconds(120));

        return new \Illuminate\Http\Response($viewContent);
    }


    public function Members()
    {
        $usersWithActivities = UserActivity::with('user') // Carica anche le informazioni dell'utente associato all'attività
            ->orderBy('hours_online', 'desc') // Ordina le attività in base al numero di ore online in ordine decrescente
            ->take(4) // Limita il risultato alle prime 4 attività
            ->get();


        $users = User::all();

        $imagePath = ImageModel::where('user_id')->value('path');



        return view('members', compact('users', 'usersWithActivities', 'imagePath'));
    }

    public function About()
    {
        $users = User::where('is_online', true)->get();
        $defaultPath = Storage::url('Avatars');
        return view('about', compact('users', 'defaultPath'));
    }

    public function UpdateImage(Request $request)
    {

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = Auth::user();

        $image = $request->file('image');

        // Genera un nome univoco per l'immagine utilizzando il timestamp corrente e l'estensione del file originale
        $imageName = 'user-' . $user->id . '-' . 'profile-picture' . '.' . $image->getClientOriginalExtension();

        $x = $request->input('x');
        $y = $request->input('y');
        $width = $request->input('width');
        $height = $request->input('height');

        //! Make the values "string" being an Integer.
        $xNum = intval($x);
        $yNum = intval($y);
        $widthNum = intval($width);
        $heightNum = intval($height);

        //! Creation of the cropped image and his relatives path.
        $croppedImagePath = public_path('storage/images/' . $imageName);
        $croppedImage = Image::make($image)
            ->crop($widthNum, $heightNum, $xNum, $yNum)
            ->save(public_path('storage/images/' . $imageName));

        // Salva il percorso dell'immagine croppata
        $imagePath = 'images/' . $imageName;

        // Update or create the image associated with the user
        if ($user->image) {
            // Delete the old image file if it exists
            if (file_exists(public_path('storage/' . $user->image->path))) {
                unlink(public_path('storage/' . $user->image->path));
            }
            $user->image()->update(['path' => $imagePath]);
        } else {
            $user->image()->create(['path' => $imagePath]);
        }

        return redirect()->back()->with('success', 'Image uploaded and cropped successfully.');
    }


    public function logout(Request $request)
    {
        // Ottieni l'utente autenticato
        $user = Auth::user();

        // Verifica se l'utente è autenticato
        if ($user) {
            $lastOnlineDateTime = new DateTime($user->last_online_at);

            // Ottieni l'orario dell'ultimo accesso online dell'utente
            $lastOnlineTime = $lastOnlineDateTime->format('H:i:s');
            // Calcola la durata della sessione online
            $durationOnline = now()->diffInSeconds($lastOnlineTime);

            $request->session()->put('duration_online', $durationOnline);

            UserActivity::updateOrCreate(
                ['user_id' => $user->id],
                ['hours_played' => 0] // Non aggiornare qui le ore online
            );

            // Imposta lo stato online dell'utente su false
            $user->is_online = false;
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

    /*
    public function createArticle(){

        return view('create-article');
    }

    public function articleShow(){
        {
            $article = Article::all();
            return view('Articles.article', compact('article'));
        }

    }


    public function articleDetail($id){
        $article = Article::find($id);
        return view('Articles.article-detail', compact('article'));
    } */


    public function createStaff()
    {
        return view('create-staff');
    }
}
