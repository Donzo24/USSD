<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Consultation
 * 
 * @property int $id_consultation
 * @property Carbon $date_consultation
 * @property int $id_calendrier
 * 
 * @property Calendrier $calendrier
 *
 * @package App\Models
 */
class Consultation extends Model
{
	protected $table = 'consultation';
	protected $primaryKey = 'id_consultation';
	public $timestamps = false;

	protected $casts = [
		'id_calendrier' => 'int'
	];

	protected $dates = [
		'date_consultation'
	];

	protected $fillable = [
		'date_consultation',
		'id_calendrier'
	];

	public function calendrier()
	{
		return $this->belongsTo(Calendrier::class, 'id_calendrier');
	}
}
