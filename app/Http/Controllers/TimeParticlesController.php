<?php

namespace App\Http\Controllers;

use App\Models\TimeParticle as TimeParticleModel;
use Illuminate\Http\Request;

class TimeParticlesController extends Controller
{
    public function index(TimeParticleModel $timeParticle)
    {
        $timeParticles = $timeParticle
                        ->orderBy('created_at', 'desc')
                        ->paginate(144);
        return view('time_particles.index', compact('timeParticles'));
    }
}
