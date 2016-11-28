<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalHistoryPresentPastModel extends Model {

	protected $table 					= 'medical_history_present_past_more';
	protected $primaryKey		= ' 	id_medical_history_present_past_more';
    protected $guarded 			= array('id_medical_history_present_past_more');
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
