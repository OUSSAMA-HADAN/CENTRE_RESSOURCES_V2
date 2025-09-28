@props(['message' => 'Chargement...'])

<div class="loader-overlay" id="loader" style="display: none;">
    <div class="loader-container">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Chargement...</span>
        </div>
        <p class="mt-3 mb-0">{{ $message }}</p>
    </div>
</div>

<style>
    .loader-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 9999;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    
    .loader-container {
        background-color: white;
        border-radius: 8px;
        padding: 2rem;
        text-align: center;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }
    
    .loader-container .spinner-border {
        width: 3rem;
        height: 3rem;
        color: #10B981;
    }
</style>

<script>
    function showLoader() {
        document.getElementById('loader').style.display = 'flex';
    }
    
    function hideLoader() {
        document.getElementById('loader').style.display = 'none';
    }
</script>