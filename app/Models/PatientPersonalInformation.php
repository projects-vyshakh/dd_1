<?php namespace App;
use Illuminate\Database\Eloquent\Model;


class PatientPersonalInformation extends Model{


  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'patients';

  protected $primaryKey = 'id_patient';

  public $incrementing = FALSE;

  public $timestamps = false;

  protected $guarded = array('id_patient');

  protected $fillable = array(
    'id_patient',
    'first_name',
    'middle_name',
    'last_name',
    'id_aadhar',
    'gender',
    'dob',
    'age',
    'maritial_status',
    'house_name',
    'street',
    'city',
    'state',
    'pincode',
    'country',
    'phone',
    'email',
    'created_date',
    'id_doctor'
  );

}
