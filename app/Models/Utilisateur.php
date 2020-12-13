<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Utilisateur
 * 
 * @property int $id_utilisateur
 * @property string|null $nom
 * @property string|null $prenom
 * @property string $telephone
 * @property string|null $session_id
 * @property string|null $session_level
 * @property string|null $langue
 * @property string $password
 * @property string|null $remember_token
 * 
 * @property Collection|Calendrier[] $calendriers
 *
 * @package App\Models
 */
class Utilisateur extends Model
{
	protected $table = 'utilisateur';
	protected $primaryKey = 'id_utilisateur';
	public $timestamps = false;

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'nom',
		'prenom',
		'telephone',
		'session_id',
		'session_level',
		'langue',
		'password',
		'remember_token',
		'temp_variable'
	];

	public function calendriers()
	{
		return $this->hasMany(Calendrier::class, 'id_utilisateur');
	}
}
