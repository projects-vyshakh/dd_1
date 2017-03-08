<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PulmoMedicalOtherHistoryModel extends Model {

	protected $table 			= 'pulmo_medical_other_history';
	protected $primaryKey		= 'id_other_historyPrimary';
    protected $guarded 			= array('id_other_historyPrimary');
	//public $incrementing 			= FALSE;
	public $timestamps 			= FALSE;



/*
  protected $fillable = array(  
															    `id_patient`, `id_doctor`, `other_history_name`, `other_history_status`, `other_history_comments`, `other_history_reference`, `created_date`, `edited_date`
															  );
*/

}
