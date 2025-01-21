<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RatingController extends Controller
{
    //

    public function store(Request $request)
    {

        $validatedData = $request->validate(
            [
                'rateable_id' => [
                    'required',
                    'integer',
                    function ($attribute, $value, $fail) use ($request) {
                        if ($request->rateable_type === 'App\Models\Destination') {
                            if (!\App\Models\Destination::where('id', $value)->exists()) {
                                $fail('ID destinasi tidak valid.');
                            }
                        } elseif ($request->rateable_type === 'App\Models\Product') {
                            if (!\App\Models\Product::where('id', $value)->exists()) {
                                $fail('ID produk tidak valid.');
                            }
                        } else {
                            $fail('Tipe rateable tidak valid.');
                        }
                    },
                ],
                'rateable_type' => 'required|string|in:App\Models\Destination,App\Models\Product',
                'score' => 'required|integer|min:1|max:5',
                'review' => 'required|string|min:10|max:1000',
            ],
            [
                'review.min' => 'Ulasan minimal 10 karakter',
                'review.required' => 'Ulasan tidak boleh kosong',
                'score.required' => 'Rating harus dipilih',
                'score.min' => 'Rating minimal 1 bintang',
                'score.max' => 'Rating maksimal 5 bintang',
                'rateable_id.required' => 'ID objek yang dinilai harus disediakan.',
                'rateable_id.integer' => 'ID objek yang dinilai harus berupa angka.',
                'rateable_type.in' => 'Tipe rateable tidak valid.',
            ]
        );



        try {
            $exists = Rating::where([
                'rateable_id' => $validatedData['rateable_id'],
                'rateable_type' => $validatedData['rateable_type'],
                'user_id' => Auth::id()
            ])->exists();

            if ($exists) {
                return back()->with('error', 'Anda sudah memberikan ulasan sebelumnya.');
            }

            Rating::create([
                'rateable_id' => $validatedData['rateable_id'],
                'rateable_type' => $validatedData['rateable_type'],
                'user_id' => Auth::id(),
                'score' => $validatedData['score'],
                'review' => $validatedData['review']
            ]);

            return back()->with('success', 'Terima kasih atas ulasan Anda!');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memberikan ulasan.');
        }
    }
}
