<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Arr;
use Livewire\Attributes\On;
use PHPUnit\Event\Telemetry\Snapshot;

class CreateStaff extends Component
{

    public $roleName;
    public $guest;
    public $description;
    public $selectedColor = "";
    public $roleIcon ="";

    public $searchUser;

    public $newStaffs= [];
    public $users;
    public $isOpen = false;

    public function render()
    {
        $this->users = \App\Models\User::where('name', 'like', '%' . $this->searchUser . '%')->get();

        return view('livewire.create-staff');
    }


    public function selectColor($color)
    {
        $this->isOpen = false;
        $this->selectedColor = $color;
        $this->updatedSelectedColor($color);

    }

    public function selectIcon($icon)
    {

        $fillColor = $this->selectedColor ? $this->selectedColor : 'var(--quaternary-color)';
        $this->isOpen = false;
        if($icon == "none"){
            $this->roleIcon = "";
        }elseif($icon == "developer"){
            $this->roleIcon = '
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="' . $fillColor . '" class="w-6 h-6">
                <path fill-rule="evenodd"
                    d="M3 6a3 3 0 0 1 3-3h12a3 3 0 0 1 3 3v12a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm14.25 6a.75.75 0 0 1-.22.53l-2.25 2.25a.75.75 0 1 1-1.06-1.06L15.44 12l-1.72-1.72a.75.75 0 1 1 1.06-1.06l2.25 2.25c.141.14.22.331.22.53Zm-10.28-.53a.75.75 0 0 0 0 1.06l2.25 2.25a.75.75 0 1 0 1.06-1.06L8.56 12l1.72-1.72a.75.75 0 1 0-1.06-1.06l-2.25 2.25Z"
                    clip-rule="evenodd" />
            </svg>';

        }elseif($icon == "articleWriter"){
             $this->roleIcon = '
             <svg class="w-9 h-9 dark:text-white" style="color:' . $fillColor . '"
             aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
             viewBox="0 0 24 24">
             <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                 stroke-width="2"
                 d="M18 5V4a1 1 0 0 0-1-1H8.914a1 1 0 0 0-.707.293L4.293 7.207A1 1 0 0 0 4 7.914V20a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-5M9 3v4a1 1 0 0 1-1 1H4m11.383.772 2.745 2.746m1.215-3.906a2.089 2.089 0 0 1 0 2.953l-6.65 6.646L9 17.95l.739-3.692 6.646-6.646a2.087 2.087 0 0 1 2.958 0Z" />
         </svg>';

        }elseif($icon == "radioPresenter"){

          $this->roleIcon = '
         <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="' . $fillColor . '"
                            class="w-6 h-6">
                            <path fill-rule="evenodd"
                                d="M19.952 1.651a.75.75 0 0 1 .298.599V16.303a3 3 0 0 1-2.176 2.884l-1.32.377a2.553 2.553 0 1 1-1.403-4.909l2.311-.66a1.5 1.5 0 0 0 1.088-1.442V6.994l-9 2.572v9.737a3 3 0 0 1-2.176 2.884l-1.32.377a2.553 2.553 0 1 1-1.402-4.909l2.31-.66a1.5 1.5 0 0 0 1.088-1.442V5.25a.75.75 0 0 1 .544-.721l10.5-3a.75.75 0 0 1 .658.122Z"
                                clip-rule="evenodd" />
                        </svg>';

        }elseif($icon == "technicalDirector"){

            $this->roleIcon = '
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="' . $fillColor . '"
                            class="w-6 h-6">
                            <path d="M16.5 7.5h-9v9h9v-9Z" />
                            <path fill-rule="evenodd"
                                d="M8.25 2.25A.75.75 0 0 1 9 3v.75h2.25V3a.75.75 0 0 1 1.5 0v.75H15V3a.75.75 0 0 1 1.5 0v.75h.75a3 3 0 0 1 3 3v.75H21A.75.75 0 0 1 21 9h-.75v2.25H21a.75.75 0 0 1 0 1.5h-.75V15H21a.75.75 0 0 1 0 1.5h-.75v.75a3 3 0 0 1-3 3h-.75V21a.75.75 0 0 1-1.5 0v-.75h-2.25V21a.75.75 0 0 1-1.5 0v-.75H9V21a.75.75 0 0 1-1.5 0v-.75h-.75a3 3 0 0 1-3-3v-.75H3A.75.75 0 0 1 3 15h.75v-2.25H3a.75.75 0 0 1 0-1.5h.75V9H3a.75.75 0 0 1 0-1.5h.75v-.75a3 3 0 0 1 3-3h.75V3a.75.75 0 0 1 .75-.75ZM6 6.75A.75.75 0 0 1 6.75 6h10.5a.75.75 0 0 1 .75.75v10.5a.75.75 0 0 1-.75.75H6.75a.75.75 0 0 1-.75-.75V6.75Z"
                                clip-rule="evenodd" />
                        </svg>';

        }elseif($icon == "programDirector"){

            $this->roleIcon = '
             <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="' . $fillColor . '"
                            class="w-6 h-6">
                            <path fill-rule="evenodd"
                                d="M2.25 5.25a3 3 0 0 1 3-3h13.5a3 3 0 0 1 3 3V15a3 3 0 0 1-3 3h-3v.257c0 .597.237 1.17.659 1.591l.621.622a.75.75 0 0 1-.53 1.28h-9a.75.75 0 0 1-.53-1.28l.621-.622a2.25 2.25 0 0 0 .659-1.59V18h-3a3 3 0 0 1-3-3V5.25Zm1.5 0v7.5a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5v-7.5a1.5 1.5 0 0 0-1.5-1.5H5.25a1.5 1.5 0 0 0-1.5 1.5Z"
                                clip-rule="evenodd" />
                        </svg>';

        }elseif($icon == "presenter"){

               $this->roleIcon = '
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="' . $fillColor . '"
                            class="w-6 h-6">
                            <path fill-rule="evenodd"
                                d="M20.432 4.103a.75.75 0 0 0-.364-1.456L4.128 6.632l-.2.033C2.498 6.904 1.5 8.158 1.5 9.574v9.176a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3V9.574c0-1.416-.997-2.67-2.429-2.909a49.017 49.017 0 0 0-7.255-.658l7.616-1.904Zm-9.585 8.56a.75.75 0 0 1 0 1.06l-.005.006a.75.75 0 0 1-1.06 0l-.006-.006a.75.75 0 0 1 0-1.06l.005-.005a.75.75 0 0 1 1.06 0l.006.005ZM9.781 15.85a.75.75 0 0 0 1.061 0l.005-.005a.75.75 0 0 0 0-1.061l-.005-.005a.75.75 0 0 0-1.06 0l-.006.005a.75.75 0 0 0 0 1.06l.005.006Zm-1.055-1.066a.75.75 0 0 1 0 1.06l-.005.006a.75.75 0 0 1-1.061 0l-.005-.005a.75.75 0 0 1 0-1.06l.005-.006a.75.75 0 0 1 1.06 0l.006.005ZM7.66 13.73a.75.75 0 0 0 1.061 0l.005-.006a.75.75 0 0 0 0-1.06l-.005-.006a.75.75 0 0 0-1.06 0l-.006.006a.75.75 0 0 0 0 1.06l.005.006ZM9.255 9.75a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75h-.008a.75.75 0 0 1-.75-.75V10.5a.75.75 0 0 1 .75-.75h.008Zm3.624 3.28a.75.75 0 0 0 .275-1.025L13.15 12a.75.75 0 0 0-1.025-.275l-.006.004a.75.75 0 0 0-.275 1.024l.004.007a.75.75 0 0 0 1.025.274l.006-.003Zm-1.38 5.126a.75.75 0 0 1-1.024-.275l-.004-.006a.75.75 0 0 1 .275-1.025l.006-.004a.75.75 0 0 1 1.025.275l.004.007a.75.75 0 0 1-.275 1.024l-.006.004Zm.282-6.776a.75.75 0 0 0-.274-1.025l-.007-.003a.75.75 0 0 0-1.024.274l-.004.007a.75.75 0 0 0 .274 1.024l.007.004a.75.75 0 0 0 1.024-.275l.004-.006Zm1.369 5.129a.75.75 0 0 1-1.025.274l-.006-.004a.75.75 0 0 1-.275-1.024l.004-.007a.75.75 0 0 1 1.025-.274l.006.004a.75.75 0 0 1 .275 1.024l-.004.007Zm-.145-1.502a.75.75 0 0 0 .75-.75v-.007a.75.75 0 0 0-.75-.75h-.008a.75.75 0 0 0-.75.75v.007c0 .415.336.75.75.75h.008Zm-3.75 2.243a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75h-.008a.75.75 0 0 1-.75-.75V18a.75.75 0 0 1 .75-.75h.008Zm-2.871-.47a.75.75 0 0 0 .274-1.025l-.003-.006a.75.75 0 0 0-1.025-.275l-.006.004a.75.75 0 0 0-.275 1.024l.004.007a.75.75 0 0 0 1.024.274l.007-.003Zm1.366-5.12a.75.75 0 0 1-1.025-.274l-.004-.006a.75.75 0 0 1 .275-1.025l.006-.004a.75.75 0 0 1 1.025.275l.004.006a.75.75 0 0 1-.275 1.025l-.006.004Zm.281 6.215a.75.75 0 0 0-.275-1.024l-.006-.004a.75.75 0 0 0-1.025.274l-.003.007a.75.75 0 0 0 .274 1.024l.007.004a.75.75 0 0 0 1.024-.274l.004-.007Zm-1.376-5.116a.75.75 0 0 1-1.025.274l-.006-.003a.75.75 0 0 1-.275-1.025l.004-.007a.75.75 0 0 1 1.025-.274l.006.004a.75.75 0 0 1 .275 1.024l-.004.007Zm-1.15 2.248a.75.75 0 0 0 .75-.75v-.007a.75.75 0 0 0-.75-.75h-.008a.75.75 0 0 0-.75.75v.007c0 .415.336.75.75.75h.008ZM17.25 10.5a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm1.5 6a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z"
                                clip-rule="evenodd" />
                        </svg>';

            }elseif($icon == "radioDirector"){


                 $this->roleIcon = '
                <svg class="w-6 h-6 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke=".' . $fillColor . '" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M14.079 6.839a3 3 0 0 0-4.255.1M13 20h1.083A3.916 3.916 0 0 0 18 16.083V9A6 6 0 1 0 6 9v7m7 4v-1a1 1 0 0 0-1-1h-1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1Zm-7-4v-6H5a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h1Zm12-6h1a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2h-1v-6Z" />
                        </svg>';

            }elseif($icon == "articleDirector"){

                $this->roleIcon = '
                 <svg class="w-6 h-6 text-[' . $fillColor . ']  dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M7 2a2 2 0 0 0-2 2v1a1 1 0 0 0 0 2v1a1 1 0 0 0 0 2v1a1 1 0 1 0 0 2v1a1 1 0 1 0 0 2v1a1 1 0 1 0 0 2v1a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H7Zm3 8a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm-1 7a3 3 0 0 1 3-3h2a3 3 0 0 1 3 3 1 1 0 0 1-1 1h-6a1 1 0 0 1-1-1Z"
                                clip-rule="evenodd" />
                        </svg>';

            }elseif($icon == "moderator"){

                 $this->roleIcon = '
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="' . $fillColor . '"
                            class="w-6 h-6">
                            <path fill-rule="evenodd"
                                d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                clip-rule="evenodd" />
                        </svg>';

            }elseif($icon == "DJ"){
               $this->roleIcon = ' <svg class="w-6 h-6 " fill="' . $fillColor . '"  aria-hidden="true" version="1.1"
               id="_x32_" xmlns="http://www.w3.org/2000/svg"
               xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve">
               <g>
                   <path class="st0" d="M230.632,191.368c-22.969,0-41.573,18.612-41.573,41.573c0,22.977,18.604,41.574,41.573,41.574
c22.97,0,41.574-18.596,41.574-41.574C272.205,209.98,253.601,191.368,230.632,191.368z" />
                   <path class="st0" d="M482.062,249.793v-0.082h-4.102v0.082c-1.179,0.082-2.35,0.172-3.44,0.336
c-1.679-8.303-6.542-15.509-13.421-20.119C459.593,103.979,356.957,2.35,230.59,2.35C103.307,2.35,0,105.568,0,232.941
s103.307,230.591,230.59,230.591c28.767,0,56.272-5.282,81.673-14.928c9.565,15.428,21.389,29.012,34.966,39.92
c16.688,13.413,40.419,21.126,65.238,21.126c44.104,0,79.83-23.648,93.244-61.799c4.11-11.57,6.207-23.141,6.289-33.622V281.655
C512,264.72,498.751,250.8,482.062,249.793z M136.029,232.949c0-52.252,42.351-94.602,94.602-94.602
c52.251,0,94.603,42.351,94.603,94.602c0,52.251-42.352,94.603-94.603,94.603C178.38,327.552,136.029,285.2,136.029,232.949z
M493.051,407.858c0,0,0,0.917,0,3.185v3.186c-0.09,8.05-1.678,17.36-5.2,27.334c-12.242,34.711-44.358,49.14-75.384,49.14
c-20.291,0-40.001-6.207-53.414-16.942c-10.98-8.884-20.963-20.037-29.012-32.697c-4.528-6.796-8.467-14.092-11.816-21.634
c-12.332-28.005-19.21-45.618-22.978-56.517c-3.774-10.817-4.618-14.838-4.782-15.935c-0.671-4.021,0.508-8.049,3.268-10.981
c2.432-2.767,5.871-4.274,9.556-4.274l1.098,0.082c1.588,0.164,3.095,0.59,4.356,1.089c1.261,0.589,2.35,1.261,3.357,2.015
c1.933,1.507,3.603,3.267,5.617,5.781c3.857,5.036,8.894,13.167,16.263,28.43c3.112,6.534,6.289,11.153,8.974,14.084
c2.686,2.932,4.782,4.275,6.207,4.782c0.835,0.418,1.425,0.418,1.843,0.418c0.499,0,0.843,0,1.261-0.253
c0.418-0.164,0.925-0.5,1.334-1.007c0.926-0.918,1.426-2.433,1.344-2.932V278.47c0-7.124,5.871-12.995,13.004-12.995
c7.205,0,13.076,5.871,13.076,12.995v75.384h12.324V253.232c0-7.124,5.789-12.995,13.003-12.995
c7.206,0,13.078,5.871,13.078,12.995v100.622h7.55h3.185V348.4v-91.982c0-7.206,5.872-12.995,12.996-12.995
c7.214,0,13.077,5.789,13.077,12.995v24.066v73.37h10.735v-72.198c0-7.206,5.871-12.995,12.995-12.995
c7.214,0,13.086,5.789,13.086,12.995V407.858z" />
               </g>
           </svg>';
            }

    }

