<?php

namespace App\Http\Livewire;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Profiles extends Component
{

    //tablas
    public $user;
    public $image;
    public $profile;

    //datos de la tabla user
    public $user_id;
    public $name;
    public $password;


    //datos de la tabla profiles
    public $profile_id;
    public $title;
    public $biography;
    public $website;
    public $facebook;
    public $linkedin;
    public $youtube;
    public $titok;
    public $snapchat;


    //datos de la tabla image
    public $image_id;
    public $url;
    public $imageable_id;
    public $imageable_type;


    public function mount(User $user)
    {
        $this->user = $user;
        $this->user_id = $user->id;
        $this->name = $user->name;


        //para el profile
        $this->profile = Profile::where('user_id', '=', $user->id)->first();
        if ($this->profile) {
            $this->profile_id =  $this->profile->id;
            $this->title =  $this->profile->title;
            $this->biography =  $this->profile->biography;
            $this->website =  $this->profile->website;
            $this->facebook =  $this->profile->facebook;
            $this->linkedin =  $this->profile->linkedin;
            $this->youtube =  $this->profile->youtube;
            $this->titok =  $this->profile->titok;
            $this->snapchat =  $this->profile->snapchat;
        }
    }

    public function render()
    {
        return view('livewire.profiles');
    }


    public function createProfile()
    {
        $this->validate([
            'title' => 'required',
            'biography' => 'required',
            'website' => 'required',
            'facebook' => 'required',
            'linkedin' => 'required',
            'youtube' => 'required',
            'titok' => 'required',
            'snapchat' => 'required',
        ]);


        $profile = Profile::create([
            'title' => $this->title,
            'biography' => $this->biography,
            'website' => $this->website,
            'facebook' => $this->facebook,
            'linkedin' => $this->linkedin,
            'youtube' => $this->youtube,
            'titok' => $this->titok,
            'snapchat' => $this->snapchat,
            'user_id' => $this->user_id
        ]);

        $this->profile = Profile::find($profile->id);
        $this->profile_id = $this->profile->id;
    }

    public function updateProfile()
    {
        $this->validate([
            'title' => 'required',
            'biography' => 'required',
            'website' => 'required',
            'facebook' => 'required',
            'linkedin' => 'required',
            'youtube' => 'required',
            'titok' => 'required',
            'snapchat' => 'required',
        ]);

        if ($this->profile) {
            $this->profile->update([
                'title' => $this->title,
                'biography' => $this->biography,
                'website' => $this->website,
                'facebook' => $this->facebook,
                'linkedin' => $this->linkedin,
                'youtube' => $this->youtube,
                'titok' => $this->titok,
                'snapchat' => $this->snapchat,
                'user_id' => $this->user_id
            ]);
        }

        $this->profile = Profile::find($this->profile->id);
        $this->profile_id = $this->profile->id;
    }


    public function updateUser()
    {
        $this->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        $this->user = User::find($this->user_id);
        $this->user->update([
            'name' => $this->name,
            'password' => Hash::make($this->password)
        ]);

        Auth::logout();
        return redirect()->route('login');
    }
}
