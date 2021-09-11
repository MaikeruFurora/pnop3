<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Strand;
use Illuminate\Http\Request;

class StrandController extends Controller
{
    public function storeStrand(Request $request)
    {
        if (empty(Helper::activeAY())) {
            return response()->json(['error' => 'No Academic Year Active']);
        } else {
            return Strand::updateorcreate(
                ['id' => $request->id],
                [
                    'strand' => $request->strand,
                    'description' => $request->description,
                ]
            );
        }
    }

    public function listStrand()
    {
        return response()->json(Strand::all());
    }

    public function editStrand(Strand $strand)
    {
        return response()->json($strand);
    }

    public function destroyStrand(Strand $strand)
    {
        return $strand->delete();
    }
}
