<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PathologyModel extends Model {

	protected $table 			= 'pathology_report';
	protected $primaryKey		= 'id_pathology_report';
    protected $guarded 			= array('id_pathology_report');
	//public $incrementing 			= FALSE;
	public $timestamps 			= FALSE;



/*
  protected $fillable = array(  
															    'id_patient',
															    'id_doctor',
															    'illness_name',
															    'illness_status',
															    'medication',
															    'illness_reference',
															    'created_date',
															    'updated_date'
															  );
*/

}
