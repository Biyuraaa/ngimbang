<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Blog;
use App\Models\Event;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Tag;
use App\Models\Umkm;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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


        $destinations = Destination::query()
            ->withCount('ratings')
            ->withAvg('ratings as average_rating', 'score')
            ->orderByDesc('average_rating')
            ->take(4)
            ->get()
            ->map(function ($destination) {
                return [
                    'id' => $destination->id,
                    'name' => $destination->name,
                    'slug' => $destination->slug,
                    'thumbnail' => $destination->thumbnail,
                    'title' => $destination->title ?? $destination->name,
                    'description' => Str::limit($destination->description, 150),
                    'rating' => number_format($destination->average_rating ?? 0, 1),
                    'reviews_count' => $destination->ratings_count ?? 0
                ];
            });

        $latestBlogs = Blog::latest()->take(3)->get();
        $latestEvents = Event::latest()->take(3)->get();
        $latestGalleries = Gallery::latest()->take(3)->get();

        return view('pages.home.index', compact(
            'products',
            'destinations',
            'latestBlogs',
            'latestEvents',
            'latestGalleries'
        ));
    }

    public function visiMisi()
    {
        return view('pages.abouts.visi-misi');
    }

    public function indexBlog()
    {
        $popularBlogs = Blog::orderBy('view_count', 'desc')->take(3)->get();
        $latestBlogs = Blog::latest()->take(3)->get();
        $blogs = Blog::paginate(8);
        $tags = Tag::all();
        return view('pages.informations.blogs.index', compact(
            'blogs',
            'popularBlogs',
            'latestBlogs',
            'tags'
        ));
    }

    public function showBlog(String $slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();

        $viewKey = 'blog-' . $blog->id . '-viewed';

        if (!session()->has($viewKey)) {
            Blog::where('id', $blog->id)->increment('view_count');

            $blog->blogViews()->create([
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'user_id' => Auth::id(),
            ]);
            session()->put($viewKey, Carbon::now()->addHours(24)->timestamp);
        } else {
            $expiryTime = session()->get($viewKey);
            if (Carbon::now()->timestamp > $expiryTime) {
                session()->forget($viewKey);

                return $this->showBlog($slug);
            }
        }

        return view('pages.informations.blogs.show', compact('blog'));
    }

    public function indexEvent()
    {
        $popularEvents = Event::withCount('comments')
            ->whereDate('start_date', '>=', now())
            ->orderByDesc('comments_count')
            ->take(3)
            ->get();
        $latestEvents = Event::latest()->take(3)->get();
        $events = Event::paginate(8);
        return view('pages.informations.events.index', compact(
            'popularEvents',
            'events',
            'latestEvents',
        ));
    }
    public function showEvent(String $slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();

        return view('pages.informations.events.show', compact('event'));
    }

    public function indexDestination()
    {
        $latestDestinations = Destination::latest()->take(3)->get();
        $popularDestinations = Destination::withCount('ratings')
            ->withAvg('ratings', 'score')
            ->having('ratings_count', '>', 0)
            ->orderBy('ratings_avg_score', 'desc')
            ->take(3)
            ->get();

        $allRating = number_format(Destination::whereHas('ratings')
            ->avg('ratings.score'), 1) ?? 0;
        $destinations = Destination::paginate(8);
        return view('pages.potentials.destinations.index', compact(
            'latestDestinations',
            'popularDestinations',
            'destinations',
            'allRating'
        ));
    }

    public function showDestination(String $slug)
    {
        $destination = Destination::where('slug', $slug)->firstOrFail();
        $destination->load('ratings', 'comments', 'attractions', 'facilities', 'socialMedia');

        return view('pages.potentials.destinations.show', compact('destination'));
    }

    public function faqs()
    {
        $faqs = Faq::where('status', 'published')->get();
        return view('pages.informations.faqs', compact('faqs'));
    }

    public function indexUmkm()
    {
        $latestUMKMs = Umkm::latest()->take(3)->get();
        $popularUMKMs = Umkm::select('umkms.id', 'umkms.name', 'umkms.address', 'umkms.slug')
            ->join('products', 'products.umkm_id', '=', 'umkms.id')
            ->join('ratings', 'ratings.rateable_id', '=', 'products.id')
            ->where('ratings.rateable_type', Product::class)
            ->groupBy('umkms.id', 'umkms.name', 'umkms.address', 'umkms.slug')
            ->selectRaw('AVG(ratings.score) as avg_rating, COUNT(ratings.id) as rating_count')
            ->orderByDesc('avg_rating')
            ->take(3)
            ->get();


        $umkms = Umkm::all();
        return view('pages.potentials.umkms.index', compact(
            'umkms',
            'latestUMKMs',
            'popularUMKMs'
        ));
    }

    public function showUmkm($slug)
    {
        $umkm = Umkm::where('slug', $slug)->firstOrFail();
        $umkm->load('products', 'socialMedia');
        $featuredProducts = Product::with(['ratings'])
            ->select('products.*')
            ->where('umkm_id', $umkm->id)
            ->withCount('ratings as rating_count')
            ->withAvg('ratings as average_rating', 'score')
            ->orderByDesc('average_rating')
            ->orderByDesc('rating_count')
            ->limit(3)
            ->get();
        return view('pages.potentials.umkms.show', compact(
            'umkm',
            'featuredProducts'
        ));
    }

    public function showProduct(String $umkmSlug, String $productSlug)
    {
        $umkm = Umkm::where('slug', $umkmSlug)->firstOrFail();
        $product = Product::where('slug', $productSlug)->firstOrFail();
        $product->load('galleries', 'ratings', 'comments');
        return view('pages.potentials.umkms.product', compact(
            'umkm',
            'product'
        ));
    }
    public function sejarahDesa()
    {
        $leaders = [
            [
                'name' => 'Joyo Darmo',
                'period' => 'Masa Penjajahan Belanda',
                'location' => 'Dusun Jantur',
            ],
            [
                'name' => 'Joyo Harjo',
                'period' => '1948–1958',
                'location' => 'Dusun Kapru',
            ],
            [
                'name' => 'Waselam',
                'period' => '1959–1966',
                'location' => 'Dusun Kandangan',
            ],
            [
                'name' => 'Kertoprayitno',
                'period' => '1967–1974',
                'location' => 'Dusun Prambatan',
            ],
            [
                'name' => 'Sarbani',
                'period' => '1974–1985',
                'location' => 'Dusun Kapru',
            ],
            [
                'name' => 'Darsono',
                'period' => '1986–1990',
                'location' => 'Dusun Talangrejo',
            ],
            [
                'name' => 'Rohman Karim',
                'period' => '1990–1998',
                'location' => 'Dusun Prambatan',
            ],
            [
                'name' => 'Soeliyono',
                'period' => '1998–2007',
                'location' => 'Dusun Prambatan',
            ],
            [
                'name' => 'Suliono',
                'period' => '2007–2013',
                'location' => 'Dusun Kapru',
            ],
            [
                'name' => 'Andi Susilo',
                'period' => '2013–sekarang',
                'location' => 'Dusun Talangsari',
            ],
        ];

        return view('pages.abouts.sejarah-desa', compact('leaders'));
    }


    public function informasiDesa()
    {
        return view('pages.abouts.informasi-desa');
    }

    public function indexGallery()
    {
        $galleries = Gallery::all();
        return view('pages.galleries', compact('galleries'));
    }

    public function sejarahDusun()
    {
        return view('pages.abouts.sejarah-dusun');
    }
}
