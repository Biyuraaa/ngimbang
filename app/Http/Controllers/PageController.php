<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;

class PageController extends Controller
{
    //

    public function index()
    {
        $products = [
            [
                'name' => 'Padi',
                'color' => 'green',
                'icon' => 'fa-wheat-awn'
            ],
            [
                'name' => 'Jagung',
                'color' => 'yellow',
                'icon' => 'fa-seedling'
            ],
            [
                'name' => 'Kacang Tanah',
                'color' => 'red',
                'icon' => 'fa-leaf'
            ],
            [
                'name' => 'Ubi Kayu',
                'color' => 'purple',
                'icon' => 'fa-carrot'
            ],
            [
                'name' => 'Tebu',
                'color' => 'pink',
                'icon' => 'fa-tree'
            ],
            [
                'name' => 'Tembakau',
                'color' => 'indigo',
                'icon' => 'fa-cannabis'
            ]
        ];


        $destinations = Destination::all()->only(['name', 'slug', 'thumbnail', 'description']);

        return view('pages.home.index', compact(
            'products',
            'destinations',
        ));
    }

    public function informasiDesa()
    {
        return view('pages.profiles.informasi-desa');
    }

    public function sejarah()
    {
        return view('pages.profiles.sejarah');
    }

    public function visiMisi()
    {
        return view('pages.profiles.visi-misi');
    }
}
