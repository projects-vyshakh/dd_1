<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientsModel extends Model {

	protected $table 			= 'patients';
	protected $primaryKey		= 'id_patient';
    protected $guarded 			= array('id_patient');
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
