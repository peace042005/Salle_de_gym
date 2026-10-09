<?php

namespace App\Http\Controllers\Site\Public;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Services\FedapayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    public function welcome(Request $request)
    {
        // get the search field value
        $search = $request->input('search');

        // do filtering
        if (isset($search)) {
            $rooms = Room::where('name', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%')
                ->orderBy('id', 'desc')
                ->paginate();
        } else {
            $rooms = Room::orderBy('id', 'desc')->paginate(9);
        }

        // return the view with de rooms data
        return view('site.public.gym.welcome', [
            "listRooms" => $rooms
        ]);
    }

    public function overview(Request $request, $id)
    {
        // get the search field value
        $search = $request->input('search');
        $room = Room::findOrFail($id);

        // do filtering
        if (isset($search)) {
            $outfits = $room->outfits()
                ->where('name', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%')
                ->orderBy('id', 'desc')
                ->paginate();
        } else {
            $outfits = $room->outfits()->orderBy('id', 'desc')->paginate(3);
        }

        // execute the fedapay callback action
        $fedapayService = new FedapayService();
        $fedapayService->useCheckout();

        // return the view with de rooms data
        return view('site.public.gym.overview', [
            "room" => $room,
            "listOutfits" => $outfits,
            'authenticatedUser' => Auth::user(),
        ]);
    }

    public function map()
    {
        return view('site.public.gym.room_map');
    }
}
