<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecializationModel extends Model {

	protected $table 			= 'specialization';
	protected $primaryKey		= 'id_specialization';
    protected $guarded 			= array('id_specialization');
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
