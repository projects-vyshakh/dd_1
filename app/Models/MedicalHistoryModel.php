<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalHistoryModel extends Model {

	protected $table 			= 'medical_history';
	protected $primaryKey		= 'id_medical_history';
    protected $guarded 			= array('id_medical_history');
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
