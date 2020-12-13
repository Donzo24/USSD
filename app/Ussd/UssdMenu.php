<?php 

namespace App\Ussd;

use App\Models\{Utilisateur};

/**
 * 
 */
class UssdMenu
{
	protected $request;
	protected $level = 0;
	protected $sessionId;
	protected $msisdn;
	protected $response;
	protected $user;
	protected $check;
	
	function __construct($data)
	{
		$this->request = $data;

		$this->sessionId = $data->sessionId;
		$this->msisdn = $data->msisdn;
		$this->response = $data->has('response') ? $data->input('response'):null;

		$this->setUser();

		$this->initSession();
	}

	public function setUser()
	{
		$this->user = Utilisateur::firstOrCreate([
			'telephone' => $this->msisdn
		]);
	}

	public function isNewSession()
	{
		if ($this->user->session_id == $this->sessionId) {
			return false;
		}

		$this->user->update([
			'session_id' => $this->sessionId
		]);

		return true;
	}

	public function initSession()
	{
		$items = collect();

		if ($this->isNewSession()) {
			$items->push(1);
			$this->setUserTempVariable(true);
			$this->check = true;
		}else{
			$items = $items->merge(explode("-", $this->user->session_level));
			$this->check = false;
		}

		$this->user->update([
			'session_level' => $items->count() ? $items->join('-'):null
		]);

		$this->level = $this->user->session_level;
	}

	public function setUserLevel($array)
	{
		$items = collect(explode("-", $this->user->session_level));

		if ($this->isMenuNumber() AND !in_array($this->response, $array)) {
			$items->push($this->response);
		}else{
			$items->push(1);
		}

		$this->user->update([
			'session_level' => $items->join('-')
		]);

		$this->level = $this->user->session_level;
	}

	public function changeLastItem($new = "1")
	{
		$items = collect(explode("-", $this->user->session_level));
		$key = $items->count()-1;

		$items = $items->replace([
			$key => $new
		]);

		$this->user->update([
			'session_level' => $items->join('-')
		]);

		$this->level = $this->user->session_level;

	}

	public function isMenuNumber()
	{
		return preg_match('/^[1-9]$/', $this->response) AND is_numeric($this->response) AND ($this->response < 10);
	}

	public function getMenu()
	{
		$this->traitement();

		return $this->level;
	}

	public function userTempVariables()
	{
		return explode(";", $this->user->temp_variable);
	}

	public function setUserTempVariable($clean = false)
	{
		$current = collect($this->userTempVariables());
		$current->push($this->response);

		$this->user->update([
			'temp_variable' => $clean ? null:$current->join(';')
		]);
	}

	public function traitement()
	{
		if (!$this->check) {
			$this->setUserLevel([
				'1-1-1',
				'1-1-1-1',
				'1-1-1-1-1',
				'1-1-1-1-1-1'
			]);

			if ($this->contains('/^1\-1\-1\-1\-1\-[1-9]$/')) {
				$this->changeLastItem();
			}
		}
			

		if ($this->level == "1-1-1-1") {
			//Date derniere regle
			$this->setUserTempVariable();

		}elseif ($this->level == "1-1-1-1-1") {
			//Duree cycle
			$this->setUserTempVariable();

		}elseif ($this->level == "1-1-1-1-1-1") {
			//Langue alerte
			$this->setUserTempVariable();

		}elseif ($this->level == "1-1-2") {
			//prochaine consultation
		}elseif ($this->level == "1-1-3") {
			//date acouchement
		}
	}

	public function contains($reg)
	{
		return preg_match($reg, $this->level);
	}
}

?>