<?php

return [
    'page_title' => 'استمارة طلب التسجيل',
    'page_description' => 'املأ هذا النموذج لتقديم طلبك.',
    
    'loader' => [
        'message' => 'جاري المعالجة...',
    ],
    
    'fields' => [
        'first_name' => 'الاسم الأول',
        'last_name' => 'اسم العائلة',
        'email' => 'البريد الإلكتروني',
        'birth_date' => 'تاريخ الميلاد',
        'birth_place' => 'مكان الميلاد',
        'id_card_number' => 'رقم بطاقة الهوية',
        'phone_number' => 'رقم الهاتف',
        'marital_status' => 'الحالة الاجتماعية',
        'years_of_experience' => 'سنوات الخبرة',
        'education_level' => 'المستوى التعليمي',
        
        'validation' => [
            'error_title' => 'يرجى تصحيح الأخطاء التالية:',
            'required_fields' => 'يرجى ملء جميع الحقول المطلوبة',
        ],
    ],
    
    'marital_status_options' => [
        'chosen' => 'اختر',
        'single' => 'أعزب',
        'married' => 'متزوج',
        'divorced' => 'مطلق',
        'widowed' => 'أرمل',
    ],
    
    'submit_button' => 'تقديم طلبي',
    
    'submission' => [
        'success' => 'تم تقديم طلبك بنجاح! رقم المرجع الخاص بك هو :reference',
        'error' => 'حدث خطأ أثناء تقديم طلبك. يرجى المحاولة مرة أخرى.',
    ],
    
    'validation' => [
        'email_unique' => 'هذا البريد الإلكتروني مستخدم بالفعل من قبل طلب آخر.',
        'id_card_unique' => 'رقم بطاقة الهوية هذا مستخدم بالفعل من قبل طلب آخر.',
        'birth_date_past' => 'يجب أن يكون تاريخ الميلاد في الماضي.',
    ],
    'loader' => [
        'message' => 'جارٍ التحميل...',
    ],
    'success' => [
        'title' => 'نجاح',
        'message' => 'تم تقديم طلبك بنجاح.',
    ],
];