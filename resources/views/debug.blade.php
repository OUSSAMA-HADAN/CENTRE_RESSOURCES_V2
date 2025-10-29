@extends('layouts.app')

@section('title', 'Debug - Asset Loading Check')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">🔍 Asset Loading Debug</h1>
            
            <div class="card mb-4">
                <div class="card-header">
                    <h5>📊 Loading Status</h5>
                </div>
                <div class="card-body">
                    <div id="loading-status">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <span class="ms-2">Checking assets...</span>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h6>✅ Loaded Assets</h6>
                        </div>
                        <div class="card-body">
                            <ul id="loaded-assets" class="list-group list-group-flush">
                                <!-- Will be populated by JavaScript -->
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h6>❌ Failed Assets</h6>
                        </div>
                        <div class="card-body">
                            <ul id="failed-assets" class="list-group list-group-flush">
                                <!-- Will be populated by JavaScript -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card mt-4">
                <div class="card-header">
                    <h6>📱 Device Information</h6>
                </div>
                <div class="card-body">
                    <div id="device-info">
                        <!-- Will be populated by JavaScript -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const loadedAssets = document.getElementById('loaded-assets');
    const failedAssets = document.getElementById('failed-assets');
    const loadingStatus = document.getElementById('loading-status');
    const deviceInfo = document.getElementById('device-info');
    
    let loadedCount = 0;
    let failedCount = 0;
    
    // Device Information
    deviceInfo.innerHTML = `
        <p><strong>Screen Size:</strong> ${window.innerWidth} x ${window.innerHeight}</p>
        <p><strong>User Agent:</strong> ${navigator.userAgent}</p>
        <p><strong>Viewport:</strong> ${window.innerWidth} x ${window.innerHeight}</p>
        <p><strong>Pixel Ratio:</strong> ${window.devicePixelRatio}</p>
        <p><strong>Language:</strong> ${navigator.language}</p>
    `;
    
    // Check CSS files
    const stylesheets = document.querySelectorAll('link[rel="stylesheet"]');
    stylesheets.forEach(link => {
        const listItem = document.createElement('li');
        listItem.className = 'list-group-item';
        listItem.innerHTML = `
            <div class="d-flex justify-content-between align-items-center">
                <span>📄 ${link.href}</span>
                <span class="badge bg-success">CSS</span>
            </div>
        `;
        loadedAssets.appendChild(listItem);
        loadedCount++;
    });
    
    // Check JS files
    const scripts = document.querySelectorAll('script[src]');
    scripts.forEach(script => {
        const listItem = document.createElement('li');
        listItem.className = 'list-group-item';
        listItem.innerHTML = `
            <div class="d-flex justify-content-between align-items-center">
                <span>📜 ${script.src}</span>
                <span class="badge bg-primary">JS</span>
            </div>
        `;
        loadedAssets.appendChild(listItem);
        loadedCount++;
    });
    
    // Check images
    const images = document.querySelectorAll('img');
    images.forEach(img => {
        const listItem = document.createElement('li');
        listItem.className = 'list-group-item';
        
        if (!img.complete || img.naturalHeight === 0) {
            listItem.innerHTML = `
                <div class="d-flex justify-content-between align-items-center">
                    <span>🖼️ ${img.src}</span>
                    <span class="badge bg-danger">FAILED</span>
                </div>
            `;
            failedAssets.appendChild(listItem);
            failedCount++;
        } else {
            listItem.innerHTML = `
                <div class="d-flex justify-content-between align-items-center">
                    <span>🖼️ ${img.src}</span>
                    <span class="badge bg-success">OK</span>
                </div>
            `;
            loadedAssets.appendChild(listItem);
            loadedCount++;
        }
    });
    
    // Check fonts
    const fontLinks = document.querySelectorAll('link[href*="font"]');
    fontLinks.forEach(link => {
        const listItem = document.createElement('li');
        listItem.className = 'list-group-item';
        listItem.innerHTML = `
            <div class="d-flex justify-content-between align-items-center">
                <span>🔤 ${link.href}</span>
                <span class="badge bg-info">FONT</span>
            </div>
        `;
        loadedAssets.appendChild(listItem);
        loadedCount++;
    });
    
    // Update status
    loadingStatus.innerHTML = `
        <div class="alert alert-success">
            <h6>✅ Check Complete!</h6>
            <p class="mb-0">Loaded: ${loadedCount} assets | Failed: ${failedCount} assets</p>
        </div>
    `;
    
    // Monitor for new errors
    window.addEventListener('error', function(e) {
        if (e.target.tagName === 'IMG' || e.target.tagName === 'LINK' || e.target.tagName === 'SCRIPT') {
            const listItem = document.createElement('li');
            listItem.className = 'list-group-item';
            listItem.innerHTML = `
                <div class="d-flex justify-content-between align-items-center">
                    <span>❌ ${e.target.src || e.target.href}</span>
                    <span class="badge bg-danger">ERROR</span>
                </div>
            `;
            failedAssets.appendChild(listItem);
            failedCount++;
            
            // Update status
            loadingStatus.innerHTML = `
                <div class="alert alert-warning">
                    <h6>⚠️ New Error Detected!</h6>
                    <p class="mb-0">Loaded: ${loadedCount} assets | Failed: ${failedCount} assets</p>
                </div>
            `;
        }
    });
});
</script>
@endsection
