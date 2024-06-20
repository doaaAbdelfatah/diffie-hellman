<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiffieHellmanController extends Controller
{
    // Given values
    private $g = '7440685022082509198642540541';
    private $p = '74406850220820509198642540543';
    private $A = '19630064516685326108960632159';
    private $B = '17243764383965318353097666820';

    public function index()
    {
        ini_set('memory_limit', '4048M'); // Increase memory limit
        ini_set('max_execution_time',-1); // Increase execution time

        $a = $this->babyStepGiantStep($this->g, $this->p, $this->A);

        if ($a !== null) {
            $K = gmp_powm(gmp_init($this->B), $a, gmp_init($this->p));
        } else {
            $K = null;
        }

        return response()->json([
            'private_key_a' => $a ? gmp_strval($a) : null,
            'shared_secret_key_K' => $K ? gmp_strval($K) : null
        ]);
    }

    private function babyStepGiantStep($g, $p, $h)
    {
        $g = gmp_init($g);
        $p = gmp_init($p);
        $h = gmp_init($h);

        $m = gmp_sqrt($p) + 1;

        // Baby steps
        $babySteps = [];
        $current = gmp_init(1);
        for ($j = 0; $j < gmp_intval($m); $j++) {
            $babySteps[gmp_strval($current)] = $j;
            $current = gmp_mod(gmp_mul($current, $g), $p);
        }

        // Giant step precomputation
        $g_m = gmp_powm($g, $m, $p);
        $g_m_inv = gmp_invert($g_m, $p);  // Use gmp_invert for modular inverse
        $current = $h;

        for ($i = 0; $i < gmp_intval($m); $i++) {
            if (array_key_exists(gmp_strval($current), $babySteps)) {
                return gmp_add(gmp_mul($i, $m), gmp_init($babySteps[gmp_strval($current)]));
            }
            $current = gmp_mod(gmp_mul($current, $g_m_inv), $p);
        }

        return null;
    }
}
