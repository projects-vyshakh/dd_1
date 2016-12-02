<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorsModel extends Model {

	protected $table 			= 'doctors';
	protected $primaryKey		= 'id_doctor';
    protected $guarded 			= array('id_doctor');
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
