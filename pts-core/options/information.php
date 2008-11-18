<?php

/*
	Phoronix Test Suite
	URLs: http://www.phoronix.com, http://www.phoronix-test-suite.com/
	Copyright (C) 2008, Phoronix Media
	Copyright (C) 2008, Michael Larabel

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 3 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program. If not, see <http://www.gnu.org/licenses/>.
*/

class information
{
	public static function run($r)
	{
		$to_info = $r[0];

		if(pts_is_suite($to_info))
		{
			$suite = new pts_test_suite_details($to_info);
			echo $suite->info_string();
		
			echo "\n";
		}
		else if(pts_is_test($to_info))
		{
			$suite = new pts_test_profile_details($to_info);
			echo $suite->info_string();
		
			echo "\n";
		}
		else
		{
			echo "\n" . $to_info . " is not recognized.\n";
		}
	}
}

?>
