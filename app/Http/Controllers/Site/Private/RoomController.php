<?php

namespace App\Http\Controllers\Site\Private;

use App\Http\Controllers\Controller;
use App\Models\Outfit;
use App\Models\Pricing;
use App\Models\Room;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class RoomController extends Controller
{
    public $fileService;
    public $authenticatedUser;
    public $fileStoragePath = "rooms";

    /**
     * 
     */
    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
        $this->authenticatedUser = Auth::user();
    }


    public function index(Request $request)
    {
        // get the search field value
        $search = $request->input('search');

        if ($this->authenticatedUser->role == "admin") {
            // do filtering
            if (isset($search)) {
                $roomLists = Room::where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orderBy('id', 'desc')
                    ->paginate();
            } else {
                $roomLists = Room::orderBy('id', 'desc')->paginate(9);
            }
        } else {
            // do filtering
            if (isset($search)) {
                $roomLists = $this->authenticatedUser->rooms()
                    ->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orderBy('id', 'desc')
                    ->paginate();
            } else {
                $roomLists = $this->authenticatedUser->rooms()->orderBy('id', 'desc')->paginate();
            }
        }

        // view with data
        return view('site.private.room.index', [
            'roomLists' => $roomLists,
        ]);
    }


    public function create()
    {
        if ($this->authenticatedUser->role == "admin") {
            // list of outfits
            $outfitsList = Outfit::pluck('name', 'id');
        } else {
            // list of outfits
            $outfitsList = Outfit::addedByManager($this->authenticatedUser->id)->pluck('name', 'id');
        }

        return view('site.private.room.form', [
            'room' => new Room(),
            'outfits' => $outfitsList,
            'pricings' => Pricing::pluck('name', 'id'),

        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'name' => 'required|string',
            'site_url' => 'nullable|string',
            'description' => 'required|string',
            'cover_image' => 'required|mimes:jpeg,png,jpg,gif',
            'overview_image' => 'required|mimes:jpeg,png,jpg,gif',
            'status' => ['required', Rule::in(0, 1)],
            'outfits' => 'required|array',
            'pricings' => 'required|array',
            'longitude' => 'required',
            'latitude' => 'required',
        ]);

        // dd($validatedData);
        (isset($request->site_url) == false) ? $siteUrl = 'http://127.0.0.1:8000' : $siteUrl = $validatedData['site_url'];


        // first create the room
        $room = Room::create([
            'name' => $validatedData['name'],
            'site_url' => $siteUrl,
            'description' => $validatedData['description'],
            'cover_image' => 'temporary_url',
            'overview_image' => 'temporary_url',
            'status' => $validatedData['status'],
            'user_id' => Auth::user()->id,
            'longitude' => $validatedData['longitude'],
            'latitude' => $validatedData['latitude']
        ]);

        // next connect the room & pricing to outfits
        $room->outfits()->sync($validatedData['outfits']);
        $room->pricings()->sync($validatedData['pricings']);

        // save updated image in storage & update the room images url
        $room->update([
            'cover_image' => $this->fileService->upload($validatedData['cover_image'], $this->fileStoragePath, "room_{$room->id}_cover_image"),
            'overview_image' => $this->fileService->upload($validatedData['overview_image'], $this->fileStoragePath, "room_{$room->id}_overview_image"),
        ]);


        // finaly redirect with success msg
        toast("La nouvelle salle a été ajouté avec succes", 'success');
        return to_route('management.room.index');
    }

    public function show($id)
    {
        return view('site.private.room.show', [
            'room' => Room::find($id)
        ]);
    }


    public function edit($id)
    {
        if ($this->authenticatedUser->role == "admin") {
            // list of outfits
            $outfitsList = Outfit::pluck('name', 'id');
        } else {
            // list of outfits
            $outfitsList = Outfit::addedByManager($this->authenticatedUser->id)->pluck('name', 'id');
        }

        return view('site.private.room.form', [
            'room' => Room::find($id),
            'outfits' => $outfitsList,
            'pricings' => Pricing::pluck('name', 'id'),
        ]);
    }


    public function update(Request $request, $id)
    {
        // dd($request);
        $validatedData = $request->validate([
            'name' => 'required|string',
            'site_url' => 'nullable|string',
            'description' => 'required|string',
            'cover_image' => 'nullable',
            'overview_image' => 'nullable',
            'status' => ['required', Rule::in(0, 1)],
            'outfits' => 'required|array',
            'pricings' => 'required|array',
            'longitude' => 'nullable',
            'latitude' => 'nullable',
        ]);

        // dd($validatedData);
        $room = Room::find($id);

        // next update the connected the room & pricing on outfits
        $room->outfits()->sync($validatedData['outfits']);
        $room->pricings()->sync($validatedData['pricings']);

        // fetch the old image path
        $newCoverImage = $room->cover_image;
        $newOverviewImage = $room->overview_image;

        // if coverImage is set in the request inputs
        if (isset($request['cover_image'])) {
            // first delete the file images
            $this->fileService->delete($room->cover_image);
            // then create the save the new image
            $newCoverImage = $this->fileService->upload($request['cover_image'], $this->fileStoragePath, "room_{$id}_cover_image");
        }

        // if overviewImage is set in the request inputs
        if (isset($request['overview_image'])) {
            // first delete the file images
            $this->fileService->delete($room->overview_image);
            // then create the save the new image
            $newOverviewImage = $this->fileService->upload($request['overview_image'], $this->fileStoragePath, "room_{$id}_overview_image");
        }

        // finaly update the reste fields
        $room->name = $validatedData['name'];
        $room->site_url = $validatedData['site_url'];
        $room->description = $validatedData['description'];
        $room->cover_image = $newCoverImage;
        $room->overview_image = $newOverviewImage;
        $room->status = $validatedData['status'];
        $room->latitude = $request['latitude'] ? $request['latitude'] : $room->latitude;
        $room->longitude = $request['longitude'] ? $request['longitude'] : $room->longitude;
        $room->save();

        toast("La salle a été mise-à-jour avec succes", 'success');
        return to_route('management.room.index');
    }

    public function destroy($id)
    {
        $room = Room::find($id);

        // 1. first delete the file images
        $this->fileService->delete([$room->cover_image, $room->overview_image]);

        // 2. next delete relation between this room and [outfits, princings]
        $room->outfits()->detach();
        $room->pricings()->detach();

        // 3. delete the outfit
        $room->delete();

        // 4. finaly redirect with success msg
        toast("La salle a été supprimée avec succes", 'success');
        return redirect()->back();
    }
}
