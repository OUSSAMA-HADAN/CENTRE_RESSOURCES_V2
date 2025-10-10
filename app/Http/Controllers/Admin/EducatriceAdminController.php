<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Educatrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class EducatriceAdminController extends Controller
{
    /**
     * Display a listing of educatrices with filters and search.
     */
    public function index(Request $request)
    {
        $query = Educatrice::query();

        // Global search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nom_fr', 'like', "%{$search}%")
                  ->orWhere('nom_ar', 'like', "%{$search}%")
                  ->orWhere('prenom_fr', 'like', "%{$search}%")
                  ->orWhere('prenom_ar', 'like', "%{$search}%")
                  ->orWhere('cin', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('telephone', 'like', "%{$search}%")
                  ->orWhere('etablissement', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($request->filled('statut')) {
            $query->where('status', $request->statut);
        }

        // Institution type filter
        if ($request->filled('type_etablissement')) {
            $query->where('type_etablissement', $request->type_etablissement);
        }

        // Education level filter
        if ($request->filled('niveau_scolaire')) {
            $query->where('niveau_scolaire', $request->niveau_scolaire);
        }

        // Age range filter
        if ($request->filled('age_min')) {
            $query->whereNotNull('date_naissance')
                  ->whereRaw('TIMESTAMPDIFF(YEAR, date_naissance, CURDATE()) >= ?', [$request->age_min]);
        }
        if ($request->filled('age_max')) {
            $query->whereNotNull('date_naissance')
                  ->whereRaw('TIMESTAMPDIFF(YEAR, date_naissance, CURDATE()) <= ?', [$request->age_max]);
        }

        // Date range filter
        if ($request->filled('date_debut')) {
            $query->whereDate('created_at', '>=', $request->date_debut);
        }
        if ($request->filled('date_fin')) {
            $query->whereDate('created_at', '<=', $request->date_fin);
        }

        // Establishment filter
        if ($request->filled('etablissement')) {
            $query->where('etablissement', 'like', "%{$request->etablissement}%");
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'created_at');
        $sortDirection = $request->get('sort_direction', 'desc');
        $query->orderBy($sortBy, $sortDirection);

        // Get statistics for dashboard cards
        $stats = [
            'pending' => Educatrice::where('status', 'pending')->count(),
            'approved' => Educatrice::where('status', 'approved')->count(),
            'rejected' => Educatrice::where('status', 'rejected')->count(),
        ];

        // Paginate results
        $educatrices = $query->paginate(15);

        return view('pages.admin.candidats.index', compact('educatrices', 'stats'));
    }

    /**
     * Export educatrices to Excel (XML format)
     */
    public function exportExcel(Request $request)
    {
        // Build query with same filters as index
        $query = Educatrice::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nom_fr', 'like', "%{$search}%")
                  ->orWhere('nom_ar', 'like', "%{$search}%")
                  ->orWhere('prenom_fr', 'like', "%{$search}%")
                  ->orWhere('prenom_ar', 'like', "%{$search}%")
                  ->orWhere('cin', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('telephone', 'like', "%{$search}%")
                  ->orWhere('etablissement', 'like', "%{$search}%");
            });
        }

        if ($request->filled('statut')) {
            $query->where('status', $request->statut);
        }

        if ($request->filled('type_etablissement')) {
            $query->where('type_etablissement', $request->type_etablissement);
        }

        if ($request->filled('niveau_scolaire')) {
            $query->where('niveau_scolaire', $request->niveau_scolaire);
        }

        if ($request->filled('age_min')) {
            $query->whereNotNull('date_naissance')
                  ->whereRaw('TIMESTAMPDIFF(YEAR, date_naissance, CURDATE()) >= ?', [$request->age_min]);
        }

        if ($request->filled('age_max')) {
            $query->whereNotNull('date_naissance')
                  ->whereRaw('TIMESTAMPDIFF(YEAR, date_naissance, CURDATE()) <= ?', [$request->age_max]);
        }

        if ($request->filled('date_debut')) {
            $query->whereDate('created_at', '>=', $request->date_debut);
        }

        if ($request->filled('date_fin')) {
            $query->whereDate('created_at', '<=', $request->date_fin);
        }

        if ($request->filled('etablissement')) {
            $query->where('etablissement', 'like', "%{$request->etablissement}%");
        }

        $sortBy = $request->get('sort_by', 'created_at');
        $sortDirection = $request->get('sort_direction', 'desc');
        $query->orderBy($sortBy, $sortDirection);

        $candidats = $query->get();

        // Status mapping
        $statusMap = [
            'pending' => 'En attente',
            'approved' => 'Accepté',
            'rejected' => 'Refusé',
        ];

        $filename = 'candidats_' . date('Y-m-d_His') . '.xls';

        // Set headers for Excel
        header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Pragma: no-cache');
        header('Expires: 0');

        // Start HTML table with Excel XML
        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<?mso-application progid="Excel.Sheet"?>';
        ?>
        <Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet"
            xmlns:o="urn:schemas-microsoft-com:office:office"
            xmlns:x="urn:schemas-microsoft-com:office:excel"
            xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet"
            xmlns:html="http://www.w3.org/TR/REC-html40">
            
            <Styles>
                <Style ss:ID="header">
                    <Font ss:Bold="1" ss:Size="12" ss:Color="#FFFFFF"/>
                    <Interior ss:Color="#4472C4" ss:Pattern="Solid"/>
                    <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
                    <Borders>
                        <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
                        <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
                        <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
                        <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
                    </Borders>
                </Style>
                <Style ss:ID="title">
                    <Font ss:Bold="1" ss:Size="16"/>
                    <Alignment ss:Horizontal="Center"/>
                </Style>
                <Style ss:ID="subtitle">
                    <Font ss:Italic="1" ss:Size="10"/>
                    <Alignment ss:Horizontal="Center"/>
                </Style>
                <Style ss:ID="pending">
                    <Interior ss:Color="#FFF3CD" ss:Pattern="Solid"/>
                    <Font ss:Bold="1" ss:Color="#856404"/>
                    <Alignment ss:Horizontal="Center"/>
                </Style>
                <Style ss:ID="approved">
                    <Interior ss:Color="#D4EDDA" ss:Pattern="Solid"/>
                    <Font ss:Bold="1" ss:Color="#155724"/>
                    <Alignment ss:Horizontal="Center"/>
                </Style>
                <Style ss:ID="rejected">
                    <Interior ss:Color="#F8D7DA" ss:Pattern="Solid"/>
                    <Font ss:Bold="1" ss:Color="#721C24"/>
                    <Alignment ss:Horizontal="Center"/>
                </Style>
                <Style ss:ID="data">
                    <Borders>
                        <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#DDDDDD"/>
                        <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#DDDDDD"/>
                        <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#DDDDDD"/>
                        <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#DDDDDD"/>
                    </Borders>
                </Style>
                <Style ss:ID="dataAlt">
                    <Interior ss:Color="#F8F9FA" ss:Pattern="Solid"/>
                    <Borders>
                        <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#DDDDDD"/>
                        <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#DDDDDD"/>
                        <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#DDDDDD"/>
                        <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#DDDDDD"/>
                    </Borders>
                </Style>
            </Styles>
            
            <Worksheet ss:Name="Candidats">
                <Table>
                    <Column ss:Width="50"/>
                    <Column ss:Width="120"/>
                    <Column ss:Width="120"/>
                    <Column ss:Width="120"/>
                    <Column ss:Width="120"/>
                    <Column ss:Width="60"/>
                    <Column ss:Width="100"/>
                    <Column ss:Width="150"/>
                    <Column ss:Width="180"/>
                    <Column ss:Width="120"/>
                    <Column ss:Width="120"/>
                    <Column ss:Width="100"/>
                    <Column ss:Width="130"/>
                    
                    <!-- Title Row -->
                    <Row>
                        <Cell ss:MergeAcross="12" ss:StyleID="title">
                            <Data ss:Type="String">CENTRE DE RESSOURCES DU PRÉSCOLAIRE - OUJDA</Data>
                        </Cell>
                    </Row>
                    
                    <!-- Subtitle Row -->
                    <Row>
                        <Cell ss:MergeAcross="12" ss:StyleID="subtitle">
                            <Data ss:Type="String">Liste des Candidats - Exporté le <?= date('d/m/Y à H:i') ?></Data>
                        </Cell>
                    </Row>
                    
                    <!-- Empty Row -->
                    <Row></Row>
                    
                    <!-- Header Row -->
                    <Row>
                        <Cell ss:StyleID="header"><Data ss:Type="String">ID</Data></Cell>
                        <Cell ss:StyleID="header"><Data ss:Type="String">Nom (FR)</Data></Cell>
                        <Cell ss:StyleID="header"><Data ss:Type="String">Nom (AR)</Data></Cell>
                        <Cell ss:StyleID="header"><Data ss:Type="String">Prénom (FR)</Data></Cell>
                        <Cell ss:StyleID="header"><Data ss:Type="String">Prénom (AR)</Data></Cell>
                        <Cell ss:StyleID="header"><Data ss:Type="String">Âge</Data></Cell>
                        <Cell ss:StyleID="header"><Data ss:Type="String">Téléphone</Data></Cell>
                        <Cell ss:StyleID="header"><Data ss:Type="String">Email</Data></Cell>
                        <Cell ss:StyleID="header"><Data ss:Type="String">Établissement</Data></Cell>
                        <Cell ss:StyleID="header"><Data ss:Type="String">Type</Data></Cell>
                        <Cell ss:StyleID="header"><Data ss:Type="String">Niveau</Data></Cell>
                        <Cell ss:StyleID="header"><Data ss:Type="String">Statut</Data></Cell>
                        <Cell ss:StyleID="header"><Data ss:Type="String">Date d'inscription</Data></Cell>
                    </Row>
                    
                    <!-- Data Rows -->
                    <?php $row = 0; foreach ($candidats as $candidat): $row++; ?>
                    <Row>
                        <Cell ss:StyleID="<?= $row % 2 == 0 ? 'dataAlt' : 'data' ?>">
                            <Data ss:Type="Number"><?= $candidat->id ?></Data>
                        </Cell>
                        <Cell ss:StyleID="<?= $row % 2 == 0 ? 'dataAlt' : 'data' ?>">
                            <Data ss:Type="String"><?= htmlspecialchars($candidat->nom_fr) ?></Data>
                        </Cell>
                        <Cell ss:StyleID="<?= $row % 2 == 0 ? 'dataAlt' : 'data' ?>">
                            <Data ss:Type="String"><?= htmlspecialchars($candidat->nom_ar ?? '') ?></Data>
                        </Cell>
                        <Cell ss:StyleID="<?= $row % 2 == 0 ? 'dataAlt' : 'data' ?>">
                            <Data ss:Type="String"><?= htmlspecialchars($candidat->prenom_fr) ?></Data>
                        </Cell>
                        <Cell ss:StyleID="<?= $row % 2 == 0 ? 'dataAlt' : 'data' ?>">
                            <Data ss:Type="String"><?= htmlspecialchars($candidat->prenom_ar ?? '') ?></Data>
                        </Cell>
                        <Cell ss:StyleID="<?= $row % 2 == 0 ? 'dataAlt' : 'data' ?>">
                            <Data ss:Type="String"><?= $candidat->age ?? 'N/A' ?></Data>
                        </Cell>
                        <Cell ss:StyleID="<?= $row % 2 == 0 ? 'dataAlt' : 'data' ?>">
                            <Data ss:Type="String"><?= htmlspecialchars($candidat->telephone ?? '') ?></Data>
                        </Cell>
                        <Cell ss:StyleID="<?= $row % 2 == 0 ? 'dataAlt' : 'data' ?>">
                            <Data ss:Type="String"><?= htmlspecialchars($candidat->email ?? 'N/A') ?></Data>
                        </Cell>
                        <Cell ss:StyleID="<?= $row % 2 == 0 ? 'dataAlt' : 'data' ?>">
                            <Data ss:Type="String"><?= htmlspecialchars($candidat->etablissement) ?></Data>
                        </Cell>
                        <Cell ss:StyleID="<?= $row % 2 == 0 ? 'dataAlt' : 'data' ?>">
                            <Data ss:Type="String"><?= ucfirst($candidat->type_etablissement) ?></Data>
                        </Cell>
                        <Cell ss:StyleID="<?= $row % 2 == 0 ? 'dataAlt' : 'data' ?>">
                            <Data ss:Type="String"><?= ucfirst($candidat->niveau_scolaire) ?></Data>
                        </Cell>
                        <Cell ss:StyleID="<?= $candidat->status ?>">
                            <Data ss:Type="String"><?= $statusMap[$candidat->status] ?? $candidat->status ?></Data>
                        </Cell>
                        <Cell ss:StyleID="<?= $row % 2 == 0 ? 'dataAlt' : 'data' ?>">
                            <Data ss:Type="String"><?= $candidat->created_at->format('d/m/Y H:i') ?></Data>
                        </Cell>
                    </Row>
                    <?php endforeach; ?>
                    
                    <!-- Summary -->
                    <Row></Row>
                    <Row></Row>
                    <Row>
                        <Cell ss:StyleID="header"><Data ss:Type="String">RÉSUMÉ</Data></Cell>
                    </Row>
                    <Row>
                        <Cell><Data ss:Type="String">Total des candidats:</Data></Cell>
                        <Cell><Data ss:Type="Number"><?= $candidats->count() ?></Data></Cell>
                    </Row>
                    <Row>
                        <Cell><Data ss:Type="String">En attente:</Data></Cell>
                        <Cell><Data ss:Type="Number"><?= $candidats->where('status', 'pending')->count() ?></Data></Cell>
                    </Row>
                    <Row>
                        <Cell><Data ss:Type="String">Acceptés:</Data></Cell>
                        <Cell><Data ss:Type="Number"><?= $candidats->where('status', 'approved')->count() ?></Data></Cell>
                    </Row>
                    <Row>
                        <Cell><Data ss:Type="String">Refusés:</Data></Cell>
                        <Cell><Data ss:Type="Number"><?= $candidats->where('status', 'rejected')->count() ?></Data></Cell>
                    </Row>
                </Table>
            </Worksheet>
        </Workbook>
        <?php
        exit;
    }

    /**
     * Handle bulk actions on multiple candidates
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:approve,reject,delete',
            'ids' => 'required|array',
            'ids.*' => 'exists:educatrices,id'
        ]);

        $action = $request->action;
        $ids = $request->ids;

        try {
            DB::beginTransaction();

            switch ($action) {
                case 'approve':
                    Educatrice::whereIn('id', $ids)->update(['status' => 'approved']);
                    $message = count($ids) . ' candidat(s) approuvé(s) avec succès';
                    break;
                    
                case 'reject':
                    Educatrice::whereIn('id', $ids)->update(['status' => 'rejected']);
                    $message = count($ids) . ' candidat(s) refusé(s) avec succès';
                    break;
                    
                case 'delete':
                    Educatrice::whereIn('id', $ids)->delete();
                    $message = count($ids) . ' candidat(s) supprimé(s) avec succès';
                    break;
                    
                default:
                    throw new \Exception('Action non valide');
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => $message
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified educatrice with full details.
     */
    public function show($id)
    {
        $educatrice = Educatrice::findOrFail($id);
        return view('pages.admin.candidats.show', compact('educatrice'));
    }

    /**
     * Show the form for editing the specified educatrice.
     */
    public function edit($id)
    {
        $educatrice = Educatrice::findOrFail($id);
        return view('pages.admin.candidats.edit', compact('educatrice'));
    }

    /**
     * Update the specified educatrice in storage.
     */
    public function update(Request $request, $id)
    {
        $educatrice = Educatrice::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'nom_fr' => 'required|string|max:255',
            'nom_ar' => 'nullable|string|max:255',
            'prenom_fr' => 'required|string|max:255',
            'prenom_ar' => 'nullable|string|max:255',
            'cin' => 'required|string|max:20|unique:educatrices,cin,' . $educatrice->id,
            'etablissement' => 'required|string|max:255',
            'type_etablissement' => 'required|in:private,public',
            'niveau_scolaire' => 'required|string|max:255',
            'annees_experience' => 'nullable|integer|min:0',
            'email' => 'nullable|email|max:255|unique:educatrices,email,' . $educatrice->id,
            'telephone' => 'nullable|string|max:20',
            'date_naissance' => 'nullable|date|before:today',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $educatrice->update($request->all());

            return redirect()->route('admin.candidats.index')
                ->with('success', 'Les informations ont été mises à jour avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Une erreur est survenue lors de la mise à jour: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified educatrice from storage (soft delete).
     */
    public function destroy($id)
    {
        try {
            $educatrice = Educatrice::findOrFail($id);
            $educatrice->delete();
            
            return redirect()->route('admin.candidats.index')
                ->with('success', 'L\'éducatrice a été supprimée avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Une erreur est survenue lors de la suppression.');
        }
    }
}