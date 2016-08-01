<?php

namespace App\Http\Controllers\Sys;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Models\sys_menus_mst as menu ;
use DB;

class menuController extends Controller
{
    //

    /**
     * @function index dibuat dan dikembangkan oleh rianday.
     * @depok
     * @return true
     */
    public function index(Request $req)
    {

	    $menus =  DB::table('sys_menus_mst AS l1')
	    			->select('l1.id_menu as id1', 'l1.nama_menu as menu1', 'l1.level', 'l2.id_menu as id2', 'l2.nama_menu as menu2', 'l3.id_menu as id3', 'l3.nama_menu as menu3', 'l4.id_menu as id4', 'l4.nama_menu as menu4')
		        	->leftJoin('sys_menus_mst AS l2', function($join){
		        		$join->on('l1.root','=','l2.id_menu')
		        		->where('l2.sys_status_aktif','=','A');
		        	})
		        	->leftJoin('sys_menus_mst AS l3', function($join){
		        		$join->on('l2.root','=','l3.id_menu')
		        		->where('l3.sys_status_aktif','=','A');
		        	})
		        	->leftJoin('sys_menus_mst AS l4', function($join){
		        		$join->on('l3.root','=','l4.id_menu')
		        		->where('l4.sys_status_aktif','=','A');
		        	})->where('l1.sys_status_aktif','A')->get();


		dd($menus);
        // select l1.id_menu as id1, l1.nama_menu as menu1, l2.id_menu as id2, l2.nama_menu as menu2, 
		// l3.id_menu as id3, l3.nama_menu as menu3, 
		// l4.id_menu as id4, l4.nama_menu as menu4 
		// from sys_menus_mst l1 
		// left join sys_menus_mst l2 on l1.root = l2.id_menu and l2.sys_status_aktif='A' 
		// left join sys_menus_mst l3 on l2.root = l3.id_menu and l3.sys_status_aktif='A'
		// left join sys_menus_mst l4 on l3.root = l4.id_menu and l4.sys_status_aktif='A'
		// where l1.sys_status_aktif = 'A'

    }
}
