<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Calendrier
 * 
 * @property int $id_calendrier
 * @property Carbon $date_derniere_regle
 * @property Carbon $date_debut
 * @property Carbon $date_fin
 * @property int $duree_cycle
 * @property int $phase_lutuale
 * @property int $id_utilisateur
 * 
 * @property Utilisateur $utilisateur
 * @property Collection|Consultation[] $consultations
 *
 * @package App\Models
 */
class Calendrier extends Model
{
	protected $table = 'calendrier';
	protected $primaryKey = 'id_calendrier';
	public $timestamps = false;

	protected $casts = [
		'duree_cycle' => 'int',
		'phase_lutuale' => 'int',
		'id_utilisateur' => 'int'
	];

	protected $dates = [
		'date_derniere_regle',
		'date_debut',
		'date_fin'
	];

	protected $fillable = [
		'date_derniere_regle',
		'date_debut',
		'date_fin',
		'duree_cycle',
		'phase_lutuale',
		'id_utilisateur'
	];

	public function utilisateur()
	{
		return $this->belongsTo(Utilisateur::class, 'id_utilisateur');
	}

	public function consultations()
	{
		return $this->hasMany(Consultation::class, 'id_calendrier');
	}
}
