<?php

return [
    'page_title' => 'Formulaire de demande d inscription',
    'page_description' => 'Remplissez ce formulaire pour soumettre votre candidature.',
    
    'loader' => [
        'message' => 'Traitement en cours...',
    ],
    
    'fields' => [
        'first_name' => 'Prénom',
        'last_name' => 'Nom',
        'email' => 'Adresse e-mail',
        'birth_date' => 'Date de naissance',
        'birth_place' => 'Lieu de naissance',
        'id_card_number' => 'Numéro de carte d identité',
        'phone_number' => 'Numéro de téléphone',
        'marital_status' => 'Situation familiale',
        'years_of_experience' => 'Années d expérience',
        'education_level' => 'Niveau d éducation',
        
        'validation' => [
            'error_title' => 'Veuillez corriger les erreurs suivantes:',
            'required_fields' => 'Veuillez remplir tous les champs obligatoires',
        ],
    ],
    
    'marital_status_options' => [
        'chosen' => 'Choisir',
        'single' => 'Célibataire',
        'married' => 'Marié(e)',
        'divorced' => 'Divorcé(e)',
        'widowed' => 'Veuf/Veuve',
    ],
    
    'submit_button' => 'Soumettre ma candidature',
    
    'submission' => [
        'success' => 'Votre candidature a été soumise avec succès! Votre numéro de référence est :reference',
        'error' => 'Une erreur s est produite lors de la soumission de votre candidature. Veuillez réessayer.',
    ],
    
    'validation' => [
        'email_unique' => 'Cette adresse e-mail est déjà utilisée par une autre candidature.',
        'id_card_unique' => 'Ce numéro de carte d identité est déjà utilisé par une autre candidature.',
        'birth_date_past' => 'La date de naissance doit être dans le passé.',
    ],
    'loader' => [
        'message' => 'Chargement en cours...',
    ],
    'success' => [
        'title' => 'Succès',
        'message' => 'Votre candidature a été soumise avec succès.',
    ],
];