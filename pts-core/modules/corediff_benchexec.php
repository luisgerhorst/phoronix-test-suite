<?php

/*
	Phoronix Test Suite
	URLs: http://www.phoronix.com, http://www.phoronix-test-suite.com/
	Copyright (C) 2015 - 2020, Phoronix Media
	Copyright (C) 2015 - 2020, Michael Larabel
    Copyright (C) 2020, Luis Gerhorst

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

// TODO: Create the same log files as the following bash code:
//


class corediff_benchexec extends pts_module_interface
{
	const module_name = 'corediff_benchexec';
	const module_version = '0.1.0';
	const module_description = 'Setting COREDIFF_BENCHEXEC will auto-load and enable this Phoronix Test Suite module. The module also depends upon running a modern Linux kernel (supporting perf) and that the perf binary is available via standard system paths.';
	const module_author = 'Luis Gerhorst';
    
	public static function module_environmental_variables()
	{
		return array('COREDIFF_BENCHEXEC', 'COREDIFF_BENCHEXEC_EXEC_BINARY_PREPEND');
	}

	public static function module_info()
	{
		return null;
	}

	public static function __run_manager_setup(&$test_run_manager)
	{
		// Verify COREDIFF_BENCHEXEC is set, `perf` can be found, and is Linux
		if(getenv('COREDIFF_BENCHEXEC') == 0 || !pts_client::executable_in_path('perf') || !phodevi::is_linux())
		{
			return pts_module::MODULE_UNLOAD; // This module doesn't have anything else to do
		}
		echo PHP_EOL . 'Corediff Benchexec Integration Enabled.' . PHP_EOL . PHP_EOL;

		// This module won't be too useful if you're not saving the results to see the graphs
		$test_run_manager->force_results_save();
	}

	public static function __pre_test_run(&$test_run_request)
	{
        $test_run_request->exec_binary_prepend = getenv('COREDIFF_BENCHEXEC_EXEC_BINARY_PREPEND') . ' ';

        echo PHP_EOL . '$test_run_request->exec_binary_prepend = ' . $test_run_request->exec_binary_prepend . PHP_EOL;
	}

	public static function __interim_test_run()
	{
		echo PHP_EOL . 'This test is being run multiple times for accuracy. Anything to do between tests?' . PHP_EOL . 'Called: __interim_test_run()' . PHP_EOL;
	}

	public static function __post_test_run()
	{
		echo PHP_EOL . 'We\'re all done running this specific test.' . PHP_EOL . 'Called: __post_test_run()' . PHP_EOL;
	}
}
?>
