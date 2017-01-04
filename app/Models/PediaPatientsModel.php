<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PediaPatientsModel extends Model {

	protected $table 			= 'pedia_patients';
	protected $primaryKey		= 'id_pedia_patient';
    protected $guarded 			= array('id_pedia_patient');
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
