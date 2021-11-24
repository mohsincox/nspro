<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use File;
use Response;
use Config;

class DownloadController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function getDownloadIndex()
	{
		$ADMIN_LOGIN = Config::get('constants.ADMIN_LOGIN');
        $ADMIN_PASSWORD = Config::get('constants.ADMIN_PASSWORD');
          
        if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) || ($_SERVER['PHP_AUTH_USER'] != $ADMIN_LOGIN) || ($_SERVER['PHP_AUTH_PW'] != $ADMIN_PASSWORD)) { 
            header('HTTP/1.1 401 Unauthorized'); 
            header('WWW-Authenticate: Basic realm="Password For Blog"'); 
            exit("Access Denied: Username and password required."); 
        } else {
			return view('download.index');
		}
	}

    public function getDownloadOne()
	{
		// $file= public_path(). "/download/info.pdf";
	 //    $headers = array(
	 //              'Content-Type: application/pdf',
	 //            );
	 //    return Response::download($file, 'filename.pdf', $headers);
	    
	    $file = public_path(). "/download/Nestle-Data1.xlsx";

	    return Response::download($file, 'Nestle-Data1.xlsx');
	}

	public function getDownloadTwo()
	{
	    $file = public_path(). "/download/Nestle-Data2.xlsx";

	    return Response::download($file, 'Nestle-Data2.xlsx');
	}

	public function getDownloadThree()
	{
	    $file = public_path(). "/download/Nestle-Data3.xlsx";

	    return Response::download($file, 'Nestle-Data3.xlsx');
	}

	public function getDownloadFour()
	{
	    $file = public_path(). "/download/Nestle-Data4.xlsx";

	    return Response::download($file, 'Nestle-Data4.xlsx');
	}

	public function getDownloadFive()
	{
	    $file = public_path(). "/download/Nestle-Data5.xlsx";

	    return Response::download($file, 'Nestle-Data5.xlsx');
	}

	public function getDownloadSix()
	{
	    $file = public_path(). "/download/Nestle-Data6.xlsx";

	    return Response::download($file, 'Nestle-Data6.xlsx');
	}

	public function getDownloadSeven()
	{
	    $file = public_path(). "/download/Nestle-Data7.xlsx";

	    return Response::download($file, 'Nestle-Data7.xlsx');
	}

	public function getDownloadEight()
	{
	    $file = public_path(). "/download/Nestle-Data8.xlsx";

	    return Response::download($file, 'Nestle-Data8.xlsx');
	}

	public function getDownloadNine()
	{
	    $file = public_path(). "/download/Nestle-Data9.xlsx";

	    return Response::download($file, 'Nestle-Data9.xlsx');
	}

	public function getDownloadTen()
	{
	    $file = public_path(). "/download/Nestle-Data10.xlsx";

	    return Response::download($file, 'Nestle-Data10.xlsx');
	}

	public function getDownloadEleven()
	{
	    $file = public_path(). "/download/Nestle-Data11.xlsx";

	    return Response::download($file, 'Nestle-Data11.xlsx');
	}

	public function getDownloadTwelve()
	{
	    $file = public_path(). "/download/Nestle-Data12.xlsx";

	    return Response::download($file, 'Nestle-Data12.xlsx');
	}
}
