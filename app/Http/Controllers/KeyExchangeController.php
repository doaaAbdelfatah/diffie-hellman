<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KeyExchangeController extends Controller
{
    private $p = 107;
    private $g = 3;

    // private $g = 7440685022082509198642540541;
    // private $p = 74406850220820509198642540543;
    // private $A = '19630064516685326108960632159';
    // private $B = '17243764383965318353097666820';

    public function showForm()
    {
        return view('key-exchange-form');
    }

    public function generateKey(Request $request)
    {
        $request->validate([
            'b' => 'required|min:0|max:' . ($this->p - 1),
            'A' => 'required'
        ]);

        $b = $request->input('b');
        $A = $request->input('A');

        // Calculate public key part B
        $B = bcpowmod($this->g, $b, $this->p);

        // Calculate shared secret key
        $k_b = bcpowmod($A, $b, $this->p);

        return view('key-exchange-result', [
            'B' => $B,
            'k_b' => $k_b
        ]);
    }
}
