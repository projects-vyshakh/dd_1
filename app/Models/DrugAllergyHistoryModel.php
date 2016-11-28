<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DrugAllergyHistoryModel extends Model {

	protected $table 					= 'medical_history_drug_allergy';
	protected $primaryKey		= ' 	id_drug_allergy';
    protected $guarded 			= array(' 	id_drug_allergy');
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
