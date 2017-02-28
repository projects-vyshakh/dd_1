<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AtlasDiseaseModel extends Model {

	protected $table 			= 'atlas_disease';
	protected $primaryKey		= 'id_disease';
    protected $guarded 			= array('id_disease');
	//public $incrementing 			= FALSE;
	public $timestamps 			= FALSE;

	



/*
  protected $fillable = array(  
															    'id_disease',
															    'name',
															    'approval_status',
															    'color',
															    'status',
															    'date_modified'
															  );
*/

}
