<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class PageBuilderController extends Controller
{
    /**
 * Edit the given page with the page builder.
 *
 * @param int|null $pageId
 * @throws Throwable
 */
        public function build($pageId = null)
        {
            $route = $_GET['route'] ?? null;
            $action = $_GET['action'] ?? null;
            $pageId = is_numeric($pageId) ? $pageId : ($_GET['page'] ?? null);
            $pageRepository = new \PHPageBuilder\Repositories\PageRepository;
            $page = $pageRepository->findWithId($pageId);

            $phpPageBuilder = app()->make('phpPageBuilder');
            $pageBuilder = $phpPageBuilder->getPageBuilder();

            $customScripts = view("pagebuilder.scripts")->render();
            $pageBuilder->customScripts('head', $customScripts);

            $pageBuilder->handleRequest($route, $action, $page);
        }

        public function Allpages(){
        $routes = Route::getRoutes('/pappu');
            $pageList = DB::table('pagebuilder__pages')
            ->join('pagebuilder__page_translations','pagebuilder__pages.id','=','pagebuilder__page_translations.page_id')
            ->select('pagebuilder__pages.*','pagebuilder__page_translations.title','pagebuilder__page_translations.route as uri')
            ->get();
            return view('pages-list.index',compact('pageList'));
        }

        public function delete($id){
            DB::table('pagebuilder__pages')->where('id', $id)->delete();
            return redirect()->back();
        }


        public function create(Request $request){
            $this->validate($request,[
                'name' => 'required|unique:pagebuilder__pages',
                'uri' => 'required|unique:pagebuilder__page_translations,route',
                'layouts' => 'required',
            ]);
           $id= DB::table('pagebuilder__pages')->insertGetId([
                'name' => $request->name,
                'layout' => $request->layouts,
            ]);

            $insertPageInfo = DB::table('pagebuilder__page_translations')->insert([
                'page_id' => $id,
                'locale' => 'en',
                'title' => $request->name,
                'route' => $request->uri,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // $pageinfo =  DB::table('pagebuilder__pages')->find($id);

            // return $pageinfo;
            return redirect()->route('pagebuilder.build','page='.$id);

        }
}
