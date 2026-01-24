<?php

use App\Models\TripTemplate;
use Illuminate\Support\Facades\DB;

$trips = DB::table('trip_templates')->select('id', 'includes')->get();

foreach ($trips as $t) {
    echo "Trip ID {$t->id}: " . $t->includes . "\n";
}
