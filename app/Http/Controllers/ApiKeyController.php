<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\ApiKey;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ApiKeyController extends Controller
{
    public function index()
    {
        $user = request()->user();
        $apiKeys = $user->apiKeys()->get();

        return Inertia::render('ApiKey/Index', [
            'apiKeys' => $apiKeys
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255']
        ]);

        $apiKey = ApiKey::create([
            'uuid' => 'api-' . Str::uuid(),
            'user_id' => $request->user()->id,
            'name' => $request->name,
            'key' => Str::random(32)
        ]);

        return redirect()->route('api-keys.index');
    }

    public function destroy(ApiKey $apiKey)
    {
        $apiKey->delete();

        return redirect()->route('api-keys.index');
    }
}
