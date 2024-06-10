<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\User;
use App\Models\Article;
use Laravolt\Avatar\Avatar;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;


class FrontController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function User(User $user)
    {

        return view('user-info', compact('user'));
    }


    public function Members()
    {
        $usersWithActivities = UserActivity::with('user') // Carica anche le informazioni dell'utente associato all'attività
            ->orderBy('hours_online', 'desc') // Ordina le attività in base al numero di ore online in ordine decrescente
            ->take(4) // Limita il risultato alle prime 4 attività
            ->get();

        $users = User::all();

        return view('members', compact('users', 'usersWithActivities'));
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

        // Salva l'immagine nel filesystem
        $imagePath = $image->storeAs('public/images', $imageName);

        // Aggiorna o crea l'immagine associata all'utente
        if ($user->image) {
            $user->image->update(['path' => $imagePath]);
        } else {
            $user->image()->create(['path' => $imagePath]);
        }



        return redirect()->back()->with('success', 'Image uploaded successfully.');
    }


    public function logout(Request $request): \Illuminate\Http\RedirectResponse
    {
        // Ottieni l'utente autenticato
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
        }

        // Effettua il logout dell'utente
        Auth::logout();

        // Invalida la sessione e rigenera il token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Reindirizza l'utente alla home
        return redirect('/');
    }



   /*  public function __invoke(Request $request)
    {
        // Il metodo indexForUsers gestisce l'elenco di utenti per la vista Members e può anche gestire la ricerca e la selezione.
        return User::query()
            ->select('id', 'name', 'email')
            ->when(
                $request->search,
                fn(Builder $query) => $query
                    ->where('name', 'like', "%{$request->search}%")
                    ->orWhere('email', 'like', "%{$request->search}%")
            )
            ->when(
                $request->exists('selected'),
                fn(Builder $query) => $query->whereIn('id', $request->input('selected', [])),
                fn(Builder $query) => $query->limit(10)
            )
            ->orderBy('name')
            ->get()
            ->map(function (User $user) {

                return $user;
            });
    } */

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
    }


    public function createStaff(){
        return view('create-staff');
    }

}
