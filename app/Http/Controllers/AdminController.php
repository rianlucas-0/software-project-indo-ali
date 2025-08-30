<?php

namespace App\Http\Controllers;

use App\Models\Local;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function addlocal()
    {
        return view('admin.add_local');
    }

    public function createlocal(Request $request)
    {
        $local = new Local();
        $local->title = $request->title;
        $local->description = $request->description;

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagename = time().'_'.uniqid().'.'.$image->getClientOriginalExtension();
                $image->move('img', $imagename);
                $images[] = $imagename;
            }
        }
        $local->images = json_encode($images);

        $local->cep = $request->cep;
        $local->address = $request->address;
        $local->address_number = $request->address_number;
        $local->neighborhood = $request->neighborhood;
        $local->city = $request->city;
        $local->state = $request->state;
        $local->phone = $request->phone;
        $local->contact_email = $request->contact_email;
        $local->category = $request->category;
        $local->features = json_encode($request->features);

        $workingHours = [];
        if ($request->working_days) {
            foreach ($request->working_days as $day) {
                $workingHours[$day] = [
                    'opening' => $request->input('opening_time_'.$day),
                    'closing' => $request->input('closing_time_'.$day)
                ];
            }
        }
        $local->working_hours = json_encode($workingHours);
        $local->user_name = Auth::user()->name;
        $local->user_id = Auth::user()->id;

        if ($local->save()) {
            return redirect()->route('admin.addlocal')->with('status', 'Adicionado com sucesso!');
        }
    }

    public function all_local()
    {
        $local = Local::all();
        return view('admin.all_local', compact('local'));
    }

    public function updatelocal($id)
    {
        $local = Local::findOrFail($id);
        return view('admin.updatelocal', compact('local'));
    }

    public function localupdate(Request $request, $id)
    {
        $local = Local::findOrFail($id);
        $local->title = $request->title;
        $local->description = $request->description;

        $images = json_decode($local->images ?? '[]', true);

        if ($request->filled('images_to_remove')) {
            $toRemove = explode(',', $request->images_to_remove);
            foreach ($toRemove as $remove) {
                if (file_exists(public_path('img/'.$remove))) {
                    unlink(public_path('img/'.$remove));
                }
                $images = array_filter($images, fn($img) => $img !== $remove);
            }
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagename = time().'_'.uniqid().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('img'), $imagename);
                $images[] = $imagename;
            }
        }

        $local->images = json_encode(array_values($images));
        $local->cep = $request->cep;
        $local->address = $request->address;
        $local->address_number = $request->address_number;
        $local->neighborhood = $request->neighborhood;
        $local->city = $request->city;
        $local->state = $request->state;
        $local->phone = $request->phone;
        $local->contact_email = $request->contact_email;
        $local->category = $request->category;
        $local->features = json_encode($request->features);

        $workingHours = [];
        if ($request->working_days) {
            foreach ($request->working_days as $day) {
                $workingHours[$day] = [
                    'opening' => $request->input('opening_time_'.$day),
                    'closing' => $request->input('closing_time_'.$day)
                ];
            }
        }
        $local->working_hours = json_encode($workingHours);
        $local->user_name = Auth::user()->name;
        $local->user_id = Auth::user()->id;

        if ($local->save()) {
            return redirect()->route('admin.all_local', $id)->with('status', 'Atualizado com sucesso!');
        }
    }

    public function destroy($id) {
        $local = Local::findOrFail($id);
        $local->delete();

        return redirect()->route('admin.all_local')->with('status', 'Deletado com sucesso');
    }
}
