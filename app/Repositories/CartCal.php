<?php
namespace App\Repositories;
use Illuminate\Support\Facades\Facade;

class CartCal extends Facade{
    
    protected static function getFacadeAccessor() {
	return 'CartCalculation';
    }
}
?>