<div class="language-switcher-modern">
    <a href="{{ route('language.switch', app()->getLocale() == 'fr' ? 'ar' : 'fr') }}" 
       class="language-btn-modern">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="language-icon">
            <path stroke-linecap="round" stroke-linejoin="round" d="m10.5 21 5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 0 1 6-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896.061 1.785.147 2.666.257m-4.589 8.495a18.023 18.023 0 0 1-3.827-5.802"></path>
        </svg>
        <span class="language-text">{{ app()->getLocale() == 'fr' ? 'FR' : 'AR' }}</span>
        <div class="language-indicator"></div>
    </a>
</div>

<style>
    .language-switcher-modern {
        position: relative;
        display: inline-block;
    }

    .language-btn-modern {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(255, 255, 255, 0.1);
        border: 2px solid rgba(255, 255, 255, 0.2);
        border-radius: 12px;
        padding: 0.5rem 1rem;
        text-decoration: none;
        color: white;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        backdrop-filter: blur(10px);
        position: relative;
        overflow: hidden;
        font-weight: 500;
        font-size: 0.9rem;
    }

    .language-btn-modern:hover {
        background: rgba(255, 255, 255, 0.2);
        border-color: rgba(255, 255, 255, 0.3);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        color: white;
        text-decoration: none;
    }

    .language-icon {
        width: 20px;
        height: 20px;
        transition: all 0.3s ease;
    }

    .language-btn-modern:hover .language-icon {
        transform: rotate(15deg) scale(1.1);
    }

    .language-text {
        font-weight: 600;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
        transition: all 0.3s ease;
    }

    .language-indicator {
        position: absolute;
        top: 50%;
        right: 8px;
        transform: translateY(-50%);
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.8);
        animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% { 
            opacity: 0.8; 
            transform: translateY(-50%) scale(1); 
        }
        50% { 
            opacity: 1; 
            transform: translateY(-50%) scale(1.2); 
        }
    }

    /* Dark theme support */
    .language-btn-modern.dark-theme {
        background: rgba(0, 0, 0, 0.1);
        border-color: rgba(0, 0, 0, 0.2);
        color: #333;
    }

    .language-btn-modern.dark-theme:hover {
        background: rgba(0, 0, 0, 0.2);
        border-color: rgba(0, 0, 0, 0.3);
        color: #333;
    }

    .language-btn-modern.dark-theme .language-text {
        text-shadow: 0 1px 2px rgba(255, 255, 255, 0.3);
    }

    .language-btn-modern.dark-theme .language-indicator {
        background: rgba(0, 0, 0, 0.6);
    }
</style>