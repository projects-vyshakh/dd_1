<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PediatricExaminationModel extends Model {

	protected $table 			= 'pediatric_examination';
	protected $primaryKey		= 'id_pediatric_examination';
    protected $guarded 			= array('id_pediatric_examination');
	//public $incrementing 			= FALSE;
	public $timestamps 			= FALSE;



}
