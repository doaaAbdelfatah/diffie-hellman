<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DHAttackController extends Controller
{
    private $g = 7440685022082509198642540541;
    private $p = 74406850220820509198642540543;
    private $A = 19630064516685326108960632159;
    private $B = 17243764383965318353097666820;

    public function bruteForce()
    {
        ini_set('max_execution_time', 600); // 600 seconds = 10 minutes
        ini_set('memory_limit', '1024M'); // 1024 MB or 1 GB

        // Try to find 'a' by brute force
        $a = $this->findExponent($this->A);
        if ($a !== null) {
            // Calculate the shared secret key K
            $K = $this->modExp($this->B, $a, $this->p);
            return "Found 'a': $a, Shared secret key K: $K";
        }

        // If 'a' is not found, try to find 'b'
        $b = $this->findExponent($this->B);
        if ($b !== null) {
            // Calculate the shared secret key K
            $K = $this->modExp($this->A, $b, $this->p);
            return "Found 'b': $b, Shared secret key K: $K";
        }

        return "Could not find 'a' or 'b' by brute force.";
    }

    private function findExponent($target)
    {
        for ($i = 0; $i < $this->p; $i++) {
            if ($this->modExp($this->g, $i, $this->p) == $target) {
                return $i;
            }
        }
        return null;
    }

    private function modExp($base, $exp, $mod)
    {
        $result = 1;
        while ($exp > 0) {
            if ($exp % 2 == 1) {
                $result = ($result * $base) % $mod;
            }
            $exp = $exp >> 1;
            $base = ($base * $base) % $mod;
        }
        return $result;
    }
}
