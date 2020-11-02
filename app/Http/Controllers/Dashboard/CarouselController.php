<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use Illuminate\Http\Request;

class CarouselController extends Controller
{
    public function index()
    {
        return view('dashboard.carousel.index', [
            'slides' => Slide::all(),
        ]);
    }

    public function create()
    {
        return view('dashboard.carousel.form', [
            'slide' => new Slide(),
            'action' => route('dashboard.carousel.store'),
            'method' => 'POST'
        ]);
    }

    public function store(Request $request)
    {
        $this->validate(
            $request,
            $this->getRules()
        );

        $slide = new Slide($request->only($this->getFields()));
        $slide->save();

        return redirect()
            ->route('dashboard.carousel.edit', ['id' => $slide->id])
            ->with('success', 'Slide Created');

    }

    public function edit($id)
    {
        $slide = Slide::findOrFail($id);

        return view('dashboard.carousel.form', [
            'slide' => $slide,
            'action' => route('dashboard.carousel.update', ['id' => $id]),
            'method' => 'PATCH'
        ]);
    }

    public function update(Request $request, $id)
    {
        $slide = Slide::findOrFail($id);

        $this->validate(
            $request,
            $this->getRules()
        );

        $slide->fill($request->only($this->getFields()));
        $slide->save();

        return redirect()
            ->route('dashboard.carousel.edit', ['id' => $slide->id])
            ->with('success', 'Slide Updated');
    }

    protected function getRules()
    {
        return [
            'title' => 'required|max:255',
            'url' => 'required|max:255',
            'caption' => 'required|max:255',
            'cta' => 'required|max:255',
            'image' => 'required|max:255',
            'background_image' => 'required|max:255',
        ];
    }

    protected function getFields()
    {
        return [
            'title',
            'url',
            'caption',
            'cta',
            'image',
            'image_metadata',
            'background_image',
            'background_image_metadata',
        ];
    }
}
