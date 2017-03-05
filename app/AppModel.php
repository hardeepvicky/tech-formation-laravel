<?php
namespace App;
use \Illuminate\Support\Facades\Auth;

abstract class AppModel extends \Illuminate\Database\Eloquent\Model
{
    use \Kyslik\ColumnSortable\Sortable;    
    
    public static $snakeAttributes = false, $authUser = [];
    
    //format for saving in database
    protected $dateFormat = "Y-m-d H:i:s";
    
    protected $children = [], $parents = [];
    
    protected $createdBy = true, $updatedBy = true, $deletedBy = true, $createdAt = true, $updatedAt = true;

    /**
     * Listen for event
     */
    protected static function boot()
    {
        self::$authUser = Auth::user();
        
        if (self::$authUser)
        {
            self::$authUser = self::$authUser->toArray();
        }
        
        parent::boot();
        
        static::saving(function($model)
        {
            return $model->beforeSave();
        });
        
        static::updating(function($model)
        {
            return $model->beforeSave();
        });
        
        static::deleting(function($model)
        {
            return $model->beforeDelete();
        });
    }
    
    /**
     * event before save
     * @return bool
     */
    protected function beforeSave()
    {
        if ($this->exists)
        {
            if ($this->updatedAt)
            {
                $this->setAttribute(self::UPDATED_AT, date($this->dateFormat));
            }

            if ($this->updatedBy && isset(self::$authUser["id"]))
            {
                $this->setAttribute("updated_by", self::$authUser["id"]);
            }
        }
        else
        {
            if ($this->createdAt)
            {
                $this->setAttribute(self::CREATED_AT, date($this->dateFormat));
            }

            if ($this->createdBy && isset(self::$authUser["id"]))
            {
                $this->setAttribute("created_by", self::$authUser["id"]);
            }
        }
        
        return true;
    }
    
    /**
     * event before delete
     * @return bool
     */
    protected function beforeDelete()
    {
        $record = $this->with($this->getChildren())->findOrFail($this->id);
        
        foreach($record->relations as $relation)
        {
            if ($relation->count() > 0)
            {
                return false;
            }
        }
        
        if ($this->deletedBy && in_array("SoftDeletes", class_uses($this)))
        {
            if (isset(self::$authUser["id"]))
            {
                $this->setAttribute("deleted_by", self::$authUser["id"]);
            }
            
            $this->save();
        }
        
        return true;
    }

    public function getParents() 
    {
        return $this->parents;
    }
    
    public function getChildren() 
    {
        return $this->children;
    }
}