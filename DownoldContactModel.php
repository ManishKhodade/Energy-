<?php

namespace App\Models;

use CodeIgniter\Model;

class DownoldContactModel extends Model
{
    protected $table = '24_form_contact';
    protected $primaryKey = 'contact_id';
    protected $allowedFields = [
        'contact_rep_title',
        'contact_rep_id',
        'promotion_executive',
        'contact_person',
        'contact_email',
        'contact_email_cc',
        'contact_ForwardTo',
        'contact_ForwardName',
        'contact_ForwardEmail',
        'contact_status',
        'is_contact_outbound',
        'contact_org_type',
        'contact_form_type',
        'contact_country',
        'contact_phone',
        'contact_msg',
        'contact_company',
        'contact_discount_code',
        'contact_payment_mode',
        'contact_purchase',
        'contact_budget',
        'contact_discount_offered',
        'contact_real_country',
        'contact_exact_region',
        'contact_datetime',
        'contact_code',
        'contact_query_nature',
        'contact_job_role',
        'contact_client_id',
        'contact_plan',
        'contact_crm_view',
        'contact_publisher',
        'contact_report_url',
        'query_source',
        'sample_shared',
        'sales_person',
        'sample_confirm',
        'crm_auto_mode',
        'crm_current_stage',
        'manual_followup_dt',
        'subscribe_status',
        'reason',
        'feedback',
        'contact_last_updated_date',
        'tags',
        'email_alert',
        'client_email_status',
        'email_alert_status',
        'choose_report_id',
        'contact_similar_ids',
        'contact_time',
        'partner_confirm',
        'client_report_url'
    ];
}
