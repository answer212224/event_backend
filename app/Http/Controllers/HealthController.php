<?php

namespace App\Http\Controllers;

use App\Models\Health;
use Illuminate\Http\Request;

class HealthController extends Controller
{
    public function update()
    {
        $health = Health::find(1);

        if (!$health) {
            $health = Health::create([
                'views' => 0
            ]);
        }

        $health->update([
            'views' => $health->views + 1
        ]);

        return response([
            'views' => $health->views
        ]);
    }
}
