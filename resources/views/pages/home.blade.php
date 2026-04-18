@extends('layouts.base')
@section('title', 'Tableau de bord')

@section('content')

    <div class="breadcrumb">
        <h3>
            Tableau de bord
        </h3>

        <div class="breadcrumbs">
                <a href="#">
                <i class="las la-home"></i>
                <span>Accueil</span>
            </a>

            <span class="separator">/</span>

            <a href="#">
                Factures
            </a>

            <span class="separator">/</span>

            <span class="current">
                Détails
            </span>
        </div>
    </div>

    <div class="container">
      <div class="card">
        <h2><i class="la la-hand-wave"></i> Bienvenue 👋</h2>
        <p>Gère tes invitations facilement et professionnellement.</p>
      </div>

      <div class="card">
        <h3><i class="la la-history"></i> Invitations récentes</h3>
        <p>Aucune invitation pour le moment.</p>
      </div>

          <div class="app-tab-container">
        <div class="app-tab-header">
            <h2 class="app-tab-title">Liste des factures</h2>
            <input type="text" class="app-tab-search" placeholder="Rechercher...">
        </div>

        <div class="app-tab-wrapper">
            <table class="app-tab-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Client</th>
                        <th>Date</th>
                        <th>Montant</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Jean Dupont</td>
                        <td>2026-04-17</td>
                        <td>$120</td>
                        <td><span class="app-tab-badge success">Payé</span></td>
                        <td>
                            <button class="app-tab-btn">Voir</button>
                            <button class="app-tab-btn danger">Supprimer</button>
                        </td>
                    </tr>

                    <tr>
                        <td>2</td>
                        <td>Marie Claire</td>
                        <td>2026-04-16</td>
                        <td>$80</td>
                        <td><span class="app-tab-badge warning">En attente</span></td>
                        <td>
                            <button class="app-tab-btn btn-primary"><i class="la la-eye"></i> Voir</button>
                            <button class="app-tab-btn btn-danger">Supprimer</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    </div>

@endsection