<footer class="pt-5" style="background-color: #12553f; padding-bottom: 0 !important;">
    <div class="container">
        <div class="row g-4">
            <!-- Logo et informations -->
            <div class="col-lg-4 mb-4 mb-lg-0">
                <div class="d-flex align-items-center mb-3">
                    <img src="{{ asset('storage/images/logo.png') }}" alt="Logo" height="50" class="me-3">
                    <h5 class="text-white fw-bold mb-0">{{ __('footer.center_name') }}</h5>
                </div>
                <div style="width: 60px; height: 3px; background-color: #ffc107;" class="mb-3"></div>
                <p class="text-white-50 mb-3">{{ __('footer.description') }}</p>
                <p class="text-white mb-1"><i class="fas fa-map-marker-alt me-2"></i>{{ __('footer.address') }}</p>
                <p class="text-white mb-1"><i class="fas fa-envelope me-2"></i>crp@markaz-oujda.com</p>
            </div>

            <!-- Liens rapides -->
            <div class="col-lg-3 mb-4 mb-lg-0">
                <h5 class="text-white mb-3">{{ __('footer.quick_links.title') }}</h5>
                <div style="width: 40px; height: 3px; background-color: #ffc107;" class="mb-3"></div>
                <ul class="list-unstyled footer-links">
                    <li class="mb-2"><a href="{{ route('home') }}#hero" class="text-white-50 text-decoration-none"><i
                                class="fas fa-chevron-right me-2 small"></i>{{ __('footer.quick_links.home') }}</a></li>
                    <li class="mb-2"><a href="{{ route('home') }}#surNous"
                            class="text-white-50 text-decoration-none"><i
                                class="fas fa-chevron-right me-2 small"></i>{{ __('footer.quick_links.about') }}</a>
                    </li>
                    <li class="mb-2"><a href="{{ route('home') }}#gallery"
                            class="text-white-50 text-decoration-none"><i
                                class="fas fa-chevron-right me-2 small"></i>{{ __('footer.quick_links.gallery') }}</a>
                    </li>
                    <li class="mb-2"><a href="{{ route('home') }}#location"
                            class="text-white-50 text-decoration-none"><i
                                class="fas fa-chevron-right me-2 small"></i>{{ __('footer.quick_links.location') }}</a>
                    </li>
                    
                    <li><a href="{{ route('admin.dashboard') }}" class="text-white-50 text-decoration-none"><i
                                class="fas fa-user-shield me-2 small"></i>Admin</a>
                    </li>
                </ul>
            </div>

            <!-- Unités -->
            <div class="col-lg-3 mb-4 mb-lg-0">
                <h5 class="text-white mb-3">{{ __('footer.units.title') }}</h5>
                <div style="width: 40px; height: 3px; background-color: #ffc107;" class="mb-3"></div>
                <ul class="list-unstyled footer-links">
                    <li class="mb-2"><a href="#formations" class="text-white-50 text-decoration-none"><i
                                class="fas fa-microscope me-2"></i>{{ __('footer.units.research') }}</a></li>
                    <li class="mb-2"><a href="#consultations" class="text-white-50 text-decoration-none"><i
                                class="fas fa-book me-2"></i>{{ __('footer.units.documentation') }}</a></li>
                    <li><a href="#ateliers" class="text-white-50 text-decoration-none"><i
                                class="fas fa-users me-2"></i>Atelier en ligne</a></li>
                </ul>
            </div>

            <!-- Statut du site -->
            <div class="col-lg-2">
                <h5 class="text-white mb-3">{{ __('footer.site_status.title') }}</h5>
                <div style="width: 40px; height: 3px; background-color: #ffc107;" class="mb-3"></div>
                <div class="bg-dark bg-opacity-25 p-3 rounded">
                    <p class="text-warning mb-2"><i
                            class="fas fa-info-circle me-2"></i>{{ __('footer.site_status.status') }}</p>
                    <p class="text-white-50 small mb-0"> {{ __('footer.site_status.description') }}</p>
                </div>
            </div>
        </div>

       <!-- Copyright section -->
       <div class="border-top border-secondary mt-4 pt-4 text-center" style="padding-bottom: 0 !important;">
        <p class="text-white-50 small mb-0">
            &copy; {{ __('footer.copyright') }}
            <br>
          
        </p>
    </div>
</div>
</footer>

@push('styles')
<style>
footer {
    padding-bottom: 0 !important;
    margin-bottom: 0 !important;
}

footer .container {
    padding-bottom: 0 !important;
    margin-bottom: 0 !important;
}

footer .border-top {
    padding-bottom: 0 !important;
    margin-bottom: 0 !important;
}
</style>
@endpush