@extends('layouts.app')

@section('title', 'Formulaire de Demande d\'inscription')

@section('content')
    <!-- Simple reliable loader -->



    <div id="formOverlay" class="position-fixed top-0 start-0 w-100 h-100 d-none"
        style="background: rgba(0,0,0,0.7); z-index: 9999;">
        <div class="position-absolute top-50 start-50 translate-middle text-center">
            <div class="spinner-border text-light" role="status" style="width: 3rem; height: 3rem;">
                <span class="visually-hidden">Chargement...</span>
            </div>
            <h5 class="text-white mt-3">{{ __('form.loader.message') }}</h5>
        </div>
    </div>

    <div class="container py-5">
        <!-- Header with simple gradient background -->
        <header class="header-custom text-white p-4 shadow-lg mb-5" style="margin-top: 70px; border-radius: 10px;">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="header-text">
                        <h1 class="display-5 fw-bold mb-2"><i class="fas fa-file-alt me-2"></i>{{ __('form.page_title') }}
                        </h1>
                        <div class="header-line mb-3"></div>
                        <p class="lead">{{ __('form.page_description') }}</p>
                    </div>
                </div>
                <div class="col-md-4 text-md-end text-center mt-3 mt-md-0">
                    <img src="{{ asset('storage/images/logo.png') }}" alt="Logo" class="img-fluid"
                        style="max-height: 100px;">
                </div>
            </div>
        </header>

        <!-- Form Card -->
        <div class="card shadow-lg border-0 mb-4">
            <div class="card-body p-4 p-md-5">
                <!-- Alert messages -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                        <div class="d-flex">
                            <div class="me-3">
                                <i class="fas fa-check-circle fa-2x"></i>
                            </div>
                            <div>
                                <h5 class="alert-heading">Succès !</h5>
                                <p class="mb-0">{{ session('success') }}</p>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                        <div class="d-flex">
                            <div class="me-3">
                                <i class="fas fa-exclamation-triangle fa-2x"></i>
                            </div>
                            <div>
                                <h5 class="alert-heading">Erreur !</h5>
                                <p class="mb-0">{{ session('error') }}</p>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                        <div class="d-flex">
                            <div class="me-3">
                                <i class="fas fa-exclamation-circle fa-2x"></i>
                            </div>
                            <div>
                                <h5 class="alert-heading">{{ __('form.fields.validation.error_title') }}</h5>
                                <ul class="mb-0 mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Single Page Form -->
                <form id="applicationForm" action="{{ route('inscription.store') }}" method="POST" class="needs-validation"
                    novalidate>
                    @csrf

                    <!-- Personal Information Section -->
                    <div class="mb-4">
                        <h3 class="section-title mb-3">
                            <i class="fas fa-user-circle me-2 text-primary"></i>
                            Informations Personnelles
                        </h3>

                        <div class="row g-4">
                            <div class="col-md-6">
                                <label for="first_name" class="form-label">
                                    <i class="fas fa-user text-primary me-2"></i>{{ __('form.fields.first_name') }} *
                                </label>
                                <input type="text" class="form-control form-control-lg" id="first_name" name="first_name"
                                    value="{{ old('first_name') }}" required>
                                <div class="invalid-feedback">
                                    Veuillez entrer votre prénom.
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="last_name" class="form-label">
                                    <i class="fas fa-user-tag text-primary me-2"></i>{{ __('form.fields.last_name') }} *
                                </label>
                                <input type="text" class="form-control form-control-lg" id="last_name" name="last_name"
                                    value="{{ old('last_name') }}" required>
                                <div class="invalid-feedback">
                                    Veuillez entrer votre nom.
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope text-primary me-2"></i>{{ __('form.fields.email') }} *
                                </label>
                                <input type="email" class="form-control form-control-lg" id="email" name="email"
                                    value="{{ old('email') }}" required>
                                <div class="invalid-feedback">
                                    Veuillez entrer une adresse email valide.
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="phone_number" class="form-label">
                                    <i class="fas fa-phone text-primary me-2"></i>{{ __('form.fields.phone_number') }} *
                                </label>
                                <input type="tel" class="form-control form-control-lg" id="phone_number"
                                    name="phone_number" value="{{ old('phone_number') }}" required>
                                <div class="invalid-feedback">
                                    Veuillez entrer un numéro de téléphone valide.
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="birth_date" class="form-label">
                                    <i
                                        class="fas fa-calendar-alt text-primary me-2"></i>{{ __('form.fields.birth_date') }}
                                    *
                                </label>
                                <input type="date" class="form-control form-control-lg" id="birth_date"
                                    name="birth_date" value="{{ old('birth_date') }}" required>
                                <div class="invalid-feedback">
                                    Veuillez entrer votre date de naissance.
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="birth_place" class="form-label">
                                    <i
                                        class="fas fa-map-marker-alt text-primary me-2"></i>{{ __('form.fields.birth_place') }}
                                    *
                                </label>
                                <input type="text" class="form-control form-control-lg" id="birth_place"
                                    name="birth_place" value="{{ old('birth_place') }}" required>
                                <div class="invalid-feedback">
                                    Veuillez entrer votre lieu de naissance.
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="id_card_number" class="form-label">
                                    <i class="fas fa-id-card text-primary me-2"></i>{{ __('form.fields.id_card_number') }}
                                    *
                                </label>
                                <input type="text" class="form-control form-control-lg" id="id_card_number"
                                    name="id_card_number" value="{{ old('id_card_number') }}" required>
                                <div class="invalid-feedback">
                                    Veuillez entrer votre numéro de carte d'identité.
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="marital_status" class="form-label">
                                    <i
                                        class="fas fa-heart text-primary me-2"></i>{{ __('form.marital_status_options.chosen') }}
                                    *
                                </label>
                                <select class="form-select form-select-lg" id="marital_status" name="marital_status"
                                    required>
                                    <option value="" disabled selected>Sélectionnez une option</option>
                                    <option value="single" {{ old('marital_status') == 'single' ? 'selected' : '' }}>
                                        {{ __('form.marital_status_options.single') }}</option>
                                    <option value="married" {{ old('marital_status') == 'married' ? 'selected' : '' }}>
                                        {{ __('form.marital_status_options.married') }}</option>
                                    <option value="divorced" {{ old('marital_status') == 'divorced' ? 'selected' : '' }}>
                                        {{ __('form.marital_status_options.divorced') }}</option>
                                    <option value="widowed" {{ old('marital_status') == 'widowed' ? 'selected' : '' }}>
                                        {{ __('form.marital_status_options.widowed') }}</option>
                                </select>
                                <div class="invalid-feedback">
                                    Veuillez sélectionner votre situation matrimoniale.
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Professional Information Section -->
                    <div class="mb-4">
                        <h3 class="section-title mb-3">
                            <i class="fas fa-briefcase me-2 text-primary"></i>
                            Informations Professionnelles
                        </h3>

                        <div class="row g-4">
                            <div class="col-md-6">
                                <label for="years_of_experience" class="form-label">
                                    <i
                                        class="fas fa-briefcase text-primary me-2"></i>{{ __('form.fields.years_of_experience') }}
                                    *
                                </label>
                                <input type="number" class="form-control form-control-lg" id="years_of_experience"
                                    name="years_of_experience" min="0" max="50"
                                    value="{{ old('years_of_experience') }}" required>
                                <div class="invalid-feedback">
                                    Veuillez entrer un nombre valide d'années d'expérience.
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="education_level" class="form-label">
                                    <i
                                        class="fas fa-university text-primary me-2"></i>{{ __('form.fields.education_level') }}
                                    *
                                </label>
                                <input type="text" class="form-control form-control-lg" id="education_level"
                                    name="education_level" value="{{ old('education_level') }}" required>
                                <div class="invalid-feedback">
                                    Veuillez entrer votre niveau d'éducation.
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit button -->
                    <div class="d-grid gap-2 mt-5">
                        <button type="submit" class="btn btn-success btn-lg" id="submitBtn">
                            <i class="fas fa-paper-plane me-2"></i>{{ __('form.submit_button') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Footer -->

    </div>
@endsection

@push('styles')
    <style>
        /* Import font */
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&display=swap');

        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f5f7fa;
        }

        /* Header styles */
        .header-custom {
            background: linear-gradient(135deg, #2c3e50, #4ca1af);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .header-line {
            width: 80px;
            height: 4px;
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 2px;
        }

        /* Section title */
        .section-title {
            color: #2c3e50;
            font-weight: 700;
            padding-bottom: 10px;
            border-bottom: 1px solid #e9ecef;
        }

        /* Form control styles */
        .form-control,
        .form-select {
            border: 1px solid #dde2e6;
            border-radius: 8px;
            padding: 12px 16px;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #4ca1af;
            box-shadow: 0 0 0 0.25rem rgba(76, 161, 175, 0.25);
        }

        /* Label styles */
        .form-label {
            font-weight: 600;
            margin-bottom: 8px;
        }

        /* Button styles */
        .btn {
            border-radius: 8px;
            padding: 12px 24px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-success:hover,
        .btn-success:focus {
            background-color: #218838;
            border-color: #1e7e34;
        }

        /* Alert styles */
        .alert {
            border-radius: 10px;
            border: none;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        /* Card styles */
        .card {
            border-radius: 12px;
        }

        /* Responsive adjustments */
        @media (max-width: 767.98px) {
            .btn {
                padding: 10px 16px;
            }

            .form-control,
            .form-select {
                padding: 10px 14px;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Elements
            const form = document.getElementById('applicationForm');
            const formOverlay = document.getElementById('formOverlay');
            const submitBtn = document.getElementById('submitBtn');

            // Form validation
            form.addEventListener('submit', function(e) {
                if (!this.checkValidity()) {
                    e.preventDefault();
                    e.stopPropagation();

                    // Show error message at the top of the form
                    const invalidFields = this.querySelectorAll(':invalid');
                    if (invalidFields.length > 0) {
                        invalidFields[0].focus();

                        // Create alert for error message
                        const alertDiv = document.createElement('div');
                        alertDiv.className = 'alert alert-danger alert-dismissible fade show mb-4';
                        alertDiv.setAttribute('role', 'alert');
                        alertDiv.innerHTML = `
                        <div class="d-flex">
                            <div class="me-3">
                                <i class="fas fa-exclamation-circle fa-2x"></i>
                            </div>
                            <div>
                                <h5 class="alert-heading">Attention</h5>
                                <p class="mb-0">Veuillez remplir tous les champs obligatoires marqués d'un astérisque (*).</p>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    `;

                        // Insert at the top of the form
                        const cardBody = this.closest('.card-body');
                        const firstChild = cardBody.firstChild;
                        cardBody.insertBefore(alertDiv, firstChild);

                        // Scroll to the top of the form
                        window.scrollTo({
                            top: cardBody.offsetTop - 100,
                            behavior: 'smooth'
                        });
                    }
                } else {
                    // Show loading overlay
                    submitBtn.disabled = true;
                    formOverlay.classList.remove('d-none');
                }

                this.classList.add('was-validated');
            });

            // Field validation on input
            const formInputs = document.querySelectorAll('input, select, textarea');
            formInputs.forEach(input => {
                input.addEventListener('input', function() {
                    if (this.checkValidity()) {
                        this.classList.remove('is-invalid');
                    }
                });
            });

            // Auto dismiss success alert after 5 seconds
            const successAlert = document.querySelector('.alert-success');
            if (successAlert) {
                setTimeout(() => {
                    const closeBtn = successAlert.querySelector('.btn-close');
                    if (closeBtn) closeBtn.click();
                }, 5000);
            }

            // Scroll to alert messages if present
            const alerts = document.querySelectorAll('.alert');
            if (alerts.length > 0) {
                alerts[0].scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }
        });
    </script>
@endpush
