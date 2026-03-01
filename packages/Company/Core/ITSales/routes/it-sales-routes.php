<?php

use Illuminate\Support\Facades\Route;
use Company\Core\ITSales\Http\Controllers\ServiceController;
use Company\Core\ITSales\Http\Controllers\ProposalController;
use Company\Core\ITSales\Http\Controllers\RequirementController;
use Company\Core\ITSales\Http\Controllers\EstimationController;
use Company\Core\ITSales\Http\Controllers\ApprovalController;
use Company\Core\ITSales\Http\Controllers\ProjectHandoverController;
use Company\Core\ITSales\Http\Controllers\LeadExtensionController;
use Company\Core\ITSales\Http\Controllers\LeadAttachmentController;
use Company\Core\ITSales\Http\Controllers\LeadLifecycleController;

Route::group([
    'prefix' => 'admin/it-sales',
    'middleware' => ['web', 'user'],
], function () {

    // ──────────────────────────────────────
    //  Services Catalog
    // ──────────────────────────────────────
    Route::controller(ServiceController::class)->prefix('services')->group(function () {
            Route::get('', 'index')->name('admin.it_sales.services.index');
            Route::get('create', 'create')->name('admin.it_sales.services.create');
            Route::post('', 'store')->name('admin.it_sales.services.store');
            Route::get('{id}/edit', 'edit')->name('admin.it_sales.services.edit');
            Route::put('{id}', 'update')->name('admin.it_sales.services.update');
            Route::delete('{id}', 'destroy')->name('admin.it_sales.services.delete');
        }
        );

        // ──────────────────────────────────────
        //  Proposals & Quotations
        // ──────────────────────────────────────
        Route::controller(ProposalController::class)->prefix('proposals')->group(function () {
            Route::get('', 'index')->name('admin.it_sales.proposals.index');
            Route::get('create/{lead_id?}', 'create')->name('admin.it_sales.proposals.create');
            Route::post('', 'store')->name('admin.it_sales.proposals.store');
            Route::get('{id}/edit', 'edit')->name('admin.it_sales.proposals.edit');
            Route::put('{id}', 'update')->name('admin.it_sales.proposals.update');
            Route::delete('{id}', 'destroy')->name('admin.it_sales.proposals.delete');
            Route::post('{id}/send', 'send')->name('admin.it_sales.proposals.send');
            Route::post('{id}/revise', 'revise')->name('admin.it_sales.proposals.revise');
            Route::get('{id}/print', 'print')->name('admin.it_sales.proposals.print');
        }
        );

        // ──────────────────────────────────────
        //  Requirement Analysis
        // ──────────────────────────────────────
        Route::controller(RequirementController::class)->prefix('requirements')->group(function () {
            Route::get('', 'index')->name('admin.it_sales.requirements.index');
            Route::get('create/{lead_id?}', 'create')->name('admin.it_sales.requirements.create');
            Route::post('', 'store')->name('admin.it_sales.requirements.store');
            Route::get('{id}/edit', 'edit')->name('admin.it_sales.requirements.edit');
            Route::put('{id}', 'update')->name('admin.it_sales.requirements.update');
            Route::delete('{id}', 'destroy')->name('admin.it_sales.requirements.delete');
        }
        );

        // ──────────────────────────────────────
        //  Technical Estimation
        // ──────────────────────────────────────
        Route::controller(EstimationController::class)->prefix('estimations')->group(function () {
            Route::get('', 'index')->name('admin.it_sales.estimations.index');
            Route::get('create/{proposal_id?}', 'create')->name('admin.it_sales.estimations.create');
            Route::post('', 'store')->name('admin.it_sales.estimations.store');
            Route::get('{id}/edit', 'edit')->name('admin.it_sales.estimations.edit');
            Route::put('{id}', 'update')->name('admin.it_sales.estimations.update');
            Route::delete('{id}', 'destroy')->name('admin.it_sales.estimations.delete');
        }
        );

        // ──────────────────────────────────────
        //  Multi-Stage Approval
        // ──────────────────────────────────────
        Route::controller(ApprovalController::class)->prefix('approvals')->group(function () {
            Route::get('', 'index')->name('admin.it_sales.approvals.index');
            Route::post('{id}/approve', 'approve')->name('admin.it_sales.approvals.approve');
            Route::post('{id}/reject', 'reject')->name('admin.it_sales.approvals.reject');
        }
        );

        // ──────────────────────────────────────
        //  Project Handover
        // ──────────────────────────────────────
        Route::controller(ProjectHandoverController::class)->prefix('handovers')->group(function () {
            Route::get('', 'index')->name('admin.it_sales.handovers.index');
            Route::get('create/{lead_id?}', 'create')->name('admin.it_sales.handovers.create');
            Route::post('', 'store')->name('admin.it_sales.handovers.store');
            Route::get('{id}', 'show')->name('admin.it_sales.handovers.show');
            Route::post('{id}/complete', 'complete')->name('admin.it_sales.handovers.complete');
        }
        );

        // ──────────────────────────────────────
        //  Lead Extensions (IT fields + scoring)
        // ──────────────────────────────────────
        Route::controller(LeadExtensionController::class)->prefix('leads')->group(function () {
            Route::get('{leadId}/extension', 'show')->name('admin.it_sales.leads.extension.show');
            Route::post('{leadId}/extension', 'store')->name('admin.it_sales.leads.extension.store');
            Route::get('{leadId}/score', 'score')->name('admin.it_sales.leads.score');
            Route::post('scores/recalculate', 'recalculateAll')->name('admin.it_sales.leads.scores.recalculate');
            Route::get('scoreboard', 'scoreboard')->name('admin.it_sales.leads.scoreboard');
        }
        );

        // ──────────────────────────────────────
        //  Lead Attachments
        // ──────────────────────────────────────
        Route::controller(LeadAttachmentController::class)->prefix('leads')->group(function () {
            Route::get('{leadId}/attachments', 'index')->name('admin.it_sales.leads.attachments.index');
            Route::post('{leadId}/attachments', 'store')->name('admin.it_sales.leads.attachments.store');
            Route::get('attachments/{id}/download', 'download')->name('admin.it_sales.leads.attachments.download');
            Route::delete('attachments/{id}', 'destroy')->name('admin.it_sales.leads.attachments.delete');
        }
        );

        // ──────────────────────────────────────
        //  Lead Lifecycle Workflow
        // ──────────────────────────────────────
        Route::controller(LeadLifecycleController::class)->group(function () {
            // Status configuration
            Route::get('lifecycle/statuses', 'statuses')->name('admin.it_sales.lifecycle.statuses.index');
            Route::post('lifecycle/statuses', 'storeStatus')->name('admin.it_sales.lifecycle.statuses.store');
            Route::put('lifecycle/statuses/{id}', 'updateStatus')->name('admin.it_sales.lifecycle.statuses.update');
            Route::delete('lifecycle/statuses/{id}', 'deleteStatus')->name('admin.it_sales.lifecycle.statuses.delete');

            // Lead transitions
            Route::post('leads/{leadId}/transition', 'transition')->name('admin.it_sales.leads.transition');
            Route::get('leads/{leadId}/transitions', 'history')->name('admin.it_sales.leads.transitions');

            // Stale leads
            Route::get('leads/stale', 'staleLeads')->name('admin.it_sales.leads.stale');
        }
        );    });
