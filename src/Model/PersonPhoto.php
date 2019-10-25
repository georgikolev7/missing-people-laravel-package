<?php

namespace Slavic\MissingPersons\Model;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use DB;
use File;

class PersonPhoto extends Model
{
    protected $table = 'person_photo';
    
    /**
     * Associations.
     *
     * @var object | collect
     */
    public function person()
    {
        return $this->belongsTo('Slavic\MissingPersons\Model\Person', 'person_id');
    }
    
    /**
     * Get dir path for uploading pictures
     *
     * @var object
     */
    public static function dirPath($person_id)
    {
        if (!empty($person_id)) {
            return storage_path('app/public/photos/item-'. $person_id . '/');
        } else {
            return '';
        }
    }
    
    public function store($id, $request)
    {
        // store
    }
    
    
    public static function remove($photo_name, $person_id)
    {
        $photo = self::where(['name' => $photo_name, 'person_id' => $person_id])->first();
        $path = self::dirPath($person_id);
        
        File::delete(
            storage_path('app/public/') . $photo->file,
            storage_path('app/public/') . $photo->thumb,
            storage_path('app/public/') . $photo->icon
        );
        
        self::where('photo_id', $photo->photo_id)->delete();
        
        return array('result' => true);
    }
    
    /**
     * Create thumbnails of uploaded pictures
     *
     * @var object | collect
     */
    public static function createThumbnails($id, $files)
    {
        foreach ($files as $key => $file) {
            $upload_path = $file['name'];
            $ext = pathinfo($upload_path, PATHINFO_EXTENSION);
            $thumbnail_name = str_replace('.' . $ext, '_thumb.' . $ext, $file['file']);
            $icon_name = str_replace('.' . $ext, '_icon.' . $ext, $file['file']);
            $img = \Image::make($file['file']);
            $img->fit(778, 1000)->save($file['file']);
            $img->fit(350, 450)->save($thumbnail_name);
            
            // Icon size for markers on the map
            $img->fit(45, 45)->save($icon_name);
            
            $files[$key]['thumb'] = $thumbnail_name;
            $photo = new self();            
            $photo->name = $file['name'];
            $photo->file = str_replace(storage_path('app/public/'), '', $file['file']);
            $photo->size = $file['size'];
            $photo->type = $file['type'];
            $photo->thumb = str_replace(storage_path('app/public/'), '', $thumbnail_name);
            $photo->icon = str_replace(storage_path('app/public/'), '', $icon_name);
            $photo->person_id = $id;            
            $photo->save();
        }
    }
    
    /**
     * Find photos by person.
     *
     * @return object
     */
    public static function getByPerson($person_id)
    {
        return self::where('person_id', '=', $person_id)->get();
    }
}
