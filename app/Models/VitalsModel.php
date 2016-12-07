<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VitalsModel extends Model {

	protected $table 			= 'vitals';
	protected $primaryKey		= 'id_vitals';
    protected $guarded 			= array('id_vitals');
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
