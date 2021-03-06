<?php

namespace App\Http\Controllers;

use App\Models\Smartphone;
use Auth;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class SmartphoneController extends Controller
{

    /**
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $smartphones = Smartphone::where('model', 'like', "%$searchTerm%")
                ->with(['brand', 'smartphonePrices', 'smartphonePrices.currency'])
                ->orderBy('featured', 'DESC')
                ->paginate(16);
        } else {
            $smartphones = Smartphone::where('launch_status', '!=', 'Discontinued')
                ->where('launch_status', '!=', 'Cancelled')
                ->with(['brand', 'smartphonePrices', 'smartphonePrices.currency'])
                ->orderBy('featured', 'DESC')
                ->paginate(16);
        }
        /* @var $smartphones LengthAwarePaginator|Smartphone */
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

        $smartphone->comments->append('likes_data')->load(['user', 'comments', 'comments.user']);
        $smartphone->append('has_user_rating');

        $smartphone->load(['brand', 'smartphonePrices', 'smartphonePrices.currency']);

        $smartphone->loadCount('ratings');
        $smartphone->loadAvg('ratings', 'stars');

        if (Auth::check()) {
            $smartphone->comments->append('has_liked');
        }
        return Inertia::render('Shop/Detail', ['smartphone' => $smartphone]);
    }

    public function getFeatured(): array|Collection
    {
        return Smartphone::where('featured', true)
            ->inRandomOrder()
            ->limit(5)
            ->with(['smartphonePrices:id,smartphone_id,currency_id,price', 'smartphonePrices.currency:id,symbol'])
            ->get(['id', 'model', 'misc_colors']);
    }
}
