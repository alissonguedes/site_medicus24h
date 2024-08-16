<?php

namespace App\View\Components;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\View\Component;

class CalendarLayout extends Component {
	public $months = [];

	public function __construct() {
		collect(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'])->each(function ($month) {

			$start = Carbon::parse($month)->startOfMonth()->startOfWeek();
			$end   = Carbon::parse($month)->endOfMonth()->endOfWeek();

			$this->months[$month] = CarbonPeriod::create($start, $end);
		});
	}

	public function render() {
		return view('components.calendar-component');
	}

}