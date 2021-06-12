<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MatrixController extends Controller
{
	public function matrix_multiplication(Request $request)
	{
		$matrix_a = $request->session()->pull('matrix_a');
		$matrix_b = $request->session()->pull('matrix_b');
		$rows = [];
		for ($i=0; $i < count($matrix_a); $i++) {
			$columns = [];
			for ($j=0; $j < count($matrix_b); $j++) { 
				$columns[] = count($matrix_b[$j]);
			}
			$rows[] = count($matrix_a[$i]);
		}
		$new_matrix = [];
		if(count(array_unique($columns)) === 1 && count(array_unique($rows))){
			for ($i = 0; $i < count ($matrix_a); $i++) {
				$new_matrix[] = [];
				for ($j = 0; $j < count ($matrix_a[$i]); $j++) {
					$new_matrix[$i][] = 0;
					for ($k = 0; $k < count ($matrix_a[$i]); $k++) {
						$new_matrix[$i][$j] += $matrix_a[$i][$k] * $matrix_b[$k][$j];
					}
				}
			}
			return back()->with('result', $new_matrix);
		} else{
			return back()->with('error_message', 'Matrix A and Matrix B do not have equal number of rows and Columns.');
			
		}
	}

	public function add_matrix(Request $request)
	{
		if (!empty($request->matrix_a)) {
			$matrix = $request->matrix_a;
			$matrix_elements = [];
			foreach (explode(',', $matrix) as $element) {
				$matrix_elements[] = (int) $element;
			}
			$name = 'Matrix A';
			$request->session()->push('matrix_a', $matrix_elements);
		} elseif(!empty($request->matrix_b)) {
			$matrix = $request->matrix_b;
			$matrix_elements = [];
			foreach (explode(',', $matrix) as $element) {
				$matrix_elements[] = (int) $element;
			}
			$name = 'Matrix B';
			$request->session()->push('matrix_b', $matrix_elements);
		}
		
		return back()->with('success_message', 'Added elements to '.$name);
	}

	public function clear_matrix(Request $request)
	{
		$request->session()->flush();
		return back();
	}
}
