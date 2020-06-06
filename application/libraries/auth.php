<?php
class auth {
	public function random_string()
	{	
		$key = '';
		$keys = array_merge(range(0, 9), range('A', 'Z'));

		for ($i = 0; $i < 6; $i++) {
			$key .= $keys[array_rand($keys)];
		}
		return $key;
	}
}
	
	
?>