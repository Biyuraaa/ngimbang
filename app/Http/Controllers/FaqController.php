<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFaqRequest;
use App\Http\Requests\UpdateFaqRequest;
use Illuminate\Support\Facades\Auth;


class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        /**  @var User $user */
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            abort(403, 'Anda tidak memiliki izin untuk melihat FAQ.');
        }
        $faqs = Faq::paginate(10);
        return view('dashboard.faqs.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            abort(403, 'Anda tidak memiliki izin untuk membuat FAQ.');
        }
        return view('dashboard.faqs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFaqRequest $request)
    {
        //
        $validatedData = $request->validated();
        try {
            Faq::create($validatedData);
            return redirect()->route('faqs.index')->with('success', 'FAQ berhasil dibuat.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat membuat FAQ.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Faq $faq)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Faq $faq)
    {
        //
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            abort(403, 'Anda tidak memiliki izin untuk membuat FAQ.');
        }
        return view('dashboard.faqs.edit', compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFaqRequest $request, Faq $faq)
    {
        //
        $validatedData = $request->validated();
        try {
            $faq->update($validatedData);
            return redirect()->route('faqs.index')->with('success', 'FAQ berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui FAQ.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faq $faq)
    {
        //
        try {
            $faq->delete();
            return redirect()->route('faqs.index')->with('success', 'FAQ berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus FAQ.');
        }
    }
}
