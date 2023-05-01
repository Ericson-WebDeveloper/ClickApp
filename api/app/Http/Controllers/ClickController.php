<?php

namespace App\Http\Controllers;

use App\Interface\ClickInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClickController extends Controller
{
    private $click_repo;
    private $today;

    public function __construct(ClickInterface $click)
    {
        $this->click_repo = $click;
        $this->today = Carbon::today();
    }

    public function index(Request $request)
    {
        try {
            // check if have click record today
            $clicks = $this->click_repo->index($this->today);

            if ($clicks) {
                // if have return current count clicks
                return response()->json(['clicks' => $clicks], 200);
            } else {
                // if not have return 0 count clicks
                return response()->json(['clicks' => null], 200);
            }
        } catch (\Exception $e) {
            // return success false
            return response()->json(['success' => false], 500);
        }
    }

    public function create(Request $request)
    {
        try {
            // create/update clicks recount count
            $click = $this->click_repo->storeOrupdate($this->today);
            // return newly/update click entry for today
            return response()->json(['success' => true, 'click' => $click], 201);
        } catch (\Exception $e) {
            // return success false
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}
