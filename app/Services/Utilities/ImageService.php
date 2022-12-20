<?php

namespace App\Services\Utilities;

use Image;
use File;

class ImageService {

	private $config;

    /**
     * Constructs a Image service class
     *
     */
    public function __construct($rootSize = 1920)
    {
    	$this->config = [ 
	        [
	            'path'=>'/',
	            'size'=>$rootSize,
	        ],[
	            'path'=>'/thumb/',
	            'size'=>200,
	        ]
	    ];

    }

    /**
     * Update user profile.
     * 
     * @param string
     * @param string
     * @param string
     * @return string
     */
    public function store($img, $path, $name)
    {
        if(!empty($img))
        {
            $filename = 'file_'.preg_replace('/[^a-zA-Z0-9_]/', '_', $name).'_'.time().'.'.$img->extension();

            $i=0;
            foreach($this->config as $setting)
            {
                // Chech if path exists and create
                if(!File::exists(public_path($path).$setting['path'])) File::makeDirectory(public_path($path).$setting['path'], 0755, true, true);

                // Store image
                if($img->extension() != 'svg'){
                    Image::make($img->getRealPath())
                        ->resize($setting['size'], $setting['size'], function ($constraint) {
                            $constraint->aspectRatio();
                            $constraint->upsize();
                        })->save(public_path($path).$setting['path'].$filename);
                }
                else
                {
                    if($i==0)
                        $img->move(public_path($path).$setting['path'],$filename);
                    else
                        File::copy(public_path($path).$this->config[0]['path'].$filename,public_path($path).$setting['path'].$filename);
                }
                $i=1;
            }

            return $filename;
        } else {
            return '';
        }
    }

    /**
     * Update user profile.
     * 
     * @param string
     * @param string
     * @param string
     * @return boolean
     */
    public function destroy($path, $name)
    {

        foreach($this->config as $setting)
            File::delete(public_path($path).$setting['path'].$name);

        return true;
    }

}