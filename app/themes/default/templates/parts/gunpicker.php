<?=B::form(
	array('method' => 'post'),
	join(array_map(function($gun) {
		return B::h4($gun->make . ' ^ ' . $gun->model)
		. B::ul(join(array_map(function($orgGun) use($gun) {
			$orgGun = $orgGun->orgMake;
			return B::li(
				B::label($orgGun->manufacturer . ' ^ ' . $orgGun->model)
				. B::input(array('type' => 'checkbox', 'name' => $gun->make . ' ^ ' . $gun->model, 'value' => $orgGun->id))
			);
		}, $gun->orgGuns)));
	}, $guns))
);


/*
 [0] => Array
        (
            [id] => 1
            [model] => 92/96D Brigadier
            [make] => BERETTA
            [rawId] => 2234
            [orgGuns] => Array
                (
                    [1] => Array
                        (
                            [id] => 1
                            [bMake] => 1
                            [orgMake] => Array
                                (
                                    [id] => 5
                                    [manufacturer] => Beretta
                                    [model] => 92 Brigadier D
                                    [bbl] => 4.9
                                )
*/
