<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AtlasDiseaseRecordModel extends Model {

	protected $table 			= 'atlas_disease_record';
	protected $primaryKey		= 'id_disease_record';
    protected $guarded 			= array('id_disease_record');
	//public $incrementing 			= FALSE;
	public $timestamps 			= FALSE;

	



/*
  protected $fillable = array(  
															    'id_disease_record',
															    'id_country',
															    'id_state',
															    'id_city',
															    'id_disease',
															    'species',
															    'cases',
															    'deaths',
															    'risk',
															    'date_created',
															    'source',
															    'source_details',
															    'disease_approval_status',
															    'disease_status',
															    'date_approved',
															    'info_date',
															    'summary',
															    'id_sender',
															    'id_species',
															    'approval_status',
															    'id_source',
															    'sender_name',
															    'state_name',
															    'country_name',
															    'city_name',
															    'disease_name',
															    'date_modified',
															    'record_by_admin',
															    'latitude',
															    'longitude',
															  );
*/

}
