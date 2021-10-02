<?php

namespace App\Http\Controllers;

use App\Models\Smartphone;
use Auth;
use Inertia\Inertia;
use Inertia\Response;

class SmartphoneController extends Controller
{

    /**
     * @return Response
     */
    public function index(): Response
    {
        $smartphones = Smartphone::where('launch_status', '!=', 'Discontinued')
            ->where('launch_status', '!=', 'Cancelled')
            ->with(['brand', 'smartphonePrices', 'smartphonePrices.currency'])
            ->orderBy('featured', 'DESC')
            ->paginate(16);

        $smartphones->loadAvg('ratings', 'stars');
        $smartphones->loadCount('ratings');

        return Inertia::render('Shop/Index', ['smartphones' => $smartphones]);
    }

    /**
     * @param Smartphone $smartphone
     * @return Response
     */
    public function show(Smartphone $smartphone): Response
    {

        $smartphone->comments->append('likes_data')->load('user');

        $smartphone->load(['brand', 'smartphonePrices', 'smartphonePrices.currency']);

        $smartphone->loadCount('ratings');

        if (Auth::check()) {
            $smartphone->comments->append('has_liked');
        }

        return Inertia::render('Shop/Detail', ['smartphone' => $smartphone->loadAvg('ratings', 'stars')]);
    }

    public function getFeatured()
    {
        return Smartphone::where('featured', true)
            ->inRandomOrder()
            ->limit(5)
            ->with(['smartphonePrices:id,smartphone_id,currency_id,price', 'smartphonePrices.currency:id,symbol'])
            ->get(['id', 'model', 'misc_colors']);
    }
}
