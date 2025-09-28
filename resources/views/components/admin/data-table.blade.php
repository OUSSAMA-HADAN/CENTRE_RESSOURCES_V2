<div class="card border-0 shadow-sm">
    @if(isset($title) || isset($actions))
        <div class="card-header bg-transparent d-flex justify-content-between align-items-center py-3">
            @if(isset($title))
                <h5 class="mb-0">{{ $title }}</h5>
            @endif
            
            @if(isset($actions))
                <div class="actions">
                    {{ $actions }}
                </div>
            @endif
        </div>
    @endif
    
    <div class="card-body p-0">
        <!-- Barre de recherche et filtres -->
        @if(isset($filters))
            <div class="p-3 border-bottom">
                {{ $filters }}
            </div>
        @endif
        
        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle data-table {{ isset($tableClass) ? $tableClass : '' }}">
                <thead class="bg-light">
                    <tr>
                        @if(isset($checkAll))
                            <th width="40">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="checkAll">
                                    <label class="form-check-label" for="checkAll"></label>
                                </div>
                            </th>
                        @endif
                        
                        {{ $headers }}
                    </tr>
                </thead>
                <tbody>
                    @if(isset($noData) && (!isset($rows) || empty($rows) || (is_countable($rows) && count($rows) === 0)))
                        <tr>
                            <td colspan="{{ $colspan ?? '100%' }}" class="text-center py-5">
                                <div class="py-4">
                                    <i class="bi bi-inbox fs-1 text-muted d-block mb-3"></i>
                                    <h6 class="text-muted mb-1">{{ $noDataTitle ?? 'Aucune donnée' }}</h6>
                                    <p class="text-muted mb-3">{{ $noDataMessage ?? 'Aucune donnée disponible dans ce tableau.' }}</p>
                                    
                                    @if(isset($noDataAction))
                                        {{ $noDataAction }}
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @else
                        {{ $rows }}
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    
    @if(isset($pagination))
        <div class="card-footer bg-transparent">
            {{ $pagination }}
        </div>
    @endif
</div>

<style>
    .data-table th {
        font-weight: 600;
        font-size: 0.875rem;
        color: #6c757d;
        border-top: none;
        white-space: nowrap;
    }
    
    .data-table td {
        vertical-align: middle;
        padding-top: 0.875rem;
        padding-bottom: 0.875rem;
    }
    
    .data-table.table-hover tbody tr:hover {
        background-color: rgba(16, 185, 129, 0.05);
    }
    
    /* Style pour les cases à cocher */
    .data-table .form-check-input {
        cursor: pointer;
    }
    
    .data-table .form-check-input:checked {
        background-color: #10b981;
        border-color: #10b981;
    }
    
    /* Support RTL */
    .rtl .data-table .me-2 {
        margin-right: 0 !important;
        margin-left: 0.5rem !important;
    }
    
    /* Style pour les boutons d'action */
    .table-action-btn {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 0.375rem;
        transition: all 0.2s ease;
        background-color: transparent;
        color: #6c757d;
        border: none;
    }
    
    .table-action-btn:hover {
        background-color: rgba(16, 185, 129, 0.1);
        color: #10b981;
    }
    
    .table-action-btn.edit:hover {
        background-color: rgba(16, 185, 129, 0.1);
        color: #10b981;
    }
    
    .table-action-btn.delete:hover {
        background-color: rgba(220, 53, 69, 0.1);
        color: #dc3545;
    }
    
    .table-action-btn.view:hover {
        background-color: rgba(13, 110, 253, 0.1);
        color: #0d6efd;
    }
    
    /* Status badges */
    .badge-success {
        background-color: rgba(16, 185, 129, 0.1);
        color: #10b981;
    }
    
    .badge-warning {
        background-color: rgba(255, 193, 7, 0.1);
        color: #ffc107;
    }
    
    .badge-danger {
        background-color: rgba(220, 53, 69, 0.1);
        color: #dc3545;
    }
    
    .badge-info {
        background-color: rgba(13, 202, 240, 0.1);
        color: #0dcaf0;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Gestion du "Tout cocher"
        const checkAllBox = document.getElementById('checkAll');
        
        if (checkAllBox) {
            checkAllBox.addEventListener('change', function() {
                const checked = this.checked;
                document.querySelectorAll('.data-table tbody .form-check-input').forEach(item => {
                    item.checked = checked;
                });
            });
            
            // Vérifier si toutes les cases sont cochées
            function updateCheckAllState() {
                const checkboxes = document.querySelectorAll('.data-table tbody .form-check-input');
                const checkedCount = document.querySelectorAll('.data-table tbody .form-check-input:checked').length;
                
                checkAllBox.checked = checkboxes.length > 0 && checkedCount === checkboxes.length;
                checkAllBox.indeterminate = checkedCount > 0 && checkedCount < checkboxes.length;
            }
            
            // Ajouter des écouteurs d'événements à chaque case
            document.querySelectorAll('.data-table tbody .form-check-input').forEach(item => {
                item.addEventListener('change', updateCheckAllState);
            });
        }
    });
</script>