    public function createRole(\Illuminate\Http\Request $request)
    {
        $snapshotData = json_decode($request['components'][0]['snapshot'], true);

        $data = $snapshotData['data'];


        $validator = \Validator::make($data,[
            'roleName' => 'required|string|max:255',
            'guest' => 'nullable|string|max:255',
            'description' => 'required|string|max:255',
            'selectedColor' => 'required|string|max:255',
            'roleIcon' => 'required|string',
        ]);


        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput();

        };

        $data['roleName'] = $this->roleName;
        $data['description'] = $this->description;
        $data['selectedColor'] = $this->selectedColor;
        $data['roleIcon'] = $this->roleIcon;

        $role = \App\Models\Role::create([
            'name' => $data['roleName'],
            'description' => $data['description'],
            'color' => $data['selectedColor'],
            'icon' => $data['roleIcon'],
        ]);


        $selectedUserIDs = Arr::flatten($data['newStaffs']);
        $selectedUserIDs = array_map('intval', $selectedUserIDs);

        if ($selectedUserIDs) {

            $user = \App\Models\User::whereIn('id', $selectedUserIDs)->update(['is_staff'=> true]);
            // Filtra gli ID utente per rimuovere eventuali valori non validi
            $validUserIDs = \App\Models\User::whereIn('id', $selectedUserIDs)->pluck('id')->toArray();


            if (!empty($validUserIDs)) {
                $role->users()->attach($validUserIDs);
            }
        }

        return redirect()->route('home');

    }

    public function updatedSearchUser()
    {

        $this->isOpen = true;
    }




public function updatedSelectedColor(string $value)
{
    $this->selectedColor = $value;

    // Quando il colore selezionato viene aggiornato, aggiorniamo l'icona
}

}
