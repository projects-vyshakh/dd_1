<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrescriptionModel extends Model {

	protected $table 			= 'prescription';
	protected $primaryKey		= 'id_prescription';
    protected $guarded 			= array('id_prescription');
	//public $incrementing 			= FALSE;
	public $timestamps 			= FALSE;

	




}
