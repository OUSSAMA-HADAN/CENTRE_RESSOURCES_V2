<div class="language-switcher">
    <div class="dropdown">
        <button class="btn dropdown-toggle d-flex align-items-center" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            @if(app()->getLocale() == 'fr')
                <span class="flag-icon me-2">🇫🇷</span> Français
            @else
                <span class="flag-icon me-2">🇲🇦</span> العربية
            @endif
        </button>
        <ul class="dropdown-menu" aria-labelledby="languageDropdown">
            <li>
                <a class="dropdown-item {{ app()->getLocale() == 'fr' ? 'active' : '' }}" href="{{ route('language.switch', 'fr') }}">
                    <span class="flag-icon me-2">🇫🇷</span> Français
                </a>
            </li>
            <li>
                <a class="dropdown-item {{ app()->getLocale() == 'ar' ? 'active' : '' }}" href="{{ route('language.switch', 'ar') }}">
                    <span class="flag-icon me-2">🇲🇦</span> العربية
                </a>
            </li>
        </ul>
    </div>
</div>

<style>
    .language-switcher .dropdown-toggle {
        color: #fff;
    }
    
    .language-switcher .dropdown-toggle::after {
        margin-left: 0.5em;
    }
    
    .language-switcher .dropdown-menu {
        min-width: 10rem;
        padding: 0.5rem 0;
        border: none;
        border-radius: 0.5rem;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }
    
    .language-switcher .dropdown-item {
        padding: 0.5rem 1rem;
    }
    
    .language-switcher .dropdown-item.active {
        background-color: rgba(16, 185, 129, 0.1);
        color: #10B981;
    }
    
    .language-switcher .dropdown-item:hover {
        background-color: rgba(16, 185, 129, 0.05);
    }
</style>