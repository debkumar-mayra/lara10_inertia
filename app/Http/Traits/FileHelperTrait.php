<?php
/**
 * Created by PhpStorm.
 * User: Gourab
 * Date: 08/4/19
 */

namespace App\Http\Traits;


use App\Models\Accessories;
use App\Models\AccessoriesImage;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

trait FileHelperTrait
{
    public static function fileUpload($file, $path)
    {
        try {
            $file_ext = $file->getClientOriginalExtension();
            $file_new_name = uniqid().time().rand(10,1000000).'.'.$file_ext;
            $file_dest = $path;
            $file->move($file_dest, $file_new_name);
            return $file_new_name;
        }
        catch ( \Exception $e ) {
            Log::error ( " :: EXCEPTION :: ".$e->getMessage()."\n".$e->getTraceAsString() );
            abort(500);
        }
        return 1;
    }




}
