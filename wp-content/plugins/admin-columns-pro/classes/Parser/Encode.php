<?php
namespace ACP\Parser;

use AC\ListScreenCollection;

interface Encode {

	/**
	 * @param ListScreenCollection $listScreens
	 *
	 * @return array
	 */
	public function encode( ListScreenCollection $listScreens );

}