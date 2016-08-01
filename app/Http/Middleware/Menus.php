<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Menu;

class Menus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $listMenu =  DB::table('sys_menus_mst AS l1')
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


        Menu::make('MyNavBar', function($menu) use ($listMenu) {

         //     $menu->add('Home',     array('action'  => 'PMS\customerController@_index', 'class' => 'navbar navbar-home', 'id' => 'home'));

            // $menu->add('About', array('url'  => 'mst/customer', 'class' => 'navbar navbar-about dropdown'));  // URL: /about 

            // $menu->group(array('prefix' => 'about'), function($m){
            //  $m->add('Who we are?', 'who-we-are');   // URL: about/who-we-are
            //  $m->add('What we do?', 'what-we-do');   // URL: about/what-we-do
            // });

            // $menu->add('Contact',  'contact');

              $menu->add('Home');

              $about = $menu->add('About');//,    array('url'  => 'mst/pms/customer'));

              $whoAreWe = $about->add('Who are we');
              $whoAreWe->add('nothing', array('url'  => 'mst/pms/customer'));
              $about->add('What we do?', 'mst/pms/customer');

              $menu->add('services', 'services');
              $menu->add('Contact',  'contact');
        });

                        // <div class="menu_section">
                        //     <h3>General</h3>
                        //     <ul class="nav side-menu">
                        //         <li><a><i class="fa fa-home"></i> Home</a>
                        //         </li>
                        //         <li><a><i class="fa fa-bank"></i> Company Profile <span class="fa fa-chevron-down"></span></a>
                        //             <ul class="nav child_menu" style="display: none">
                        //                 <li><a href="index.html">Sejarah</a></li>
                        //                 <li><a href="index2.html">Struktur Organisasi</a></li>
                        //                 <li><a href="index2.html">Peraturan Perusahaan</a></li>
                        //                 <li><a href="index3.html">...</a></li>
                        //             </ul>
                        //         </li>
                        //         <li><a><i class="fa fa-navicon"></i> Serabutan <span class="fa fa-chevron-down"></span></a>
                        //             <ul class="nav child_menu" style="display: none">
                        //                 <li><a href="index.html">Download</a></li>
                        //                 <li><a href="index2.html">Gallery</a></li>
                        //                 <li><a href="index2.html">Event</a></li>
                        //                 <li><a href="index2.html">Extension</a></li>
                        //                 <li><a href="index3.html">...</a></li>
                        //             </ul>
                        //         </li>
                        //     </ul>
                        // </div>
        return $next($request);
    }
}
