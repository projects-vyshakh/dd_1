<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PulmoMedicalHistoryModel extends Model {

	protected $table 			= 'pulmo_medical_history';
	protected $primaryKey		= 'id_medical_history';
    protected $guarded 			= array('id_medical_history');
	//public $incrementing 			= FALSE;
	public $timestamps 			= FALSE;



/*
  protected $fillable = array(  
															    `id_patient`, `id_doctor`, `doctor_specialization`, `history_family_father`, `history_family_father_other`, `history_family_mother`, `history_family_mother_other`, `history_family_sibling`, `history_family_sibling_other`, `history_family_grandfather`, `history_family_grandfather_other`, `history_family_grandmother`, `history_family_grandmother_other`, `history_allergy_general`, `history_allergy_drug`, `history_social_alcohol`, `history_social_tobacco_smoke`, `history_social_tobacco_chew`, `history_social_other`, `history_other_appetite`, `history_other_appetite_comments`, `history_other_sleep`, `history_other_sleep_comments`, `history_other_stool`, `history_other_stool_comments`, `history_other_urine`, `history_other_urine_comments`, `history_prev_intervention_anaesthesia`, `medical_history_reference`, `history_presentpast_no`, `history_family_no`, `history_surgery_no`, `history_generalallergy_no`, `history_drugallergy_no`, `history_social_no`, `created_date`, `edited_date`
															  );
*/

}
