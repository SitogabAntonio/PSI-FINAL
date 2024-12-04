<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;

class InformasiGerejaMobileAPIController extends Controller
{
    public function APIGetInformasi()
    {
        $getallinformasi = User::with(['ayatHarians', 'organisasiGereja', 'events', 'wartaJemaats.detailWartas', 'sukaDukaCitas'])->get();

        return response($getallinformasi, 200);
    }
}
