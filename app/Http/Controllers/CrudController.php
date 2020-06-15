<?php

namespace App\Http\Controllers;

use App\Http\Requests\offerRequest;
use App\Models\offer;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\DocBlock\Tags\Method;

class CrudController extends Controller
{
    use OfferTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getOffers()
    {
        return offer::get();
    }

    public function create()
    {

        return view('offers.create');
    }

    public function store(offerRequest $request)
    {

//        $rules = $this->getRules();
//
//        $messages = $this->getMessages();
//
//        $validator = Validator::make($request->all(), $rules, $messages);
//
//        if ($validator->fails()) {
//            return redirect()->back()->withErrors($validator)->withInput($request->all());
//        }

        $file_name=   $this->saveImage($request->photo, 'images/offers');

        offer::create([
            'photo' => $file_name,
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'price' => $request->price,
            'details_ar' => $request->details_ar,
            'details_en' => $request->details_en,
        ]);

        return redirect()->back()->with(['success' => __('messages.offer_added')]);


    }

    public function getAllOffers()
    {
        $lang = app()->getLocale();
        $offers = offer::select('id', 'name_' . $lang . ' as name', 'price', 'details_' . $lang . ' as details')->get();

        return view('offers.all', compact('offers'));
    }

    public function editOffer($offer_id)
    {

        Offer::findOrfail($offer_id);

        $offer = Offer::select('id', 'name_ar', 'name_en', 'price', 'details_ar', 'details_en')->find($offer_id);


        return view('offers.edit', compact('offer'));

    }

    public function updateOffer(offerRequest $request, $offer_id)
    {
        $offer = Offer::select('id', 'name_ar', 'name_en', 'price', 'details_ar', 'details_en')->find($offer_id);

        if (!$offer) return redirect()->back();


        $offer->update($request->all());

        return redirect()->back()->with(['success' => __('messages.offer_updated')]);
    }




//    protected function getMessages()
//    {
//
//        return $messages = [
//            'name.required' => __('messages.offer_name_required'),
//            'name.max' => __('messages.offer_name_max'),
//            'name.unique' => __('messages.offer_name_unique'),
//            'price.required' => __('messages.offer_price_required'),
//            'price.numeric' => __('messages.offer_price_numeric'),
//            'details.required' => __('messages.offer_details_required'),
//        ];
//    }

//    protected function getRules()
//    {
//        return $rules = [
//            'name' => 'required|max:100|unique:offers,name',
//            'price' => 'required|numeric',
//            'details' => 'required',
//
//        ];
//    }
}
